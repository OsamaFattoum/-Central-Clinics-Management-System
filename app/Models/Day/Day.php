<?php

namespace App\Models\Day;

use App\Models\Facility\FacilityDay;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as ContractsTranslatable;


class Day extends Model implements ContractsTranslatable
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['day'];

    protected $guarded = [];

    public function facilityDays()
    {
        return $this->hasMany(FacilityDay::class);
    } //end of facilityDays relation
}
