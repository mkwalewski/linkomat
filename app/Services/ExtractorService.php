<?php

namespace App\Services;

use App\Helpers\ArrayHelper;
use App\Helpers\RegExpHelper;
use App\Models\DomainPatterns;
use Carbon\Carbon;
use Symfony\Component\DomCrawler\Crawler;

class ExtractorService
{
    public function extract(array $rawData, DomainPatterns $pattern): array
    {
        $data = [
            'url' => $rawData['url'],
            'is_premium' => false,
            'domains_id' => $pattern->domain->id,
            'created_at' => new Carbon('now'),
        ];
        $html = file_get_contents($rawData['url']);
//        file_put_contents('yt.html', $html);
        $crawler = new Crawler($html);

        if (isset($rawData['date'])) {
            $data['created_at'] = Carbon::createFromTimestamp($rawData['date']);
        }

        if ($pattern->domain->name === 'businessinsider.com.pl' && str_contains($html, 'class="premium-wrapper"')) {
            $data['is_premium'] = true;
            $pattern = DomainPatterns::where(['domains_id' => $pattern->domain->id, 'is_premium' => true])->first();
        }

        foreach ($pattern->fields as $field) {
            $value = null;
            $filter = match ($field->filter_type) {
                'css' => $crawler->filter($field->filter_pattern),
                'xpath' => $crawler->filterXPath($field->filter_pattern),
                'script' => $crawler->filterXPath(sprintf('//script[contains(., "var %s")]/text()', $field->filter_pattern)),
            };
            if ($filter->count() > 0) {
                $value = match ($field->return_type) {
                    'text' => $filter->text(),
                    'html' => $filter->html(),
                    'src' => $filter->attr('src'),
                    'datetime' => $filter->attr('datetime'),
                    'multi_text' => $filter->each(function (Crawler $node): string {
                        return $node->text();
                    }),
                    'multi_html' => $filter->each(function (Crawler $node): string {
                        return $node->html();
                    }),
                    'json' => call_user_func(static function () use ($filter, $field) {
                        $string = sprintf('var %s = ({.*?});', $field->filter_pattern);
                        $pattern = RegExpHelper::preparePattern($string, 'musi');
                        preg_match($pattern, $filter->text(), $match);
                        $json = json_decode($match[1], true);
                        $extract = ArrayHelper::extract($json, $field->return_path);
                        return $extract;
                    }),
                };
            }
            $data[$field->field] = $value ?? null;
        }

        return $data;
    }
}
