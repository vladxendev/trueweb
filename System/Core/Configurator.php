<?php
namespace System\Core;
use System\Core\Configurator;

class Configurator
{
	public $Configuration = [];
	
	public function __construct()
	{
		$ConfigList = scandir(CONFIG_DIR);
		foreach ($ConfigList as $FileId => $File) {
			$FilesInfo[$FileId] = pathinfo($File);
			if (file_exists(CONFIG_DIR . DIRECTORY_SEPARATOR . strtolower($FilesInfo[$FileId]['filename']) . '.php') && $FilesInfo[$FileId]['extension'] == 'php') {
				$CfgFiles[strtolower($FilesInfo[$FileId]['filename'])] = CONFIG_DIR . DIRECTORY_SEPARATOR . $FilesInfo[$FileId]['filename'] . '.' . $FilesInfo[$FileId]['extension'];
			}
		}
		
		foreach ($CfgFiles as $CfgKey => $CfgVal) {
			
			$this->Configuration[$CfgKey] = require $CfgVal;
		}
	}
	
	public function setConfig($CfgName, array $CfgSettings)
	{
		if (empty($this->Configuration[$CfgName]) && !file_exists(CONFIG_DIR . DIRECTORY_SEPARATOR . strtolower($CfgName) . '.php') && !empty($CfgSettings)) {
			$this->Configuration[$CfgName] = $CfgSettings;
		} else {
			return false;
		}
	}
	
	public function getConfig()
	{
		return $this->Configuration;
	}
}
?>