<?php

use Thrashzone13\WordnetWrapper\Entities\Word;
use Thrashzone13\WordnetWrapper\Exceptions\WordNotFoundException;
use Thrashzone13\WordnetWrapper\Wordnet;

class OverviewTest extends \PHPUnit\Framework\TestCase
{
    public function test_all_parts_of_speeches_are_fetched()
    {
        /** @var Word $word */
        $word = Wordnet::create()->search('cat');

        $this->assertTrue(count($word->includedPartsOfSpeeches()) == 2);
    }

    public function test_word_not_found()
    {
        $this->expectException(WordNotFoundException::class);
        Wordnet::create()->search('jijijij');
    }

    public function test_return_type_is_word()
    {
        $this->assertTrue(Wordnet::create()->search('cat') instanceof Word);
    }
}