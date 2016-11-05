<?php

namespace Frameworkless\Controllers;

use Twig_Environment;
use DebugBar\StandardDebugBar;


/**
 * Description of PageInterface
 *
 * @author d.lanec
 */
interface PageInterface {
	
	public function setTwig(Twig_Environment $twig);
	
	public  function setDebugbar(StandardDebugBar $debugbar);
	
}
