<?php

namespace Thrashzone13\Wordnet;

use Thrashzone13\Contracts\WordnetCLIInterface;

class WordnetCLI implements WordnetCLIInterface
{
    /**
     * @param string $word
     * @param string|null $searchType
     * @param string $path
     * @return string
     */
    public function exec(string $word, string $searchType = null, string $path = 'wn'): string
    {
        return shell_exec("{$path} {$word} " . is_null($searchType) ? "" : "-{$searchType}");
    }
}