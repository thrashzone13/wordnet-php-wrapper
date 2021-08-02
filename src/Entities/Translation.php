<?php

namespace Thrashzone13\WordnetWrapper\Entities;

class Translation
{
    /**
     * @var string $translation
     */
    protected $translation;

    /**
     * @var array $examples
     */
    protected $examples;

    /**
     * @param string $translation
     */
    public function __construct(
        string $translation
    )
    {
        $this->translation = $translation;
    }

    /**
     * @return string
     */
    public function getTranslation(): string
    {
        return $this->translation;
    }

    /**
     * @return array
     */
    public function getExamples(): array
    {
        return $this->examples;
    }
}