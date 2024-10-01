<?php

namespace App\Helpers;

use DOMDocument;
use DOMXPath;

class HTMLHelper implements Helper
{
    public static function removeByClass(string $html, string $classToRemove): string
    {
        $dom = new DOMDocument('1.0', 'UTF-8');
        @$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
        $xpath = new DOMXPath($dom);
        $divs = $xpath->query('//div[contains(@class, "'.$classToRemove.'")]');
        foreach ($divs as $div) {
            $div->parentNode->removeChild($div);
        }
        $html = $dom->saveHTML();

        return $html;
    }
}
