<?php

namespace User\Form;

use Laminas\Form\Form;

class UserForm extends Form {
	/** @param null $name */
	public function __construct( $name = null ) {
		// We will ignore the name provided to the constructor
		parent::__construct( 'user' );

		$this->add(
			[
				'name'    => 'id',
				'type'    => 'text',
				'options' => [
					'label' => 'ID:',
				],
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
	}
}