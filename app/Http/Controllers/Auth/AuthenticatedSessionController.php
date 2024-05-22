<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function loginAdmin()
    {
        return view('auth.login');
    } //end of login admin


    public function loginFacility()
    {
        return view('auth.facility-login');
    } //end of login facility

    public function loginDoctor()
    {
        return view('auth.doctor-login');
    } //end of login doctor

    public function loginPatient()
    {
        return view('auth.patient-login');
    } //end of login patient


    public function store(LoginRequest $request): RedirectResponse
    {

        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    } //end of store


    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard($request->guard)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        switch ($request->guard) {
            case 'admin':
                return redirect()->route('admin.login');
            case 'clinic':
            case 'pharmacy':
                return redirect()->route('facility.login');
                break;
            case 'doctor':
                return redirect()->route('doctor.login');
                break;
            case 'patient':
                return redirect()->route('patient.login');
                break;
        }
    } //end of destroy
}
