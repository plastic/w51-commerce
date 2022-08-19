<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class CheckImage implements Rule
{
    private $width;
    private $height;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
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
        $image = getimagesize($value);
        return ($image[0] === $this->width && $image[1] === $this->height);


    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Image dimension must be equal " . $this->width . "x" . $this->height;
    }
}
