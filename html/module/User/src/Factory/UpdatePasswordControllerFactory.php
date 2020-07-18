<?php

namespace User\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use User\Command\UserCommand;
use User\Controller\UpdatePasswordController;
use User\Form\UpdatePasswordForm;

class UpdatePasswordControllerFactory implements FactoryInterface {
	/**
	 * @param ContainerInterface $container
	 * @param string $requestedName
	 * @param array|null $options
	 * @return object|UpdatePasswordController
	 */
	public function __invoke( ContainerInterface $container, $requestedName, array $options = null ) {
		$FormManager = $container->get( 'FormElementManager' );

		return new UpdatePasswordController(
			$container->get( UserCommand::class ),
			$FormManager->get( UpdatePasswordForm::class )
		);
	}
}