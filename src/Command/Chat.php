<?php

namespace App\Command;

use Exception;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Ratchet\ComponentInterface;

class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onMessage(ConnectionInterface $from, $msg) : void
    {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

        foreach ($this->clients as $client) {
            if ($from !== $client) {
                $client->send($from->resourceId);
                $client->send("\n");
                $client->send($msg);
                $client->send("\n");
            }
        }
    }

    public function onClose(ConnectionInterface $conn) : void
    {
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, Exception $e) : void
    {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }

    public function onOpen(ConnectionInterface $conn) : void
    {
        $this->clients->attach($conn);

        echo 'connection ({$connection->resourceId})\n';
    }
}
