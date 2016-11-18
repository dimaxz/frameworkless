<?php
namespace Frameworkless\Controllers;

use Twig_Environment;
use DebugBar\StandardDebugBar;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of BaseController
 *
 * @author d.lanec
 */
abstract class BaseController implements \Psr\Log\LoggerAwareInterface, PageInterface{

    /**
     * @var Twig_Environment
     */
    protected $twig;

    /**
     *
     * @var StandardDebugBar
     */
    protected $debugbar;

    use \Psr\Log\LoggerAwareTrait;

    protected function render($view, array $data = []){

	$debugbarRenderer = $this->debugbar->getJavascriptRenderer("/assets/debug_bar");

	$data["debugbar_Head"]	 = $debugbarRenderer->renderHead();
	$data["debugbar_Body"]	 = $debugbarRenderer->render();

	return new Response($this->twig->render($view, $data));
    }

    public function setTwig(Twig_Environment $twig){
	$this->twig = $twig;
	return $this;
    }

    public function setDebugbar(StandardDebugBar $debugbar){
	$this->debugbar = $debugbar;
	return $this;
    }
}
