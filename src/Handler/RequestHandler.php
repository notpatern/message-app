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
        echo "New conenction: {$conn->resourceId}\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        foreach ($this->clients as $client) {
            if (!($from == $client)) {
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
    }
}
