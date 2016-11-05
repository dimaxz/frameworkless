<?php

namespace Frameworkless\Controllers;

use Core\Modules\UserList\UserList;

class IndexController extends BaseController {
	
	/**
	 *
	 * @var \Models\User\UserRepository $UserRepository
	 */
	protected $UserRepository;

	protected $userListModule;

	/**
	 * IndexController, constructed by container
	 *
	 * @param Twig_Environment $twig
	 */
	public function __construct( UserList $userListModule) {

		$this->userListModule = $userListModule;
	}

	/**
	 * Return index page (/)
	 *
	 * @param array $args
	 * @return Response
	 */
	public function get($args) {
		return $this->render('pages/index.html.twig', [
				"content" => $this->userListModule->process($args),
		]);
	}

}
