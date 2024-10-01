<?php

namespace App\Parsers;

use App\Models\DomainPatterns;
use App\Models\Videos;
use App\Services\ExtractorService;
use App\Transformers\YoutubeTransformer;

readonly class YoutubeParser implements Parser
{
    public function __construct(
        private ExtractorService   $extractor,
        private YoutubeTransformer $transformer,
    ) {
    }

    public function parse(array $data, DomainPatterns $pattern): int
    {
        # @todo add duplicate check

        $rawData = $this->extractor->extract($data, $pattern);
        $data = $this->transformer->transform($rawData, $pattern);

        $video = new Videos($data);
        $video->save();

        return $video->id;
    }
}
