<?php
namespace Frameworkless\Controllers;

/**
 * Description of ModuleController
 *
 * @author d.lanec
 */
abstract class ModuleController extends BaseController implements \Frameworkless\ModuleInterface{

    protected function render($view, array $data = array()){

	$ref = new \ReflectionClass($this);

	$tpl = (new \SplFileInfo($ref->getFileName()))->getPath() . DIRECTORY_SEPARATOR . 'tpl';

	$twig = new \Twig_Environment(new \Twig_Loader_Filesystem($tpl));

	return $twig->render($view . '.twig', $data);
    }

    abstract public function process();

    /**
     * set module params
     * @param array $params
     * @return $this
     * @throws \Exception
     */
    public function setParams(array $params = array()){

	foreach($params as $param => $value){
	    if((new \ReflectionClass($this))->hasProperty($param) === false)
		throw new \Exception(sprintf("param '%s' not found in module '%s'", $param, self::class));

	    $this->{$param} = $value;
	}
	return $this;
    }
}
