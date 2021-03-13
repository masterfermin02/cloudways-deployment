<?php

namespace CloudWays\Deploy;

use CloudWays\Requester;
use CloudWays\Response;
use CloudWays\Server;

class Client implements DeployInterface
{
    public function __construct(
        protected string $email,
        protected string $apiKey,
        protected Requester $requester
    ) {
    }

    public static function create(string $email, string $apiKey, Requester $requester): self
    {
        return new static($email, $apiKey, $requester);
    }

    public function execute(Server $server): Response
    {
        $response = $this->requester->call('POST', '/oauth/access_token', [
            'email' => $this->email,
            'api_key' => $this->apiKey,
        ]);

        return $this->requester->callWithToken('POST', '/git/pull', $response->getCloudWaysResponse()->getAccessToken(), [
            'server_id' => $server->getServerId(),
            'app_id' => $server->getAppId(),
            'git_url' => $server->getGitUrl(),
            'branch_name' => $server->getBranchName(),
        ]);
    }
}
