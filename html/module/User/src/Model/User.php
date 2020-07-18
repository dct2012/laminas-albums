<?php

namespace User\Model;

class User {
	/* @var mixed */
	private $id;
	/* @var string */
	private string $username;
	/* @var string */
	private string $password;

	/**
	 * User constructor.
	 * @param string $username
	 * @param string $password
	 * @param int|null $id
	 */
	public function __construct( string $username, string $password, $id = null ) {
		$this->username = $username;
		$this->password = $password;
		$this->id       = $id;
	}

	/* @return mixed */
	public function getId() {
		return $this->id;
	}

	/* @return string */
	public function getUserName(): string {
		return $this->username;
	}

	/* @return string */
	public function getPassword(): string {
		return $this->password;
	}
}