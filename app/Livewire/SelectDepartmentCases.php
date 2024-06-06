<?php

namespace App\Livewire;

use App\Models\Case\CaseType;
use App\Models\Department\Department;
use Livewire\Component;

class SelectDepartmentCases extends Component
{
    public $departments;
    public $department;
    public $case_type;
    public $selectedDepartment = false;

    public $caseTypes;

    public function mount()
    {
        if(auth()->guard('doctor')->check()){
            $this->departments = auth()->user()->department->name;
            $this->department = auth()->user()->department->id;
            $this->selectDepartment();
        }else{

            $this->departments = Department::where('status',1)->get();
        }

        if($this->selectedDepartment){
            $this->selectDepartment();
        }
    }//end of mount

    public function selectDepartment()
    {
        if ($this->department) {
            $this->caseTypes = CaseType::where('department_id',$this->department)->get();
            $this->selectedDepartment = true;
           
        } else {
            $this->reset('department','selectedDepartment');
        }
    } //end of select Department



    public function render()
    {
        return view('livewire.select-department-cases');
    }
}
