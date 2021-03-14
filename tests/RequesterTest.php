<?php

use CloudWays\Requester;
use PHPUnit\Framework\TestCase;

class Requestertest extends TestCase
{
    protected string $url = 'http://test.fake';

    /** @test */
    public function it_can_create_instances_of_response()
    {
        $this->assertInstanceOf(Requester::class, $this->getInstanceRequester());
    }
    
    protected function getInstanceRequester() : Requester
    {
        return Requester::create($this->url);
    }
}
