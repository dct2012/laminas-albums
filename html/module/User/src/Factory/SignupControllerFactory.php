<?php

namespace User\Factory;

use User\Form\SignupForm;
use User\Command\UserCommand;
use User\Controller\SignupController;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class SignupControllerFactory implements FactoryInterface {
	/**
	 * @param ContainerInterface $container
	 * @param string $requestedName
	 * @param array|null $options
	 * @return object|SignupController
	 */
	public function __invoke( ContainerInterface $container, $requestedName, array $options = null ) {
		$FormManager = $container->get( 'FormElementManager' );

		return new SignupController(
			$container->get( UserCommand::class ),
			$FormManager->get( SignupForm::class )
		);
	}
}