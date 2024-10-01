<?php

namespace App\Helpers;

class ArrayHelper implements Helper
{
    public static function extract(array $data, string $path, string $delimiter = '->'): null|string|array
    {
        $parts = explode($delimiter, $path);

        foreach ($parts as $part) {
            if (!isset($data[$part])) {
                return null;
            }
            $data = $data[$part];
        }

        return $data;
    }
}
