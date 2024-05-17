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
       
    }//end of rules

    public function selectedRules(): array {

        if($this->type == 'admin'){
            return [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(Admin::class)->ignore($this->user()->id)],
                'phone' => ['required','min:10','max:15', 'string', 'regex:[^(\+962)?0?(7[789]\d{7}|0(6|2|3|5)\d{7})$]'],
                'image' => ['mimes:png,jpg,jpeg','max:1024'],
            ];
        }

    }


}
