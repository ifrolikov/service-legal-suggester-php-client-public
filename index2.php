<?php

require_once 'vendor/autoload.php';

$legalSuggesterClient = new TuTu\LegalSuggester\Client('http://suggester.app:20003');
$legalSuggesterClient->setHeaders(['x-request-id' => 'x-request-id', 'session-id' => 'session-id']);
$legalSuggesterClient->setConnectTimeout(15);
$legalSuggesterClient->setRequestTimeout(2);

try
{
	$suggestions = $legalSuggesterClient->search("пао сбербанк", 20);

	foreach ($suggestions as $suggestion)
	{
		echo $suggestion->getInn();
		echo $suggestion->getKpp();
		echo $suggestion->getOkpo();
		echo $suggestion->getType();
		echo $suggestion->getOgrn();
		echo $suggestion->getRegistrationDate();
		echo $suggestion->getDirectorFullName();
		print_r($suggestion->getContactPhones());
		echo $suggestion->getFullWithOpf();
		echo $suggestion->getShortWithOpf();
		echo $suggestion->getLegalAddress();
		echo $suggestion->getName();

		echo "\n\n";
	}
}
catch (TuTu\LegalSuggester\Exception\LegalSuggesterException $e)
{
	echo $e->getMessage();
}
