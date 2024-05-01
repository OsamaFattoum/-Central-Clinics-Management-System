<?php

namespace App\Models;

use App\Models\Users\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    public function patients()
    {
        return $this->hasMany(Patient::class);
    } //end of patient relation
}
