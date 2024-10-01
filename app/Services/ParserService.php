<?php

namespace App\Services;

use App\Exceptions\NoParserException;
use App\Helpers\RegExpHelper;
use App\Models\DomainPatterns;
use App\Models\Domains;

class ParserService
{
    private const PARSERS_NAMESPACE = 'App\\Parsers\\';
    private const TRANSFORMERS_NAMESPACE = 'App\\Transformers\\';

    public function __construct(
        private readonly ExtractorService $extractor,
    ) {
    }

    /**
     * @throws NoParserException
     */
    public function parse(array $data): int
    {
        $patterns = DomainPatterns::all();

        foreach ($patterns as $pattern) {
            if (preg_match(RegExpHelper::preparePattern($pattern->pattern), $data['url'])) {
                $parserClassName = self::PARSERS_NAMESPACE . $pattern->parser;
                $transformerClassName = self::TRANSFORMERS_NAMESPACE . str_replace('Parser', 'Transformer', $pattern->parser);
                $parser = new $parserClassName($this->extractor, new $transformerClassName());

                return $parser->parse($data, $pattern);
            }
        }

        throw new NoParserException('Nie znaleziono parsera!');
    }
}
