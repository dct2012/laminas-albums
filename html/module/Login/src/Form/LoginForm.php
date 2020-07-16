<?php

namespace Login\Form;

use Laminas\Form\Form;

class LoginForm extends Form {
	public function __construct( $name = null ) {
		// We will ignore the name provided to the constructor
		parent::__construct( 'login' );

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
				'name'       => 'login',
				'type'       => 'submit',
				'attributes' => [
					'value' => 'Login',
					'id'    => 'loginButton',
				],
			]
		);
	}
}