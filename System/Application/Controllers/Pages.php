<?php
namespace System\Application\Controllers;
use System\Application\Controllers\Pages;

class Pages extends \System\Core\Controller
{
	public $DefaultAction = 'index';
	
	public function index()
	{
		//$staticPages = new \System\Application\Models\StaticPages;
		echo \System\Application\Views\FrontView::render('/main.html', $Data = ['test' => 'Welcome']);
	}
	
	public function static()
	{
		$staticPages = new \System\Application\Models\StaticPages;
		$data['page'] = $staticPages->getPage(trim($this->route['alias']));
		$TplSettings = $this->config;
		$data['tplpath'] = '/Templates/' . ucfirst($TplSettings['config']['tplname']);
		
		if (!empty($data['page'])) {
			$data['page']['title'] = trim(mb_strimwidth($data['page']['title'], 0, 70, "..."));
			//$data['page']['tags'] = explode(',', $data['page']['tags']);
			$data['page']['create_at'] = date('d-m-Y H:i', $data['page']['create_at']);
			$data['pagetitle'] = $data['page']['title'] . ' - Страницы TrueWeb.Dev';
			$data['description'] = !empty($data['page']['description']) ? $data['page']['description'] : $TplSettings['config']['description'];
			$data['keywords'] = !empty($data['page']['keywords']) ? $data['page']['keywords'] : $TplSettings['config']['keywords'];	
		}
		$data['breadcrumb'][0] = ['url' => '/', 'urlname' => 'Главная'];
		$data['breadcrumb'][1] = ['url' => '/pages/', 'urlname' => 'Страницы'];
		$data['breadcrumb'][2] = ['url' => '/pages/', 'urlname' => $data['page']['title']];
		echo \System\Application\Views\FrontView::render('/pages_static.html', $data);
		//print_r($data['page']);
	}
	
}
?>