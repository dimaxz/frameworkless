<?php

namespace Frameworkless\Controllers;

use Core\Models\User\UserRepository;
use Monolog\Logger;

class IndexController extends BaseController {

	/**
	 *
	 * @var \Models\User\UserRepository $UserRepository
	 */
	protected $UserRepository;

	use \Psr\Log\LoggerAwareTrait;

	/**
	 * IndexController, constructed by container
	 *
	 * @param Twig_Environment $twig
	 */
	public function __construct( UserRepository $UserRepository, Logger $logger) {

		$this->UserRepository = $UserRepository;

		$this->logger = $logger;
	}

	/**
	 * Return index page (/)
	 *
	 * @param array $args
	 * @return Response
	 */
	public function get($args) {
		
		$this->logger->info('home controller');

		$Users = $this->UserRepository->findMany();

		$table	 = \Donquixote\Cellbrush\Table\Table::create();
		$table->addColNames([0, 1, 2]);
		$table->addClass('table table-striped');
		$table->thead()
				->addRowName('head row')
				->th('head row', 0, 'Id')
				->th('head row', 1, 'Имя')
				->th('head row', 2, 'Email');
		$i		 = 0;
		foreach ($Users as $User) {
			$table->addRow($i)->tdMultiple([
				$User->getId(),
				$User->getName(),
				$User->getEmail()]);
			$i++;
		}

		return $this->render('pages/index.html.twig', [
					"table" => $table->render(),
		]);
	}

	public function add($args) {

		
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
