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

	/**
	* @Assert\NotBlank()
	* @var string
	*/
	public $slug;

	
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

	/**
	* @return string
	*/
	public function getSlug()
	{
		return $this->slug;
	}

	/**
	* @param string $slug
	*/
	public function setSlug($slug)
	{
		$this->slug = $slug;
	}

}