<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientRequest;
use App\Models\BloodType;
use App\Models\Department\Department;
use App\Models\Record\Record;
use App\Models\Users\Patient;
use App\Models\Users\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:read-patients'])->only(['index', 'show']);
        $this->middleware(['permission:create-patients'])->only(['create', 'store']);
        $this->middleware(['permission:update-patients'])->only(['edit', 'update', 'status']);
        $this->middleware(['permission:delete-patients'])->only(['destroy', 'bulk']);
    } //end of construct

    public function index()
    {
        $patients = Patient::all();

        return view('patients.index', [
            'patients' => $patients,
        ]);
    } //end of index

    public function create()
    {
        $citiesJson = file_get_contents(resource_path('json/cities.json'));
        $cities = json_decode($citiesJson, true);

        return view('patients.create', [
            'cities' => $cities,
            'bloodType' => BloodType::all(),
        ]);
    } //end of create

    public function store(PatientRequest $request)
    {
        DB::beginTransaction();
        try {
            $patient = Patient::create([
                "civil_id" => $request->civil_id,
                "email" => $request->email,
                "password" => Hash::make($request->password),
                'blood_type_id' => $request->blood_type,
            ]);


            $patient->profile()->create([
                "ar" => [
                    "name" => $request->ar['name'],
                ],
                "en" => [
                    "name" => $request->en['name'],
                ],
                'gender' => $request->gender,
                'birth_date' => $request->dob,
                'phone' => $request->phone,
                'city' => $request->city,
                'address' => $request->address,
                'profile_id' => $patient->id,
                'profile_type' => Patient::class,
            ]);



            $patient->addRole('patient');

            DB::commit();
            session()->flash('add');
            return redirect()->route('patients.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('patients.index')->withErrors(['error' => $e->getMessage()]);
        }
    } //end of store

    public function getLatestRecordsByDepartment(Patient $patient)
    {
        // Retrieve the latest 6 records per department grouped by department ID
        $latestRecordsByDepartment = [];

        // Retrieve unique department IDs
        $departmentIds = Record::select('department_id')
            ->distinct()
            ->pluck('department_id');
            

        // Iterate through each department ID
        foreach ($departmentIds as $departmentId) {
            // Retrieve the latest 6 records for the current department
            $latestRecords = Record::where('department_id', $departmentId)->where('patient_id',$patient->id)
                ->latest() // Order by latest records first
                ->limit(6) // Limit to 6 records per department
                ->get();
            
            // Add the latest records to the grouped array under the department ID key
            $latestRecordsByDepartment[$departmentId] = $latestRecords;
        }

        return $latestRecordsByDepartment;
    }


    public function show(Patient $patient)
    {
    
        $profile = Profile::where('profile_id', $patient->id)->where('profile_type',Patient::class)->first();

        return view('patients.show', [
            'records' => $this->getLatestRecordsByDepartment($patient),
            'departments' => Department::all(),
            'patient' => $patient,
            'profile' => $profile,
            'medications' => $patient->medications()->count(),
            'medications_undispensed' => $patient->medications()->where('medication_taken',0)->count()
        ]);
    } //end of show

    public function edit(Patient $patient)
    {
        $citiesJson = file_get_contents(resource_path('json/cities.json'));
        $cities = json_decode($citiesJson, true);
        $profile = Profile::where('profile_id', $patient->id)->where('profile_type', Patient::class)->first();

        return view('patients.edit', [
            'patient' => $patient,
            'cities' => $cities,
            'profile' => $profile,
            'bloodType' => BloodType::all(),
        ]);
    } //end of edit

    public function update(PatientRequest $request, Patient $patient)
    {
        DB::beginTransaction();
        try {
            $patient->update([
                "civil_id" => $request->civil_id,
                "email" => $request->email,
                'blood_type_id' => $request->blood_type,
            ]);
            $patient->profile()->update([

                'gender' => $request->gender,
                'birth_date' => $request->dob,
                'phone' => $request->phone,
                'city' => $request->city,
                'address' => $request->address,
                'profile_id' => $patient->id,
                'profile_type' => Patient::class,
            ]);
            Profile::find($patient->profile->id)->update([
                "ar" => [
                    "name" => $request->ar['name'],
                ],
                "en" => [
                    "name" => $request->en['name'],
                ],
            ]);

            DB::commit();
            session()->flash('edit');
            return redirect()->route('patients.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('patients.index')->withErrors(['error' => $e->getMessage()]);
        }
    } //end of update

    public function status(Patient $patient)
    {
        try {
            $patient->update(['status' => !$patient->status]);
            session()->flash('change_status');
            return redirect()->route('patients.index',['s' => $patient->civil_id]);
        } catch (\Exception $e) {
            return redirect()->route('patients.index')->withErrors(['error' => $e->getMessage()]);
        }
    } //end of status
    
    public function destroy(Patient $patient)
    {
    
        DB::beginTransaction();
        try {
            if ($patient->image()->exists()) {

                $this->deleteImage('uploads', $patient->image->url, $patient->id);
            }
            $patient->delete();
            $patient->profile()->delete();
            DB::commit();
            session()->flash('delete');
            return redirect()->route('patients.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('patients.index')->withErrors(['error' => $e->getMessage()]);
        }
    } //end of destroy

    public function bulk(Request $request)
    {
        $ids = explode(',', $request->delete_select_id);
        DB::beginTransaction();
        try {
            foreach ($ids as $id) {
                $patient = Patient::findOrFail($id);
                if ($patient->image()->exists()) {
                    $this->deleteImage('uploads', $patient->image->url, $patient->id);
                }
                $patient->profile()->delete();
            }
            Patient::destroy($ids);
            DB::commit();
            session()->flash('delete');
            return redirect()->route('patients.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('patients.index')->withErrors(['error' => $e->getMessage()]);
        }
    } //end of bulk

}
