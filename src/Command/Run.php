<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument; // to use in configure
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand("message:run")]
class Run extends Command {

    protected function configure() : void {

    }

    public function execute(InputInterface $input, OutputInterface $output) : int {
        echo 'test' . PHP_EOL;

        return self::SUCCESS;
    }

}

