<?php

namespace CloudWays;

class CloudWaysResponse
{
    protected string $accessToken;

    public function __construct(protected $response)
    {
        $this->accessToken = $this->response->access_token;
    }

    public static function create($response) : self
    {
        return new static($response);
    }

    public function getAccessToken() : string
    {
        return $this->accessToken;
    }
}
