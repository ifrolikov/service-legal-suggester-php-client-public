<?php

namespace LegalSuggesterClient;

use GuzzleHttp\Client;
use LegalSuggesterClient\Helper\ClientHelper;
use LegalSuggesterClient\Model\Suggestion;

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
		$connectTimeout = LegalSuggesterClient::CONNECT_TIMEOUT)
	{
		$this->client = ClientHelper::getClient($xRequestId, $sessionId, $requestTimeout, $connectTimeout);
	}

	public function search(string $query, array $params = [], $reqTimeout = LegalSuggesterClient::REQUEST_TIMEOUT): Suggestion
	{
		$uri = $this->_buildUrl("/legal_suggester_service/api/v1/suggestions/search?query=$query");
		$responce = $this->_request('get', $uri, [], $reqTimeout);
		return Suggestion::init($responce);
	}

	protected function _request(string $method, string $uri, array $data = [], $reqTimeout)
	{
		try {

			$response = $this->client->request(
				strtoupper($method),
				$uri,
				[
					'json' => $data,
					'timeout' => $reqTimeout
				]
			);

			$result = \GuzzleHttp\json_decode((string)$response->getBody()->getContents(), true);

			$this->_checkResult($result);

			return $result;

		}
		catch (\GuzzleHttp\Exception\RequestException $e)
		{
			throw new ApiException((string)$e, 0, $e);
		}
		catch (\Exception $e)
		{
			throw new ApiException($e->getMessage(), 0, $e);
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