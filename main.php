<?php

require __DIR__.'/vendor/autoload.php';

use App\Command\Run;
use Symfony\Component\Console\Application;

$application = new Application();

$application->addCommands([new Run()]);

$application->run();
