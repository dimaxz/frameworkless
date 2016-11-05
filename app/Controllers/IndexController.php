<?php

namespace Frameworkless\Controllers;

use Core\Modules\UserList\UserListController;

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
	public function __construct( UserListController $userListModule) {

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
				"content" => $this->userListModule->process(),
		]);
	}

	public function add($args) {

		
		return;
		
		$this->logger->info('add controller');
		
		try {

			$User = new \Core\Models\User\User();
			$User->setEmail('tedt@mail.ru');

			if (!$this->UserRepository->save($User)) {
				throw new Exception('User not save');
			} else {
				$this->logger->info("Пользователь успешно сохранен!");
			}
		} catch(\Frameworkless\Exceptions\ValidationException $ex) {

			foreach ($ex->getFailures() as $failure) {
				$this->logger->error("Property " . $failure->getPropertyPath() . ": " . $failure->getMessage() . "\n");
			}

			$this->logger->info("Произошла ошибка при сохранении пользователя");
			
		} catch(\Exception $ex) {

			$this->logger->error("system error:" . $ex->getMessage());

			$this->logger->info("Произошла ошибка при сохранении пользователя");
		}

		return $this->render('pages/index.html.twig');
	}

}
