<?php
class Server
{
	public $server;

	public function __construct($addr, $port)
	{
		$this->server = new swoole_websocket_server($addr, $port);
		$this->server->on('open', [$this, 'onOpen']);
		$this->server->on('message', [$this, 'onMessage']);
		$this->server->on('close', [$this, 'onClose']);
		$this->server->on('request',[$this, 'onRequest']);
		$this->server->start();
	}


	public function onOpen($server, $request)
	{
		$server->push($request->fd, 'connect is successful');
		var_dump($server);
		print_r($request);
		print_r(PHP_EOL.'onOpen'.PHP_EOL);
	}

	public function onMessage($server, $frame)
	{
		print_r($frame);
		print_r(PHP_EOL.'onMessage'.PHP_EOL);

	}

	public function onClose($server, $fd)
	{
		echo "client {$fd} closed".PHP_EOL;
	}

	public function onRequest($request, $response)
	{
		print_r($request);
		print_r($response);
		print_r(PHP_EOL.'onRequest'.PHP_EOL);

	}
}

new Server('0.0.0.0', 8812);
