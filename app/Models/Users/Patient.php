<?php

namespace App\Models\Users;

use App\Models\Appointment;
use App\Models\BloodType;
use App\Models\Image;
use App\Models\Record\Medication;
use App\Models\Record\Record;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\HasRolesAndPermissions;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Contracts\LaratrustUser;

class Patient extends Authenticatable implements  LaratrustUser
{
    use HasFactory, Notifiable, HasRolesAndPermissions;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected $appends = ['name','image_path', 'city_name','gender'];


    //attr
    public function getNameAttribute()
    {
        return $this->profile->name;
    } //end of name

    public function getImagePathAttribute()
    {
        $disk = 'uploads/';
        return $this->image == null ? $disk . 'patient.jpg' : $disk . $this->image->url;
    } //end of getImagePathAttribute

    public function getCityNameAttribute()
    {
        $citiesJson = file_get_contents(resource_path('json/cities.json'));
        $cities = json_decode($citiesJson, true);

        $city = collect($cities)->firstWhere('id', '=', $this->profile->city);

        return $city['name_' . app()->getLocale()];
    } //end of city name

    public function getGenderAttribute()
    {
        return $this->profile->gender ? __('users.male') : __('users.female');
    } //end of gender

    public function getAgeAttribute()
    {
        return  Carbon::parse($this->profile->birth_date)->age;
    } //end of age

    //relation
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    } //end of image relation

    public function profile()
    {
        return $this->morphOne(Profile::class, 'profile');
    } //end of Profile relation

    public function bloodType()
    {
        return $this->belongsTo(BloodType::class);
    } //end of blood Type relation

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
