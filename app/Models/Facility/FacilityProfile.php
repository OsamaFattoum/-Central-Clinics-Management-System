<?php

namespace App\Models\Facility;

use App\Casts\TimeCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Type\Time;

class FacilityProfile extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'open_hours' => TimeCast::class,
        'close_hours' => TimeCast::class,
    ];

    public function facility()
    {
        return $this->morphTo();
    } //end of profileable relation
}
