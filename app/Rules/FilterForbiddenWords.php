<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FilterForbiddenWords implements Rule
{


    private $forbiddenWords = ['forbidden word', 'another forbidden word'];

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($forbiddenWords = [])
    {
        $this->forbiddenWords = $forbiddenWords;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return !in_array($value, $this->forbiddenWords);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is forbidden word.';
    }
}
