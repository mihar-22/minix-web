<?php

namespace Minix\Uuid\Rules;

use Illuminate\Contracts\Validation\Rule;

class UuidRule implements Rule
{
    public function passes($attribute, $value)
    {
        $regex = '^[a-f]{2,3}_[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-'.
            '[0-9A-Fa-f]{12}$';

        return (bool) preg_match($regex, $value);
    }

    public function message()
    {
        return 'The :attribute must be a valid UUID.';
    }
}
