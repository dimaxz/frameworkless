<?php

namespace Core\Modules\UserList;

use Frameworkless\Controllers;
use Donquixote\Cellbrush\Table\Table;

/**
 * Description of UserListController
 *
 * @author d.lanec
 */
class UserListController extends Controllers\ModuleController implements Controllers\ModuleInterface {

	/**
	 *
	 * @var \Core\Models\User\UserRepository 
	 */
	protected $userRepository;
			
	function __construct(\Core\Models\User\UserRepository $userRepository) {
		$this->userRepository = $userRepository;
	}


	public function process() {
		
		$this->logger->info('home controller');

		$Users = $this->userRepository->findMany();

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

		return $this->render('default',[
			'table'	 =>	$table->render()
		]);
		
	}

}
