<?php

namespace Frameworkless\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Twig_Environment;
use Core\Models\User\UserRepository;
use DebugBar\StandardDebugBar;
use Frameworkless\Helpers\Debug;

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


	/**
     * IndexController, constructed by container
     *
     * @param Twig_Environment $twig
     */
    public function __construct(
			Twig_Environment $twig, 
			UserRepository $UserRepository,
			StandardDebugBar $debugbar
			)
    {
        $this->twig = $twig;
        $this->UserRepository = $UserRepository;
		$this->debugbar = $debugbar;
		$logger = new \Monolog\Logger('mylogger');
		$this->debugbar->addCollector(new \DebugBar\Bridge\MonologCollector($logger));
		
		$logger->addError('start work',[1,2,'test']);
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

		$this->debugbar["messages"]->addMessage("hello world!");
		
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
                    "table"			=> $table->render(),
					"debugbar_Head"	=>	$debugbarRenderer->renderHead(),
					"debugbar_Body"	=>	$debugbarRenderer->render()
        ]));
    }

    public function add($args)
    {

	
		
       // $User = $this->UserRepository->build();
        //$User->setEmail('email.ru');
        //VarDumper::dump($User);

        try {
            //$this->UserRepository->save($User);
			
			//Faker
//			$generator = \Faker\Factory::create();
//			$populator = new \Faker\ORM\Propel2\Populator($generator);
//			$populator->addEntity('Core\Models\User\User', 5);
//			$insertedPKs = $populator->execute();				
			
			
			
			
            return new Response("success create!");
        } catch(\Exception $ex) {
            return new Response("system error:" . $ex->getMessage());
        }
    }
}
