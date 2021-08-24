<?php

namespace Thrashzone13\WordnetWrapper\Exceptions;

class WordNotFoundException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Word not found", 404);
    }
}