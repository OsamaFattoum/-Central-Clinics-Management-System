<?php

namespace App\Rules;

use App\Models\Case\CaseType;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class UniqueCaseTypeName implements ValidationRule
{

    protected $departmentId;
    protected $caseTypeId;
    protected $locale;

    public function __construct($departmentId,string $locale, $caseTypeId = null)
    {
        $this->departmentId = $departmentId;
        $this->locale = $locale;
        $this->caseTypeId = $caseTypeId;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $query = CaseType::where('department_id', $this->departmentId)
            ->whereHas('translations', function ($query) use ($value) {
                $query->where('name', $value);
                $query->where('locale', $this->locale);
            });


        if ($this->caseTypeId !== null) {
            $query->where('id', '!=', $this->caseTypeId);
        }

        if ($query->exists()) {

            $fail(__('case_type.'.$this->locale.'.name.unique'));

        }

       
    }
}
