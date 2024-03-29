<?php

namespace App\Models\Department;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as ContractsTranslatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model implements ContractsTranslatable
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['name','description'];

    protected $guarded = [];
}
