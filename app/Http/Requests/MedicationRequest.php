<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MedicationRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    } //end of authorize

    public function rules(): array
    {
        $rules =  [
            'department' => ['required', 'exists:departments,id'],
            'case_type' => ['required', 'exists:case_types,id'],
            'name' => ['required', 'string', 'min:5', 'max:100', Rule::unique('medications')->where(function ($query) {
                return $query->where('patient_id', $this->patient->id);
            })],
            'dosage' => ['required', 'string', 'max:100'],
            'instructions' => ['required', 'string', 'min:5'],

        ];

        if ($this->getMethod() == 'PUT') {

            array_pop($rules['name']);


            $rules['name'] = [
                ...$rules['name'],
                Rule::unique('medications', 'name')->where(function ($query) {
                    return $query->where('patient_id', $this->patient->id);
                })->ignore($this->medication->id, 'id'),
            ];

            $rules['medication_taken'] = ['required'];
            $rules['has_alternative'] = ['required'];
        }

        return $rules;
    } //end of rules


    public function messages()
    {
        return [
            'department.required' => __('medications.department.required'),
            'department.exists' => __('medications.department.exists'),
            'case_type.required' => __('medications.case_type.required'),
            'case_type.exists' => __('medications.case_type.exists'),
            'name.required' => __('medications.name.required'),
            'name.string' => __('medications.name.string'),
            'name.min' => __('medications.name.min'),
            'name.max' => __('medications.name.max'),
            'name.unique' => __('medications.name.unique'),
            'dosage.required' => __('medications.dosage.required'),
            'dosage.string' => __('medications.dosage.string'),
            'dosage.max' => __('medications.dosage.max'),
            'instructions.required' => __('medications.instructions.required'),
            'instructions.string' => __('medications.instructions.string'),
            'instructions.max' => __('medications.instructions.max'),
            'medication_taken.required' => __('medications.medication_taken.required'),
            'has_alternative.required' => __('medications.has_alternative.required'),
        ];
    } //end of messages
}
