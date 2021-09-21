<?php

if (!function_exists('str_between')) {
    function str_between(string $string, string $start, string $end): string
    {
        return strstr(ltrim(strstr($string, $start), $start), $end, true);
    }
}

if (!function_exists('str_starts_with')) {
    function str_starts_with(string $string, string $needle): bool
    {
        return substr($string, 0, strlen($needle)) === $needle;
    }

}
if (!function_exists('str_ends_with')) {
    function str_ends_with(string $string, string $needle): bool
    {
        $length = strlen($needle);
        return !$length || substr($string, -$length) === $needle;
    }
}

if (!function_exists('str_is_between')) {
    function str_is_between(string $string, string $start, string $end): bool
    {
        return str_starts_with($string, $start) && str_ends_with($string, $end);
    }
}