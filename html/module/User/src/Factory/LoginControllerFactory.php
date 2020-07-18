<?php

namespace User\Factory;

use User\Form\LoginForm;
use User\Controller\LoginController;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class LoginControllerFactory implements FactoryInterface {
	/**
	 * @param ContainerInterface $container
	 * @param string $requestedName
	 * @param array|null $options
	 * @return LoginController|object
	 */
	public function __invoke( ContainerInterface $container, $requestedName, array $options = null ) {
		$FormManager = $container->get( 'FormElementManager' );

		return new LoginController( $FormManager->get( LoginForm::class ) );
	}
}