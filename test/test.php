<?php

require './vendor/autoload.php';

use App\Command\UserConnect;
use Symfony\Component\Console\Application;

$application = new Application();

$application->addCommands([new UserConnect()]);

$application->run();