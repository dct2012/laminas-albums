<?php

namespace Signup\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use User\Command\UserCommand;
use Signup\Controller\SignupController;
use Signup\Form\SignupForm;

class SignupControllerFactory implements FactoryInterface {
	public function __invoke( ContainerInterface $container, $requestedName, array $options = null ) {
		$formManager = $container->get( 'FormElementManager' );

		return new SignupController(
			$container->get( UserCommand::class ),
			$formManager->get( SignupForm::class )
		);
	}
}