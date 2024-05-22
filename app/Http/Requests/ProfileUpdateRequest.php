<?php

namespace App\Http\Requests;

use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{

    public function rules(): array
    {
        return $this->selectedRules();
    } //end of rules

    public function selectedRules(): array
    {

        if ($this->type == 'admin') {
            return [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(Admin::class)->ignore($this->user()->id)],
                'phone' => ['required', 'min:10', 'max:15', 'string', 'regex:[^(\+962)?0?(7[789]\d{7}|0(6|2|3|5)\d{7})$]'],
                'image' => ['mimes:png,jpg,jpeg', 'max:1024'],
            ];
        } elseif ($this->type == 'clinic') {
            return [
                'ar.name' => ['required', 'string', 'min:5', 'max:100', Rule::unique('clinic_translations', 'name')->where('locale', 'ar')->ignore($this->user()->id, 'clinic_id')],
                'en.name' => ['required', 'string', 'min:5', 'max:100', Rule::unique('clinic_translations', 'name')->where('locale', 'en')->ignore($this->user()->id, 'clinic_id')],
                'email' => ['required', 'email',Rule::unique('clinics', 'email')->ignore($this->user()->id, 'id')],
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
        }
    }
}
