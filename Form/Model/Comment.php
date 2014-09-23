<?php

namespace Acme\BlogBundle\Form\Model;



/*
 *	Data underlying class for CommentType 
 */
class Comment
{

	/**
     * @var string
     */
	public $text;

	/**
	 * @var string
	 */
	private $author;

	
	
	public function getText()
	{
		return $this->text;
	}

	public function setText($text)
	{
		$this->text = $text;
	}

	public function getAuthor()
	{
		return $this->author;
	}

	/**
	* @param string $author
	*/
	public function setAuthor($author)
	{
		$this->author = $author;
	}

	public function setCreatedAt(DateTime $createdAt)
	{
		$this->createdAt = $createdAt;
	}

	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	public function getId()
	{
		return $this->id;
	}

}