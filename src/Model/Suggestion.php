<?php

namespace LegalSuggesterClient\Model;

class Suggestion extends BaseModel
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
	 * @var string
	 */
	private $name;

	/**
	 * @var string
	 */
	private $legalAddress;

	/**
	 * @var int
	 */
	private $registrationDate;

	/**
	 * @var string
	 */
	private $contactPhones;
		
	/**
	 * @var string
	 */
	private $directorFullName;

	/**
	 * @var string
	 */
	private $fullWithOpf;

	/**
	 * @var string
	 */
	private $shortWithOpf;
	

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

	public function getName(): string
	{
		return $this->name;
	}

	public function setName(string $name)
	{
		$this->name = $name;
	}

	public function getLegalAddress(): string
	{
		return $this->legalAddress;
	}

	public function setLegalAddress(string $legalAddress)
	{
		$this->legalAddress = $legalAddress;
	}
	
	public function getContactPhones(): string
	{
		return $this->contactPhones;
	}

	public function setContactPhones(string $contactPhones)
	{
		$this->contactPhones = $contactPhones;
	}

	public function getRegistrationDate(): int
	{
		return $this->registrationDate;
	}

	public function setRegistrationDate(int $registrationDate)
	{
		$this->registrationDate = $registrationDate;
	}
	
	public function getDirectorFullName(): string
	{
		return $this->directorFullName;
	}

	public function setDirectorFullName(string $directorFullName)
	{
		$this->directorFullName = $directorFullName;
	}
	
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
	
	public function toArray()
	{
		return [
			'inn' => $this->getInn(),
			'kpp' => $this->getKpp(),
			'okpo' => $this->getOkpo(),
			'type' => $this->getType(),
			'ogrn' => $this->getOgrn(),
			'registrationDate' => $this->getRegistrationDate(),
			'directorFullName' => $this->getDirectorFullName(),
			'contactPhones' => $this->getContactPhones(),
			'fullWithOpf' => $this->getFullWithOpf(),
			'shortWithOpf' => $this->getShortWithOpf(),
			'legalAddress' => $this->getLegalAddress(),
			'name' => $this->getName()
		];
	}
}
