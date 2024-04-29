<?php

namespace App\Http\Controllers;

use App\Models\Users\Doctor;
use App\Models\Users\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read-doctors'])->only(['index', 'show']);
        $this->middleware(['permission:create-doctors'])->only(['manage', 'store']);
        $this->middleware(['permission:update-doctors'])->only(['manage', 'update', 'status']);
        $this->middleware(['permission:delete-doctors'])->only(['destroy', 'bulk']);
    } //end of construct

    public function index(Request $request)
    {
        if (auth()->guard('clinic')->check()) {

            $doctors = Doctor::with(['profile', 'clinic'])->where('clinic_id', auth()->user()->id)->get();
        } else {
            $doctors = Doctor::when($request->clinic, function ($query) use ($request) {
                return $query->whereHas('clinic', function ($subquery) use ($request) {
                    $subquery->where('clinic_id', $request->clinic);
                });
            })->with('profile')->get();
        }

        return view('doctors.index', [
            'doctors' => $doctors,
        ]);
    } //end of index

    public function manage()
    {
        return view('doctors.manage');
    } //end of manage

    public function show(Doctor $doctor)
    {
        if (auth()->guard('clinic')->check()) {
            if ($doctor->clinic_id != auth()->user()->id) {
                abort(404);
            }
        }
        $profile = Profile::where('profile_id', $doctor->id)->first();

        return view('doctors.show', [
            'doctor' => $doctor,
            'profile' => $profile,
        ]);
    } //end of show

    public function status(Doctor $doctor)
    {
        try {
            $doctor->update(['status' => !$doctor->status]);
            session()->flash('change_status');
            return redirect()->route('doctors.index');
        } catch (\Exception $e) {
            return redirect()->route('doctors.index')->withErrors(['error' => $e->getMessage()]);
        }
    } //end of status

    public function destroy(Doctor $doctor)
    {
       

        DB::beginTransaction();
        try {
            if ($doctor->image()->exists()) {

                $this->deleteImage('uploads', $doctor->image->url, $doctor->id);
            }
            $doctor->delete();
            $doctor->removePermissions();
            $doctor->profile()->delete();
            DB::commit();
            session()->flash('delete');
            return redirect()->route('doctors.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('doctors.index')->withErrors(['error' => $e->getMessage()]);
        }
    } //end of destroy

    public function bulk(Request $request)
    {
        $ids = explode(',', $request->delete_select_id);
        DB::beginTransaction();
        try {
            foreach ($ids as $id) {
                $doctor = Doctor::findOrFail($id);
                if ($doctor->image()->exists()) {
                    $this->deleteImage('uploads', $doctor->image->url, $doctor->id);
                }
                $doctor->profile()->delete();
                $doctor->removePermissions();
            }
            Doctor::destroy($ids);
            DB::commit();
            session()->flash('delete');
            return redirect()->route('doctors.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('doctors.index')->withErrors(['error' => $e->getMessage()]);
        }
    } //end of bulk

}
