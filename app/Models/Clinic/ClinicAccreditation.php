<?php

namespace App\Models\Clinic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicAccreditation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    } //end of clinic relation
}
