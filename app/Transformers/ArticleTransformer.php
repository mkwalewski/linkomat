<?php

namespace App\Transformers;

use App\Helpers\DateHelper;
use App\Helpers\HTMLHelper;
use App\Helpers\UrlHelper;
use App\Models\DomainPatterns;

class ArticleTransformer implements Transformer
{
    public function transform(array $data, DomainPatterns $pattern): array
    {
        $data['date'] = match($pattern->domain->name) {
            'www.telepolis.pl', 'spidersweb.pl' => DateHelper::replace($data['date'], '#(\d+).(\d+).(\d+)#ui', '%s-%s-%s'),
            'www.ppe.pl' => DateHelper::replace($data['date'],'#(\d+).(\d+),#ui', '2024-%s-%s'),
            'businessinsider.com.pl' => DateHelper::getFormatDateByString($data['date'], 'Y-m-d'),
            default => $data['date'],
        };

        if (empty($data['category']) && $pattern->domain->name === 'businessinsider.com.pl') {
            $urlData = explode('/', $data['url']);
            if (count($urlData) > 5) {
                $data['category'] = UrlHelper::unslugify($urlData[3]);
            }
            if ($data['category'] === 'Wiadomosci') {
                $data['category'] = 'Wiadomości';
            }
        }

        if (empty($data['author']) && $pattern->domain->name === 'businessinsider.com.pl') {
            $data['author'] = 'Materiał promocyjny';
        }

        if (empty($data['category'])) {
            $data['category'] = 'Ogólne';
        }

        if (str_starts_with($data['image'], '/')) {
            $data['image'] = UrlHelper::addHost($data['image'], $data['url']);
        }

        if (is_array($data['tags'])) {
            $data['tags'] = implode(',', $data['tags']);
        }

        if (is_array($data['content'])) {
            $data['content'] = implode('', $data['content']);
        }

        if ($pattern->domain->name === 'www.ppe.pl') {
            $data['content'] = str_replace('src="data:','src1="data:', $data['content']);
            $data['content'] = str_replace('data-src="https://','src="https://', $data['content']);
        }

        if ($pattern->domain->name === 'businessinsider.com.pl') {
            $data['content'] = HTMLHelper::removeByClass($data['content'], 'article-share');
            $data['content'] = HTMLHelper::removeByClass($data['content'], 'related_articles-container');
        }

        if ($pattern->domain->name === 'spidersweb.pl') {
            $data['content'] = str_replace('srcset="','srcset1="', $data['content']);
            $data['content'] = HTMLHelper::removeByClass($data['content'], 'newAd');
            $data['content'] = HTMLHelper::removeByClass($data['content'], 'reddit-embed-outer-wrap');
        }

        $data['content'] = str_replace('src="/', sprintf('src="%s/', UrlHelper::getDomain($data['url'])), $data['content']);
        $data['words_count'] = str_word_count(strip_tags($data['content']));

        return $data;
    }
}
