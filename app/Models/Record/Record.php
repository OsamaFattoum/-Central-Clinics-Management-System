<?php

namespace App\Models\Record;

use App\Models\Case\CaseType;
use App\Models\Department\Department;
use App\Models\Users\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['result_value', 'reference_range', 'measurement_unit', 'date'];



    //attr
    public function getMeasurementUnitAttribute()
    {

        return is_null($this->attributes['measurement_unit']) ? __('records.no_value') : $this->attributes['measurement_unit'];
    } //end of measurement unit

    public function getReferenceRangeAttribute()
    {
        return is_null($this->attributes['reference_range']) ? __('records.no_value') : $this->attributes['reference_range'];
    } //end of measurement unit

    public function getDateAttribute()
    {
        return $this->created_at->format('Y-m-d');
    } //end of date 

    public function getResultValueAttribute()
    {
        switch ($this->result) {
            case 0:
                return __('records.res_abnormal');
                break;
            case 1:
                return __('records.res_normal');
                break;
            case 2:
                return __('records.res_positive');
                break;
            case 3:
                return __('records.res_negative');
                break;
        };
    } //end of result value

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

    public function medications()
    {
        return $this->hasMany(Medication::class);
    } //end of medications relation



}
