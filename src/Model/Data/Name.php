<?php

namespace LegalSuggesterClient\Model\Data;

use LegalSuggesterClient\Model\BaseModel;

class Name extends BaseModel
{
	/**
	 * @var string
	 */
	private $fullWithOpf;

	/**
	 * @var string
	 */
	private $shortWithOpf;

	public function getFullWithOpf(): string
	{
		return $this->fullWithOpf;
	}

	public function setFullWithOpf(string $fullWithOpf)
	{
		$this->fullWithOpf = $fullWithOpf;
	}

	public function getShortWithOpf(): string
	{
		return $this->shortWithOpf;
	}

	public function setShortWithOpf(string $shortWithOpf)
	{
		$this->shortWithOpf = $shortWithOpf;
	}
}
