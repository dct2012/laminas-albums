<?php

namespace Signup\Form;

use User\Model\User;
use Laminas\Form\Form;
use Laminas\Hydrator\ReflectionHydrator;

class SignupForm extends Form {
	public function __construct( $name = null ) {
		// We will ignore the name provided to the constructor
		parent::__construct( 'signup' );

		$this->setHydrator( new ReflectionHydrator() );
		$this->setObject( new User( '', '' ) );

		$this->add(
			[
				'name' => 'id',
				'type' => 'hidden',
			]
		);
		$this->add(
			[
				'name'    => 'username',
				'type'    => 'text',
				'options' => [
					'label' => 'Username',
				],
			]
		);
		$this->add(
			[
				'name'    => 'password',
				'type'    => 'text',
				'options' => [
					'label' => 'Password',
				],
			]
		);
		$this->add(
			[
				'name'    => 'password-retype',
				'type'    => 'text',
				'options' => [
					'label' => 'Password Retype',
				],
			]
		);
		$this->add(
			[
				'name'       => 'signup',
				'type'       => 'submit',
				'attributes' => [
					'value' => 'Sign Up',
					'id'    => 'signupButton',
				],
			]
		);
	}
}