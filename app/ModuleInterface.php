<?php
namespace Frameworkless;

/**
 * Description of ModuleInterafce
 *
 * @author d.lanec
 */
interface ModuleInterface{

    public function process();

    public function setParams(array $params = []);
}
