<?php

namespace User\Command;

use RuntimeException;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\Sql\Insert;
use Laminas\Db\Sql\Sql;
use User\Model\User;

class UserCommand {
	/** @var AdapterInterface */
	private $db;

	/** @param AdapterInterface $db */
	public function __construct( AdapterInterface $db ) {
		$this->db = $db;
	}

	public function create( User $user ) {
		$username = $user->getUserName();
		$password = password_hash( $user->getPassword(), PASSWORD_DEFAULT );

		$insert = new Insert( 'users' );
		$insert->values(
			[
				'username' => $username,
				'password' => $password,
			]
		);

		$sql       = new Sql( $this->db );
		$statement = $sql->prepareStatementForSqlObject( $insert );
		$result    = $statement->execute();

		if( !$result instanceof ResultInterface ) {
			throw new RuntimeException(
				'Database error occurred during blog post insert operation'
			);
		}

		$id = $result->getGeneratedValue();

		return new User(
			$username,
			$password,
			$id
		);
	}

	public function read() {

	}

	public function update() {

	}

	public function delete() {

	}
}