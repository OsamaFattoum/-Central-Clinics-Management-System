<?php

namespace App\Http\Controllers;

use App\Http\Requests\DerpartmentRequest;
use App\Models\Admin;
use App\Models\Department\Department;
use App\Models\Permission;
use App\Traits\ImageOperations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    use ImageOperations;

    public function __construct()
    {
        $this->middleware(['permission:read-departments'])->only(['index']);
        $this->middleware(['permission:create-departments'])->only(['store']);
        $this->middleware(['permission:update-departments'])->only(['update']);
        $this->middleware(['permission:delete-departments'])->only(['destroy', 'bulk']);
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
            $permissions = [];

            $data = $request->except('image');
            $department = Department::create($data);
            
            if ($request->hasFile('image')) { 
                $this->verifyAndStoreImage($request, 'image','departments', 'uploads',$department->id,Department::class);
            }
            foreach (config('laratrust_seeder.permissions_map') as $map) {
                $permissions[] = Permission::firstOrCreate([
                    'name' => $map . '-' . $department->scientific_name,
                    'display_name' => ucfirst($map) . ' ' . ucfirst($department->scientific_name),
                    'description' => ucfirst($map) . ' ' . ucfirst($department->scientific_name),
                ])->name;
            }

           Admin::find(auth()->user()->id)->syncPermissions($permissions);

            DB::commit();
            session()->flash('add');
            return redirect()->route('departments.index');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('departments.index')->withErrors(['error' => $e->getMessage()]);
        }
    } //end of store



    public function update(DerpartmentRequest $request, Department $department)
    {   
        DB::beginTransaction();
        try {
            $data = $request->except('image');

            if ($request->image) {
                if ($department->image) {
                    $this->deleteImage('uploads', $department->image->url, $department->id);
                }
                $this->verifyAndStoreImage($request, 'image', 'departments', 'uploads', $department->id, Department::class);
            }
            $department->update($data);

            DB::commit();
            session()->flash('edit');
            return redirect()->route('departments.index');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('departments.index')->withErrors(['error' => $e->getMessage()]);
        }
    } //end of update


    public function destroy(Department $department)
    {
        DB::beginTransaction();
        try {
            if ($department->image) {
                $this->deleteImage('uploads', $department->image->url, $department->id);
            }
            foreach (config('laratrust_seeder.permissions_map') as  $map) {
                Permission::where('name', $map . '-' . $department->scientific_name)->delete();
            }
    
            $department->delete();

            DB::commit();
            session()->flash('delete');
            return redirect()->route('departments.index');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('departments.index')->withErrors(['error' => $e->getMessage()]);
        }
    } //end of destroy

    public function bulk(Request $request)
    {
        $ids = explode(',', $request->delete_select_id);
        DB::beginTransaction();
        try {

            foreach ( $ids as  $id) {
                $department = Department::find($id);
                foreach (config('laratrust_seeder.permissions_map') as  $map) {
                    Permission::where('name', $map . '-' . $department->scientific_name)->delete();
                }
                if ($department->image) {
                    $this->deleteImage('uploads', $department->image->url, $department->id);
                }
               
            }
            Department::destroy($ids);
            DB::commit();
            session()->flash('delete');
            return redirect()->route('departments.index');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('departments.index')->withErrors(['error' => $e->getMessage()]);
        }
    } //end of bulk
}
