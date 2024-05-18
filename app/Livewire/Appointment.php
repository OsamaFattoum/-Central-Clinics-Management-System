<?php

namespace App\Livewire;

use App\Models\Clinic\Clinic;
use Livewire\Component;

class Appointment extends Component
{
    public $selectedClinic = false;
    public $selectedDepartment = false;
    public $clinics;
    public $departments;
    public $doctors;

    public $clinic;
    public $department;
    public $doctor;

    public function mount($clinic = null,$department = null,$doctor = null)
    {
     
        $this->clinics = Clinic::where('status', 1)->get();
        if($this->selectedClinic){
            $this->selectClinic();
            if($this->selectedDepartment){
                $this->selectDepartment();
            }
        }else{
            $this->clinic = request()->old('clinic');
            if($this->clinic){
                $this->selectClinic();
            }
            $this->department = request()->old('department');
            if($this->department){
                $this->selectDepartment();
            }
            $this->doctor = request()->old('doctor');
        }
       


    } //end of mount

    public function selectClinic()
    {
        if ($this->clinic) {
            $this->departments = Clinic::findOrFail($this->clinic)->departments;
            $this->selectedClinic = true;
        } else {
            $this->resetExcept('clinics');
        }
    } //end of select Clinic

    public function selectDepartment()
    {
        if ($this->department) {
            $clinic = Clinic::find($this->clinic);
            $this->doctors = $clinic->departments()->where('departments.id', $this->department)->firstOrFail()->doctors;
            $this->selectedDepartment = true;
        }else{
            $this->reset('doctors','selectedDepartment');
        }
    } //end of select Department

    public function render()
    {
        return view('livewire.appointment');
    }
}
