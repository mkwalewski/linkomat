<?php

namespace App\Helpers;

class UrlHelper implements Helper
{
    public static function getDomain(string $url): string
    {
        $urlData = parse_url($url);
        $domain = $urlData['scheme'] . '://' . $urlData['host'];

        return $domain;
    }

    public static function addHost(string $link, string $url): string
    {
        $urlData = parse_url($url);
        $fullLink = $urlData['scheme'] . '://' . $urlData['host'] . $link;

        return $fullLink;
    }

    public static function unslugify(string $slug): string
    {
        $text = str_replace('-', ' ', $slug);
        $text = ucfirst(strtolower($text));

        return $text;
    }
}
