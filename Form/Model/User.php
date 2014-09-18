<?php
namespace Acme\BlogBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

/* 
*	Data underlying class for UserType
*/
class User 
{

	/**
     * @var int
     */
	public $id;

	/**
	 * @Assert\NotBlank()
     * @var string
     */
	public $firstName;

	/**
	 * @Assert\NotBlank()
     * @var string
     */
	public $lastName;

	/**
	 * @Assert\NotBlank()
     * @var string
     */
	public $email;

	/**
	 * 
     * @var string
     */
	public $password;
 

	public function getId()
	{
		return $this->id;
	}

	public function getFirstName()
	{
		return $this->firstName;
	}

	public function getLastName()
	{
		return $this->lastName;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setFirstName($firstName)
	{
		$this->firstName = $firstName;
	}

	public function setLastName($lastName)
	{
		$this->lastName = $lastName;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function setPassword($password)
	{
		$this->password = $password;
	}

}