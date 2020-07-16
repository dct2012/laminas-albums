<?php

namespace Login\Controller;

use Laminas\Authentication\Adapter\DbTable\CredentialTreatmentAdapter;
use Laminas\Authentication\AuthenticationService;
use Laminas\Mvc\Plugin\Identity\Identity;
use Login\Form\LoginForm;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use User\Model\User;

class LoginController extends AbstractActionController {
	/* @var LoginForm */
	private LoginForm $form;

	/**
	 * @param LoginForm $form
	 */
	public function __construct( LoginForm $form ) {
		$this->form = $form;
	}

	public function indexAction() {
		$request   = $this->getRequest();
		$viewModel = new ViewModel( [ 'form' => $this->form ] );

		if( !$request->isPost() ) {
			return $viewModel;
		}

		$this->form->setData( $request->getPost() );

		if( !$this->form->isValid() ) {
			return $viewModel;
		}

		$post = $this->form->getData();

		/** @var Identity $identity */
		$identity = $this->plugin( 'identity' );
		/** @var AuthenticationService $authenticationService */
		$authenticationService = $identity->getAuthenticationService();

		/** @var CredentialTreatmentAdapter $adapter */
		$adapter = $authenticationService->getAdapter();
		$adapter->setIdentity( $post[ 'username' ] )
		        ->setCredential( $post[ 'password' ] );

		$result = $authenticationService->authenticate( $adapter );

		if( !$result->isValid() ) {
			return $viewModel;
		}

		$storage = $authenticationService->getStorage();
		$result  = $adapter->getResultRowObject( [ 'id', 'username', 'password' ] );

		$user = new User( $result->username, $result->password, $result->id );

		// Write to session
		$storage->write( $user );

		return $this->redirect()->toRoute( 'user' );
	}

	//	public function logoutAction() {
	//		// Has identity?
	//		if( !$this->identity() ) {
	//			return $this->redirect()->toRoute( '…' );
	//		}
	//
	//		// Get authentication service
	//		/** @var AuthenticationService $authenticationService */
	//		$authenticationService = $this->plugin( 'identity' )->getAuthenticationService();
	//
	//		// Clear identity
	//		$authenticationService->clearIdentity();
	//
	//		// Set success message
	//		$this->flashMessenger()->addSuccessMessage( 'Logout successful…' );
	//
	//		return $this->redirect()->toRoute( '…' );
	//	}
}