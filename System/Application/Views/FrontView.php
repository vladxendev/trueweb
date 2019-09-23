<?php
namespace System\Application\Views;
use System\Application\Views\FrontView;

class FrontView extends \System\Core\Singleton
{
	public static function render($TplFile, $Data = null)
	{
		$LoadConfig = new \System\Core\Configurator;
		$TplConfig = $LoadConfig->getConfig();
		$LoadView = new \System\Core\View(TPL_PATH . DIRECTORY_SEPARATOR . ucfirst($TplConfig['config']['tplname']), $TplConfig['config']['tplcache'], $TplConfig['config']['tpldebug']);
		return $LoadView->twig->render($TplFile, $Data);
	}
}
?>