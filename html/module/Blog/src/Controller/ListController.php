<?php

namespace Blog\Controller;

use Blog\Model\PostRepositoryInterface;

use Laminas\Authentication\AuthenticationService;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class ListController extends AbstractActionController {
	/* @var PostRepositoryInterface */
	private $postRepository;

	public function __construct( PostRepositoryInterface $postRepository ) {
		$this->postRepository = $postRepository;
	}

	public function indexAction() {
		/* @var AuthenticationService */
		$authenticationService = $authenticationService = $this->plugin( 'identity' )->getAuthenticationService();

		if( !$authenticationService->hasIdentity() ) {
			return $this->redirect()->toRoute( 'login' );
		}

		return new ViewModel(
			[
				'posts' => $this->postRepository->findAllPosts(),
			]
		);
	}

	public function detailAction() {
		/* @var AuthenticationService */
		$authenticationService = $authenticationService = $this->plugin( 'identity' )->getAuthenticationService();

		if( !$authenticationService->hasIdentity() ) {
			return $this->redirect()->toRoute( 'login' );
		}

		$id = $this->params()->fromRoute( 'id' );

		try {
			$post = $this->postRepository->findPost( $id );
		} catch( \InvalidArgumentException $ex ) {
			return $this->redirect()->toRoute( 'blog' );
		}

		return new ViewModel(
			[
				'post' => $post,
			]
		);
	}
}