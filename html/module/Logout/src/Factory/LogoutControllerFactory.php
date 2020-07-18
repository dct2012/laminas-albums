<?php

namespace Logout\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Logout\Controller\LogoutController;
use Logout\Form\LogoutForm;

class LogoutControllerFactory implements FactoryInterface {
	/**
	 * @param ContainerInterface $container
	 * @param string $requestedName
	 * @param array|null $options
	 * @return LogoutController|object
	 */
	public function __invoke( ContainerInterface $container, $requestedName, array $options = null ) {
		$FormManager = $container->get( 'FormElementManager' );

		return new LogoutController( $FormManager->get( LogoutForm::class ) );
	}
}