<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }//end of authorize

    public function rules(): array
    {
        $rules = [];
        switch ($this->type) {
            case 'admin':
                $rules = [
                    'email' => ['required', 'email'],
                ];
                break;
            case 'clinic':
            case 'pharmacy':
                $rules =  [
                    'number' => ['required', 'string', 'min:7', 'max:7'],
                ];
                break;
            case 'doctor':
                $rules =  [
                    'job_number' => ['required', 'string', 'min:9', 'max:13'],
                ];
                break;
            case 'patient':
                $rules =  [
                    'civil_id' => ['required', 'string', 'min:10', 'max:10'],
                ];
                break;
            default:
                $rules =  [
                    'civil_id' => ['required', 'string', 'min:10', 'max:10'],
                ];
        }
        $rules = [
            ...$rules,
            'password' => ['required', 'string','min:8'],
        ];

        return $rules;
    }//end of rules


    
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (!auth($this->type)->attempt($this->getCredentialsForUserType($this->type),$this->remember)) {

            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                $this->checkerKey() => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }//end of authenticate


    protected function checkerKey(): string
    {
        
        $key = '';
        switch ($this->type) {
            case 'admin':
                $key = 'email';
                break;
            case 'clinic':
            case 'pharmacy':
                $key = 'number';
                break;
            case 'doctor':
                $key = 'job_number';
                break;
            case 'patient':
                $key = 'civil_id';
                break;
        };
        return $key;
    } //end of checkerKey

    protected function getCredentialsForUserType(string $userType): array
    {
        switch ($userType) {
            case 'admin':
                return $this->only('email', 'password');
                break;
            case 'clinic':
            case 'pharmacy':
                return $this->only('number', 'password');
                break;
            case 'doctor':
                return $this->only('job_number', 'password');
                break;
            case 'patient':
                return $this->only('civil_id', 'password');
                break;
        }
    } // end of getCredentialsForUserType


    public function ensureIsNotRateLimited(): void
    {
        
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            $this->checkerKey() => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }//end of ensureIsNotRateLimited

   
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string($this->checkerKey())) . '|' . $this->ip());
    }//end of throttleKey



}
