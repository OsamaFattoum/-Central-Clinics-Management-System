<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccreditaionRequest;
use App\Models\Clinic\Clinic;
use App\Models\Clinic\ClinicAccreditation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClinicAccreditationsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:read-clinics_accreditations'])->only(['index']);
        $this->middleware(['permission:create-clinics_accreditations'])->only(['store']);
        $this->middleware(['permission:update-clinics_accreditations'])->only(['update']);
        $this->middleware(['permission:delete-clinics_accreditations'])->only(['destroy','bulk']);
        $this->middleware('checkDepartment');

    } //end of construct



    public function index(Clinic $clinic)
    {
        return view('clinics.accreditations.index', [
            'clinic' => $clinic,
            'accreditations' => ClinicAccreditation::where('clinic_id',$clinic->id)->get(),
        ]);
    } //end of index
    
    public function store(Clinic $clinic,AccreditaionRequest $request)
    {
    
        try {
            $clinic->accreditations()->create($request->all());
            session()->flash('add');
            return redirect()->route('accreditations.index',$clinic->id)->withInput();
        } catch (Exception $e) {
            return redirect()->route('accreditations.index',$clinic->id)->withErrors(['error' => $e->getMessage()]);
        }
    } //end of store

    public function update(Clinic $clinic, ClinicAccreditation $accreditation ,AccreditaionRequest $request)
    {
        
        try {
            $accreditation->update($request->all());
            session()->flash('edit');
            return redirect()->route('accreditations.index',$clinic->id);
        } catch (Exception $e) {
            return redirect()->route('accreditations.index',$clinic->id)->withErrors(['error' => $e->getMessage()]);
        }
    } //end of update

    

    public function destroy(Clinic $clinic,ClinicAccreditation $accreditation)
    {
        try {
            $accreditation->delete();
            session()->flash('delete');
            return redirect()->route('accreditations.index',$clinic->id);
        } catch (Exception $e) {
            return redirect()->route('accreditations.index',$clinic->id)->withErrors(['error' => $e->getMessage()]);
        }
    } //end of destroy

    public function bulk(Clinic $clinic,Request $request)
    {
        $ids = explode(',', $request->delete_select_id);
        DB::beginTransaction();
        try {
            foreach ($ids as $id) {
                $clinic->accreditations()->where('clinic_accreditations.id',$id)->delete();
            }
            DB::commit();
            session()->flash('delete');
            return redirect()->route('accreditations.index',$clinic->id);
        } catch (Exception $e) {
            DB::rollback(); 
            return redirect()->route('accreditations.index',$clinic->id)->withErrors(['error' => $e->getMessage()]);
        }
    } //end of bulk

}
