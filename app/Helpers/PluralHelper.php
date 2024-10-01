<?php

namespace App\Helpers;

class PluralHelper implements Helper
{
    public static function plural(int $number, string $one, string $few, string $many): string
    {
        // Exceptions from 11 to 19 always "many"
        if ($number % 100 > 10 && $number % 100 < 20) {
            return $number . ' ' . $many;
        }

        $form = match ($number % 10) {
            1 => $one,
            2,3,4 => $few,
            default => $many,
        };

        return $number . ' ' . $form;
    }
}
