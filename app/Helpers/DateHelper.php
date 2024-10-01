<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper implements Helper
{
    public static function replace(string $date, string $pattern, string $format): string
    {
        if (str_contains(strtolower($date), 'dzisiaj')) {
            return self::getFormatDateByString('today', 'Y-m-d');
        }

        if (str_contains(strtolower($date), 'wczoraj')) {
            return self::getFormatDateByString('yesterday', 'Y-m-d');
        }

        if (preg_match($pattern, $date, $match)) {
            $values = match($format) {
                '%s-%s-%s' => [$match[3], $match[2], $match[1]],
                '2024-%s-%s' => [$match[2], $match[1]],
            };

            return vsprintf($format, $values);
        }

        return $date;
    }

    public static function getFormatDateByString(?string $time, string $format): string
    {
        if (!$time) {
            $time = 'now';
        }

        $date = new Carbon($time);

        return $date->format($format);
    }
}
