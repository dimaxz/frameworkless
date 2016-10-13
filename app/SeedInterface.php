<?php

namespace Frameworkless;

/**
 * Description of SeedInterface
 *
 * @author Dmitriy
 */
interface SeedInterface
{
	static public function build($id = 1);
	
	static public function reset();
}
