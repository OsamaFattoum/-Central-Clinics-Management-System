<?php

namespace App\Models\Case;

use App\Models\Department\Department;
use App\Models\Record\Record;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as ContractsTranslatable;
use Astrotomic\Translatable\Translatable;

class CaseType extends Model implements ContractsTranslatable
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['name'];

    protected $guarded = [];


    //attr

    //relation
    public function department()
    {
        return $this->belongsTo(Department::class);
    } //end of department relation

    public function records()
    {
        return $this->hasMany(Record::class);
    } //end of records relation

}
