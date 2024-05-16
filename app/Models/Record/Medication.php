<?php

namespace App\Models\Record;

use App\Models\Case\CaseType;
use App\Models\Department\Department;
use App\Models\Users\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['date','medication_taken_value','has_alternative_value'];

    //attr
    public function getDateAttribute()
    {
        return $this->created_at->format('Y-m-d');
    } //end of date 

    public function getMedicationTakenValueAttribute()
    {
        return $this->medication_taken == 0 ? __('medications.undispensed') : __('medications.dispensed');
    } //end of medication taken value 

    public function getHasAlternativeValueAttribute()
    {
        return $this->has_alternative == 0 ? __('medications.not_taken') : __('medications.taken');
    } //end of has alternative value 


    //relation
    public function department()
    {
        return $this->belongsTo(Department::class);
    } //end of department relation

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    } //end of patient relation

    public function caseType()
    {
        return $this->belongsTo(CaseType::class);
    } //end of caseType relation
}
