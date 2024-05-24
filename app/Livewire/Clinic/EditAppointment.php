<?php

namespace App\Livewire\Clinic;

use App\Models\Appointment;
use Livewire\Component;

class EditAppointment extends Component
{

    public $appointmentId;
    public $department;
    public $doctor;
    public $date;
    public $time;
    public $status;

    protected $listeners = ['editAppointment'];


    public function editAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);

        $this->appointmentId = $appointment->id;
        $this->department = $appointment->department->name;
        $this->doctor = $appointment->doctor->name;
        $this->date = $appointment->date;
        $this->time = $appointment->time;
        $this->status = $appointment->status;

        $this->dispatch('openModal')->self();
    }

    public function save()
    {
        $appointment = Appointment::findOrFail($this->appointmentId);
        $appointment->date = $this->date;
        $appointment->status = $this->status;
        $appointment->save();

        $this->dispatch('closeModal')->self();
        $this->dispatch('appointmentUpdated')->self();
    }

    public function render()
    {
        return view('livewire.clinic.edit-appointment',[
            'debug' => 'Component Loaded',
        ]);
    }
}
