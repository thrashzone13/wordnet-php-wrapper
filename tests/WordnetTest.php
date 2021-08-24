<?php

use Thrashzone13\WordnetWrapper\Exceptions\PathIsIncorrectException;
use Thrashzone13\WordnetWrapper\Wordnet;

class WordnetTest extends \PHPUnit\Framework\TestCase
{
    public function test_path_is_not_defined_correctly()
    {
        $this->expectException(PathIsIncorrectException::class);
        Wordnet::create('path/to/wn')->search('word');
    }
}