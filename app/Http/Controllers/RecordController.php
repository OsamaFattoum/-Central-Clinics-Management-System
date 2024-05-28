<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecordRequest;
use App\Models\Case\CaseType;
use App\Models\Department\Department;
use App\Models\Record\Record;
use App\Models\Users\Patient;
use App\Models\Users\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecordController extends Controller
{

    public function __construct(Request $request)
    {
        if ($request->department) {
            $department = Department::findOrFail($request->department);

            if ($department) {
                $this->middleware(['permission:read-' . $department->scientific_name])->only(['index']);
                $this->middleware(['permission:create-' . $department->scientific_name])->only(['store']);
                $this->middleware(['permission:update-' . $department->scientific_name, 'checkEditable:record'])->only(['update']);
                $this->middleware(['permission:delete-' . $department->scientific_name])->only(['destroy', 'bulk']);
            }
            $this->middleware('checkCaseType');
        }
    } //end of construct

    public function index(Patient $patient, Department $department)
    {

        $profile = Profile::where('profile_id', $patient->id)->where('profile_type', Patient::class)->first();

        $records = Record::with('caseType')->where('patient_id', $patient->id)->where('department_id', $department->id)->get();

        $caseTypes = CaseType::where('department_id', $department->id)->get();

        return view('records.index', compact('records', 'patient', 'department', 'profile', 'caseTypes'));
    } //end of index

    public function store(Patient $patient, Department $department, RecordRequest $request)
    {

        try {
            $data = $request->except('case_type');
            $data['case_type_id'] = $request->case_type;
            $data['patient_id'] = $patient->id;
            $data['department_id'] = $department->id;
            Record::create($data);
            session()->flash('add');
            return redirect()->route('records.index', ['patient' => $patient->id, 'department' => $department->id]);
        } catch (\Exception $e) {
            return redirect()->route('records.index', ['patient' => $patient->id, 'department' => $department->id])
                ->withErrors(['error' => $e->getMessage()]);
        }
    } //end of store


    public function update(Patient $patient, Department $department, Record $record, RecordRequest $request)
    {

        try {
            $data = $request->except('case_type');
            $data['case_type_id'] = $request->case_type;
            $data['patient_id'] = $patient->id;
            $data['department_id'] = $department->id;
            $record->update($data);
            session()->flash('add');
            return redirect()->route('records.index', ['patient' => $patient->id, 'department' => $department->id]);
        } catch (\Exception $e) {
            return redirect()->route('records.index', ['patient' => $patient->id, 'department' => $department->id])
                ->withErrors(['error' => $e->getMessage()]);
        }
    } //end of update

    public function destroy(Patient $patient, Department $department, Record $record)
    {
        try {
            $record->delete();
            session()->flash('delete');
            return redirect()->route('records.index', ['patient' => $patient->id, 'department' => $department->id]);
        } catch (\Exception $e) {
            return redirect()->route('records.index', ['patient' => $patient->id, 'department' => $department->id])
                ->withErrors(['error' => $e->getMessage()]);
        }
    } //end of destroy

    public function bulk(Patient $patient, Department $department, Request $request)
    {
        $ids = explode(',', $request->delete_select_id);

        try {
            Record::destroy($ids);
            session()->flash('delete');
            return redirect()->route('records.index', ['patient' => $patient->id, 'department' => $department->id]);
        } catch (\Exception $e) {
            return redirect()->route('records.index', ['patient' => $patient->id, 'department' => $department->id])
                ->withErrors(['error' => $e->getMessage()]);
        }
    } //end of bulk
}
