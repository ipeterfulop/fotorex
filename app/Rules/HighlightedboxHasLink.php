<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class HighlightedboxHasLink implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {

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
        return (intval(request()->input('printer_id')) > 0)
            || (intval(request()->input('printer_rentaloption_id')) > 0)
            || (intval(request()->input('article_id')) > 0);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Válasszon terméket, bérelhető terméket vagy cikket.';
    }
}
