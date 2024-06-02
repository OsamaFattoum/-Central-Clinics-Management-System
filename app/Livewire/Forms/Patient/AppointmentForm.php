<?php

namespace App\Livewire\Forms\Patient;

use Livewire\Attributes\Validate;
use Livewire\Form;

class AppointmentForm extends Form
{
    public $clinic;
    public $department;
    public $doctor;
    public $date;
    public $time;
    public $notes;


    public function rules()
    {
        return [
            'clinic' => ['required', 'exists:clinics,id'],
            'department' => ['required', 'exists:departments,id'],
            'doctor' => ['required', 'exists:doctors,id'],
            'date' => ['required','date_format:Y-m-d','after_or_equal:today'],
            'time' => ['required','date_format:H:i'],
            'notes' => ['nullable','string'],
        ];
    }//end of rules
}
