<?php

namespace App\Models\Department;

use App\Models\Appointment;
use App\Models\Case\CaseType;
use App\Models\Clinic\Clinic;
use App\Models\Image;
use App\Models\Record\Medication;
use App\Models\Record\Record;
use App\Models\TransferRequest;
use App\Models\Users\Doctor;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as ContractsTranslatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Department extends Model implements ContractsTranslatable
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['name', 'description'];

    protected $guarded = [];

    protected $appends = ['image_path'];


    //attr

    public function getNameAttribute(){

        return $this->translate(app()->getLocale())->name;

    }//end of get name 

    public function getDescriptionAttribute(){

        return $this->translate(app()->getLocale())->description;

    }//end of get description 

    public function getImagePathAttribute()
    {
        $disk = 'uploads/';
        return $this->image == null ? $disk . 'department.png' : $disk . $this->image->url;
    } //end of getImagePathAttribute


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
    
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    } //end of image relation

    
    public function transferRequests()
    {
        return $this->hasMany(TransferRequest::class);
    } //end of transfer requests relation
}
