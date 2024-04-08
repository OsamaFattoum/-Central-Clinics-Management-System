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



    public function messages()
    {
        return  [
            'ar.name.required' => __('validation.name.ar.required'),
            'ar.name.string' => __('validation.name.ar.string'),
            'ar.name.min' => __('validation.name.ar.min'),
            'ar.name.max' => __('validation.name.ar.max'),
            'ar.name.unique' => __('validation.name.ar.unique'),

            'en.name.required' => __('validation.name.en.required'),
            'en.name.string' => __('validation.name.en.string'),
            'en.name.min' => __('validation.name.en.min'),
            'en.name.max' => __('validation.name.en.max'),
            'en.name.unique' => __('validation.name.en.unique'),

            'number.required' => __('validation.number.required'),
            'number.regex' => __('validation.number.regex'),
            'number.string' => __('validation.number.string'),
            'number.min' => __('validation.number.min'),
            'number.max' => __('validation.number.max'),
            'number.unique' => __('validation.number.unique'),

            'email.required' => __('validation.email.required'),
            'email.email' => __('validation.email.email'),
            'email.unique' => __('validation.email.unique'),

            'password.required' => __('validation.password.required'),
            'password.string' => __('validation.password.string'),
            'password.min' => __('validation.password.min'),
            'password.confirmed' => __('validation.password.confirmed'),

            'password_confirmation.required' => __('validation.password_confirmation.required'),
            'password_confirmation.string' => __('validation.password_confirmation.string'),

            'days.required' => __('validation.days.required'),
            'days.array' => __('validation.days.array'),
            'days.min' => __('validation.days.min'),

            'address.required' => __('validation.address.required'),
            'address.min' => __('validation.address.min'),
            'address.string' => __('validation.address.string'),

            'city.required' => __('validation.city.required'),
            'city.in' => __('validation.city.in'),

            'postal_code.required' => __('validation.postal_code.required'),
            'postal_code.min' => __('validation.postal_code.min'),
            'postal_code.regex' => __('validation.postal_code.regex'),
            'postal_code.max' => __('validation.postal_code.max'),
            'postal_code.string' => __('validation.postal_code.string'),

            'phone.required' => __('validation.phone.required'),
            'phone.min' => __('validation.phone.min'),
            'phone.max' => __('validation.phone.max'),
            'phone.string' => __('validation.phone.string'),
            'phone.regex' => __('validation.phone.regex'),

            'open_hours.required' => __('validation.open_hours.required'),
            'open_hours.date_format' => __('validation.open_hours.date_format'),

            'close_hours.required' => __('validation.close_hours.required'),
            'close_hours.date_format' => __('validation.close_hours.date_format'),

            'image.image' => __('validation.image.image'),
            'image.max' => __('validation.image.max'),

            'owner_name.required' => __('validation.owner_name.required'),
            'owner_name.min' => __('validation.owner_name.min'),
            'owner_name.max' => __('validation.owner_name.max'),
            'owner_name.string' => __('validation.owner_name.string'),

            'owner_phone.required' => __('validation.owner_phone.required'),
            'owner_phone.min' => __('validation.owner_phone.min'),
            'owner_phone.max' => __('validation.owner_phone.max'),
            'owner_phone.string' => __('validation.owner_phone.string'),
            'owner_phone.regex' => __('validation.phone.regex'),


            'owner_email.required' => __('validation.owner_email.required'),
            'owner_email.email' => __('validation.owner_email.email'),
        ];
    } //end of messages


}
