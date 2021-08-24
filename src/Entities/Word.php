<?php

namespace Thrashzone13\WordnetWrapper\Entities;
class Word
{
    /**
     * @var string $word
     */
    protected $word;

    /**
     * @var array $translations
     */
    protected $translations;

    /**
     * @param string $word
     * @param array $translations
     */
    public function __construct(
        string $word,
        array  $translations
    )
    {
        $this->word = $word;
        $this->translations = $translations;
    }

    /**
     * @return string
     */
    public function getWord(): string
    {
        return $this->word;
    }

    /**
     * @return array
     */
    public function getTranslations(): array
    {
        return $this->translations;
    }

    /**
     * @return array
     */
    public function includedPartsOfSpeeches(): array
    {
        $partsOfSpeeches = [];

        /** @var Translation $translation */
        foreach ($this->translations as $translation) {
            array_push($partsOfSpeeches, $translation->getPartOfSpeech());
        }

        return array_unique($partsOfSpeeches);
    }
}