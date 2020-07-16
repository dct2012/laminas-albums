<?php

namespace Login;

use Laminas\Router\Http\Segment;
use User\Controller\UserController;

return [
	'router'          => [
		'routes' => [
			'login' => [
				'type'    => Segment::class,
				'options' => [
					'route'    => '/login',
					'defaults' => [
						'controller' => Controller\LoginController::class,
						'action'     => 'index',
					],
				],
			],
		],
	],
	'view_manager'    => [
		'template_path_stack' => [
			'login' => __DIR__.'/../view',
		],
	],
	'controllers'     => [
		'factories' => [
			Controller\LoginController::class => Factory\LoginControllerFactory::class,
		],
	],
	'service_manager' => [
		'aliases'   => [],
		'factories' => [],
	],
];