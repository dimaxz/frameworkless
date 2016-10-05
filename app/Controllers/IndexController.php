<?php

namespace Frameworkless\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Twig_Environment;
use Models\User\Base\UserQuery;
use Symfony\Component\VarDumper\VarDumper;

use Models\User\UserRepo;

class IndexController
{

    /**
     * @var Twig_Environment
     */
    private $twig;

    /**
     *
     * @var \Models\User\UserRepo $UserRepo
     */
    protected $UserRepo;
    
    /**
     * IndexController, constructed by container
     *
     * @param Twig_Environment $twig
     */
    public function __construct(Twig_Environment $twig, UserRepo $UserRepo)
    {
        $this->twig     = $twig;
        $this->UserRepo = $UserRepo;
    }

    /**
     * Return index page (/)
     *
     * @param array $args
     * @return Response
     */
    public function get($args)
    {
        
        $Users = $this->UserRepo->findMany();

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

        return new Response($this->twig->render('pages/index.html.twig',[
            "table" => $table->render()
        ]));
    }
    
    public function add($args){
        
        $User = $this->UserRepo->build();
        $User->setEmail('email.ru');
        //VarDumper::dump($User);
        
        try{
            $this->UserRepo->save($User);
            return new Response("success create!");
        } catch (\Exception $ex) {
            return new Response("system error:" . $ex->getMessage());
        }
        
        
    }
}
