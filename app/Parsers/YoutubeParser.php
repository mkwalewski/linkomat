<?php

namespace App\Parsers;

use App\Exceptions\DuplicateException;
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

    /**
     * @throws DuplicateException
     */
    public function parse(array $data, DomainPatterns $pattern): int
    {
        $video = Videos::where(['url' => $data['url']])->first();

        if ($video) {
            throw new DuplicateException('Takie video już istnieje!');
        }

        $rawData = $this->extractor->extract($data, $pattern);
        $data = $this->transformer->transform($rawData, $pattern);

        $video = new Videos($data);
        $video->save();

        return $video->id;
    }
}
