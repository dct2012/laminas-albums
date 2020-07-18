<?php

namespace User\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use User\Controller\LogoutController;
use User\Form\LogoutForm;

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