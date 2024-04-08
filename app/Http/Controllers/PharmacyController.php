<?php

namespace App\Http\Controllers;

use App\Http\Requests\PharmacyRequest;
use App\Models\Day\Day;
use App\Models\Pharmacy\Pharmacy;
use App\Traits\ImageOperations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PharmacyController extends Controller
{
    use ImageOperations;

    public function index(Request $request)
    {
        $pharmacies = Pharmacy::all();

        return view('pharmacies.index', [
            'pharmacies' =>  $pharmacies,
        ]);

    } //end of index

    public function create()
    {
        $citiesJson = file_get_contents(resource_path('json/cities.json'));
        $cities = json_decode($citiesJson, true);

        return view('pharmacies.create', [
            'days' => Day::all(),
            'cities' => $cities,
        ]);
    } //end of create

    public function store(PharmacyRequest $request)
    {

        DB::beginTransaction();
        try {
            $pharmacy = Pharmacy::create([
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

            // Attach each day to the clinic
            $daysIds = $request->days;

            foreach ($daysIds as $day) {
                $pharmacy->facilityDays()->create([
                    'day_id' => $day,
                    'facility_type' => Pharmacy::class,
                    'facility_id' => $pharmacy->id,
                ]);
            }

            $pharmacy->facilityProfile()->create([
                'facility_id' => $pharmacy->id,
                'facility_type' => Pharmacy::class,
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

            $this->verifyAndStoreImage($request, 'image', 'pharmacies', 'uploads', $pharmacy->id, Pharmacy::class);

            DB::commit();
            session()->flash('add');
            return redirect()->route('pharmacies.index');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('pharmacies.index')->withErrors(['error' => $e->getMessage()]);
        }
    } //end of store


    public function show(Pharmacy $pharmacy)
    {
        return view('pharmacies.show',[
            'pharmacy'=> $pharmacy
        ]);
    } //end of show

    public function edit(Pharmacy $pharmacy)
    {
        $citiesJson = file_get_contents(resource_path('json/cities.json'));
        $cities = json_decode($citiesJson, true);

        return view('pharmacies.edit', [
            'pharmacy' => $pharmacy,
            'days' => Day::all(),
            'cities' => $cities,
        ]);
    } //end of edit

    public function update(PharmacyRequest $request,Pharmacy $pharmacy)
    {

        DB::beginTransaction();
        try {

            if ($request->image) {
                if ($pharmacy->image) {
                    $this->deleteImage('uploads', $pharmacy->image->url, $pharmacy->id);
                }
                $this->verifyAndStoreImage($request, 'image', 'pharmacies', 'uploads', $pharmacy->id, Pharmacy::class);
            }

            $pharmacy->update([
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

            // Attach each day to the clinic

            foreach ($pharmacy->facilityDays as $facilityDay) {
                $facilityDay->delete();
            }

            $daysIds = $request->days;

            foreach ($daysIds as $day) {
                $pharmacy->facilityDays()->create([
                    'day_id' => $day,
                    'facility_type' => Pharmacy::class,
                    'facility_id' => $pharmacy->id,
                ]);
            }

            $pharmacy->facilityProfile()->update([
                'facility_id' => $pharmacy->id,
                'facility_type' => Pharmacy::class,
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
            return redirect()->route('pharmacies.index');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('pharmacies.index')->withErrors(['error' => $e->getMessage()]);
        }
    } //end of update

    public function status(Pharmacy $pharmacy)
    {
        try {
            $pharmacy->update(['status' => !$pharmacy->status]);
            session()->flash('change_status');
            return redirect()->route('pharmacies.index');
        } catch (Exception $e) {
            return redirect()->route('pharmacies.index')->withErrors(['error' => $e->getMessage()]);
        }
    }//end of status

    public function destroy(Pharmacy $pharmacy)
    {

        DB::beginTransaction();
        try {
            if ($pharmacy->image->exists()) {

                $this->deleteImage('uploads', $pharmacy->image->url, $pharmacy->id);
            }
            $pharmacy->delete();
            $pharmacy->facilityDays()->delete();
            $pharmacy->facilityProfile()->delete();
            DB::commit();
            session()->flash('delete');
            return redirect()->route('pharmacies.index');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('pharmacies.index')->withErrors(['error' => $e->getMessage()]);
        }
    } //end of destroy

    public function bulk(Request $request)
    {
        $ids = explode(',', $request->delete_select_id);
        DB::beginTransaction();
        try {
            foreach ($ids as $id) {
                $pharmacy = Pharmacy::findOrFail($id);
                if ($pharmacy->image->exists()) {
                    $this->deleteImage('uploads', $pharmacy->image->url, $pharmacy->id);
                }
                $pharmacy->facilityDays()->delete();
                $pharmacy->facilityProfile()->delete();
            }
            Pharmacy::destroy($ids);
            DB::commit();
            session()->flash('delete');
            return redirect()->route('pharmacies.index');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('pharmacies.index')->withErrors(['error' => $e->getMessage()]);
        }
    } //end of bulk
}
