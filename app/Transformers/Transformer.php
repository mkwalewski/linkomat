<?php

namespace App\Transformers;

use App\Models\DomainPatterns;

interface Transformer
{
    public function transform(array $data, DomainPatterns $pattern): array;
}
