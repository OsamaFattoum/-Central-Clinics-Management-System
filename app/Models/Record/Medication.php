<?php

namespace App\Models\Record;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    use HasFactory;

    protected $guarded = [];

    //attr

    //relation
    public function record()
    {
        return $this->belongsTo(Record::class);
    } //end of record relation
}
