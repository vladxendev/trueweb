<?php
namespace System\Core;
use System\Core\Controller;

class Controller
{
	public $route = [];
	public $config = [];
	
	public function __construct($route)
	{
		$this->route = $route;
		$LoadConfig = new \System\Core\Configurator;
		$this->config = $LoadConfig->getConfig();
	}
}
?>