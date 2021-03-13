<?php

use CloudWays\Deploy\Client;
use CloudWays\Requester;
use CloudWays\Response;
use CloudWays\Server;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    protected string $email = 'test@email.com';
    protected string $apiKey = 'testapikey';
    protected string $responseOutPut = '{ "access_token": "tets1234"}';
    protected string $responseWithAccessToken = '{ "success": true }';

    public function setUp() : void
    {
        parent::setUp();
    }

    /** @test */
    public function it_can_create_instances_of_response()
    {
        $this->assertInstanceOf(Client::class, $this->getInstanceClient());
    }

    /** @test */
    public function it_can_call_execute()
    {
        $client = $this->getInstanceClient();
        $response = $client->execute(Server::create(
            "testserverid",
            "testgiturl",
            "testbranch",
            "testappID"
        ));

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(json_decode($this->responseWithAccessToken), $response->toJSON());
    }

    protected function getInstanceClient() : Client
    {
        $this->requester = $this->createStub(Requester::class);

        $this->requester->method('call')
             ->willReturn(Response::create($this->responseOutPut));

        $this->requester->method('callWithToken')
        ->willReturn(Response::create($this->responseWithAccessToken)); 

        return Client::create($this->email, $this->apiKey, $this->requester);
    }
}
