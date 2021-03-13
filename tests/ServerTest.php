<?php

use CloudWays\Server;
use PHPUnit\Framework\TestCase;

class Servertest extends TestCase
{
    protected string $serverId = "1233";
    protected string $gitUrl = "https://gitfake.com";
    protected string $branchName = "master";
    protected string $appId = "1234-appid";

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_can_create_instances_of_server()
    {
        $this->assertInstanceOf(Server::class, $this->getInstanceServer());
    }

    /** @test */
    public function it_can_get_prop_instances_of_server()
    {
        $server = $this->getInstanceServer();
        $this->assertEquals($this->serverId, $server->getServerId());
        $this->assertEquals($this->gitUrl, $server->getGitUrl());
        $this->assertEquals($this->branchName, $server->getBranchName());
        $this->assertEquals($this->appId, $server->getAppId());
    }

    protected function getInstanceServer() : Server
    {
        return Server::create(
            $this->serverId,
            $this->gitUrl,
            $this->branchName,
            $this->appId
        );
    }
}
