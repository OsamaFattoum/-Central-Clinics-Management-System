<?php

namespace App\Livewire\Patient;

use App\Livewire\Forms\Patient\AppointmentForm;
use App\Models\Appointment;
use App\Models\Clinic\Clinic;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AppointmentMedication extends Component
{

    public AppointmentForm $form;

    public $selectedClinic = false;
    public $selectedDepartment = false;

    public $clinics = [];
    public $departments;
    public $doctors;



    public function addAppointment()
    {

        $this->clinics = Clinic::where('status', 1)->get();

        $this->dispatch('openModal');
    } //end of add appointment


    public function selectClinic()
    {
        if ($this->form->clinic) {
            $this->form->reset('department', 'doctor');
            $this->departments = Clinic::findOrFail($this->form->clinic)->departments;
            $this->selectedClinic = true;
        } else {
            $this->resetExcept('clinics', 'form');
            $this->form->reset('clinic', 'department', 'doctor');
        }
    } //end of select Clinic

    public function selectDepartment()
    {
        if ($this->form->department) {
            $clinic = Clinic::find($this->form->clinic);
            $this->doctors = $clinic->departments()->where('departments.id', $this->form->department)->firstOrFail()->doctors;
            $this->selectedDepartment = true;
        } else {
            $this->reset('doctors', 'selectedDepartment');
            $this->form->reset('department', 'doctor');
        }
    } //end of select Department

    public function saveAppointment()
    {
        DB::beginTransaction();
        try {

           $data = $this->form->validate();
            

            $clinic = Clinic::find($this->form->clinic)->first();

            if (!$clinic->checkOpenStatus($this->form->date, $this->form->time)) {
                session()->flash('error_appointment', __('appointments.closed_clinic'));
            } else {

                $existingAppointment = Appointment::where('doctor_id', $this->form->doctor)
                    ->where('date', $this->form->date)
                    ->where('time', $this->form->time)
                    ->first();

                if ($existingAppointment) {

                    session()->flash('error_appointment', __('appointments.has_appointment'));
                }else{
                    
                    Appointment::create([
                        'patient_id' => auth()->user()->id,
                        'clinic_id' => $data['clinic'],
                        'department_id' => $data['department'],
                        'doctor_id' => $data['doctor'],
                        'notes' => $data['notes'],
                        'date' => $data['date'],
                        'time' => $data['time'],
                    ]);
                    
                    DB::commit();
                    $this->reset();
                    $this->dispatch('addedAppointment');
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error_appointment',$e->getMessage());

        }
    } //end of save appointment




    public function render()
    {
        return view('livewire.patient.appointment-medication', [
            'medications' => auth()->user()->medications->where('medication_taken', 0),
            'appointments' => auth()->user()->appointments,
        ]);
    }
}
