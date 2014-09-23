<?php

namespace Acme\BlogBundle\Document;

use \DateTime;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\EmbeddedDocument
 */
class Comment
{
	
	/**
	* @MongoDB\Id
	*/
	private $id;

	/**
     * @MongoDB\String
     */
	private $text;

	/**
	 * @MongoDB\String;
	 */
	private $author;

	/**
	* @MongoDB\Date
	*/
	private $createdAt;
	
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