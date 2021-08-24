<?php

namespace Thrashzone13\WordnetWrapper\Exceptions;

class PathIsIncorrectException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Wordnet not found in the defined path");
    }
}