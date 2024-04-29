<?php

namespace App\Http\Requests;

use App\Rules\UniqueCaseTypeName;
use Illuminate\Foundation\Http\FormRequest;

class CaseTypeRequest extends FormRequest
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
            'ar.name' => ['required', 'string', 'min:2', 'max:100', new UniqueCaseTypeName($this->department->id, 'ar')],
            'en.name' => ['required', 'string', 'min:2', 'max:100', new UniqueCaseTypeName($this->department->id, 'en')],

        ];

        if ($this->getMethod() == 'PUT') {
            foreach (config('translatable.locales') as  $locale) {

                array_pop($rules[$locale .'.name']);
            
                $rules[$locale .'.name'] = [
                    ...$rules[$locale .'.name'],
                    new UniqueCaseTypeName($this->department->id,$locale ,$this->case_type->id)
                ];
            }
        }

        return $rules;
    } //end of rules

    public function messages()
    {
        return [
            'ar.name.required' => __('case_type.ar.name.required'),
            'en.name.required' => __('case_type.en.name.required'),
            'ar.name.string' => __('case_type.name.string'),
            'en.name.string' => __('case_type.name.string'),
            'ar.name.min' => __('case_type.name.min'),
            'en.name.min' => __('case_type.name.min'),
            'ar.name.max' => __('case_type.name.max'),
            'en.name.max' => __('case_type.name.max'),
        ];
    } //end of messages
}
