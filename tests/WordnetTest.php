<?php

use Thrashzone13\WordnetWrapper\Entities\Word;
use Thrashzone13\WordnetWrapper\Exceptions\PathIsIncorrectException;
use Thrashzone13\WordnetWrapper\Wordnet;

class WordnetTest extends \PHPUnit\Framework\TestCase
{
    public function test_path_is_not_defined_correctly()
    {
        $this->expectException(PathIsIncorrectException::class);

        Wordnet::create('path/to/wn')->search('word');
    }

    public function test_words_including_space_inside()
    {
        $input = 'word';

        /** @var Word $word */
        $word = Wordnet::create()->search($input);

        $this->assertStringContainsString($word->getWord(), $input);
    }
}