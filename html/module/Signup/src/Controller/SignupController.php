<?php

namespace Signup\Controller;

use Laminas\Authentication\AuthenticationService;
use Laminas\Http\Response;
use Laminas\Mvc\Plugin\FlashMessenger\FlashMessenger;
use Laminas\Mvc\Plugin\Identity\Identity;
use Laminas\Validator\Identical;
use Laminas\Validator\StringLength;
use User\Command\UserCommand;
use Signup\Form\SignupForm;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Exception;
use User\Model\User;

class SignupController extends AbstractActionController {
	/** @var UserCommand */
	protected UserCommand $Command;
	/* @var SignupForm */
	private SignupForm $Form;

	/**
	 * @param UserCommand $Command
	 * @param SignupForm $Form
	 */
	public function __construct( UserCommand $Command, SignupForm $Form ) {
		$this->Command = $Command;
		$this->Form    = $Form;
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
			return $this->redirect()->toRoute( 'home' );
		}

		if( !$Request->isPost() ) {
			return new ViewModel( [ 'Form' => $this->Form ] );
		}

		$data = $Request->getPost();


		$Identical = new Identical( $data[ 'password' ] );
		$Identical->setMessage( 'Passwords are not identical!' );
		if( !$Identical->isValid( $data[ 'verify-password' ] ) ) {
			foreach( $Identical->getMessages() as $error ) {
				$FM->addErrorMessage( $error );
			}
			return new ViewModel( [ 'Form' => $this->Form ] );
		}

		$StringLength = new StringLength( [ 'min' => 8, 'max' => 100 ] );
		$StringLength->setMessage( 'The password is less than %min% characters long', $StringLength::TOO_SHORT );
		$StringLength->setMessage( 'The password is more than %max% characters long', $StringLength::TOO_LONG );
		if( !$StringLength->isValid( $data[ 'verify-password' ] ) ) {
			foreach( $StringLength->getMessages() as $error ) {
				$FM->addErrorMessage( $error );
			}
			return new ViewModel( [ 'Form' => $this->Form ] );
		}

		$this->Form->setData( $data );

		if( !$this->Form->isValid() ) {
			foreach( $this->Form->getMessages() as $error ) {
				$FM->addErrorMessage( $error );
			}
			return new ViewModel( [ 'Form' => $this->Form ] );
		}

		/* @var User $User */
		$User = $this->Form->getData();

		try {
			$User = $this->Command->create( $User );
		} catch( Exception $e ) {
			$FM->addErrorMessage( $e->getMessage() );

			return new ViewModel( [ 'Form' => $this->Form ] );
		}

		$FM->addSuccessMessage( "Successfully signed up user: {$User->getUserName()}." );

		return $this->redirect()->toRoute( 'login' );
	}
}