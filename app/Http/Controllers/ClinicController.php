<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClinicRequest;
use App\Models\Clinic\Clinic;
use App\Models\Day\Day;
use App\Models\Department\Department;
use App\Traits\ImageOperations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClinicController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read-clinics'])->only(['index','show']);
        $this->middleware(['permission:create-clinics'])->only(['create','store']);
        $this->middleware(['permission:update-clinics'])->only(['edit','update','status']);
        $this->middleware(['permission:delete-clinics'])->only(['destroy','bulk']);

    } //end of construct


    use ImageOperations;

    public function index(Request $request)
    {
        $clinics = Clinic::when($request->department, function ($query) use ($request) {
            return $query->whereHas('departments', function ($subquery) use ($request) {
                $subquery->where('department_id', $request->department);
            });
        })->with(['departments','facilityProfile'])->get();
        return view('clinics.index', [
            'clinics' =>  $clinics,
        ]);
    } //end of index

    public function create()
    {
        $citiesJson = file_get_contents(resource_path('json/cities.json'));
        $cities = json_decode($citiesJson, true);

        return view('clinics.create', [
            'days' => Day::all(),
            'departments' => Department::all(),
            'cities' => $cities,
        ]);
    } //end of create

    public function store(ClinicRequest $request)
    {

        DB::beginTransaction();
        try {
            $clinic = Clinic::create([
                "ar" => [
                    "name" => $request->ar['name'],
                    "description" => $request->ar['description'],
                ],
                "en" => [
                    "name" => $request->en['name'],
                    "description" => $request->en['description'],
                ],
                "number" => $request->number,
                "email" => $request->email,
                "password" => Hash::make($request->password),
            ]);
            $clinic->departments()->attach($request->departments);

            // Attach each day to the clinic
            $daysIds = $request->days;

            foreach ($daysIds as $day) {
                $clinic->facilityDays()->create([
                    'day_id' => $day,
                    'facility_type' => Clinic::class,
                    'facility_id' => $clinic->id,
                ]);
            }

            $clinic->facilityProfile()->create([
                'facility_id' => $clinic->id,
                'facility_type' => Clinic::class,
                "address" => $request->address,
                "city" => $request->city,
                'phone' => $request->phone,
                "postal_code" => $request->postal_code,
                "open_hours" => $request->open_hours,
                "close_hours" => $request->close_hours,
                "owner_name" => $request->owner_name,
                "owner_phone" => $request->owner_phone,
                "owner_email" => $request->owner_email,
            ]);

            $this->verifyAndStoreImage($request, 'image', 'clinics', 'uploads', $clinic->id, Clinic::class);

            DB::commit();
            session()->flash('add');
            return redirect()->route('clinics.index');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('clinics.index')->withErrors(['error' => $e->getMessage()]);
        }
    } //end of store

    public function show(Clinic $clinic)
    {
        return view('clinics.show',[
            'clinic'=> $clinic
        ]);
    } //end of show

    public function edit(Clinic $clinic)
    {
        $citiesJson = file_get_contents(resource_path('json/cities.json'));
        $cities = json_decode($citiesJson, true);

        return view('clinics.edit', [
            'clinic' => $clinic,
            'days' => Day::all(),
            'departments' => Department::all(),
            'cities' => $cities,
        ]);
    } //end of edit

    public function update(ClinicRequest $request, Clinic $clinic)
    {

        DB::beginTransaction();
        try {

            if ($request->image) {
                if ($clinic->image) {
                    $this->deleteImage('uploads', $clinic->image->url, $clinic->id);
                }
                $this->verifyAndStoreImage($request, 'image', 'clinics', 'uploads', $clinic->id, Clinic::class);
            }

            $clinic->update([
                "ar" => [
                    "name" => $request->ar['name'],
                    "description" => $request->ar['description'],
                ],
                "en" => [
                    "name" => $request->en['name'],
                    "description" => $request->en['description'],
                ],
                "number" => $request->number,
                "email" => $request->email,
                "password" => Hash::make($request->password),
            ]);
            $clinic->departments()->sync($request->departments);



            // Attach each day to the clinic

            foreach ($clinic->facilityDays as $facilityDay) {
                $facilityDay->delete();
            }

            $daysIds = $request->days;

            foreach ($daysIds as $day) {
                $clinic->facilityDays()->create([
                    'day_id' => $day,
                    'facility_type' => Clinic::class,
                    'facility_id' => $clinic->id,
                ]);
            }

            $clinic->facilityProfile()->update([
                'facility_id' => $clinic->id,
                'facility_type' => Clinic::class,
                "address" => $request->address,
                "city" => $request->city,
                'phone' => $request->phone,
                "postal_code" => $request->postal_code,
                "open_hours" => $request->open_hours,
                "close_hours" => $request->close_hours,
                "owner_name" => $request->owner_name,
                "owner_phone" => $request->owner_phone,
                "owner_email" => $request->owner_email,
            ]);
            DB::commit();
            session()->flash('edit');
            return redirect()->route('clinics.index');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('clinics.index')->withErrors(['error' => $e->getMessage()]);
        }
    } //end of update


    public function status(Clinic $clinic)
    {
        try {
            $clinic->update(['status' => !$clinic->status]);
            session()->flash('change_status');
            return redirect()->route('clinics.index');
        } catch (Exception $e) {
            return redirect()->route('clinics.index')->withErrors(['error' => $e->getMessage()]);
        }
    }//end of status

    public function destroy(Clinic $clinic)
    {

        DB::beginTransaction();
        try {
            if ($clinic->image->exists()) {

                $this->deleteImage('uploads', $clinic->image->url, $clinic->id);
            }
            $clinic->delete();
            $clinic->facilityDays()->delete();
            $clinic->facilityProfile()->delete();
            DB::commit();
            session()->flash('delete');
            return redirect()->route('clinics.index');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('clinics.index')->withErrors(['error' => $e->getMessage()]);
        }
    } //end of destroy

    public function bulk(Request $request)
    {
        $ids = explode(',', $request->delete_select_id);
        DB::beginTransaction();
        try {
            foreach ($ids as $id) {
                $clinic = Clinic::findOrFail($id);
                if ($clinic->image->exists()) {
                    $this->deleteImage('uploads', $clinic->image->url, $clinic->id);
                }
                $clinic->facilityDays()->delete();
                $clinic->facilityProfile()->delete();
            }
            Clinic::destroy($ids);
            DB::commit();
            session()->flash('delete');
            return redirect()->route('clinics.index');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('clinics.index')->withErrors(['error' => $e->getMessage()]);
        }
    } //end of bulk

}
