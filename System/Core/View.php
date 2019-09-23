<?php
namespace System\Core;
use System\Core\View;

class View
{
	public $loader;
	public $twig;
	
	public function __construct($TemplateDir = TPL_PATH, $TemplateCache = false, $TemplateDebug = false)
	{
		$this->loader = new \Twig\Loader\FilesystemLoader($TemplateDir);
		$this->twig = new \Twig\Environment($this->loader, ['cache' => $TemplateCache, 'debug' => $TemplateDebug]);
	}
	
	public function render($TplFile, $Data = null)
	{
		return $this->twig->render($TplFile, $Data);
	}
}
?>