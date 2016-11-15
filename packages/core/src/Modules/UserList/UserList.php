<?php
namespace Core\Modules\UserList;

use Frameworkless\Controllers;
use Donquixote\Cellbrush\Table\Table;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of UserListController
 *
 * @author d.lanec
 */
class UserList extends Controllers\ModuleController
{

	/**
	 * UserRepository 
	 * @var \Core\Models\User\UserRepository 
	 */
	protected $userRepository;

	/**
	 * Request
	 * @var Symfony\Component\HttpFoundation\Request 
	 */
	protected $request;

	protected $limit = 5;

	function __construct(\Core\Models\User\UserRepository $userRepository, Request $request)
	{
		$this->userRepository	 = $userRepository;
		$this->request			 = $request;
	}

	public function process()
	{

		if ($this->request->query->get('fn') == 'add') {
			$this->add();
		}

		$Users = $this->userRepository->findMany([],$this->limit);

		$table	 = Table::create();
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

		return $this->render('default', [
					'table' => $table->render()
		]);
	}

	protected function add()
	{

		try {

			$User = $this->userRepository->build();
			$User->setEmail('tedt@mail.ru');

			if (!$this->userRepository->save($User)) {
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
	}
}
