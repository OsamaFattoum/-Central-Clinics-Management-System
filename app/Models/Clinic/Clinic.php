<?php

namespace App\Models\Clinic;

use App\Models\Department\Department;
use App\Models\Facility\FacilityProfile;
use App\Models\Facility\FacilityDay;
use App\Models\Image;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as ContractsTranslatable;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Clinic extends Authenticatable implements ContractsTranslatable
{
    use HasFactory, Translatable, Notifiable;

    public $translatedAttributes = ['name', 'description'];

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function cityName()
    {
        $citiesJson = file_get_contents(resource_path('json/cities.json'));
        $cities = json_decode($citiesJson, true);
        
        $city = collect($cities)->firstWhere('id','=',$this->facilityProfile->city);
       
        return $city['name_'.app()->getLocale()];
    } //end of city name

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    } //end of image relation

    public function facilityDays()
    {
        return $this->morphMany(FacilityDay::class, 'facility');
    } //end of facilityDays relation

    public function accreditations()
    {
        return $this->hasMany(ClinicAccreditation::class);
    } //end of accreditations relation

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_clinic');
    } //end of departments relation

    public function facilityProfile()
    {
        return $this->morphOne(FacilityProfile::class, 'facility');
    } //end of facilityProfile relation
}
