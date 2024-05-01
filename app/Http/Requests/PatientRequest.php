<?php

namespace App\Http\Requests;

use App\Models\Users\Patient;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PatientRequest extends FormRequest
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
            'ar.name' => ['required', 'string', 'min:5', 'max:100', 'unique:profile_translations,name,NULL,id,locale,ar'],
            'en.name' => ['required', 'string', 'min:5', 'max:100', 'unique:profile_translations,name,NULL,id,locale,en'],
            'civil_id' => ['required', 'regex:[^\d+$]', 'string', 'min:10', 'max:10', 'unique:doctors,civil_id'],
            'email' => ['required', 'email', 'unique:patients,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string'],
            'address' => ['required', 'min:5', 'string'],
            'city' => ['required', 'in:1,2,3,4,5,6,7,8,9,10,11,12,13'],
            'phone' => ['required', 'regex:[^(\+962)?0?(7[789]\d{7}|0(6|2|3|5)\d{7})$]', 'min:6', 'max:15', 'string'],
            'gender' => ['required', 'in:0,1'],
            'dob' => ['required', 'date'],
            'blood_type' => ['required', 'exists:blood_types,id'],
        ];

        if ($this->getMethod() == 'PUT') {

            $profile_id = Patient::findOrFail($this->patient->id)->profile->id;

            unset($rules['password'], $rules['password_confirmation']);
            array_pop($rules['ar.name']);
            array_pop($rules['en.name']);
            array_pop($rules['civil_id']);
            array_pop($rules['email']);


            $rules['ar.name'] = [
                ...$rules['ar.name'],
                Rule::unique('profile_translations', 'name')->where('locale','ar')->ignore($profile_id, 'profile_id'),
            ];
            $rules['en.name'] = [
                ...$rules['en.name'],
                Rule::unique('profile_translations', 'name')->where('locale','en')->ignore($profile_id, 'profile_id'),
            ];

            $rules['civil_id'] = [
                ...$rules['civil_id'],
                Rule::unique('patients', 'civil_id')->ignore($this->patient->id, 'id'),
            ];
            $rules['email'] = [
                ...$rules['email'],
                Rule::unique('patients', 'email')->ignore($this->patient->id, 'id'),
            ];
        }

        return $rules;
    }
}
