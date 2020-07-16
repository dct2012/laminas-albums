<?php

namespace Auth;

use Laminas\Authentication\AuthenticationServiceInterface;

return [
	'service_manager' => [
		'factories' => [
			AuthenticationServiceInterface::class => Factory\AuthenticationServiceFactory::class,
		],
	],
];