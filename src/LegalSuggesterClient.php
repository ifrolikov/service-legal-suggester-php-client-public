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
//		$uri = $this->_buildUrl("/legal_suggester_service/api/v1/suggestions/search", ['query' => $query, 'count' => $count]);
//		$legals = $this->_request('get', $uri, [], $reqTimeout);
//
//		if (!is_array($legals))
//		{
//			throw new ApiException("The suggester service returned invalid response");
//		}
//
//		$result = [];
//		foreach ($legals as $legal)
//		{
//			$result[] = Suggestion::init($legal);
//		}
//
//		return $result;

		$legals = [
			[
				"inn" => "7707083893",
				"kpp" => "773601001",
				"type" => "LEGAL",
				"ogrn" => "1027700132195",
				"name" => "ПАО СБЕРБАНК",
				"legalAddress" => "г Москва, ул Вавилова, д 19",
				"registrationDate" => 677376000000,
				"directorFullName" => "Греф Герман Оскарович",
				"shortWithOpf" => "ПАО СБЕРБАНК",
				"fullWithOpf" => "ПУБЛИЧНОЕ АКЦИОНЕРНОЕ ОБЩЕСТВО \"СБЕРБАНК РОССИИ\""
			],
			[
				"inn" => "4825124195",
				"kpp" => "482501001",
				"type" => "LEGAL",
				"ogrn" => "1174827008333",
				"name" => "The english company",
				"legalAddress" => "398020, ОБЛАСТЬ ЛИПЕЦКАЯ, ГОРОД ЛИПЕЦК, УЛИЦА ГАЙДАРА, ДОМ 2, КОРПУС Б, ОФИС 311",
				"registrationDate" => 1493337600000,
				"directorFullName" => "Горбатюк Ирина Юрьевна",
				"shortWithOpf" => "The english company",
				"fullWithOpf" => "The english company"
			],
			[
				"inn" => "4027033642",
				"kpp" => "402701001",
				"type" => "LEGAL",
				"ogrn" => "1024001344124",
				"name" => "Очень большая компания с очень-очень и очень длинным названием",
				"legalAddress" => "г Калуга, ул Суворова, д 118",
				"registrationDate" => 893808000000,
				"directorFullName" => "Бабинов Валентин Иванович",
				"shortWithOpf" => "ЗАО \"Очень большая компания с очень-очень и очень длинным названием\"",
				"fullWithOpf" => "ЗАКРЫТОЕ АКЦИОНЕРНОЕ ОБЩЕСТВО \"Очень большая компания с очень-очень и очень длинным названием\""
			],
			[
				"inn" => "5047178648",
				"kpp" => "504701001",
				"type" => "LEGAL",
				"ogrn" => "1155047015122",
				"name" => "ООО \"НТТ\"",
				"legalAddress" => "Московская обл, г Химки, ул Ленинградская, влд 39 стр 5",
				"registrationDate" => 1451347200000,
				"shortWithOpf" => "ООО \"НТТ\"",
				"fullWithOpf" => "ОБЩЕСТВО С ОГРАНИЧЕННОЙ ОТВЕТСТВЕННОСТЬЮ \"НАУЧНО-ТЕХНИЧЕСКАЯ ТЕХНИКА\""
			]
		];

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