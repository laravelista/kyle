<?php

if (! function_exists('convert_integer')) {
    /**
     * Converts "1.123,45" to 112345.
     *
     * @param  string $number
     * @return integer
     */
    function convert_integer(string $number)
    {
        // Remove . and , from number
        return preg_replace('/[.|,]/', '', $number);
    }
}