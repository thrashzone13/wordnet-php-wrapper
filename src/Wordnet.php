<?php

namespace Thrashzone13\WordnetWrapper;

use Thrashzone13\Wordnet\Overview;
use Thrashzone13\Wordnet\WordnetCLI;

class Wordnet
{
    /** @var Wordnet|null $instance */
    protected static $instance = null;

    /** @var string $word */
    protected static $word;

    /** @var string $path */
    protected static $path;

    private function __construct()
    {
    }

    /**
     * @param string $word
     * @param string $path
     * @return static
     */
    public static function setWord(string $word, string $path = 'wn'): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        self::$path = $path;
        self::$word = $word;

        return self::$instance;
    }

    /**
     * @return array
     */
    public function getAvailableSearchTypes(): array
    {
        $result = explode(PHP_EOL, (new WordnetCLI())->exec(self::$word));

        return [];
    }

    /**
     * @param string $searchType
     * @return mixed
     */
    public function search(string $searchType = Overview::class)
    {
        return (new $searchType(self::$word))->parse();
    }
}