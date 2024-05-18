<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequest;
use App\Models\Appointment;
use App\Models\Clinic\Clinic;
use App\Models\Users\Patient;
use App\Models\Users\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read-appointments'])->only(['index']);
        $this->middleware(['permission:create-appointments'])->only(['store']);
        $this->middleware(['permission:update-appointments'])->only(['update']);
        $this->middleware(['permission:delete-appointments'])->only(['destroy', 'bulk']);
    } //end of construct

    public function index(Patient $patient)
    {
        $profile = Profile::where('profile_id', $patient->id)->where('profile_type', Patient::class)->first();

        return view('appointments.index', [
            'appointments' => Appointment::where('patient_id', $patient->id)->get(),
            'profile' => $profile,
            'patient' => $patient,
        ]);
    } //end of index

    public function store(Patient $patient, AppointmentRequest $request)
    {
        try {
            $data = $request->except('clinic', 'department', 'doctor');
            $data['patient_id'] = $patient->id;
            $data['clinic_id'] = $request->clinic;
            $data['department_id'] = $request->department;
            $data['doctor_id'] = $request->doctor;
            $clinic = Clinic::find($request->clinic)->first();
            if (!$clinic->checkOpenStatus($request->date, $request->time)) {
                return redirect()->route('appointments.index', ['patient' => $patient->id])->withErrors(['error' => __('appointments.closed_clinic')])->withInput();
            }

            $existingAppointment = Appointment::where('doctor_id', $request->doctor)
                ->where('date', $request->date)
                ->where('time', $request->time)
                ->first();
            if ($existingAppointment) {
                return redirect()->route('appointments.index', ['patient' => $patient->id])->withErrors(['error' => __('appointments.has_appointment')])->withInput();
            }
            Appointment::create($data);
            session()->flash('add');
            return redirect()->route('appointments.index', ['patient' => $patient->id]);
        } catch (\Exception $e) {
            return redirect()->route('appointments.index', ['patient' => $patient->id])->withErrors(['error' => $e->getMessage()]);
        }
    } //end of store

    public function update(Patient $patient, Appointment $appointment, AppointmentRequest $request)
    {
        try {
            $data = $request->except('clinic', 'department', 'doctor');
            $data['patient_id'] = $patient->id;
            $data['clinic_id'] = $request->clinic;
            $data['department_id'] = $request->department;
            $data['doctor_id'] = $request->doctor;

            $clinic = Clinic::find($request->clinic)->first();
            if (!$clinic->checkOpenStatus($request->date, $request->time)) {
                return redirect()->route('appointments.index', ['patient' => $patient->id])->withErrors(['error' => __('appointments.closed_clinic')])->withInput();
            }

            $existingAppointment = Appointment::where('doctor_id', $request->doctor)
                ->where('date', $request->date)
                ->where('time', $request->time)
                ->first();
            if ($existingAppointment) {
                return redirect()->route('appointments.index', ['patient' => $patient->id])->withErrors(['error' => __('appointments.has_appointment')])->withInput();
            }
            $appointment->update($data);
            session()->flash('edit');
            return redirect()->route('appointments.index', ['patient' => $patient->id]);
        } catch (\Exception $e) {
            return redirect()->route('appointments.index', ['patient' => $patient->id])->withErrors(['error' => $e->getMessage()]);
        }
    } //end of update

    public function destroy(Patient $patient, Appointment $appointment)
    {
        try {
            $appointment->delete();
            session()->flash('delete');
            return redirect()->route('appointments.index', ['patient' => $patient->id]);
        } catch (\Exception $e) {
            return redirect()->route('appointments.index', ['patient' => $patient->id])->withErrors(['error' => $e->getMessage()]);
        }
    } //end of destroy

    public function bulk(Patient $patient, Request $request)
    {
        $ids = explode(',', $request->delete_select_id);

        try {
            Appointment::destroy($ids);
            session()->flash('delete');
            return redirect()->route('appointments.index', ['patient' => $patient->id]);
        } catch (\Exception $e) {
            return redirect()->route('appointments.index', ['patient' => $patient->id])->withErrors(['error' => $e->getMessage()]);
        }
    } //end of bulk

}
