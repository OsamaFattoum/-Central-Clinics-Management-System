<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicationRequest;
use App\Models\Record\Medication;
use App\Models\Users\Patient;
use App\Models\Users\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read-medications'])->only(['index']);
        $this->middleware(['permission:create-medications'])->only(['store']);
        $this->middleware(['permission:update-medications', 'checkEditable:medication'])->only(['update']);
        $this->middleware(['permission:status-medications','checkEditable:medication'])->only(['status']);
        $this->middleware(['permission:delete-medications'])->only(['destroy', 'bulk']);
        $this->middleware('checkDepartment');

    } //end of construct


    public function index(Patient $patient, Request $request)
    {

        $profile = Profile::where('profile_id', $patient->id)->where('profile_type', Patient::class)->first();

        $medications = Medication::when(isset($request->taken), function ($query) use ($request) {
            return $query->where('medication_taken', $request->taken);
        })->with('caseType')->where('patient_id', $patient->id)->get();

        return view('medications.index', compact('medications', 'patient', 'profile'));
    } //end of index


    public function store(Patient $patient, MedicationRequest $request)
    {

        try {
            $data = $request->except('department', 'case_type');
            $data['patient_id'] = $patient->id;
            $data['department_id'] = $request->department;
            $data['case_type_id'] = $request->case_type;


            Medication::create($data);
            session()->flash('add');
            return redirect()->route('medications.index', ['patient' => $patient->id]);
        } catch (\Exception $e) {
            return redirect()->route('medications.index', ['patient' => $patient->id])->withErrors(['error' => $e->getMessage()]);
        }
    } //end of store

    public function status(Patient $patient, Medication $medication, Request $request)
    {  
        if($medication->medication_taken){
            abort(403);
       }
        try {
            $this->validate($request, [
                'medication_taken' => ['required', 'in:0,1'],
                'has_alternative' => ['required', 'in:0,1'],
            ]);
            $medication->update([
                'medication_taken' => $request->medication_taken,
                'has_alternative' => $request->has_alternative,
            ]);
            session()->flash('change_status');
            return redirect()->route('medications.index', ['patient' => $patient->id]);
        } catch (\Exception $e) {
            return redirect()->route('medications.index', ['patient' => $patient->id])->withErrors(['error' => $e->getMessage()]);
        }
    } //end of status

    public function update(Patient $patient, Medication $medication, MedicationRequest $request)
    {

        try {
            $data = $request->except('department', 'case_type');
            $data['patient_id'] = $patient->id;
            $data['department_id'] = $request->department;
            $data['case_type_id'] = $request->case_type;


            $medication->update($data);
            session()->flash('edit');
            return redirect()->route('medications.index', ['patient' => $patient->id]);
        } catch (\Exception $e) {
            return redirect()->route('medications.index', ['patient' => $patient->id])->withErrors(['error' => $e->getMessage()]);
        }
    } //end of update


    public function destroy(Patient $patient, Medication $medication)
    {
        try {
            $medication->delete();
            session()->flash('delete');
            return redirect()->route('medications.index', ['patient' => $patient->id]);
        } catch (\Exception $e) {
            return redirect()->route('medications.index', ['patient' => $patient->id])->withErrors(['error' => $e->getMessage()]);
        }
    } //end of destroy

    public function bulk(Patient $patient, Request $request)
    {
        $ids = explode(',', $request->delete_select_id);
        DB::beginTransaction();
        try {
            foreach ($ids as $id) {
                $patient->medications()->delete($id);
            }
            DB::commit();
            session()->flash('delete');
            return redirect()->route('medications.index', ['patient' => $patient->id]);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('medications.index', ['patient' => $patient->id])->withErrors(['error' => $e->getMessage()]);
        }
    } //end of bulk
}
