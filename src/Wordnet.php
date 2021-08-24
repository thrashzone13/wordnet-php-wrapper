<?php

namespace Thrashzone13\WordnetWrapper;

use Thrashzone13\WordnetWrapper\Types\Overview;

class Wordnet
{
    /** @var string $word */
    protected $word;

    /** @var string $path */
    protected $path;

    /**
     * Wordnet Constructor.
     *
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * @param string $path
     * @return static
     */
    public static function create(string $path = 'wn'): self
    {
        return (new self($path));
    }

    /**
     * @param string $word
     * @param string $searchType
     * @return mixed
     */
    public function search(string $word, string $searchType = Overview::class)
    {
        return (new $searchType($word, $this->path))->parse();
    }
}