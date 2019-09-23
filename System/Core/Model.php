<?php
namespace System\Core;
use System\Core\Model;

class Model
{
	public $config = [];
	
	public function __construct()
	{
		$LoadConfig = new \System\Core\Configurator;
		$this->config = $LoadConfig->getConfig();
	}
}
?>