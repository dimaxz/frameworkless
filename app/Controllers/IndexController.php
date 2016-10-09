<?php

namespace Frameworkless\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Twig_Environment;

use Symfony\Component\VarDumper\VarDumper;
use Core\Models\User\UserRepository;
use DebugBar\StandardDebugBar;

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
		$Selfprices = \Selfprice\Models\Selfprice\SelfpriceQuery::create()->find();

        $this->twig = $twig;
        $this->UserRepository = $UserRepository;
		$this->debugbar = $debugbar;
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

        $User = $this->UserRepo->build();
        $User->setEmail('email.ru');
        //VarDumper::dump($User);

        try {
            $this->UserRepo->save($User);
            return new Response("success create!");
        } catch(\Exception $ex) {
            return new Response("system error:" . $ex->getMessage());
        }
    }
}
