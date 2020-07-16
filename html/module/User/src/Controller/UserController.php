<?php

namespace User\Controller;

use Laminas\Authentication\AuthenticationService;
use User\Form\UserForm;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class UserController extends AbstractActionController {
	/* @var UserForm */
	private UserForm $form;

	/**
	 * @param UserForm $form
	 */
	public function __construct( UserForm $form ) {
		$this->form = $form;
	}

	public function indexAction() {
		/* @var AuthenticationService */
		$authenticationService = $authenticationService = $this->plugin( 'identity' )->getAuthenticationService();

		if( !$authenticationService->hasIdentity() ) {
			return $this->redirect()->toRoute( 'login' );
		}

		return new ViewModel( [ 'form' => $this->form, 'user' => $authenticationService->getIdentity() ] );
	}
}