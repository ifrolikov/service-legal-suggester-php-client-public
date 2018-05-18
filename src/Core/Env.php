<?php

namespace LegalSuggesterClient\Core;

class Env
{
	public static function getEtcdHost() : string
	{
		return getenv('ETCD_HOST');
	}

	public static function getEtcdPort() : string
	{
		return getenv('ETCD_PORT');
	}
}
