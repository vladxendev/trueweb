<?php
namespace System\Application\Controllers;
use System\Application\Controllers\Main;

class Main extends \System\Core\Controller
{
	public $DefaultAction = 'index';
	
	public function index()
	{
		$TplSettings = $this->config;
		$data['tplpath'] = '/Templates/' . ucfirst($TplSettings['config']['tplname']);
		$data['pagetitle'] = $TplSettings['config']['sitename'];
		$data['description'] = $TplSettings['config']['description'];
		$data['keywords'] = $TplSettings['config']['keywords'];
		$data['breadcrumb'][0] = ['url' => '/', 'urlname' => 'Главная'];
		$insert['login'] = 'xenkok';
		$insert['email'] = 'counterstrikec4@gmail.com';
		$insert['password'] = '13371994';
		$insert['hash'] = '8888ds9dfds9fsd9fsf9==';
		$update['login'] = 'csc4';
		$params['login'] = 'xenkok';
		//$delete['login'] = 'xenkok';
		$delete['id'] = 15;
		//print_r(\System\Application\Models\PgSql::getRows('public.users', '*', $params));
		//print_r(\System\Application\Models\PgSql::getAllRows('public.users'));
		//print_r(\System\Application\Models\PgSql::getRow('public.users', '*', $params));
		//\System\Application\Models\PgSql::update('public.users', $update, $params);
		//print_r(\System\Application\Models\PgSql::deleteRows('public.users'));
		//print_r(\System\Application\Models\PgSql::deleteRow('public.users', $delete));
		//\System\Application\Models\PgSql::insert('public.users', $insert);
		//print_r($data);
		echo \System\Application\Views\FrontView::render('/main.html', $data);
		//$date = new \DateTime('2000-01-01');
		//echo strtotime($date->format('Y-m-d H:i:s'));
		//$date = (new \DateTime('now'))->format('d-m-Y H:i:s');
		//echo strtotime((new \DateTime('now'))->format('Y-m-d H:i:s'));
		
	}
	
	public function about()
	{
		$TplSettings = $this->config;
		$data['tplpath'] = '/Templates/' . ucfirst($TplSettings['config']['tplname']);
		$data['pagetitle'] = $TplSettings['config']['sitename'];
		$data['description'] = $TplSettings['config']['description'];
		$data['keywords'] = $TplSettings['config']['keywords'];
		echo \System\Application\Views\FrontView::render('/main.html', $data);
		echo 'About site page';
	}
}
?>