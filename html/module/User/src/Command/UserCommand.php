<?php

namespace User\Command;

use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\Sql\Select;
use Laminas\Hydrator\ReflectionHydrator;
use RuntimeException;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\Sql\Insert;
use Laminas\Db\Sql\Sql;
use User\Model\User;

class UserCommand {
	/** @var AdapterInterface */
	private AdapterInterface $db;

	/** @param AdapterInterface $db */
	public function __construct( AdapterInterface $db ) {
		$this->db = $db;
	}

	/**
	 * @param User $User
	 * @return User
	 */
	public function create( User $User ): User {
		$username = $User->getUserName();
		$password = password_hash( $User->getPassword(), PASSWORD_DEFAULT );

		$User = $this->read( $User );
		if( !empty( $User->getId() ) ) {
			throw new RuntimeException( "Username: {$username}, already exists!" );
		}

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
			throw new RuntimeException( 'Database error occurred during user insert operation' );
		}

		return new User( $username, $password, $result->getGeneratedValue() );
	}

	/**
	 * @param User $User
	 * @return User
	 */
	public function read( User $User ): User {
		$username = $User->getUserName();

		$select = ( new Select( 'users' ) )
			->columns( [ 'id', 'username', 'password' ] )
			->where( [ 'username' => $username ] );

		$sql       = new Sql( $this->db );
		$statement = $sql->prepareStatementForSqlObject( $select );
		$result    = $statement->execute();

		if( !$result instanceof ResultInterface ) {
			throw new RuntimeException( 'Database error occurred during user insert operation' );
		}

		$resultSet = new HydratingResultSet( new ReflectionHydrator(), $User );
		$resultSet->initialize( $result );
		foreach( $resultSet as $r ) {
			$User = $r;
		}

		return $User;
	}

	public function update() {

	}

	public function delete() {

	}
}