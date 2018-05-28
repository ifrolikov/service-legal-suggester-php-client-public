<?php

namespace LegalSuggesterClient\Core;

class Config
{
	const ETCD_SUGGESTER_HOST_KEY = '/config-tutu/infrastructure/internal_services/suggester';

	public static function getBaseUri() : string
	{
		$etcd = new Etcd(Env::getEtcdHost(), Env::getEtcdPort());

		$baseDomain = $etcd->get(Config::ETCD_SUGGESTER_HOST_KEY);

		return "http://suggester.$baseDomain";
	}

	public static function getHeaders() : array
	{
		return ['Accept' => 'application/json'];
	}
}
