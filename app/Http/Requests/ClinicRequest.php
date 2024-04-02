<?php

namespace App\Http\Requests;

use App\Traits\RulesOperations;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClinicRequest extends FormRequest
{
    use RulesOperations;

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


    public function messages()
    {
        return  [
            'ar.name.required' => __('clinics.name.ar.required'),
            'ar.name.string' => __('clinics.name.ar.string'),
            'ar.name.min' => __('clinics.name.ar.min'),
            'ar.name.max' => __('clinics.name.ar.max'),
            'ar.name.unique' => __('clinics.name.ar.unique'),

            'en.name.required' => __('clinics.name.en.required'),
            'en.name.string' => __('clinics.name.en.string'),
            'en.name.min' => __('clinics.name.en.min'),
            'en.name.max' => __('clinics.name.en.max'),
            'en.name.unique' => __('clinics.name.en.unique'),

            'number.required' => __('clinics.number.required'),
            'number.regex' => __('clinics.number.regex'),
            'number.string' => __('clinics.number.string'),
            'number.min' => __('clinics.number.min'),
            'number.max' => __('clinics.number.max'),
            'number.unique' => __('clinics.number.unique'),

            'email.required' => __('clinics.email.required'),
            'email.email' => __('clinics.email.email'),
            'email.unique' => __('clinics.email.unique'),

            'password.required' => __('clinics.password.required'),
            'password.string' => __('clinics.password.string'),
            'password.min' => __('clinics.password.min'),
            'password.confirmed' => __('clinics.password.confirmed'),

            'password_confirmation.required' => __('clinics.password_confirmation.required'),
            'password_confirmation.string' => __('clinics.password_confirmation.string'),

            'departments.required' => __('clinics.departments.required'),
            'departments.array' => __('clinics.departments.array'),
            'departments.min' => __('clinics.departments.min'),

            'days.required' => __('clinics.days.required'),
            'days.array' => __('clinics.days.array'),
            'days.min' => __('clinics.days.min'),

            'address.required' => __('clinics.address.required'),
            'address.min' => __('clinics.address.min'),
            'address.string' => __('clinics.address.string'),

            'city.required' => __('clinics.city.required'),
            'city.in' => __('clinics.city.in'),

            'postal_code.required' => __('clinics.postal_code.required'),
            'postal_code.min' => __('clinics.postal_code.min'),
            'postal_code.regex' => __('clinics.postal_code.regex'),
            'postal_code.max' => __('clinics.postal_code.max'),
            'postal_code.string' => __('clinics.postal_code.string'),

            'phone.required' => __('clinics.phone.required'),
            'phone.min' => __('clinics.phone.min'),
            'phone.max' => __('clinics.phone.max'),
            'phone.string' => __('clinics.phone.string'),
            'phone.regex' => __('clinics.phone.regex'),

            'open_hours.required' => __('clinics.open_hours.required'),
            'open_hours.date_format' => __('clinics.open_hours.date_format'),

            'close_hours.required' => __('clinics.close_hours.required'),
            'close_hours.date_format' => __('clinics.close_hours.date_format'),

            'image.image' => __('clinics.image.image'),
            'image.max' => __('clinics.image.max'),

            'owner_name.required' => __('clinics.owner_name.required'),
            'owner_name.min' => __('clinics.owner_name.min'),
            'owner_name.max' => __('clinics.owner_name.max'),
            'owner_name.string' => __('clinics.owner_name.string'),

            'owner_phone.required' => __('clinics.owner_phone.required'),
            'owner_phone.min' => __('clinics.owner_phone.min'),
            'owner_phone.max' => __('clinics.owner_phone.max'),
            'owner_phone.string' => __('clinics.owner_phone.string'),
            'owner_phone.regex' => __('clinics.phone.regex'),


            'owner_email.required' => __('clinics.owner_email.required'),
            'owner_email.email' => __('clinics.owner_email.email'),
        ];
    } //end of messages



}
