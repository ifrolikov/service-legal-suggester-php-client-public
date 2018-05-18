<?php

namespace LegalSuggesterClient\Helper;

use GuzzleHttp\Client;
use LegalSuggesterClient\Core\Config;

class ClientHelper
{
	public static function getClient($xRequestId, $sessionId, $requestTimeout, $connectTimeout) : Client
	{
		$headers = array_merge(
			Config::getHeaders(),
			[
				'x-request-id' => $xRequestId,
				'session-id' => $sessionId
			]
		);

		return new Client([
			'base_uri' => Config::getBaseUri(),
			'headers' => $headers,
			'timeout' => $requestTimeout,
			'connect_timeout' => $connectTimeout
		]);
	}
}
