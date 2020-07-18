<?php

namespace User\Controller;

use Laminas\Authentication\AuthenticationService;
use Laminas\Http\Response;
use Laminas\Mvc\Plugin\FlashMessenger\FlashMessenger;
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
		/**
		 * @var AuthenticationService $AS
		 * @var FlashMessenger $FM
		 */
		$AS = $this->plugin( 'identity' )->getAuthenticationService();
		$FM = $this->plugin( 'flashMessenger' );

		if( !$AS->hasIdentity() ) {
			$FM->addErrorMessage( 'You have to be logged in to view user info!' );
			return $this->redirect()->toRoute( 'login' );
		}

		return new ViewModel( [ 'Form' => $this->Form, 'User' => $AS->getIdentity() ] );
	}
}