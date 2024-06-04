<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }//end of authorize

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'department_id' => ['required','exists:departments,id'],
            'information' => ['required','string'],
        ];
    }//end of rules

    public function messages()
    {

        return [
            'department_id.required' =>  __('transfer.department_id.required'),
            'department_id.exists' => __('transfer.department_id.exists'),
            'information.required' =>  __('transfer.information.required'),
            'information.string' =>  __('transfer.information.string'),
        ];
        
    }//end of messages
}
