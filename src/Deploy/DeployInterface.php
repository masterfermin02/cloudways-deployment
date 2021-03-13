<?php

namespace CloudWays\Deploy;

use CloudWays\Response;
use CloudWays\Server;

interface DeployInterface
{
    public function execute(Server $server): Response;
}
