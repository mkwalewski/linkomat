<?php

namespace App\Parsers;

use App\Exceptions\DuplicateException;
use App\Models\Articles;
use App\Models\DomainPatterns;
use App\Services\ExtractorService;
use App\Transformers\ArticleTransformer;

readonly class ArticleParser implements Parser
{
    public function __construct(
        private ExtractorService   $extractor,
        private ArticleTransformer $transformer,
    ) {
    }

    /**
     * @throws DuplicateException
     */
    public function parse(array $data, DomainPatterns $pattern): int
    {
        $article = Articles::where(['url' => $data['url']])->first();

        if ($article) {
            throw new DuplicateException('Taki artykuł już istnieje!');
        }

        $rawData = $this->extractor->extract($data, $pattern);
        $data = $this->transformer->transform($rawData, $pattern);

        $article = new Articles($data);
        $article->save();

        return $article->id;
    }
}
