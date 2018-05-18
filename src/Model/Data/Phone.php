<?php

namespace LegalSuggesterClient\Model\Data;

use LegalSuggesterClient\Model\BaseModel;

class Phone extends BaseModel
{
	/**
	 * @var string
	 */
	private $number;

	public function getNumber(): string
	{
		return $this->number;
	}

	public function setNumber(string $number)
	{
		$this->number = $number;
	}
}
