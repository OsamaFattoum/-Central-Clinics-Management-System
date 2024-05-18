<?php

namespace App\Models;

use App\Models\Clinic\Clinic;
use App\Models\Department\Department;
use App\Models\Users\Doctor;
use App\Models\Users\Patient;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['status_value'];


    //attr
    public function getStatusValueAttribute()
    {
        switch ($this->status) {
            case 0:
                return __('appointments.pending');
                break;
            case 1:
                return __('appointments.confirmed');
                break;
            case 2:
                return __('appointments.cancelled');
                break;
        };
    } //end of status value




    //relations
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    } //end of patient relation

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    } //end of clinic relation

    public function department()
    {
        return $this->belongsTo(Department::class);
    } //end of department relation

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    } //end of doctor relation
    
}
