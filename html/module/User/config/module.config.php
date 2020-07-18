<?php

namespace User;

use Laminas\Router\Http\Segment;
use User\Controller\UserController;
use User\Factory\UserControllerFactory;
use User\Command\UserCommand;
use User\Factory\UserCommandFactory;

return [
	'router'          => [
		'routes' => [
			'user' => [
				'type'    => Segment::class,
				'options' => [
					'route'    => '/user',
					'defaults' => [
						'controller' => UserController::class,
						'action'     => 'index',
					],
				],
			],
		],
	],
	'view_manager'    => [
		'template_path_stack' => [
			'user' => __DIR__.'/../view',
		],
	],
	'controllers'     => [
		'factories' => [
			UserController::class => UserControllerFactory::class,
		],
	],
	'service_manager' => [
		'factories' => [
			UserCommand::class => UserCommandFactory::class,
		],
	],
];