<?php

namespace LegalSuggesterClient\Core;

use LegalSuggesterClient\Model\BaseModel;

class Serializator
{
	public static function serialize(BaseModel $model): array
	{
		$data = [];

		$class = new \ReflectionClass(get_class($model));

		foreach ($class->getMethods() as $method)
		{
			if (substr($method->name, 0, 3) !== 'get'){
				continue;
			}

			$value = $method->invoke($model);

			if (
				(is_object($value) || is_array($value))
				&& reset($value) instanceof BaseModel
			){
				if(is_object($value)) {
					$value = static::serialize($model);
				}

				if(is_array($value)) {
					$value = array_map(
						function (BaseModel $model)
						{
							return static::serialize($model);
						},
						$value
					);
				}
			}

			$propName = lcfirst(substr($method->name, 3));
			$data[$propName] = $value;
		}

		return $data;
	}

	public static function deserialize(BaseModel $model, array $data): BaseModel
	{
		$class = new \ReflectionClass(get_class($model));

		foreach ($class->getMethods() as $method)
		{
			if (substr($method->name, 0, 3) !== 'set'){
				continue;
			}

			$propName = lcfirst(substr($method->name, 3));
			if (!isset($data[$propName])){
				continue;
			}

			$value = $data[$propName];

			$comment = $class->getProperty($propName)->getDocComment();

			preg_match('/model="(?P<model>.+)"/', $comment, $matches);

			if (
				(is_object($value) || is_array($value))
				&& isset($matches['model']) && class_exists($matches['model'])
			)
			{
				if(is_object($value)) {
					$value = static::deserialize(
						(new \ReflectionClass($matches['model']))->newInstance(),
						$value
					);
				}

				if(is_array($value)) {
					$value = array_map(
						function ($item) use ($matches)
						{
							return static::deserialize(
								(new \ReflectionClass($matches['model']))->newInstance(),
								$item
							);
						},
						$value
					);
				}
			}

			$method->invoke($model, $value);
		}

		return $model;
	}
}
