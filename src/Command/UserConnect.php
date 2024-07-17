<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand("user:connect")]
class UserConnect extends Command {
    private $socketInstance;
    private string $username;
    private string $uri;
    private int $port;

    protected function configure() : void {
        $this
            ->addArgument("username", InputArgument::REQUIRED, "username")
            ->addArgument("uri", InputArgument::REQUIRED, "uri")
            ->addArgument("port", InputArgument::REQUIRED, "port");
    }

    public function execute(InputInterface $input, OutputInterface $output) : int {
        $this->username = $input->getArgument("username");
        $this->uri = $input->getArgument("uri");
        $this->port = $input->getArgument("port");

        $this->socketInstance = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        socket_connect($this->socketInstance, $this->uri, $this->port);

        while(true) {
            $buffer = readline();
            $this->SendTextToSocket($buffer);
        }

        socket_close($this->socketInstance);

        return self::SUCCESS;
    }

    private function SendTextToSocket(string $message) : void {
        $json = "{\"username\":\"$this->username\",\"message\":\"$message\"}";
        socket_write($this->socketInstance, $json . "\r" . PHP_EOL, strlen($json));
    }
}
