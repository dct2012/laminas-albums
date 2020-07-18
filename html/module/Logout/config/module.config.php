<?php

namespace Logout;

use Laminas\Router\Http\Segment;
use Logout\Controller\LogoutController;
use Logout\Factory\LogoutControllerFactory;

return [
	'router'      => [
		'routes' => [
			'logout' => [
				'type'    => Segment::class,
				'options' => [
					'route'    => '/logout',
					'defaults' => [
						'controller' => LogoutController::class,
						'action'     => 'index',
					],
				],
			],
		],
	],
	'controllers' => [
		'factories' => [
			LogoutController::class => LogoutControllerFactory::class,
		],
	],
];