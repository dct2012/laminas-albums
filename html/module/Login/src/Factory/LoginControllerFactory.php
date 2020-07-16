<?php

namespace Login\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Login\Controller\LoginController;
use Login\Form\LoginForm;

class LoginControllerFactory implements FactoryInterface {
	public function __invoke( ContainerInterface $container, $requestedName, array $options = null ) {
		$formManager = $container->get( 'FormElementManager' );

		return new LoginController( $formManager->get( LoginForm::class ) );
	}
}