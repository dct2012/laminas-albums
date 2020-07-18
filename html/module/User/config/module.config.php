<?php

namespace User;

use User\Controller\{
	LoginController,
	LogoutController,
	SignupController,
	UserController,
	DeleteController,
	UpdatePasswordController
};
use User\Command\UserCommand;
use User\Factory\{LoginControllerFactory,
	LogoutControllerFactory,
	SignupControllerFactory,
	UserCommandFactory,
	UserControllerFactory,
	DeleteControllerFactory,
	AuthenticationServiceFactory,
	UpdatePasswordControllerFactory
};
use Laminas\Router\Http\Literal;
use Laminas\Authentication\AuthenticationServiceInterface;

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
					'login'           => [
						'type'    => Literal::class,
						'options' => [
							'route'    => '/login',
							'defaults' => [
								'controller' => LoginController::class,
								'action'     => 'index',
							],
						],
					],
					'logout'          => [
						'type'    => Literal::class,
						'options' => [
							'route'    => '/logout',
							'defaults' => [
								'controller' => LogoutController::class,
								'action'     => 'index',
							],
						],
					],
					'signup'          => [
						'type'    => Literal::class,
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
			LoginController::class          => LoginControllerFactory::class,
			DeleteController::class         => DeleteControllerFactory::class,
			LogoutController::class         => LogoutControllerFactory::class,
			SignupController::class         => SignupControllerFactory::class,
			UpdatePasswordController::class => UpdatePasswordControllerFactory::class,
		],
	],
	'service_manager' => [
		'factories' => [
			UserCommand::class                    => UserCommandFactory::class,
			AuthenticationServiceInterface::class => AuthenticationServiceFactory::class,
		],
	],
];