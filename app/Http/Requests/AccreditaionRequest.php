<?php

namespace App\Http\Requests;

use App\Rules\UniqueAccreditaionByClinicRule;
use App\Rules\UniqueAccreditationName;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AccreditaionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules =  [
            'name' => ['required','string','min:2','max:100',new UniqueAccreditationName($this->clinic->id)],

        ];

        if ($this->getMethod() == 'PUT') {

            array_pop($rules['name']);

            $rules['name'] = [
                ...$rules['name'],
                new UniqueAccreditationName($this->clinic->id,$this->accreditation)
            ];
        }

        return $rules;
    }//end of rules
    
}
