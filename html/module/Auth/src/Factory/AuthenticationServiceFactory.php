<?php

namespace Auth\Factory;

use Interop\Container\ContainerInterface;
use Laminas\Authentication\Adapter\DbTable\CallbackCheckAdapter;
use Laminas\Authentication\AuthenticationService;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class AuthenticationServiceFactory implements FactoryInterface {
	/**
	 * @param ContainerInterface $container
	 * @param string $requestedName
	 * @param array|null $options
	 * @return AuthenticationService|object
	 */
	public function __invoke( ContainerInterface $container, $requestedName, array $options = null ) {
		$dbAdapter   = $container->get( AdapterInterface::class );
		$authAdapter = new CallbackCheckAdapter(
			$dbAdapter,
			'users',
			'username',
			'password',
			fn( $hash, $password ) => password_verify( $password, $hash )
		);

		return new AuthenticationService( null, $authAdapter );
	}
}