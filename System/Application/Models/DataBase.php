<?php
namespace System\Application\Models;
use System\Application\Models\DataBase;

class DataBase extends \System\Core\Singleton
{
	public static function connect()
	{
		//echo 'Connecting to DataBase';
		$LoadConfig = new \System\Core\Configurator;
		$LoadConfig->getConfig();
	}
}
?>