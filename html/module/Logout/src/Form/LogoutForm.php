<?php

namespace Logout\Form;

use Laminas\Form\Form;

class LogoutForm extends Form {
	/** @param null $name */
	public function __construct( $name = null ) {
		parent::__construct( 'logout' );

		$this->add(
			[
				'name'       => 'logout',
				'type'       => 'submit',
				'attributes' => [
					'value' => 'logout',
					'id'    => 'logoutButton',
				],
			]
		);
	}
}