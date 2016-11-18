<?php
namespace Frameworkless\Controllers;

use Core\Modules\UserList\UserList;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends BaseController{

    /**
     * Return index page (/)
     *
     * @param array $args
     * @return Response
     */
    public function get(){

	$result = \App::getModule(UserList::class, [
		    "limit" => 50
	]);

	return new Response($this->render('pages/index.html.twig', [
		    "content" => $result,
	]));
    }
}
