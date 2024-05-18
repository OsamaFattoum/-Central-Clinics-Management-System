<?php

namespace App\Models\Clinic;

use App\Models\Appointment;
use App\Models\Department\Department;
use App\Models\Facility\FacilityProfile;
use App\Models\Facility\FacilityDay;
use App\Models\Image;
use App\Models\Users\Doctor;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as ContractsTranslatable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;

class Clinic extends Authenticatable implements ContractsTranslatable, LaratrustUser
{
    use HasFactory, Translatable, Notifiable, HasRolesAndPermissions;

    public $translatedAttributes = ['name', 'description'];

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = ['image_path'];

    //attr
    public function getImagePathAttribute()
    {
        $disk = 'uploads/';
        return $this->image == null ? $disk . 'clinic.png' : $disk . $this->image->url;
    } //end of getImagePathAttribute

    public function checkOpenStatus($date=null,$time=null)
    {
        $open_hours = Carbon::parse($this->facilityProfile->open_hours);
        $close_hours = Carbon::parse($this->facilityProfile->close_hours);
        if(is_null($date) && is_null($time)){
            $thisTime = Carbon::now();
        }else{
            $thisTime = Carbon::parse($date . ' ' . $time);
        }
        $open_days = [];

        foreach ($this->facilityDays as $day) {
            $open_days[] = $day->day->translate('en')->day;
        }
        
        $isTodayOpen = in_array($thisTime->englishDayOfWeek, $open_days);

        if ($isTodayOpen) {
            if ($close_hours->lt($open_hours)) {
                return  $thisTime->gt($open_hours) || $thisTime->lt($close_hours) ? 1 : 0;
            } else {

                return $thisTime->between($open_hours, $close_hours) ? 1 : 0;
            }
        }
        return 0;
    } //end of checkOpenStatus


    public function openStatusLabel()
    {

        return $this->checkOpenStatus() ? __('facility.open') : __('facility.close');
    } //end of checkOpenStatus

    public function cityName()
    {
        $citiesJson = file_get_contents(resource_path('json/cities.json'));
        $cities = json_decode($citiesJson, true);

        $city = collect($cities)->firstWhere('id', '=', $this->facilityProfile->city);

        return $city['name_' . app()->getLocale()];
    } //end of city name

    //relation
    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    } //end of doctors relation
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

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    } //end of appointments relation
}
