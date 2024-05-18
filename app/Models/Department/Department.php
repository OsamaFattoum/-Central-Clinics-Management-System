<?php

namespace App\Models\Department;

use App\Models\Appointment;
use App\Models\Case\CaseType;
use App\Models\Clinic\Clinic;
use App\Models\Record\Medication;
use App\Models\Record\Record;
use App\Models\Users\Doctor;
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

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    } //end of doctors relation

    public function caseTypes()
    {
        return $this->hasMany(CaseType::class);
    } //end of caseTypes relation

    public function records()
    {
        return $this->hasMany(Record::class);
    } //end of records relation

    public function medications()
    {
        return $this->hasMany(Medication::class);
    } //end of medications relation

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    } //end of appointments relation
}
