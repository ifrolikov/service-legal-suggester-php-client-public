<?php

namespace LegalSuggesterClient\Model;

class Suggestion extends BaseModel
{
	/**
	 * @var string
	 */
	private $value;

	/**
	 * @var string
	 */
	private $unrestrictedValue;

	/**
	 * @var object
	 * model="\LegalSuggesterClient\Model\SuggestionData"
	 */
	private $data;

	public function getValue(): string
	{
		return $this->value;
	}

	public function setValue(string $value)
	{
		$this->value = $value;
	}

	public function getUnrestrictedValue(): string
	{
		return $this->unrestrictedValue;
	}

	public function setUnrestrictedValue(string $unrestrictedValue)
	{
		$this->unrestrictedValue = $unrestrictedValue;
	}

	public function getData()
	{
		return $this->data;
	}

	public function setData(SuggestionData $data)
	{
		$this->data = $data;
	}

	public function toArrayByTemplate()
	{
		return [
			'inn' => $this->getData()->getInn(),
			'kpp' => $this->getData()->getKpp(),
			'okpo' => $this->getData()->getOkpo(),
			'type' => $this->getData()->getType(),
			'ogrn' => $this->getData()->getOgrn(),
			'status' => $this->getData()->getState()->getStatus(),
			'registrationDate' => $this->getData()->getState()->getRegistrationDate(),
			'directorFullName' => $this->getData()->getManagement()->getName(),
			'contactPhones' =>
				array_map(
					function ($phone)
					{
						return $phone->getNumber();
					},
					$this->getData()->getPhones()
				),
			'fullWithOpf' => $this->getData()->getName()->getFullWithOpf(),
			'shortWithOpf' => $this->getData()->getName()->getShortWithOpf(),
			'addressValue' => $this->getData()->getAddress()->getValue(),
		];
	}
}
