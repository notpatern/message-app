<?php

namespace App\Handler;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class RequestHandler implements MessageComponentInterface
{
    private $clients;
    public function __construct(){
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "New connection: id->{$conn->resourceId}\n";
        $conn->send("Connected to server\r\n");
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        foreach ($this->clients as $client) {
            if (!($from == $client)) {
                $client->send("id{$from->resourceId}: ".$msg."\r\n");
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Connection ended: id->{$conn->resourceId}\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Error: {$conn->resourceId}->{$e}";
    }
}
