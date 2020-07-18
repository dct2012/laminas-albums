<?php

namespace User\Controller;

use User\Model\User;
use User\Form\LoginForm;
use Laminas\Http\Response;
use Laminas\View\Model\ViewModel;
use Laminas\Mvc\Plugin\Identity\Identity;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\Plugin\FlashMessenger\FlashMessenger;
use Laminas\Authentication\AuthenticationService;
use Laminas\Authentication\Adapter\DbTable\CredentialTreatmentAdapter;

class LoginController extends AbstractActionController {
	/* @var LoginForm */
	private LoginForm $Form;

	/** @param LoginForm $Form */
	public function __construct( LoginForm $Form ) {
		$this->Form = $Form;
	}

	/** @return Response|ViewModel */
	public function indexAction() {
		/**
		 * @var User $User
		 * @var FlashMessenger $FM
		 * @var Identity $Identity
		 * @var AuthenticationService $AS
		 * @var CredentialTreatmentAdapter $Adapter
		 **/
		$Request  = $this->getRequest();
		$Identity = $this->plugin( 'identity' );
		$AS       = $Identity->getAuthenticationService();
		$FM       = $this->plugin( 'flashMessenger' );
		$Adapter  = $AS->getAdapter();

		if( $AS->hasIdentity() ) {
			$FM->addInfoMessage( 'You are already logged in.' );
			return $this->redirect()->toRoute( 'user' );
		}

		if( !$Request->isPost() ) {
			return new ViewModel( [ 'Form' => $this->Form ] );
		}

		$this->Form->setData( $Request->getPost() );
		if( !$this->Form->isValid() ) {
			foreach( $this->Form->getMessages() as $error ) {
				$FM->addErrorMessage( $error );
			}
			return $this->redirect()->refresh();
		}

		$User = $this->Form->getData();

		$Adapter->setIdentity( $User->getUserName() )
		        ->setCredential( $User->getPassword() );
		$Result = $AS->authenticate( $Adapter );
		if( !$Result->isValid() ) {
			foreach( $Result->getMessages() as $error ) {
				$FM->addErrorMessage( $error );
			}
			return $this->redirect()->refresh();
		}

		$userData = $Adapter->getResultRowObject( [ 'id', 'password' ] );
		$AS->getStorage()->write( $User->setID( $userData->id )->setPassword( $userData->password ) );

		$FM->addSuccessMessage( 'Successfully Logged In.' );

		return $this->redirect()->toRoute( 'user' );
	}
}