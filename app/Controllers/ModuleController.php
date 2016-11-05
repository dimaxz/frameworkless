<?php

namespace Frameworkless\Controllers;

/**
 * Description of ModuleController
 *
 * @author d.lanec
 */
class ModuleController extends BaseController {
	
	protected function render($view, array $data = array()) {
		
		$ref = new \ReflectionClass($this);
		
		$tpl = (new \SplFileInfo($ref->getFileName()))->getPath() . DIRECTORY_SEPARATOR .'tpl';
		
		$twig = new \Twig_Environment(new \Twig_Loader_Filesystem($tpl));

		return $twig->render($view . '.twig',$data);
	}

}
