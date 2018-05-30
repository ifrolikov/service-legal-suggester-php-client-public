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

	public function search(string $query, array $params = [], $reqTimeout = LegalSuggesterClient::REQUEST_TIMEOUT): Suggestion
	{
//		$uri = $this->_buildUrl("/legal_suggester_service/api/v1/suggestions/search?query=$query");
//		$responce = $this->_request('get', $uri, [], $reqTimeout);
//		return Suggestion::init($responce);

		return Suggestion::init(json_decode('{"inn":"7707083893","kpp":"773601001","type":"LEGAL","ogrn":"1027700132195","name":"\u041f\u0410\u041e \u0421\u0411\u0415\u0420\u0411\u0410\u041d\u041a","legalAddress":"\u0433 \u041c\u043e\u0441\u043a\u0432\u0430, \u0443\u043b \u0412\u0430\u0432\u0438\u043b\u043e\u0432\u0430, \u0434 19","registrationDate":677376000000,"directorFullName":"\u0413\u0440\u0435\u0444 \u0413\u0435\u0440\u043c\u0430\u043d \u041e\u0441\u043a\u0430\u0440\u043e\u0432\u0438\u0447","shortWithOpf":"\u041f\u0410\u041e \u0421\u0411\u0415\u0420\u0411\u0410\u041d\u041a","fullWithOpf":"\u041f\u0423\u0411\u041b\u0418\u0427\u041d\u041e\u0415 \u0410\u041a\u0426\u0418\u041e\u041d\u0415\u0420\u041d\u041e\u0415 \u041e\u0411\u0429\u0415\u0421\u0422\u0412\u041e \"\u0421\u0411\u0415\u0420\u0411\u0410\u041d\u041a \u0420\u041e\u0421\u0421\u0418\u0418\""}', true));
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