<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class UniqueAccreditationName implements ValidationRule
{

    protected $clinicId;
    protected $accreditationId;

    public function __construct($clinicId, $accreditationId = null)
    {
        $this->clinicId = $clinicId;
        $this->accreditationId = $accreditationId;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $query = DB::table('clinic_accreditations')
            ->where('clinic_id', $this->clinicId)
            ->where('name', $value);

        if ($this->accreditationId !== null) {
            $query->where('id', '!=', $this->accreditationId);
        }

      
        if ($query->exists()) {
            
            $fail(__('clinic_accreditations.name.unique'));
        }
    }
}
