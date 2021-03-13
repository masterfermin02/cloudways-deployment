<?php

namespace CloudWays;

use Exception;

class RequestException extends Exception
{
    public static function invalidResponseCode(string $httpcode, string $output): self
    {
        return new static("An error occurred code :  `{$httpcode}` output: `{$output}`");
    }
}
