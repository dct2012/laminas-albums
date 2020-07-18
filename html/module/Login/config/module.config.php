<?php

namespace Login;

use Laminas\Router\Http\Segment;
use Login\Controller\LoginController;
use Login\Factory\LoginControllerFactory;

return [
	'router'       => [
		'routes' => [
			'login' => [
				'type'    => Segment::class,
				'options' => [
					'route'    => '/login',
					'defaults' => [
						'controller' => LoginController::class,
						'action'     => 'index',
					],
				],
			],
		],
	],
	'view_manager' => [
		'template_path_stack' => [
			'login' => __DIR__.'/../view',
		],
	],
	'controllers'  => [
		'factories' => [
			LoginController::class => LoginControllerFactory::class,
		],
	],
];