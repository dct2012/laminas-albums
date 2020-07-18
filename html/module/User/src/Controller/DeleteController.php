<?php

namespace User\Controller;

use Exception;
use Laminas\Authentication\Adapter\DbTable\CredentialTreatmentAdapter;
use User\Form\DeleteForm;
use User\Command\UserCommand;
use Laminas\Http\Response;
use Laminas\View\Model\ViewModel;
use Laminas\Authentication\AuthenticationService;
use Laminas\Mvc\Plugin\Identity\Identity;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\Plugin\FlashMessenger\FlashMessenger;
use User\Model\User;

class DeleteController extends AbstractActionController {
	/** @var UserCommand */
	protected UserCommand $Command;
	/* @var DeleteForm */
	private DeleteForm $Form;

	/**
	 * @param UserCommand $Command
	 * @param DeleteForm $Form
	 */
	public function __construct( UserCommand $Command, DeleteForm $Form ) {
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
			$FM->addErrorMessage( 'You must be logged in to delete your account!' );
			return $this->redirect()->toRoute( 'user/login' );
		}

		$User = $AS->getIdentity();

		if( !$Request->isPost() ) {
			return new ViewModel( [ 'Form' => $this->Form, 'User' => $User ] );
		}

		$this->Form->setData( $Request->getPost() );
		if( !$this->Form->isValid() ) {
			foreach( $this->Form->getMessages() as $error ) {
				$FM->addErrorMessage( $error );
			}
			return $this->redirect()->refresh();
		}

		$User = $this->Form->getData();

		$Result = $Adapter->setIdentity( $User->getUserName() )
		                  ->setCredential( $User->getPassword() )
		                  ->authenticate();
		if( !$Result->isValid() ) {
			foreach( $Result->getMessages() as $error ) {
				$FM->addErrorMessage( $error );
			}
			return $this->redirect()->refresh();
		}

		try {
			$User = $this->Command->delete( $User );
		} catch( Exception $e ) {
			$FM->addErrorMessage( $e->getMessage() );
			return $this->redirect()->refresh();
		}

		$AS->clearIdentity();
		$FM->addSuccessMessage( "Successfully deleted account: {$User->getUserName()}." );

		return $this->redirect()->toRoute( 'user/login' );
	}
}