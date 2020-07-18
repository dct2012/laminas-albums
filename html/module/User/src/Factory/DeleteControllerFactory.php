<?php

namespace User\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use User\Command\UserCommand;
use User\Controller\DeleteController;
use User\Form\DeleteForm;

class DeleteControllerFactory implements FactoryInterface {
	/**
	 * @param ContainerInterface $container
	 * @param string $requestedName
	 * @param array|null $options
	 * @return object|DeleteController
	 */
	public function __invoke( ContainerInterface $container, $requestedName, array $options = null ) {
		$FormManager = $container->get( 'FormElementManager' );

		return new DeleteController(
			$container->get( UserCommand::class ),
			$FormManager->get( DeleteForm::class )
		);
	}
}