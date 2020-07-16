<?php

namespace User;

use Laminas\Router\Http\Segment;

return [
	'router'          => [
		'routes' => [
			'user' => [
				'type'    => Segment::class,
				'options' => [
					'route'    => '/user',
					'defaults' => [
						'controller' => Controller\UserController::class,
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
			Controller\UserController::class => Factory\UserControllerFactory::class,
		],
	],
	'service_manager' => [
		'aliases'   => [
		],
		'factories' => [
			Command\UserCommand::class => Factory\UserCommandFactory::class,
		],
	],
];