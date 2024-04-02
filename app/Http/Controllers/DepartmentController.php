<?php

namespace App\Http\Controllers;

use App\Http\Requests\DerpartmentRequest;
use App\Models\Department\Department;
use Exception;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    public function index()
    {
        return view('departments.index', [
            'departments' => Department::all(),
        ]);
    } //end of index



    public function store(DerpartmentRequest $request)
    {
        try {
            Department::create($request->all());
            session()->flash('add');
            return redirect()->route('departments.index')->withInput();
        } catch (Exception $e) {
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
