<?php

namespace App\Http\Requests;

use App\Traits\RulesOperations;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClinicRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    } //end of authorize


    public function rules(): array
    {
        $rules =  [
            'ar.name' => ['required', 'string', 'min:5', 'max:100', 'unique:clinic_translations,name,NULL,id,locale,ar'],
            'en.name' => ['required', 'string', 'min:5', 'max:100', 'unique:clinic_translations,name,NULL,id,locale,en'],
            'number' => ['required', 'regex:[^\d+$]', 'string', 'min:7', 'max:7', 'unique:clinics,number'],
            'email' => ['required', 'email', 'unique:clinics,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string'],
            'departments' => ['required', 'array', 'min:1'],
            'days' => ['required', 'array', 'min:1'],
            'address' => ['required', 'min:5', 'string'],
            'city' => ['required', 'in:1,2,3,4,5,6,7,8,9,10,11,12,13'],
            'postal_code' => ['required', 'regex:[^\d+$]', 'min:5', 'max:5', 'string'],
            'phone' => ['required', 'regex:[^(\+962)?0?(7[789]\d{7}|0(6|2|3|5)\d{7})$]', 'min:6', 'max:15', 'string'],
            'open_hours' => ['required', 'date_format:H:i'],
            'close_hours' => ['required', 'date_format:H:i'],
            'image' => ['sometimes', 'image', 'max:1024'],
            'owner_name' => ['required', 'min:5', 'max:100', 'string'],
            'owner_phone' => ['required', 'regex:[^(\+962)?0?(7[789]\d{7}|0(6|2|3|5)\d{7})$]', 'min:6', 'max:15', 'string'],
            'owner_email' => ['required', 'email'],
        ];

        if ($this->getMethod() == 'PUT') {
            unset($rules['password'], $rules['password_confirmation']);
            array_pop($rules['ar.name']);
            array_pop($rules['en.name']);
            array_pop($rules['number']);
            array_pop($rules['email']);

            $rules['ar.name'] = [
                ...$rules['ar.name'],
                Rule::unique('clinic_translations', 'name')->where('locale','ar')->ignore($this->clinic->id, 'clinic_id'),
            ];
            $rules['en.name'] = [
                ...$rules['en.name'],
                Rule::unique('clinic_translations', 'name')->where('locale','en')->ignore($this->clinic->id, 'clinic_id'),
            ];
            $rules['number'] = [
                ...$rules['number'],
                Rule::unique('clinics', 'number')->ignore($this->clinic->id, 'id'),
            ];
            $rules['email'] = [
                ...$rules['email'],
                Rule::unique('clinics', 'email')->ignore($this->clinic->id, 'id'),
            ];

        }


        return $rules;
    } //end of rules


 

}
