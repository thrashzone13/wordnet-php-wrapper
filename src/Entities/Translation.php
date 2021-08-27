<?php

namespace Thrashzone13\WordnetWrapper\Entities;

abstract class Translation
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
     * @param array $examples
     */
    public function __construct(
        string $translation,
        array  $examples
    )
    {
        $this->translation = trim($translation);
        $this->examples = $examples;
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

    /**
     * @return string
     */
    public function getPartOfSpeech(): string
    {
        return (new \ReflectionClass(get_called_class()))->getShortName();
    }
}