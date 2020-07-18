<?php

namespace User\Controller;

use Exception;
use User\Model\User;
use User\Command\UserCommand;
use User\Form\UpdatePasswordForm;
use Laminas\Http\Response;
use Laminas\View\Model\ViewModel;
use Laminas\Validator\{Identical, StringLength};
use Laminas\Mvc\Plugin\FlashMessenger\FlashMessenger;
use Laminas\Mvc\Plugin\Identity\Identity;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Authentication\AuthenticationService;
use Laminas\Authentication\Adapter\DbTable\CredentialTreatmentAdapter;

class UpdatePasswordController extends AbstractActionController {
	/** @var UserCommand */
	protected UserCommand $Command;
	/* @var UpdatePasswordForm */
	private UpdatePasswordForm $Form;

	/**
	 * @param UserCommand $Command
	 * @param UpdatePasswordForm $Form
	 */
	public function __construct( UserCommand $Command, UpdatePasswordForm $Form ) {
		$this->Command = $Command;
		$this->Form    = $Form;
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

		if( !$AS->hasIdentity() ) {
			$FM->addErrorMessage( 'You must be logged in to update password!' );
			return $this->redirect()->toRoute( 'login' );
		}

		$User = $AS->getIdentity();

		if( !$Request->isPost() ) {
			return new ViewModel( [ 'Form' => $this->Form, 'User' => $User ] );
		}

		$data              = $Request->getPost();
		$currentPassword   = $data[ 'current_password' ];
		$newPassword       = $data[ 'password' ];
		$verifyNewPassword = $data[ 'verify_new_password' ];

		$Identical = new Identical( $newPassword );
		if( !$Identical->isValid( $verifyNewPassword ) ) {
			$FM->addErrorMessage( 'New passwords are not identical!' );
			return $this->redirect()->refresh();
		}
		if( $Identical->isValid( $currentPassword ) ) {
			$FM->addErrorMessage( 'Current password and new password must be different!' );
			return $this->redirect()->refresh();
		}

		$StringLength = new StringLength( [ 'min' => 8, 'max' => 100 ] );
		$StringLength->setMessage( 'The new password is less than %min% characters long', $StringLength::TOO_SHORT );
		$StringLength->setMessage( 'The new password is more than %max% characters long', $StringLength::TOO_LONG );
		if( !$StringLength->isValid( $verifyNewPassword ) ) {
			foreach( $StringLength->getMessages() as $error ) {
				$FM->addErrorMessage( $error );
			}
			return $this->redirect()->refresh();
		}

		$this->Form->setData( $data );
		if( !$this->Form->isValid() ) {
			foreach( $this->Form->getMessages() as $error ) {
				$FM->addErrorMessage( $error );
			}
			return $this->redirect()->refresh();
		}

		$User = $this->Form->getData();;

		$Result = $Adapter->setIdentity( $User->getUserName() )
		                  ->setCredential( $currentPassword )
		                  ->authenticate();
		if( !$Result->isValid() ) {
			$FM->addErrorMessage( 'Current password is incorrect!' );
			return $this->redirect()->refresh();
		}

		try {
			$User = $this->Command->update( $User );
		} catch( Exception $e ) {
			$FM->addErrorMessage( $e->getMessage() );
			return $this->redirect()->refresh();
		}

		$AS->clearIdentity();
		$FM->addSuccessMessage( "Successfully updated password for user: {$User->getUserName()}." );

		return $this->redirect()->toRoute( 'login' );
	}
}