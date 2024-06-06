<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransferRequest as RequestsTransferRequest;
use App\Models\Department\Department;
use App\Models\TransferRequest;
use App\Models\Users\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransferRequestController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:read-transfer-requests'])->only(['index']);
        $this->middleware(['permission:create-transfer-requests'])->only(['store']);
        $this->middleware(['permission:status-transfer-requests'])->only(['status']);
        $this->middleware(['permission:delete-transfer-requests'])->only(['destroy', 'bulk']);
    } //end of construct

    public function index(Patient $patient)
    {
        $query = TransferRequest::where('patient_id', $patient->id);
        $departments = [];
        if (auth()->guard('doctor')->check()) {
            $query->where('department_id', auth()->user()->department->id);
            $departments = Department::where('id', '!=', auth()->user()->department->id)->get();
        }

        $transferRequests = $query->with(['department', 'doctor'])->get();


        return view('transferRequests.index', compact('patient', 'transferRequests', 'departments'));
    } //end of index


    public function store(Patient $patient, RequestsTransferRequest $request)
    {
        try {
            $data = $request->all();
            $data['doctor_id'] = auth()->user()->id;
            $data['patient_id'] = $patient->id;

            TransferRequest::create($data);
            session()->flash('send');
            return redirect()->route('transferRequests.index', ['patient' => $patient->id]);
        } catch (\Exception $e) {
            return redirect()->route('transferRequests.index', ['patient' => $patient->id])->withErrors(['error' => $e->getMessage()]);
        }
    } //end of store

    public function status(Patient $patient, TransferRequest $transferRequest)
    {
        try {
            $transferRequest->update(['status' => !$transferRequest->status]);
            session()->flash('change_status');
            return redirect()->route('transferRequests.index', ['patient' => $patient->id]);
        } catch (\Exception $e) {
            return redirect()->route('transferRequests.index', ['patient' => $patient->id])->withErrors(['error' => $e->getMessage()]);
        }
    } //end of status

    public function destroy(Patient $patient, TransferRequest $transferRequest)
    {
        try {
            $transferRequest->delete();
            session()->flash('delete');
            return redirect()->route('transferRequests.index', ['patient' => $patient->id]);
        } catch (\Exception $e) {
            return redirect()->route('transferRequests.index', ['patient' => $patient->id])->withErrors(['error' => $e->getMessage()]);
        }
    } //end of destroy

    public function bulk(Patient $patient, Request $request)
    {
        $ids = explode(',', $request->delete_select_id);
        DB::beginTransaction();
        try {
            foreach ($ids as $id) {
                $patient->transferRequests()->delete($id);
            }
            DB::commit();
            session()->flash('delete');
            return redirect()->route('transferRequests.index', ['patient' => $patient->id]);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('transferRequests.index', ['patient' => $patient->id])->withErrors(['error' => $e->getMessage()]);
        }
    } //end of bulk
}
