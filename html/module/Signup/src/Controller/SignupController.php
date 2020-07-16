<?php

namespace Signup\Controller;

use User\Command\UserCommand;
use Signup\Form\SignupForm;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class SignupController extends AbstractActionController {
	/** @var UserCommand */
	protected $command;
	/* @var SignupForm */
	private $form;

	/**
	 * @param UserCommand $command
	 * @param SignupForm $form
	 */
	public function __construct( UserCommand $command, SignupForm $form ) {
		$this->command = $command;
		$this->form    = $form;
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

		$user = $this->form->getData();

		try {
			$user = $this->command->create( $user );
		} catch( \Exception $ex ) {
			// An exception occurred; we may want to log this later and/or
			// report it to the user. For now, we'll just re-throw.
			throw $ex;
		}

		return $this->redirect()->toRoute( 'login' );
	}
}