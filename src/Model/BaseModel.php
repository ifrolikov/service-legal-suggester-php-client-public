<?php

namespace LegalSuggesterClient\Model;

use LegalSuggesterClient\Core\Serializator;

abstract class BaseModel
{
	public function toArray(): array
	{
		return Serializator::serialize($this);
	}

	public static function init(array $data): BaseModel
	{
		return Serializator::deserialize(new static, $data);
	}
}
