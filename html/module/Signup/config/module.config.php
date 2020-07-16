<?php

namespace Signup;

use Laminas\Router\Http\Segment;

return [
	'router'          => [
		'routes' => [
			'signup' => [
				'type'    => Segment::class,
				'options' => [
					'route'    => '/signup',
					'defaults' => [
						'controller' => Controller\SignupController::class,
						'action'     => 'index',
					],
				],
			],
		],
	],
	'view_manager'    => [
		'template_path_stack' => [
			'signup' => __DIR__.'/../view',
		],
	],
	'controllers'     => [
		'factories' => [
			Controller\SignupController::class => Factory\SignupControllerFactory::class,
		],
	],
	'service_manager' => [
		'aliases'   => [],
		'factories' => [],
	],
];