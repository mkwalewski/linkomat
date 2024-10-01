<?php

namespace App\Transformers;

use App\Models\DomainPatterns;
use Carbon\Carbon;

class YoutubeTransformer implements Transformer
{
    public function transform(array $data, DomainPatterns $pattern): array
    {
        $data['date'] = new Carbon($data['date']);

        if (is_array($data['keywords'])) {
            $data['keywords'] = implode(',', $data['keywords']);
        }

        if (is_array($data['thumb'])) {
            $data['thumb'] = array_pop($data['thumb']);
            if (isset($data['thumb']['url'])) {
                $data['thumb'] = $data['thumb']['url'];
            } else {
                $data['thumb'] = null;
            }
        }

        return $data;
    }
}
