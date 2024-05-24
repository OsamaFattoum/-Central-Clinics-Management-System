<?php

namespace App\Livewire\Doctor;

use App\Models\Appointment;
use Carbon\Carbon;
use Livewire\Component;

class AppointmentsCalendar extends Component
{
    public $appointments;

    public $appointmentId;
    public $patient;
    public $date;
    public $time;
    public $status;

    protected $listeners = ['appointmentUpdated' => 'refreshAppointments'];

    public function mount()
    {
        $this->loadAppointments();
    }//end of mount


    public function loadAppointments(){

        $this->appointments = Appointment::with('patient')
        ->where('doctor_id', auth()->user()->id) // Adjust the condition as needed
        ->get()
        ->map(function ($appointment) {
            $datetimeString = $appointment->date . ' ' . $appointment->time;
            $datetime = Carbon::parse($datetimeString);
            return [
                'id' => $appointment->id,
                'title' => '(' . $appointment->patient->name . ')',
                'start' => $datetime->toDateTimeString(),
                'color' => $appointment->status == 1 ? 'cayan' : ($appointment->status == 0 ? 'gray' : 'red'), // Customize color based on status
                'display' => 'block',
            ];
        })->toArray();

    }//end of load appointments

    public function edit($id)
    {
       
        $appointment = Appointment::findOrFail($id);

        $this->appointmentId = $appointment->id;
        $this->patient = $appointment->patient->name;
        $this->date = $appointment->date;
        $this->time = $appointment->time;
        $this->status = $appointment->status;

        $this->dispatch('openModal');

    }//end of edit

    public function updateStatus()
    {
        $this->validate([
            'status' => ['required','in:0,1,2'],
        ]);

        $appointment = Appointment::findOrFail($this->appointmentId);
        $appointment->status = $this->status;
        $appointment->save();
        $this->dispatch('appointmentUpdated');
       
    }//end of update status

    public function refreshAppointments()
    {
        $this->loadAppointments();
        $this->dispatch('appointmentsRefreshed', $this->appointments);
    }//end of refresh appointments
    

    public function render()
    {
        return view('livewire.doctor.appointments-calendar');
    }//end of render
}
