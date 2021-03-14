<?php

namespace CloudWays;

use CurlHandle;

class Requester
{
    public static function create(string $baseUrl): self
    {
        return new static($baseUrl);
    }

    public function __construct(
        protected string $baseUrl
    ) {
    }

    public function callWithToken(string $method, string $endPoint, string $accessToken, array $post): Response
    {
        $ch = $this->createCH($method, $endPoint, $post);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $accessToken]);

        return $this->getResponse($ch);
    }

    public function call(string $method, string $endPoint, array $post): Response
    {
        $ch = $this->createCH($method, $endPoint, $post);

        return $this->getResponse($ch);
    }

    protected function createCH(string $method, string $endPoint, array $post) : CurlHandle | false
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_URL, $this->baseUrl . $endPoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //Set Post Parameters
        $encoded = '';
        if (count($post)) {
            foreach ($post as $name => $value) {
                $encoded .= urlencode($name) . '=' . urlencode($value) . '&';
            }
            $encoded = substr($encoded, 0, strlen($encoded) - 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $encoded);
            curl_setopt($ch, CURLOPT_POST, 1);
        }

        return $ch;
    }

    protected function getResponse($ch): Response
    {
        $output = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpcode != '200') {
            throw RequestException::invalidResponseCode($httpcode, substr($output, 0, 10000));
        }
        curl_close($ch);

        return Response::create($output);
    }
}
