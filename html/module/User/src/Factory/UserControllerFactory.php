<?php

namespace User\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use User\Controller\UserController;
use User\Form\UserForm;

class UserControllerFactory implements FactoryInterface {
	/**
	 * @param ContainerInterface $container
	 * @param string $requestedName
	 * @param array|null $options
	 * @return object|UserController
	 */
	public function __invoke( ContainerInterface $container, $requestedName, array $options = null ) {
		$FormManager = $container->get( 'FormElementManager' );

		return new UserController( $FormManager->get( UserForm::class ) );
	}
}