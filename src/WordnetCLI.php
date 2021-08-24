<?php

namespace Thrashzone13\WordnetWrapper;

use Thrashzone13\WordnetWrapper\Exceptions\PathIsIncorrectException;
use Thrashzone13\WordnetWrapper\Exceptions\WordNotFoundException;

abstract class WordnetCLI
{
    const RESPONSE_STATUS_CODE_NEEDLE = 'code:';

    /** @var string $word */
    protected $word;

    /** @var string $response */
    protected $response;

    /**
     * WordnetCLI Constructor.
     *
     * @throws \Exception
     */
    public function __construct(string $word, string $path)
    {
        $this->word = $word;
        $this->exec($word, $this->getSearchType(), $path);
    }

    /**
     * @param string $word
     * @param string|null $searchType
     * @param string $path
     * @return void
     * @throws PathIsIncorrectException
     * @throws WordNotFoundException
     */
    private function exec(string $word, string $searchType, string $path = 'wn'): void
    {
        $this->response = shell_exec("{$path} {$word} -{$searchType} 2>&1; echo " . self::RESPONSE_STATUS_CODE_NEEDLE . "$?");

        if ($this->getResponseStatusCode() === 127) {
            throw new PathIsIncorrectException;
        }

        if ($this->getResponseStatusCode() === 0) {
            throw new WordNotFoundException;
        }

        $this->response = strstr($this->response, self::RESPONSE_STATUS_CODE_NEEDLE, true);
    }

    /**
     * @return int
     */
    protected function getResponseStatusCode(): int
    {
        return (int)str_between($this->response, self::RESPONSE_STATUS_CODE_NEEDLE, PHP_EOL);
    }

    protected abstract function getSearchType(): string;
}