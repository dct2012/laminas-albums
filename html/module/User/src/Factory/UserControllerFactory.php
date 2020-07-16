<?php

namespace User\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use User\Controller\UserController;
use User\Form\UserForm;

class UserControllerFactory implements FactoryInterface {
	public function __invoke( ContainerInterface $container, $requestedName, array $options = null ) {
		$formManager = $container->get( 'FormElementManager' );

		return new UserController( $formManager->get( UserForm::class ) );
	}
}