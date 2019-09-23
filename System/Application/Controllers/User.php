<?php
namespace System\Application\Controllers;
use System\Application\Controllers\User;

class User extends \System\Core\Controller
{
	public $DefaultAction = 'index';
	
	public function index()
	{
		$TplSettings = $this->config;
		$data['tplpath'] = '/Templates/' . ucfirst($TplSettings['config']['tplname']);
		$data['pagetitle'] = $TplSettings['config']['sitename'];
		$data['description'] = $TplSettings['config']['description'];
		$data['keywords'] = $TplSettings['config']['keywords'];
		echo \System\Application\Views\FrontView::render('/main.html', $data);
	}
	
	public function register()
	{
		$TplSettings = $this->config;
		$data['tplpath'] = '/Templates/' . ucfirst($TplSettings['config']['tplname']);
		$data['pagetitle'] = 'Регистрация - ' . $TplSettings['config']['sitename'];
		$data['description'] = $TplSettings['config']['description'];
		$data['keywords'] = $TplSettings['config']['keywords'];
		$data['breadcrumb'][0] = ['url' => '/', 'urlname' => 'Главная'];
		$data['breadcrumb'][1] = ['url' => '/user/register', 'urlname' => 'Регистрация'];
		echo \System\Application\Views\FrontView::render('/user_register.html', $data);
	}
	
	public function login()
	{
		$TplSettings = $this->config;
		$data['tplpath'] = '/Templates/' . ucfirst($TplSettings['config']['tplname']);
		$data['pagetitle'] = 'Авторизация - ' . $TplSettings['config']['sitename'];
		$data['description'] = $TplSettings['config']['description'];
		$data['keywords'] = $TplSettings['config']['keywords'];
		$data['breadcrumb'][0] = ['url' => '/', 'urlname' => 'Главная'];
		$data['breadcrumb'][1] = ['url' => '/user/register', 'urlname' => 'Авторизация'];
		echo \System\Application\Views\FrontView::render('/user_login.html', $data);
	}
	
	public function profile($uid)
	{
		//print_r($this->route['alias']);
		//print_r($_GET);
		echo $uid;
	}
}
?>