<?php
namespace Acme\BlogBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\EmbeddedDocument
 */
class Tag
{
	/**
     * @MongoDB\String
     */
	private $name;

	public function __construct($name)
	{
		$this->name = $name;
	}

	/**
	* @return string
	*/
	public function getName()
	{
		return $this->name;
	}
}