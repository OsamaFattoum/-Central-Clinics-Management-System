<?php

namespace App\Http\Controllers;

use App\Http\Requests\DerpartmentRequest;
use App\Models\Department\Department;
use App\Models\Permission;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:read-departments'])->only(['index']);
        $this->middleware(['permission:create-departments'])->only(['store']);
        $this->middleware(['permission:update-departments'])->only(['update']);
        $this->middleware(['permission:delete-departments'])->only(['destroy','bulk']);

    } //end of construct
    
    public function index(Request $request)
    {
        $departments = Department::when($request->clinic, function ($query) use ($request) {
            return $query->whereHas('clinics', function ($subquery) use ($request) {
                $subquery->where('clinic_id', $request->clinic);
        });
        })->get();
        return view('departments.index', [
            'departments' => $departments,
        ]);
    } //end of index



    public function store(DerpartmentRequest $request)
    {
        DB::beginTransaction();
        try {
            $department = Department::create($request->all());
            foreach (config('laratrust_seeder.permissions_map') as $map) {
                Permission::firstOrCreate([
                    'name' => $map . '-' . $department->scientific_name,
                    'display_name' => ucfirst($map) . ' ' . ucfirst($department->scientific_name),
                    'description' => ucfirst($map) . ' ' . ucfirst($department->scientific_name),
                ]);
            }
            DB::commit();
            session()->flash('add');
            return redirect()->route('departments.index')->withInput();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('departments.index')->withErrors(['error' => $e->getMessage()]);
        }
    } //end of store



    public function update(DerpartmentRequest $request, Department $department)
    {
        try {
            $department->update($request->all());
            session()->flash('edit');
            return redirect()->route('departments.index');
        } catch (Exception $e) {
            return redirect()->route('departments.index')->withErrors(['error' => $e->getMessage()]);
        }
    } //end of update


    public function destroy(Department $department)
    {
        try {
            $department->delete();
            session()->flash('delete');
            return redirect()->route('departments.index');
        } catch (Exception $e) {
            return redirect()->route('departments.index')->withErrors(['error' => $e->getMessage()]);
        }
    } //end of destroy

    public function bulk(Request $request)
    {
        $ids = explode(',', $request->delete_select_id);
        try {
            Department::destroy($ids);
            session()->flash('delete');
            return redirect()->route('departments.index');
        } catch (Exception $e) {
            return redirect()->route('departments.index')->withErrors(['error' => $e->getMessage()]);
        }
    } //end of bulk
}
