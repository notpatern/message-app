<?php

require __DIR__.'/vendor/autoload.php';

use App\Service\TCPServer;

$server = new TCPServer(8080);
