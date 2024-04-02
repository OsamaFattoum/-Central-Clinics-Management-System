<?php

namespace App\Models\Facility;

use App\Models\Day\Day;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityDay extends Model
{
    use HasFactory;

    protected $fillable = ['day_id', 'facility_id', 'facility_type'];

    public function day()
    {
        return $this->belongsTo(Day::class);
    }//end of day relation

    public function facility()
    {
        return $this->morphTo();
    }// end of facility relation
}
