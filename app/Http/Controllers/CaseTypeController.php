<?php

namespace App\Http\Controllers;

use App\Http\Requests\CaseTypeRequest;
use App\Models\Case\CaseType;
use App\Models\Department\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CaseTypeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['permission:read-case_type'])->only(['index']);
        $this->middleware(['permission:create-case_type'])->only(['store']);
        $this->middleware(['permission:update-case_type'])->only(['update']);
        $this->middleware(['permission:delete-case_type'])->only(['destroy','bulk']);
        $this->middleware('checkDepartment');


    } //end of construct

    public function index(Department $department)
    {
        return view('departments.caseTypes.index', [
            'department' => $department,
            'caseTypes' => CaseType::where('department_id',$department->id)->get(),
        ]);
    } //end of index

    public function store(Department $department,CaseTypeRequest $request)
    {
        try {
            
            $department->caseTypes()->create($request->all());
            session()->flash('add');
            return redirect()->route('case_types.index',$department->id);
        } catch (\Exception $e) {
            return redirect()->route('case_types.index',$department->id)->withErrors(['error' => $e->getMessage()]);
        }
    } //end of store


    
    public function update(Department $department, CaseType $caseType ,CaseTypeRequest $request)
    {
        
        try {
            $caseType->update($request->all());
            session()->flash('edit');
            return redirect()->route('case_types.index',$department->id);
        } catch (\Exception $e) {
            return redirect()->route('case_types.index',$department->id)->withErrors(['error' => $e->getMessage()]);
        }
    } //end of update

    public function destroy(Department $department,CaseType $caseType)
    {
        try {
            $caseType->delete();
            session()->flash('delete');
            return redirect()->route('case_types.index',$department->id);
        } catch (\Exception $e) {
            return redirect()->route('case_types.index',$department->id)->withErrors(['error' => $e->getMessage()]);
        }
    } //end of destroy

    public function bulk(Department $department,Request $request)
    {
        $ids = explode(',', $request->delete_select_id);
        DB::beginTransaction();
        try {
            foreach ($ids as $id) {
                $department->caseTypes()->where('case_types.id',$id)->delete();
            }
            DB::commit();
            session()->flash('delete');
            return redirect()->route('case_types.index',$department->id);
        } catch (\Exception $e) {
            DB::rollback(); 
            return redirect()->route('case_types.index',$department->id)->withErrors(['error' => $e->getMessage()]);
        }
    } //end of bulk



}
