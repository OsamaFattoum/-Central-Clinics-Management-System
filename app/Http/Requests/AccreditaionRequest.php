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


    public function messages()
    {
        return [
            'name.required' => __('clinic_accreditations.name.required'),
            'name.string' => __('clinic_accreditations.name.string'),
            'name.min' => __('clinic_accreditations.name.min'),
            'name.max' => __('clinic_accreditations.name.max'),
            'name.unique' => __('clinic_accreditations.name.unique'),
        ];
        
        
    }//end of messages
    
}
