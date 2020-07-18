<?php

namespace Logout\Controller;

use Laminas\Authentication\AuthenticationService;
use Laminas\Http\Response;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\Plugin\FlashMessenger\FlashMessenger;
use Laminas\View\Model\ViewModel;
use Logout\Form\LogoutForm;

class LogoutController extends AbstractActionController {
	/* @var LogoutForm */
	protected LogoutForm $Form;

	/** @param LogoutForm $Form */
	public function __construct( LogoutForm $Form ) {
		$this->Form = $Form;
	}

	/** @return Response|ViewModel */
	public function indexAction() {
		$Request   = $this->getRequest();
		$ViewModel = new ViewModel( [ 'Form' => $this->Form ] );
		/** @var AuthenticationService $AuthService */
		$AuthService = $this->plugin( 'identity' )->getAuthenticationService();

		if( !$AuthService->hasIdentity() ) {
			return $this->redirect()->toRoute( 'login' );
		}

		if( !$Request->isPost() ) {
			return $this->redirect()->toRoute( 'home' );
		}

		$this->Form->setData( $Request->getPost() );

		if( !$this->Form->isValid() ) {
			return $ViewModel;
		}

		// Clear identity
		$AuthService->clearIdentity();

		// Set success message
		/* @var FlashMessenger $FlashMessenger */
		$FlashMessenger = $this->plugin( 'flashMessenger' );
		$FlashMessenger->addSuccessMessage( 'Successfully Logged Out.' );

		return $this->redirect()->toRoute( 'login' );
	}
}