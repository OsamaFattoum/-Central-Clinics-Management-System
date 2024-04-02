<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait ImageOperations
{
    public function verifyAndStoreImage(Request $request, $inputname, $foldername, $disk, $imageable_id, $imageable_type)
    {

        if ($request->hasFile($inputname)) {

            // Check img
            if (!$request->file($inputname)->isValid()) {
                session()->flash('Invalid Image!');
                return redirect()->back()->withInput();
            }

            $photo = $request->file($inputname);

            $fileName = $photo->hashName();

            // insert Image
            $Image = new Image();
            $Image->url = $foldername . '/' . $fileName;
            $Image->imageable_id = $imageable_id;
            $Image->imageable_type = $imageable_type;
            $Image->save();
          
            return $photo->storeAs($foldername, $fileName, $disk);
        }

        return null;
    } //end of verifyAndStoreImage

    public function deleteImage($disk, $path, $id)
    {
            $selected_disk = Storage::disk($disk);
            if ($selected_disk->exists($path)) {
                $selected_disk->delete($path);
            }
            image::where('imageable_id', $id)->delete();
        
    } //end of delete image


}//end of trait