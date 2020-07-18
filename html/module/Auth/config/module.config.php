<?php

namespace Auth;

use Laminas\Authentication\AuthenticationServiceInterface;
use Auth\Factory\AuthenticationServiceFactory;

return [
	'service_manager' => [
		'factories' => [
			AuthenticationServiceInterface::class => AuthenticationServiceFactory::class,
		],
	],
];