<?php

namespace App\Models\Department;

use App\Models\Case\CaseType;
use App\Models\Clinic\Clinic;
use App\Models\Record\Record;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as ContractsTranslatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model implements ContractsTranslatable
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['name', 'description'];

    protected $guarded = [];

    public function clinics()
    {
        return $this->belongsToMany(Clinic::class, 'department_clinic');
    } //end of clinics relation

    public function caseTypes()
    {
        return $this->hasMany(CaseType::class);
    } //end of caseTypes relation

    public function records()
    {
        return $this->hasMany(Record::class);
    } //end of records relation
}
