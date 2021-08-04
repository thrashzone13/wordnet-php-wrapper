<?php

namespace Thrashzone13\Contracts;
interface SearchTypeInterface
{
    /**
     * @return mixed
     */
    public function parse();

    /**
     * @return string
     */
    public function getSearchType(): string;
}