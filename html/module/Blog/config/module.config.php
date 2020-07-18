<?php

namespace Blog;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;

return [
	'router'          => [
		'routes' => [
			'blog' => [
				'type'          => Literal::class,
				'options'       => [
					'route'    => '/blog',
					'defaults' => [
						'controller' => Controller\ListController::class,
						'action'     => 'index',
					],
				],
				'may_terminate' => true,
				'child_routes'  => [
					'detail' => [
						'type'    => Segment::class,
						'options' => [
							'route'       => '/:id',
							'defaults'    => [
								'action' => 'detail',
							],
							'constraints' => [
								'id' => '[1-9]\d*',
							],
						],
					],
					'add'    => [
						'type'    => Literal::class,
						'options' => [
							'route'    => '/add',
							'defaults' => [
								'controller' => Controller\WriteController::class,
								'action'     => 'add',
							],
						],
					],
					'edit'   => [
						'type'    => Segment::class,
						'options' => [
							'route'       => '/edit/:id',
							'defaults'    => [
								'controller' => Controller\WriteController::class,
								'action'     => 'edit',
							],
							'constraints' => [
								'id' => '[1-9]\d*',
							],
						],
					],
					'delete' => [
						'type'    => Segment::class,
						'options' => [
							'route'       => '/delete/:id',
							'defaults'    => [
								'controller' => Controller\DeleteController::class,
								'action'     => 'delete',
							],
							'constraints' => [
								'id' => '[1-9]\d*',
							],
						],
					],
				],
			],
		],
	],
	'controllers'     => [
		'factories' => [
			Controller\ListController::class   => Factory\ListControllerFactory::class,
			Controller\WriteController::class  => Factory\WriteControllerFactory::class,
			Controller\DeleteController::class => Factory\DeleteControllerFactory::class,
		],
	],
	'view_manager'    => [
		'template_path_stack' => [
			__DIR__.'/../view',
		],
	],
	'service_manager' => [
		'aliases'   => [
			Model\PostRepositoryInterface::class => Model\PostRepository::class,
			Model\PostCommandInterface::class    => Model\PostCommand::class,
		],
		'factories' => [
			Model\PostRepository::class => Factory\PostRepositoryFactory::class,
			Model\PostCommand::class    => Factory\PostCommandFactory::class,
		],
	],
];