<?php

namespace Thrashzone13\WordnetWrapper\Types;

use Thrashzone13\WordnetWrapper\Entities\Word;
use Thrashzone13\WordnetWrapper\WordnetCLI;

class Overview extends WordnetCLI
{
    const TRANSLATIONS_SEPARATOR = 'Overview of';

    public function parse(): Word
    {
        $translations = [];

        /** @var string $translation */
        foreach ($this->getTranslations() as $translation) {
            $translations = array_merge($translations, $this->parseTranslation($translation));
        }

        return new Word($this->word, $translations);
    }

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

    private function parsePartOfSpeech(string $translation): string
    {
        preg_match("/(.*?) {$this->word}\n/", $translation, $matches);
        return ucfirst(trim(end($matches)));
    }

    private function getTranslations(): array
    {
        $items = explode(self::TRANSLATIONS_SEPARATOR, $this->response);
        return array_filter($items, function ($value) {
            return !empty(trim($value));
        });
    }

    protected function getSearchType(): string
    {
        return 'over';
    }
}