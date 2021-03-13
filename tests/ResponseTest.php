<?php

use CloudWays\Response;
use PHPUnit\Framework\TestCase;

class Responsetest extends TestCase
{
    protected string $output = '{ "access_token": "12345" }';

    /** @test */
    public function it_can_create_instances_of_response()
    {
        $this->assertInstanceOf(Response::class, $this->getInstanceResponse());
    }

    /** @test */
    public function it_can_get_access_token_prop()
    {
        $response = $this->getInstanceResponse();
        $json = json_decode($this->output);

        $this->assertEquals($json->access_token, $response->getCloudWaysResponse()->getAccessToken());
    }

    protected function getInstanceResponse() : Response
    {
        return Response::create($this->output);
    }
}
