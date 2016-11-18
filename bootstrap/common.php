<?php

class App{

    private $settings = array();

    private static $_instance = null;

    private function __construct(){
	// приватный конструктор ограничивает реализацию getInstance ()
    }

    protected function __clone(){
	// ограничивает клонирование объекта
    }

    /**
     * Вызов модуля
     * @param type $name
     * @param array $params
     * @return string
     */
    public static function getModule($name, array $params = []){
	$DI		 = self::getInstance()->load("DI");
	$debugbar	 = $DI->get(DebugBar\StandardDebugBar::class);
	$debugbar['messages']->debug(sprintf('App::getModule %s, with params %s', $name, json_encode($params)));
	$debugbar['time']->startMeasure($name, 'Load module ' . $name);
	$module		 = $DI->get($name);
	$result		 = $module->setParams($params)->process();
	$debugbar['time']->stopMeasure($name);
	return $result;
    }

    public static function getInstance(){
	if(is_null(self::$_instance)){
	    self::$_instance = new self();
	}
	return self::$_instance;
    }

    public function import($key, $value){
	$this->settings[$key] = $value;
    }

    public function load($key){
	return $this->settings[$key];
    }
}
