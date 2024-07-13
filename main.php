<?php

require __DIR__.'/vendor/autoload.php';

use App\Command\Run;
use Ratchet\Server\IoServer;
use App\Command\Chat;

$server = IoServer::factory(
    new Chat(),
    8080
);

$server->run();
