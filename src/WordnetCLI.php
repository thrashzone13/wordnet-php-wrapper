<?php

namespace Thrashzone13\WordnetWrapper;

use Exception;
use Thrashzone13\WordnetWrapper\Exceptions\PathIsIncorrectException;
use Thrashzone13\WordnetWrapper\Exceptions\WordNotFoundException;

abstract class WordnetCLI
{
    const RESPONSE_STATUS_CODE_NEEDLE = 'code:';

    /** @var string $word */
    protected $word;

    /** @var string $path */
    protected $path;

    /** @var string $response */
    private $response;

    /**
     * WordnetCLI Constructor.
     *
     * @throws Exception
     */
    public function __construct(string $word, string $path)
    {
        $this->word = $word;
        $this->path = $path;

        $this->exec();
    }

    /**
     * @return void
     * @throws PathIsIncorrectException
     * @throws WordNotFoundException
     */
    private function exec(): void
    {
        $this->response = shell_exec("{$this->path} \"{$this->word}\" -{$this->getSearchType()} 2>&1; echo " . self::RESPONSE_STATUS_CODE_NEEDLE . "$?");

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

    /**
     * @return string
     */
    protected function getResponse(): string
    {
        return $this->response;
    }

    /**
     * @return string
     */
    protected abstract function getSearchType(): string;
}