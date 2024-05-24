<?php

namespace App\Livewire\Clinic;

use App\Models\Appointment;
use Carbon\Carbon;
use Livewire\Component;
use PDO;

class AppointmentsCalendar extends Component
{
    public $appointments;

    public $appointmentId;
    public $department;
    public $doctor;
    public $date;
    public $time;
    public $status;

    protected $listeners = ['appointmentUpdated' => 'refreshAppointments'];

    public function mount()
    {
        $this->loadAppointments();
    }

    public function loadAppointments(){

        $this->appointments = Appointment::with('department', 'patient')
        ->where('clinic_id', auth()->user()->id) // Adjust the condition as needed
        ->get()
        ->map(function ($appointment) {
            $datetimeString = $appointment->date . ' ' . $appointment->time;
            $datetime = Carbon::parse($datetimeString);
            return [
                'id' => $appointment->id,
                'title' => '(' . $appointment->department->name . ') (' . $appointment->doctor->name . ')',
                'start' => $datetime->toDateTimeString(),
                'color' => $appointment->status == 1 ? 'cayan' : ($appointment->status == 0 ? 'gray' : 'red'), // Customize color based on status
                'display' => 'block',
            ];
        })->toArray();
    }
    
    public function edit($id)
    {
       
        $appointment = Appointment::findOrFail($id);

        $this->appointmentId = $appointment->id;
        $this->department = $appointment->department->name;
        $this->doctor = $appointment->doctor->name;
        $this->date = $appointment->date;
        $this->time = $appointment->time;
        $this->status = $appointment->status;

        $this->dispatch('openModal');

    }

    public function updateStatus()
    {
        $this->validate([
            'status' => ['required','in:0,1,2'],
        ]);

        $appointment = Appointment::findOrFail($this->appointmentId);
        $appointment->status = $this->status;
        $appointment->save();
        $this->dispatch('appointmentUpdated');
       
    }

    public function refreshAppointments()
    {
        $this->loadAppointments();
        $this->dispatch('appointmentsRefreshed', $this->appointments);
    }

    public function render()
    {
        return view('livewire.clinic.appointments-calendar');
    }
}
