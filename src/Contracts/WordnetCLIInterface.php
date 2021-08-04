<?php

namespace Thrashzone13\Contracts;
interface WordnetCLIInterface
{
    /**
     * @param string $word
     * @param string $path
     * @param string|null $searchType
     * @return string
     */
    public function exec(string $word, string $searchType = null, string $path = 'wn'): string;
}