<?php

namespace LegalSuggesterClient\Core;

use LinkORB\Component\Etcd\Client;

class Etcd
{
	protected $client;

	public function __construct($host, $port)
	{
		$this->client = new Client("http://$host:$port");
	}

	public function get($key)
	{
		try
		{
			return $this->client->get($key);
		}
		catch (\Exception $e)
		{
			throw new $e("The key $key was not found in etcd");
		}
	}
}
