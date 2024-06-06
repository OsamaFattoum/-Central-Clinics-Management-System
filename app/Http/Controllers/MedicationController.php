<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicationRequest;
use App\Models\Record\Medication;
use App\Models\Users\Patient;
use App\Models\Users\Profile;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read-medications'])->only(['index']);
        $this->middleware(['permission:create-medications'])->only(['store']);
        $this->middleware(['permission:update-medications', 'checkEditable:medication'])->only(['update']);
        $this->middleware(['permission:status-medications', 'checkEditable:medication'])->only(['status']);
        $this->middleware(['permission:delete-medications'])->only(['destroy', 'bulk']);
        $this->middleware('checkDepartment');
    } //end of construct


    public function index(Patient $patient)
    {

        $medications = Medication::with('caseType')->where('patient_id', $patient->id)->get();


        return view('medications.index', compact('medications', 'patient'));
    } //end of index


    public function store(Patient $patient, MedicationRequest $request)
    {


        try {
            $data = $request->except('department', 'case_type');
            $data['patient_id'] = $patient->id;
            $data['department_id'] = $request->department;
            $data['case_type_id'] = $request->case_type;
            $data['date_medication'] = Carbon::now();

            Medication::create($data);
            session()->flash('add');
            return redirect()->route('medications.index', ['patient' => $patient->id]);
        } catch (\Exception $e) {
            return redirect()->route('medications.index', ['patient' => $patient->id])->withErrors(['error' => $e->getMessage()]);
        }
    } //end of store

    public function status(Patient $patient, Medication $medication, Request $request)
    {
        try {
            $date_validation = [
                'medication_taken' => ['required', 'in:0,1'],
                'has_alternative' => ['required', 'in:0,1'],
            ];

            if (auth()->guard('doctor')->check()) {
                array_pop($date_validation);
            } else {
                if ($medication->medication_taken) {
                    return redirect()->route('medications.index', ['patient' => $patient->id])->withErrors(['error' => __('messages.no-edit-medication'). ' ' . __('messages.medication-dispensed')]);
                }
            }

            $data = $this->validate($request, $date_validation);

            if (auth()->guard('doctor')->check()) {
                if ($medication->medication_taken) {
                    if ($medication->department_id != auth()->user()->department->id) {
                        return redirect()->route('medications.index', ['patient' => $patient->id])->withErrors(['error' => __('messages.no-edit-medication') . ' ' . __('messages.medication-no-auth-edit') ]);
                    } {
                        $data['date_medication'] = Carbon::now();
                        $data['has_alternative'] = false;
                    }
                } else {
                    return redirect()->route('medications.index', ['patient' => $patient->id])->withErrors(['error' => __('messages.no-edit-medication') . ' ' . __('messages.medication-undispensed')]);
                }
            } else {
                if ($data['has_alternative'] == 1 && $data['medication_taken'] == 0) {
                    return redirect()->route('medications.index', ['patient' => $patient->id])->withErrors(['error' => __('messages.must-medciation-taken')]);
                }
            }



            $medication->update($data);

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
