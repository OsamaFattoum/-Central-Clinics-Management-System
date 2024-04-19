<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as ContractsTranslatable;
use Astrotomic\Translatable\Translatable;



class Profile extends Model implements ContractsTranslatable
{
    use HasFactory,Translatable;

    public $translatedAttributes = ['name'];

    protected $guarded = [];

    //relation
    public function profile()
    {
        return $this->morphTo();
    } //end of profile relation

}
