<?php
namespace System\Application\Controllers;
use System\Application\Controllers\News;
use System\Application\Models\Pagination;

class News extends \System\Core\Controller
{
	public $DefaultAction = 'index';
	
	public function index()
	{
		$TplSettings = $this->config;
		$data['tplpath'] = '/Templates/' . ucfirst($TplSettings['config']['tplname']);
		$data['pagetitle'] = 'Новости сайта - ' . $TplSettings['config']['sitename'];
		$data['description'] = $TplSettings['config']['description'];
		$data['keywords'] = $TplSettings['config']['keywords'];
		
		$getNews = new \System\Application\Models\News;
		$currPage = 1;
		$pagination = new \System\Application\Models\Pagination($currPage, 10, $getNews->countNews());
		$data['pagination'] = $pagination->listPages;
		$data['currpage'] = $pagination->currentPage;
		$data['firstpage'] = $pagination->firstPage;
		$data['lastpage'] = $pagination->lastPage;
		$data['news'] = $getNews->getNews($pagination);
		if (!empty($data['news'])) {
			foreach ($data['news'] as $newsKey => $newsVal) {
				$data['news'][$newsKey]['title'] = trim(mb_strimwidth($newsVal['title'], 0, 70, "..."));
				$data['news'][$newsKey]['create_at'] = date('d-m-Y H:i', $newsVal['create_at']);
			}
		}
		
		$data['breadcrumb'][0] = ['url' => '/', 'urlname' => 'Главная'];
		$data['breadcrumb'][1] = ['url' => '/news/', 'urlname' => 'Новости'];
		echo \System\Application\Views\FrontView::render('/news_main.html', $data);
	}
	
	// News single page
	public function post()
	{
		$getNew = new \System\Application\Models\News;
		$data['new'] = $getNew->getPost($this->route['alias']);
		$data['new']['title'] = trim(mb_strimwidth($data['new']['title'], 0, 70, "..."));
		$data['new']['tags'] = isset($data['new']['tags']) ? explode(',', $data['new']['tags']) : '';
		$data['new']['create_at'] = isset($data['new']['create_at']) ? date('d-m-Y H:i', $data['new']['create_at']) : '';
		$TplSettings = $this->config;
		$data['tplpath'] = '/Templates/' . ucfirst($TplSettings['config']['tplname']);
		$data['pagetitle'] = $data['new']['title'] . ' - Новости TrueWeb.Dev';
		$data['description'] = !empty($data['new']['description']) ? $data['new']['description'] : $TplSettings['config']['description'];
		$data['keywords'] = !empty($data['new']['keywords']) ? $data['new']['keywords'] : $TplSettings['config']['keywords'];
		$data['breadcrumb'][0] = ['url' => '/', 'urlname' => 'Главная'];
		$data['breadcrumb'][1] = ['url' => '/news/', 'urlname' => 'Новости'];
		$data['breadcrumb'][2] = ['url' => '/news/', 'urlname' => $data['new']['title']];
		echo \System\Application\Views\FrontView::render('/news_post.html', $data);
	}
	
	public function page()
	{
		$TplSettings = $this->config;
		$data['tplpath'] = '/Templates/' . ucfirst($TplSettings['config']['tplname']);
		$data['pagetitle'] = 'Новости сайта - ' . $TplSettings['config']['sitename'];
		$data['description'] = $TplSettings['config']['description'];
		$data['keywords'] = $TplSettings['config']['keywords'];
		
		$getNews = new \System\Application\Models\News;
		$currPage = !empty($this->route['alias']) ? (int)$this->route['alias'] : 1;
		$pagination = new \System\Application\Models\Pagination($currPage, 10, $getNews->countNews());
		$data['pagination'] = $pagination->listPages;
		$data['currpage'] = $pagination->currentPage;
		$data['firstpage'] = $pagination->firstPage;
		$data['lastpage'] = $pagination->lastPage;
		$data['news'] = $getNews->getNews($pagination);
		if (!empty($data['news'])) {
			foreach ($data['news'] as $newsKey => $newsVal) {
				$data['news'][$newsKey]['title'] = trim(mb_strimwidth($newsVal['title'], 0, 70, "..."));
				$data['news'][$newsKey]['create_at'] = date('d-m-Y H:i', $newsVal['create_at']);
			}
		}
		
		$data['breadcrumb'][0] = ['url' => '/', 'urlname' => 'Главная'];
		$data['breadcrumb'][1] = ['url' => '/news/', 'urlname' => 'Новости'];
		echo \System\Application\Views\FrontView::render('/news_main.html', $data);
	}
	
	// 
	public function categories()
	{
		//print_r($this->route['alias']);
	}
}
?>