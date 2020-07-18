<?php

namespace User\Controller;

use Laminas\Authentication\AuthenticationService;
use Laminas\Http\Response;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\Plugin\FlashMessenger\FlashMessenger;
use Laminas\View\Model\ViewModel;
use User\Form\LogoutForm;

class LogoutController extends AbstractActionController {
	/* @var LogoutForm */
	protected LogoutForm $Form;

	/** @param LogoutForm $Form */
	public function __construct( LogoutForm $Form ) {
		$this->Form = $Form;
	}

	/** @return Response|ViewModel */
	public function indexAction() {
		/* @var FlashMessenger $FM */
		/** @var AuthenticationService $AS */
		$Request = $this->getRequest();
		$AS      = $this->plugin( 'identity' )->getAuthenticationService();
		$FM      = $this->plugin( 'flashMessenger' );

		if( !$AS->hasIdentity() ) {
			$FM->addErrorMessage( 'You have to login before you can logout!' );
			return $this->redirect()->toRoute( 'user/login' );
		}

		if( !$Request->isPost() ) {
			return $this->redirect()->refresh();
		}

		$this->Form->setData( $Request->getPost() );
		if( !$this->Form->isValid() ) {
			foreach( $this->Form->getMessages() as $error ) {
				$FM->addErrorMessage( $error );
			}
			return $this->redirect()->refresh();
		}

		$AS->clearIdentity();
		$FM->addSuccessMessage( 'Successfully Logged Out.' );

		return $this->redirect()->toRoute( 'user/login' );
	}
}