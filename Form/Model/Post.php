<?php
namespace Acme\BlogBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

/* 
*	Data underlying class for PostType
*/
class Post
{

	

	/**
	 * @Assert\NotBlank()
     * @var string
     */
	public $title;

	/**
	 * @Assert\NotBlank()
     * @var string
     */
	public $body;

	/**
	 * @Assert\NotBlank()
     * @var string
     */
	public $tags;

	
	public function getTitle()
	{
		return $this->title;
	}

	public function getBody()
	{
		return $this->body;
	}

	public function getTags()
	{
		return $this->tags;
	}

	
	public function setTitle($title)
	{
		$this->title = $title;
	}

	public function setBody($body)
	{
		$this->body = $body;
	}

	public function setTags($tags)
	{
		$this->tags = $tags;
	}

}