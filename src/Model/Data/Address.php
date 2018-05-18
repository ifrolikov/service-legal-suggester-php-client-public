<?php

namespace LegalSuggesterClient\Model\Data;

use LegalSuggesterClient\Model\BaseModel;

class Address extends BaseModel
{
	/**
	 * @var string
	 */
	private $value;

	public function getValue(): string
	{
		return $this->value;
	}

	public function setValue(string $value)
	{
		$this->value = $value;
	}
}
