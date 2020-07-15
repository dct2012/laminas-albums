<?php

namespace Blog\Factory;

use Interop\Container\ContainerInterface;
use Blog\Model\Post;
use Blog\Model\PostRepository;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Hydrator\ReflectionHydrator;
use Laminas\ServiceManager\Factory\FactoryInterface;

class PostRepositoryFactory implements FactoryInterface {
	/**
	 * @param ContainerInterface $container
	 * @param string $requestedName
	 * @param null|array $options
	 * @return PostRepository
	 */
	public function __invoke( ContainerInterface $container, $requestedName, array $options = null ) {
		return new PostRepository(
			$container->get( AdapterInterface::class ),
			new ReflectionHydrator(),
			new Post( '', '' )
		);
	}
}