<?php

namespace App\Service;

use Ratchet\Server\IoServer;
use App\Handler\RequestHandler;

class TCPServer{

    public $server;
    private $handler;

    public function __construct(int $port){
        $this->handler = new RequestHandler();
        //create the server with a new RequestHandler on the provided port number
        $this->server = IoServer::factory($this->handler, $port);
        //start the server loop
        $this->server->run();
    }
}
