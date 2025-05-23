<?php

use Italofantone\Marky\Facades\Marky;

if (!function_exists('markdown')) {
    function markdown(string $markdown): string
    {
        return Marky::render($markdown);
    }
}