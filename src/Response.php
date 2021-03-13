<?php

namespace CloudWays;

class Response
{
    public static function create(string $output)
    {
        return new static($output);
    }

    public function __construct(
        protected string $output
    ) {
    }

    public function toJSON()
    {
        return json_decode($this->output);
    }

    public function getCloudWaysResponse() : CloudWaysResponse
    {
        return CloudWaysResponse::create($this->toJSON());
    }
}
