<?php

namespace Frameworkless\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Twig_Environment;
use Core\Models\User\UserRepository;
use DebugBar\StandardDebugBar;
use Frameworkless\Helpers\Debug;
use Monolog\Logger;

class IndexController
{

	/**
	 * @var Twig_Environment
	 */
	private $twig;

	/**
	 *
	 * @var \Models\User\UserRepository $UserRepository
	 */
	protected $UserRepository;

	protected $debugbar;
	
	use \Psr\Log\LoggerAwareTrait;

	/**
	 * IndexController, constructed by container
	 *
	 * @param Twig_Environment $twig
	 */
	public function __construct(
	Twig_Environment $twig, UserRepository $UserRepository, StandardDebugBar $debugbar, Logger $logger
	)
	{
		$this->twig = $twig;
		$this->UserRepository = $UserRepository;
		$this->debugbar = $debugbar;
		
		$this->logger = $logger;
		
		$this->logger->info('start controller');
	}

	/**
	 * Return index page (/)
	 *
	 * @param array $args
	 * @return Response
	 */
	public function get($args)
	{
		$debugbarRenderer = $this->debugbar->getJavascriptRenderer("/assets/debug_bar");

		$Users = $this->UserRepository->findMany();

		$table = \Donquixote\Cellbrush\Table\Table::create();
		$table->addColNames([0, 1, 2]);
		$table->addClass('table table-striped');
		$table->thead()
				->addRowName('head row')
				->th('head row', 0, 'Id')
				->th('head row', 1, 'Имя')
				->th('head row', 2, 'Email');
		$i = 0;
		foreach ($Users as $User) {
			$table->addRow($i)->tdMultiple([
				$User->getId(),
				$User->getName(),
				$User->getEmail()]);
			$i++;
		}

		return new Response($this->twig->render('pages/index.html.twig', [
					"table"			 => $table->render(),
					"debugbar_Head"	 => $debugbarRenderer->renderHead(),
					"debugbar_Body"	 => $debugbarRenderer->render()
		]));
	}

	public function add($args)
	{

		$debugbarRenderer = $this->debugbar->getJavascriptRenderer("/assets/debug_bar");
		
		try {

			$User = new \Core\Models\User\User();
			$User->setEmail('tedt@mail.ru');
			
			if(!$User->validate()){
				
				foreach ($User->getValidationFailures() as $failure) {
					$this->logger->error("Property ".$failure->getPropertyPath().": ".$failure->getMessage()."\n");
				}				
				
			}
			else{
				$this->logger->info('success create!');
			}
			

			
			
		} catch(\Exception $ex) {
			
			$this->logger->info("system error:" . $ex->getMessage());
		}
		
		return new Response($this->twig->render('pages/index.html.twig', [
					"debugbar_Head"	 => $debugbarRenderer->renderHead(),
					"debugbar_Body"	 => $debugbarRenderer->render()
		]));
	}
}
