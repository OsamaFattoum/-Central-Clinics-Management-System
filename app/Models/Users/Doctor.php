<?php

namespace App\Models\Users;

use App\Models\Appointment;
use App\Models\Clinic\Clinic;
use App\Models\Department\Department;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Notifications\Notifiable;


class Doctor extends Authenticatable implements  LaratrustUser
{
    use HasFactory,Notifiable, HasRolesAndPermissions;

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
        return $this->image == null ? $disk . 'doctor.png' : $disk . $this->image->url;
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


    //relation
    public function clinic(){
        return $this->belongsTo(Clinic::class);
    }//end of clinic relation

    public function department(){
        return $this->belongsTo(Department::class);
    }//end of clinic relation
    
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    } //end of image relation

    public function profile()
    {
        return $this->morphOne(Profile::class, 'profile');
    } //end of Profile relation

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    } //end of appointments relation

}
