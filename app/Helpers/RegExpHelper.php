<?php

namespace App\Helpers;

class RegExpHelper implements Helper
{
    public static function preparePattern(string $pattern, string $modifiers = 'ui'): string
    {
        return '#' . $pattern . '#' . $modifiers;
    }
}
