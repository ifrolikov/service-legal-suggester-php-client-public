<?php

namespace LegalSuggesterClient\Model;

use LegalSuggesterClient\Model\Data\Address as DataName;
use LegalSuggesterClient\Model\Data\Name as DataAddress;
use LegalSuggesterClient\Model\Data\State as DataState;
use LegalSuggesterClient\Model\Data\Management as DataManagement;
use LegalSuggesterClient\Model\Data\Phone as DataPhone;

class SuggestionData extends BaseModel
{
	/**
	 * @var string
	 */
	private $inn;

	/**
	 * @var string
	 */
	private $kpp;

	/**
	 * @var string
	 */
	private $okpo;

	/**
	 * @var string
	 */
	private $type;

	/**
	 * @var string
	 */
	private $ogrn;

	/**
	 * @var object
	 * model="\LegalSuggesterClient\Model\Data\Name"
	 */
	private $name;

	/**
	 * @var object
	 * model="\LegalSuggesterClient\Model\Data\Address"
	 */
	private $address;

	/**
	 * @var object
	 * model="\LegalSuggesterClient\Model\Data\State"
	 */
	private $state;

	/**
	 * @var object
	 * model="\LegalSuggesterClient\Model\Data\Management"
	 */
	private $management;

	/**
	 * @var array
	 * model="\LegalSuggesterClient\Model\Data\Phone"
	 */
	private $phones;

	public function getInn(): string
	{
		return $this->inn;
	}

	public function setInn(string $inn)
	{
		$this->inn = $inn;
	}

	public function getKpp(): string
	{
		return $this->kpp;
	}

	public function setKpp(string $kpp)
	{
		$this->kpp = $kpp;
	}

	public function getOkpo(): string
	{
		return $this->okpo;
	}

	public function setOkpo(string $okpo)
	{
		$this->okpo = $okpo;
	}

	public function getType(): string
	{
		return $this->type;
	}

	public function setType(string $type)
	{
		$this->type = $type;
	}

	public function getOgrn(): string
	{
		return $this->ogrn;
	}

	public function setOgrn(string $ogrn)
	{
		$this->ogrn = $ogrn;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName(DataName $name)
	{
		$this->name = $name;
	}

	public function getAddress()
	{
		return $this->address;
	}

	public function setAddress(DataAddress $address)
	{
		$this->address = $address;
	}

	public function getState()
	{
		return $this->state;
	}

	public function setState(DataState $state)
	{
		$this->state = $state;
	}

	public function getManagement()
	{
		return $this->management;
	}

	public function setManagement(DataManagement $management)
	{
		$this->management = $management;
	}

	public function getPhones(): array
	{
		return $this->phones;
	}

	public function addPhone(DataPhone $phone)
	{
		$this->phones[] = $phone;
	}

	public function setPhones(array $phones)
	{
		$this->phones = $phones;
	}
}
