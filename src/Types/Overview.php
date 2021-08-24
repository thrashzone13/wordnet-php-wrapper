<?php

namespace Thrashzone13\Wordnet;

use Thrashzone13\Contracts\SearchTypeInterface;

class Overview implements SearchTypeInterface
{
    public function parse()
    {
        // TODO: Implement parse() method.
    }

    public function getSearchType(): string
    {
        return 'over';
    }
}