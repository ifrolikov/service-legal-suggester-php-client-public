<?php

namespace LegalSuggesterClient\Model\Data;

use LegalSuggesterClient\Model\BaseModel;

class Management extends BaseModel
{
	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var string
	 */
	private $post;

	public function getName(): string
	{
		return $this->name;
	}

	public function setName(string $name)
	{
		$this->name = $name;
	}

	public function getPost(): string
	{
		return $this->post;
	}

	public function setPost(string $post)
	{
		$this->post = $post;
	}
}
