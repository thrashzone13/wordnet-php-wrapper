<?php

namespace Thrashzone13\WordnetWrapper\Types;

use Thrashzone13\WordnetWrapper\Entities\Word;
use Thrashzone13\WordnetWrapper\WordnetCLI;

class Overview extends WordnetCLI
{
    const TRANSLATIONS_SEPARATOR = 'Overview of';

    /**
     * @return Word
     */
    public function parse(): Word
    {
        $translations = [];

        foreach ($this->extractTranslations() as $translation) {
            $translations = array_merge($translations, $this->parseTranslation($translation));
        }

        return new Word($this->extractBaseWord(), $translations);
    }

    /**
     * @param string $translation
     * @return array
     */
    private function parseTranslation(string $translation): array
    {
        preg_match_all("/([0-9]). (.*?)\n/", $translation, $matches);

        $translations = [];

        foreach (reset($matches) as $match) {

            $parts = preg_split("/[:;]/", str_between($match, '-- (', ')'));
            $exampleStrings = [];
            $translationStrings = [];

            foreach ($parts as $part) {
                $part = trim($part);
                if (str_is_between($part, '"', '"')) {
                    array_push($exampleStrings, trim($part, '"'));
                } else {
                    array_push($translationStrings, $part);
                }
            }

            $pos = "Thrashzone13\\WordnetWrapper\\Entities\\" . $this->parsePartOfSpeech($translation);
            array_push($translations, new $pos(implode(', ', $translationStrings), $exampleStrings));
        }

        return $translations;
    }

    /**
     * @param string $translation
     * @return string
     */
    private function parsePartOfSpeech(string $translation): string
    {
        preg_match("/(.*?) {$this->extractBaseWord()}\n/", $translation, $matches);

        $pos = ucfirst(trim(end($matches)));

        switch ($pos) {
            case 'Adj':
                return 'Adjective';
            case 'Adv':
                return 'Adverb';
            default:
                return $pos;
        }
    }

    /**
     * @return array
     */
    private function extractTranslations(): array
    {
        $items = explode(self::TRANSLATIONS_SEPARATOR, $this->getResponse());

        return array_filter($items, function ($value) {
            return !empty(trim($value));
        });
    }

    /**
     * @return string
     */
    private function extractBaseWord(): string
    {
        preg_match("/" . self::TRANSLATIONS_SEPARATOR . " (.*?)\n/", $this->getResponse(), $matches);

        $words = explode(' ', reset($matches));

        return end($words);
    }

    /**
     * @return string
     */
    protected function getSearchType(): string
    {
        return 'over';
    }
}