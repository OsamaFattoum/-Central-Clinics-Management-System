<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Traits\ImageOperations;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    use ImageOperations;
    public function index()
    {
        return view('profile', [
            'user' => auth()->user(),
        ]);
    } //end of index

    public function update(ProfileUpdateRequest $request)
    {
        try {
            $user = $request->user();
            
            if ($request->hasFile('image')) {
                if ($user->image) {
                    $this->deleteImage('uploads', $user->image->url, $user->id);
                }
                $this->verifyAndStoreImage($request, 'image',Str::plural(auth()->guard()->name), 'uploads', $user->id, get_class($user));
            }

            $user->fill($request->validated());
            $user->save();

            session()->flash('edit');
            return redirect()->route('profile');
        } catch (\Exception $e) {
            return redirect()->route('profile')->withErrors(['error' => $e->getMessage()]);
        }
    } //end of Update the user's profile information.


}
