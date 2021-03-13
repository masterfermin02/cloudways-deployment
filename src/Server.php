<?php

namespace CloudWays;

class Server
{
    public static function create(string $serverId, string $gitUrl, string $branchName, string $appId): self
    {
        return new static($serverId, $gitUrl, $branchName, $appId);
    }

    public function __construct(
        protected string $serverId,
        protected string $gitUrl,
        protected string $branchName,
        protected string $appId
    ) {
    }

    public function getServerId(): string
    {
        return $this->serverId;
    }

    public function getGitUrl(): string
    {
        return $this->gitUrl;
    }

    public function getBranchName(): string
    {
        return $this->branchName;
    }

    public function getAppId(): string
    {
        return $this->appId;
    }
}
