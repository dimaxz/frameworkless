<?php

namespace Frameworkless\Controllers;

use Core\Modules\UserList\UserList;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends BaseController {

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
		
		$result = \App::getModule(UserList::class,[
					"limit" => 2
				]);
		
		$result .= \App::getModule(UserList::class,[
					"limit" => 1
				]);
		
		return $this->render('pages/index.html.twig', [
				"content" => $result,
		]);
	}

}
