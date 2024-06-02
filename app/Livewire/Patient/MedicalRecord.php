<?php

namespace App\Livewire\Patient;

use App\Models\Department\Department;
use App\Models\Record\Record;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Livewire\Component;

class MedicalRecord extends Component
{

    public $showMoreStatus = false;

    public $departmentName = '';
    public $departmentID = '';

    public $startDate;
    public $endDate;

    public $recordsSearch = [];



    public function showMoreRecordModal(Department $department){

        $this->departmentName = $department->name;
        $this->departmentID = $department->id;
        $this->endDate = Date::now()->format('Y-m-d');
        $this->showMoreStatus = true;

    }//end of showMoreRecordModal

    public function searchRecords() {

        $validated = $this->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date',
        ]);

        try{
            $startDate = Carbon::parse($validated['startDate'])->startOfDay();
            $endDate = Carbon::parse($validated['endDate'])->endOfDay();
            
            
            if(!$startDate->gt($endDate)){

                $this->recordsSearch = Record::with('caseType')->where('patient_id',auth()->user()->id)->where('department_id',$this->departmentID)->whereBetween('created_at', [$startDate, $endDate])->get(); 
            }else{
                session()->flash('error_search',__('records.start_date_gt_end_date'));
            }

        }catch(\Exception $e){
            dd($e->getMessage());
            $this->reset('recordsSearch','startDate','endDate');
        }
     

    }//end of searchRecords


    public function clearData() {
        
        $this->reset('startDate','endDate','recordsSearch');
        $this->endDate = Date::now()->format('Y-m-d');

    }//end of clear Data

    public function back() {
        
        $this->reset();

    }//end of back


    public function getLatestRecordsByDepartment()
    {
        // Retrieve the latest 6 records per department grouped by department ID
        $latestRecordsByDepartment = [];

        // Retrieve unique department IDs
        $departmentIds = Record::select('department_id')
            ->distinct()
            ->pluck('department_id');
            

        // Iterate through each department ID
        foreach ($departmentIds as $departmentId) {
            // Retrieve the latest 6 records for the current department
            $latestRecords = Record::where('department_id', $departmentId)->where('patient_id',Auth::user()->id)
                ->latest() // Order by latest records first
                ->limit(6) // Limit to 6 records per department
                ->get();
            
            // Add the latest records to the grouped array under the department ID key
            $latestRecordsByDepartment[$departmentId] = $latestRecords;
        }

        return $latestRecordsByDepartment;
    }//end of getLatestRecordsByDepartment


    public function render()
    {
        return view('livewire.patient.medical-record',[
            'records' => $this->getLatestRecordsByDepartment(),
            'departments' => Department::all(),
        ]);
    }//end of render
}
