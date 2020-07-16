<?php

namespace User\Model;

class User {
	/* @var int */
	private $id;
	/* @var string */
	private $username;
	/* @var string */
	private $password;

	/**
	 * User constructor.
	 * @param string $username
	 * @param string $password
	 * @param null $id
	 */
	public function __construct( string $username, string $password, $id = null ) {
		$this->username = $username;
		$this->password = $password;
		$this->id       = $id;
	}

	/* @return int|null */
	public function getId() {
		return $this->id;
	}

	/* @return string */
	public function getUserName() {
		return $this->username;
	}

	/* @return string */
	public function getPassword() {
		return $this->password;
	}
}