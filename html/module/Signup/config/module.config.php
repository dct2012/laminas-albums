<?php

namespace Signup;

use Laminas\Router\Http\Segment;
use Signup\Controller\SignupController;
use Signup\Factory\SignupControllerFactory;

return [
	'router'       => [
		'routes' => [
			'signup' => [
				'type'    => Segment::class,
				'options' => [
					'route'    => '/signup',
					'defaults' => [
						'controller' => SignupController::class,
						'action'     => 'index',
					],
				],
			],
		],
	],
	'view_manager' => [
		'template_path_stack' => [
			'signup' => __DIR__.'/../view',
		],
	],
	'controllers'  => [
		'factories' => [
			SignupController::class => SignupControllerFactory::class,
		],
	],
];