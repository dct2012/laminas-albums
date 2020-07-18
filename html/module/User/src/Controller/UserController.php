<?php

namespace User\Controller;

use Laminas\Authentication\AuthenticationService;
use Laminas\Http\Response;
use User\Form\UserForm;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class UserController extends AbstractActionController {
	/* @var UserForm */
	private UserForm $Form;

	/* @param UserForm $Form */
	public function __construct( UserForm $Form ) {
		$this->Form = $Form;
	}

	/** @return Response|ViewModel */
	public function indexAction() {
		/* @var AuthenticationService */
		$AS = $this->plugin( 'identity' )->getAuthenticationService();

		if( !$AS->hasIdentity() ) {
			return $this->redirect()->toRoute( 'login' );
		}

		return new ViewModel( [ 'Form' => $this->Form, 'User' => $AS->getIdentity() ] );
	}
}