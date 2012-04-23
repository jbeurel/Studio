<?php

namespace Jbl\StudioBundle\Entity;

class Contactmail
{
	private $fromMail;
	private $name;
	private $message;
	private $phone;	
	
	public function setFromMail($fromMail) {
		$this->fromMail = $fromMail;
	}
	
	public function getFromMail() {
		return $this->fromMail;
	}
	
	public function setName($name) {
		$this->name = $name;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function setMessage($message) {
		$this->message = $message;
	}
	
	public function getMessage() {
		return $this->message;
	}
	
	public function setPhone($phone) {
		$this->phone = $phone;
	}
	
	public function getPhone() {
		return $this->phone;
	}

}