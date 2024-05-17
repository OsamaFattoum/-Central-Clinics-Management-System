<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(PasswordRequest $request): RedirectResponse
    {
        try {
            $request->user()->update([
                'password' => Hash::make($request->password),
            ]);
            session()->flash('edit');
            return redirect()->route('profile');
        } catch (\Exception $e) {
            return redirect()->route('profile')->withErrors(['error' => $e->getMessage()]);
        }
       
    }
}
