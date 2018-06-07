<?php

namespace LegalSuggesterClient;

use GuzzleHttp\Client;
use LegalSuggesterClient\Helper\ClientHelper;
use LegalSuggesterClient\Model\Suggestion;
use LegalSuggesterClient\Core\Config;

class LegalSuggesterClient
{
	const REQUEST_TIMEOUT = 0.5;
	const CONNECT_TIMEOUT = 0.1;

	/**
	 * @var Client
	 */
	protected $client;

	public function __construct(
		$xRequestId,
		$sessionId,
		$requestTimeout = LegalSuggesterClient::REQUEST_TIMEOUT,
		$connectTimeout = LegalSuggesterClient::CONNECT_TIMEOUT,
		string $uri = null
	)
	{
		$uri = $uri ?? Config::getBaseUri();

		$this->client = ClientHelper::getClient($xRequestId, $sessionId, $requestTimeout, $connectTimeout, $uri);
	}

	public function search(string $query, int $count = null, $reqTimeout = LegalSuggesterClient::REQUEST_TIMEOUT): array
	{
		$uri = $this->_buildUrl("/legal_suggester_service/api/v1/suggestions/search", ['query' => $query, 'count' => $count]);
		$legals = $this->_request('get', $uri, [], $reqTimeout);

		if (!is_array($legals))
		{
			throw new ApiException("The suggester service returned invalid response");
		}

		$result = [];
		foreach ($legals as $legal)
		{
			$result[] = Suggestion::init($legal);
		}

		return $result;
	}

	protected function _request(string $method, string $uri, array $data = [], $reqTimeout)
	{
		try {

			$options = ['json' => $data];
			if ($reqTimeout != static::REQUEST_TIMEOUT)
			{
				$options['timeout'] = $reqTimeout;
			}

			$response = $this->client->request(strtoupper($method), $uri, $options);

			$result = \GuzzleHttp\json_decode((string)$response->getBody()->getContents(), true);

			$this->_checkResult($result);

			return $result;

		}
		catch (\GuzzleHttp\Exception\RequestException $e)
		{
			throw new ApiException((string)$e, $e->getResponse()->getStatusCode(), $e);
		}
		catch (\Exception $e)
		{
			//все остальные эксепшены, которые кидает guzzle + эксепшены самого клиента
			throw new ApiException($e->getMessage(), $e->getCode(), $e);
		}
	}

	protected function _buildUrl(string $url, array $params = []): string
	{
		if (empty($params))
		{
			return $url;
		}

		return $url .'?'. http_build_query($params);
	}

	protected function _checkResult($result)
	{
		if (!is_array($result))
		{
			throw new \Exception("Invalid service suggestions response");
		}

		if (!empty($result['error']))
		{
			$errorCode = $result['error']['code'];
			$errorMessages = $result['error']['messages'];

			$errorMessage = "Something went wrong! The answer has ErrorCode. Error Description:\n";
			$errorMessage .= "Error code: $errorCode\n";
			$errorMessage .= "User message: ". implode(", ", $errorMessages);

			throw new \Exception($errorMessage);
		}
	}
}