<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ValidPassword implements Rule
{
    /**
     * Minimum password length
     *
     * @var integer
     */
    public $minimumLength = 10;
	
    /**
     * Determine if the Length Validation Rule passes.
     *
     * @var boolean
     */
    public $lengthPasses = true;

    /**
     * Determine if the Uppercase Validation Rule passes.
     *
     * @var boolean
     */
    public $uppercasePasses = true;

    /**
     * Determine if the Numeric Validation Rule passes.
     *
     * @var boolean
     */
    public $numericPasses = true;

    /**
     * Determine if the Special Character Validation Rule passes.
     *
     * @var boolean
     */
    public $specialCharacterPasses = true;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->lengthPasses = (Str::length($value) >= $this->minimumLength);
        $this->uppercasePasses = (Str::lower($value) !== $value);
        $this->numericPasses = ((bool) preg_match('/[0-9]/', $value));
        $this->specialCharacterPasses = ((bool) preg_match('/[^A-Za-z0-9]/', $value));

        return ($this->lengthPasses && $this->uppercasePasses && $this->numericPasses && $this->specialCharacterPasses);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        switch (true) {
            case ! $this->uppercasePasses
                && $this->numericPasses
                && $this->specialCharacterPasses:
                return 'The :attribute must be at least '. $this->minimumLength .' characters and contain at least one uppercase character.';

            case ! $this->numericPasses
                && $this->uppercasePasses
                && $this->specialCharacterPasses:
                return 'The :attribute must be at least '. $this->minimumLength .' characters and contain at least one number.';

            case ! $this->specialCharacterPasses
                && $this->uppercasePasses
                && $this->numericPasses:
                return 'The :attribute must be at least '. $this->minimumLength .' characters and contain at least one special character.';

            case ! $this->uppercasePasses
                && ! $this->numericPasses
                && $this->specialCharacterPasses:
                return 'The :attribute must be at least '. $this->minimumLength .' characters and contain at least one uppercase character and one number.';

            case ! $this->uppercasePasses
                && ! $this->specialCharacterPasses
                && $this->numericPasses:
                return 'The :attribute must be at least '. $this->minimumLength .' characters and contain at least one uppercase character and one special character.';

            case ! $this->uppercasePasses
                && ! $this->numericPasses
                && ! $this->specialCharacterPasses:
                return 'The :attribute must be at least '. $this->minimumLength .' characters and contain at least one uppercase character, one number, and one special character.';

            default:
                return 'The :attribute must be at least '. $this->minimumLength .' characters.';
        }
    }
}
