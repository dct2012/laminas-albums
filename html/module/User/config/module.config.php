<?php

namespace User;

use Laminas\Router\Http\Literal;
use User\Controller\{DeleteController, UpdatePasswordController, UserController};
use User\Factory\{UserCommandFactory, DeleteControllerFactory, UserControllerFactory, UpdatePasswordControllerFactory};
use User\Command\UserCommand;

return [
	'router'          => [
		'routes' => [
			'user' => [
				'type'          => Literal::class,
				'options'       => [
					'route'    => '/user',
					'defaults' => [
						'controller' => UserController::class,
						'action'     => 'index',
					],
				],
				'may_terminate' => true,
				'child_routes'  => [
					'update_password' => [
						'type'    => Literal::class,
						'options' => [
							'route'    => '/update_password',
							'defaults' => [
								'controller' => UpdatePasswordController::class,
								'action'     => 'index',
							],
						],
					],
					'delete'          => [
						'type'    => Literal::class,
						'options' => [
							'route'    => '/delete',
							'defaults' => [
								'controller' => DeleteController::class,
								'action'     => 'index',
							],
						],
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
			UserController::class           => UserControllerFactory::class,
			DeleteController::class         => DeleteControllerFactory::class,
			UpdatePasswordController::class => UpdatePasswordControllerFactory::class,
		],
	],
	'service_manager' => [
		'factories' => [
			UserCommand::class => UserCommandFactory::class,
		],
	],
];