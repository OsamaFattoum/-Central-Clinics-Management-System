<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DerpartmentRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }//end of authorize

 
    public function rules(): array
    {
        $rules =  [
            'ar.name' => ['required','string','min:5','max:100','unique:department_translations,name,NULL,id,locale,ar'],
            'en.name' => ['required','string','different:ar.name','min:5','max:100','unique:department_translations,name,NULL,id,locale,en'],
            'scientific_name' => ['required', 'string', 'max:30'],
            'status' => ['required', 'in:0,1'],
            'image' => ['required','image','mimes:svg,png','max:1024'],
        ];

        if ($this->getMethod() == 'PUT') {

            array_pop($rules['ar.name']);
            array_pop($rules['en.name']);

            $rules['ar.name'] = [
                ...$rules['ar.name'],
                Rule::unique('department_translations', 'name')->where('locale','ar')->ignore($this->department->id, 'department_id'),
            ];
            $rules['en.name'] = [
                ...$rules['en.name'],
                Rule::unique('department_translations', 'name')->where('locale','en')->ignore($this->department->id, 'department_id'),
            ];
        }

        return $rules;
    }//end of rules


    public function messages()
    {
        return [
            'ar.name.required' => __('departments.name.ar.required'),
            'en.name.required' => __('departments.name.en.required'),
            'ar.name.string' => __('departments.name.string'),
            'en.name.string' => __('departments.name.string'),
            'ar.name.min' => __('departments.name.ar.min'),
            'en.name.max' => __('departments.name.en.max'),
            'ar.name.unique' => __('departments.name.ar.unique'),
            'en.name.unique' => __('departments.name.en.unique'),
            'en.name.different' => __('departments.name.en.different'),
            'scientific_name.required' => __('departments.scientific_name.required'),
            'scientific_name.string' => __('departments.scientific_name.string'),
            'scientific_name.max' => __('departments.scientific_name.max'),
            'status.required' => __('departments.status.required'),
            'status.in' => __('departments.status.in'),
            'image.required' => __('departments.image.required'),
            'image.image' => __('departments.image.image'),
            'image.mimes' => __('departments.image.mimes'),
            'image.max' => __('departments.image.max'),
        ];
    }//end of messages
}
