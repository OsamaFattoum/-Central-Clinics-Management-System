<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Day\Day;
use App\Traits\ImageOperations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    use ImageOperations;
    public function index()
    {
        $data = [
            'user' => auth()->user(),
        ];

        if (Auth::guard('clinic')->check()) {
            $citiesJson = file_get_contents(resource_path('json/cities.json'));
            $cities = json_decode($citiesJson, true);

            $data['days'] = Day::all();
            $data['cities'] = $cities;
        }

        return view('profile', $data);
    } //end of index

    public function update(ProfileUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = $request->user();

            if ($request->hasFile('image')) {
                if ($user->image) {
                    $this->deleteImage('uploads', $user->image->url, $user->id);
                }
                $this->verifyAndStoreImage($request, 'image', Str::plural(auth()->guard()->name), 'uploads', $user->id, get_class($user));
            }
            $data = $request->validated();
            if (Auth::guard('clinic')->check()) {

                foreach ($user->facilityDays as $facilityDay) {
                    $facilityDay->delete();
                }
                foreach ($request->days as $day) {
                    $user->facilityDays()->create([
                        'day_id' => $day,
                        'facility_type' => get_class($user),
                        'facility_id' => $user->id,
                    ]);
                }

                $user->facilityProfile()->update([
                    'facility_id' => $user->id,
                    'facility_type' => get_class($user),
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
                $data = $request->only('email');
            }

            $user->fill($data);
            $user->save();

            DB::commit();
            session()->flash('edit');
            return redirect()->route('profile');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('profile')->withErrors(['error' => $e->getMessage()]);
        }
    } //end of Update the user's profile information.


}
