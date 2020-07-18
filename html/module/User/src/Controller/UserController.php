<?php

namespace User\Controller;

use User\Form\UserForm;
use Laminas\Http\Response;
use Laminas\View\Model\ViewModel;
use Laminas\Authentication\AuthenticationService;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\Plugin\FlashMessenger\FlashMessenger;

class UserController extends AbstractActionController {
	/* @var UserForm */
	private UserForm $Form;

	/* @param UserForm $Form */
	public function __construct( UserForm $Form ) {
		$this->Form = $Form;
	}

	/** @return Response|ViewModel */
	public function indexAction() {
		/**
		 * @var AuthenticationService $AS
		 * @var FlashMessenger $FM
		 */
		$AS = $this->plugin( 'identity' )->getAuthenticationService();
		$FM = $this->plugin( 'flashMessenger' );

		if( !$AS->hasIdentity() ) {
			$FM->addErrorMessage( 'You have to be logged in to view user info!' );
			return $this->redirect()->toRoute( 'user/login' );
		}

		return new ViewModel( [ 'Form' => $this->Form, 'User' => $AS->getIdentity() ] );
	}
}