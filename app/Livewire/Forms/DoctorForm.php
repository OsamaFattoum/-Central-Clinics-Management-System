<?php

namespace App\Livewire\Forms;

use App\Models\Users\Doctor;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class DoctorForm extends Form
{
    #[Validate]
    public $names = [];
    public $civil_id = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $clinic = '';
    public $department = '';
    public $permissions = [];

    public $address = '';
    public $city = '';
    public $phone = '';
    public $gender = '';
    public $dob = ''; // date of birth

    public $onUpdated = false;
    public $doctor_id = '';


    public function rules()
    {
        $rules =  [
            'names.ar' => ['required', 'string', 'min:5', 'max:100', 'unique:profile_translations,name,NULL,id,locale,ar'],
            'names.en' => ['required', 'string', 'min:5', 'max:100', 'unique:profile_translations,name,NULL,id,locale,en'],
            'civil_id' => ['required', 'regex:[^\d+$]', 'string', 'min:10', 'max:10', 'unique:doctors,civil_id'],
            'email' => ['required', 'email', 'unique:doctors,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string'],
            'clinic' => ['required', 'regex:[^\d+$]', 'exists:clinics,id'],
            'department' => ['required', 'regex:[^\d+$]', 'exists:departments,id'],
            'permissions' => ['required', 'array', 'min:1'],
            'address' => ['required', 'min:5', 'string'],
            'city' => ['required', 'in:1,2,3,4,5,6,7,8,9,10,11,12,13'],
            'phone' => ['required', 'regex:[^(\+962)?0?(7[789]\d{7}|0(6|2|3|5)\d{7})$]', 'min:6', 'max:15', 'string'],
            'gender' => ['required', 'in:0,1'],
            'dob' => ['required', 'date'],
        ];

        if($this->onUpdated){

            $profile_id = Doctor::findOrFail($this->doctor_id)->profile->id;
      
            unset($rules['password'], $rules['password_confirmation']);
            array_pop($rules['names.ar']);
            array_pop($rules['names.en']);
            array_pop($rules['civil_id']);
            array_pop($rules['email']);

            $rules['names.ar'] = [
                ...$rules['names.ar'],
                Rule::unique('profile_translations', 'name')->where('locale','ar')->ignore($profile_id, 'profile_id'),
            ];
            $rules['names.en'] = [
                ...$rules['names.en'],
                Rule::unique('profile_translations', 'name')->where('locale','en')->ignore($this->doctor_id, 'profile_id'),
            ];
            $rules['civil_id'] = [
                ...$rules['civil_id'],
                Rule::unique('doctors', 'civil_id')->ignore($this->doctor_id, 'id'),
            ];
            $rules['email'] = [
                ...$rules['email'],
                Rule::unique('doctors', 'email')->ignore($this->doctor_id, 'id'),
            ];

        }

        return $rules;
    }
}
