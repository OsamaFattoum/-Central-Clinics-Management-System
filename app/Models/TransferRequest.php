<?php

namespace App\Models;

use App\Models\Department\Department;
use App\Models\Users\Doctor;
use App\Models\Users\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    
    protected $appends = ['status_value'];

    //attr
    public function getStatusValueAttribute()
    {
        return $this->status ? __('transfer.confirmed') :  __('transfer.pending');
    } //end of status value

    //relations
    public function patient(){
        return $this->belongsTo(Patient::class);
    }//end of relation patient

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    } //end of doctor relation

    public function department()
    {
        return $this->belongsTo(Department::class);
    } //end of department relation
}
