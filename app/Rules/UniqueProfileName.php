<?php

namespace App\Rules;

use App\Models\Users\ProfileTranslation;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueProfileName implements ValidationRule
{
    protected $profileType;
    protected $profileId;
    protected $locale;


    public function __construct($profileType, $locale, $profileId = null)
    {
        $this->profileType = $profileType;
        $this->profileId = $profileId;
        $this->locale = $locale;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Query to check if the name exists for the given profileable type, excluding the current profile if updating
        $query = ProfileTranslation::where('name', $value)
            ->where('locale', $this->locale)
            ->whereHas('profile', function ($query) {
                $query->where('profile_type', $this->profileType);
                if ($this->profileId) {
                    $query->where('profile_id', '!=', $this->profileId);
                }
            });

        if ($query->exists()) {
            $fail(__('validation.unique'));
        }
    }
}
