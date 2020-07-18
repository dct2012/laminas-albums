<?php

namespace Login\Controller;

use Laminas\Authentication\Adapter\DbTable\CredentialTreatmentAdapter;
use Laminas\Authentication\AuthenticationService;
use Laminas\Http\Response;
use Laminas\Mvc\Plugin\FlashMessenger\FlashMessenger;
use Laminas\Mvc\Plugin\Identity\Identity;
use Login\Form\LoginForm;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use User\Model\User;

class LoginController extends AbstractActionController {
	/* @var LoginForm */
	private LoginForm $Form;

	/** @param LoginForm $Form */
	public function __construct( LoginForm $Form ) {
		$this->Form = $Form;
	}

	/** @return Response|ViewModel */
	public function indexAction() {
		/* @var FlashMessenger $FM */
		/** @var Identity $Identity */
		/** @var AuthenticationService $AS */
		$Request  = $this->getRequest();
		$Identity = $this->plugin( 'identity' );
		$AS       = $Identity->getAuthenticationService();
		$FM       = $this->plugin( 'flashMessenger' );

		// if logged in go to home
		if( $AS->hasIdentity() ) {
			$FM->addInfoMessage( 'You are already logged in.' );
			return $this->redirect()->toRoute( 'user' );
		}

		// not a post show self
		if( !$Request->isPost() ) {
			return new ViewModel( [ 'Form' => $this->Form ] );
		}

		$this->Form->setData( $Request->getPost() );

		if( !$this->Form->isValid() ) {
			return new ViewModel( [ 'Form' => $this->Form ] );
		}

		$post = $this->Form->getData();

		/** @var CredentialTreatmentAdapter $Adapter */
		$Adapter = $AS->getAdapter();
		$Adapter->setIdentity( $post[ 'username' ] )
		        ->setCredential( $post[ 'password' ] );

		$Result = $AS->authenticate( $Adapter );

		if( !$Result->isValid() ) {
			foreach( $Result->getMessages() as $error ) {
				$FM->addErrorMessage( $error );
			}
			return new ViewModel( [ 'Form' => $this->Form ] );
		}

		$Storage  = $AS->getStorage();
		$userData = $Adapter->getResultRowObject( [ 'id', 'username', 'password' ] );

		$Storage->write( new User( $userData->username, $userData->password, $userData->id ) );

		$FM->addSuccessMessage( 'Successfully Logged In.' );

		return $this->redirect()->toRoute( 'user' );
	}
}