<?php

namespace LegalSuggesterClient\Model\Data;

use LegalSuggesterClient\Model\BaseModel;

class State extends BaseModel
{
	/**
	 * @var string
	 */
	private $status;

	/**
	 * @var int
	 */
	private $registrationDate;

	public function getStatus(): string
	{
		return $this->status;
	}

	public function setStatus(string $status)
	{
		$this->status = $status;
	}

	public function getRegistrationDate(): int
	{
		return $this->registrationDate;
	}

	public function setRegistrationDate(int $registrationDate)
	{
		$this->registrationDate = $registrationDate;
	}
}
