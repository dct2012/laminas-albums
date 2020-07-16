<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare( strict_types = 1 );

namespace Application\Controller;

use Laminas\Authentication\AuthenticationService;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class IndexController extends AbstractActionController {
	public function indexAction() {
		/* @var AuthenticationService */
		$authenticationService = $authenticationService = $this->plugin( 'identity' )->getAuthenticationService();

		if( !$authenticationService->hasIdentity() ) {
			return $this->redirect()->toRoute( 'login' );
		}

		return new ViewModel();
	}
}
