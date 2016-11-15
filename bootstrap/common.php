<?php

class App
{

	private $settings = array();
	
	private static $_instance = null;

	private function __construct()
	{
		// приватный конструктор ограничивает реализацию getInstance ()
	}

	protected function __clone()
	{
		// ограничивает клонирование объекта
	}

	static function getModule($name, array $params = [])
	{
		$DI = self::getInstance()->load("DI");
		$debugbar = $DI->get(DebugBar\StandardDebugBar::class);
		$debugbar['time']->startMeasure($name, 'Load module ' . $name);
		$result = $DI->get($name)->process();	
		$debugbar['time']->stopMeasure($name);
		return $result;
	}

	static public function getInstance()
	{
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function import($key,$value)
	{
		$this->settings[$key] = $value;
	}

	public function load($key)
	{
		return $this->settings[$key];
	}
}
