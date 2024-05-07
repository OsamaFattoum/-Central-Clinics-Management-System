<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecordRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }//end of authorize


    public function rules(): array
    {
        $rules = [
            'case_type' => ['required','exists:case_types,id'],
            'measurement_unit' => ['string','nullable','max:20'],
            'result' => ['required','in:0,1,2,3'],
            'reference_range' => ['string','nullable','max:15'], 
            'value' => ['required','string','min:5'],
        ];

        return $rules;
    }//end of rules

    public function messages()
    {

        return [
            'case_type.required' =>  __('records.case_type.required'),
            'case_type.exists' => __('records.case_type.exists'),
            'measurement_unit.string' =>  __('records.measurement_unit.string'),
            'measurement_unit.max' => __('records.measurement_unit.max'),
            'result.required' =>  __('records.result.required'),
            'result.in' =>  __('records.result.in'),
            'reference_range.string' =>  __('records.reference_range.string'),
            'reference_range.max' =>  __('records.reference_range.max'),
            'value.required' =>   __('records.value.required'),
            'value.string' =>  __('records.value.string'),
            'value.min' =>  __('records.value.min'),
        ];
        
    }//end of messages
}
