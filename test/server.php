<?php

$host_ip = "192.168.1.34";
$server_port = 8080;

$server_socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_bind($server_socket, $host_ip, $server_port);
socket_listen($server_socket);

$client = socket_accept($server_socket);

socket_listen($server_socket);

$client2 = socket_accept($server_socket);

while(true){
    $message1 = socket_read($client, 1024) . "\r\n\r\n";
    $message2 = socket_read($client2, 1024) . "\r\n\r\n";

    if ($message1 != "") {
        echo $message1;
    }

    if ($message2 != "") {
        echo $message2;
    }
}