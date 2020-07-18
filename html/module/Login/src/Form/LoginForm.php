<?php

namespace Login\Form;

use Laminas\Form\Form;
use Laminas\Form\Element\Csrf;

class LoginForm extends Form {
	/** @param null $name */
	public function __construct( $name = null ) {
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
					'label' => 'Username:',
				],
			]
		);
		$this->add(
			[
				'name'    => 'password',
				'type'    => 'password',
				'options' => [
					'label' => 'Password:',
				],
			]
		);
		$this->add( new Csrf( 'security' ) );
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