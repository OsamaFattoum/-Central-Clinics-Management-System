<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileTranslation extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public $timestamps = false;


    //relation
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }//end of profile


  
}
