<?php

use Thrashzone13\WordnetWrapper\Entities\Word;
use Thrashzone13\WordnetWrapper\Exceptions\WordNotFoundException;
use Thrashzone13\WordnetWrapper\Wordnet;

class OverviewTest extends \PHPUnit\Framework\TestCase
{
    public function test_all_parts_of_speeches_are_fetched()
    {
        $this->assertCount(2, Wordnet::create()->search('cat')->includedPartsOfSpeeches());
    }

    public function test_word_not_found()
    {
        $this->expectException(WordNotFoundException::class);

        Wordnet::create()->search('jijijij');
    }

    public function test_return_type_is_word()
    {
        $this->assertInstanceOf(Word::class, Wordnet::create()->search('cat'));
    }
}