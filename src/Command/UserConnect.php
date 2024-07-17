<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand("user:connect")]
class UserConnect extends Command {
    private string $username;
    private string $uri;
    private string $port;

    protected function configure() : void {
        $this
            ->addArgument("username", InputArgument::REQUIRED, "Username")
            ->addArgument("uri", InputArgument::REQUIRED, "uri")
            ->addArgument("port", InputArgument::REQUIRED, "port");
    }

    public function execute(InputInterface $input, OutputInterface $output) : int {
        $this->username = $input->getArgument("username");
        $this->uri = $input->getArgument("uri");
        $this->port = $input->getArgument("port");

        $socketInstance = socket_create(AF_INET, SOCK_STREAM, 0);
        socket_connect($socketInstance, $this->uri, $this->port);

        while(true) {

        }

        socket_close($socketInstance);

        return self::SUCCESS;
    }
}
