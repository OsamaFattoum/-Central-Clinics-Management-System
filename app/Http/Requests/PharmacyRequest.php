<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PharmacyRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }//end of authorize

    public function rules(): array
    {
        $rules =  [
            'ar.name' => ['required', 'string', 'min:5', 'max:100', 'unique:pharmacy_translations,name,NULL,id,locale,ar'],
            'en.name' => ['required', 'string', 'min:5', 'max:100', 'unique:pharmacy_translations,name,NULL,id,locale,en'],
            'number' => ['required', 'regex:[^\d+$]', 'string', 'min:7', 'max:7', 'unique:pharmacies,number'],
            'email' => ['required', 'email', 'unique:pharmacies,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string'],
            'days' => ['required', 'array', 'min:1'],
            'address' => ['required', 'min:5', 'string'],
            'city' => ['required', 'in:1,2,3,4,5,6,7,8,9,10,11,12,13'],
            'postal_code' => ['required', 'regex:[^\d+$]', 'min:5', 'max:5', 'string'],
            'phone' => ['required', 'regex:[^(\+962)?0?(7[789]\d{7}|0(6|2|3|5)\d{7})$]', 'min:6', 'max:15', 'string',],
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
                Rule::unique('pharmacy_translations', 'name')->where('locale','ar')->ignore($this->pharmacy->id, 'pharmacy_id'),
            ];
            $rules['en.name'] = [
                ...$rules['en.name'],
                Rule::unique('pharmacy_translations', 'name')->where('locale','en')->ignore($this->pharmacy->id, 'pharmacy_id'),
            ];
            $rules['number'] = [
                ...$rules['number'],
                Rule::unique('pharmacies', 'number')->ignore($this->pharmacy->id, 'id'),
            ];
            $rules['email'] = [
                ...$rules['email'],
                Rule::unique('pharmacies', 'email')->ignore($this->pharmacy->id, 'id'),
            ];

        }


        return $rules;
    } //end of rules

}
