<?php

function str_between(string $string, string $start, string $end): string
{
    return strstr(ltrim(strstr($string, $start), $start), $end, true);
}

function str_start_with(string $string, string $needle): bool
{
    return substr($string, 0, strlen($needle)) === $needle;
}

function str_end_with(string $string, string $needle): bool
{
    $length = strlen($needle);
    return !$length || substr($string, -$length) === $needle;
}

function str_is_between(string $string, string $start, string $end): bool
{
    return str_start_with($string, $start) && str_end_with($string, $end);
}