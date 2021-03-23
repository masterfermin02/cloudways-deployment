<p align="center"><img src="https://banners.beyondco.de/Cloudways%20deployment%20tool.png?theme=dark&packageManager=composer+require&packageName=masterfermin02%2Fcloud-ways-deploy&pattern=architect&style=style_1&description=A+deployment+tool+written+in+PHP+to+deploy+apps+to+cloudways.&md=1&showWatermark=1&fontSize=100px&images=cloud-upload" alt="Social Card of cloudways deployment tool"></p>

# cloudways-deployment

[![GitHub forks](https://img.shields.io/github/forks/masterfermin02/cloudways-deployment)](https://img.shields.io/github/issues/masterfermin02/cloudways-deployment)
[![GitHub starts](https://img.shields.io/github/stars/masterfermin02/cloudways-deployment)](https://img.shields.io/github/stars/masterfermin02/cloudways-deployment)
[![license](https://img.shields.io/github/license/masterfermin02/cloudways-deployment)](LICENSE.md)

A deployment tool written in PHP to deploy apps to cloudways.

## Installation and usage

This package requires PHP 8 or higher.

- Install by composer
```bash
composer require masterfermin02/cloud-ways-deploy
```
# Use
- Config your git webhook [doc](https://docs.github.com/en/developers/webhooks-and-events/creating-webhooks)
- Deploy example script:
```php
<?php declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

use App\Input;
use CloudWays\Deploy\Client;
use CloudWays\Requester;
use CloudWays\Server;

$apiKey = $_ENV['API_KEY']; // API key clouds ways key
$API_URL = $_ENV['API_URL']; // your cloudways server api url
$email = $_ENV['DEPLOYMENT_EMAIL']; // your email to receive notifiy on deploy finish
$input = Input::create(array_merge($_GET, $_POST));

// git web hook example url http://yourserver/deployApplication.php?server_id=1234&app_id=1234&git_url=git_url&branch_name=master&deploy_path=path_to_your_app
$gitPullResponse = Client::create($email, $apiKey, Requester::create($API_URL))
->execute(Server::create(
    $input->get('server_id'),
    $input->get('git_url'),
    $input->get('branch_name'),
    $input->get('app_id')
));

echo (json_encode($gitPullResponse));
```

## Testing

Run the tests with:

``` bash
composer test
```

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Credits

- [Fermin Perdomo](https://github.com/masterfermin02)
- [All Contributors](../../contributors)
