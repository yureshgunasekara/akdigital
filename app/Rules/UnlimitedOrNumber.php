<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UnlimitedOrNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $isNumber = (int) $value == 0 ? false : true;
        if (!$isNumber && $value != 'Unlimited') {
            $fail('The :attribute must be number or unlimited.');
        }
    }
}
