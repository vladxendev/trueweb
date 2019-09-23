<?php
namespace System\Application\Controllers;
use System\Application\Controllers\Articles;

class Articles extends \System\Core\Controller
{
	public $DefaultAction = 'index';
	
	// Articles general page all categories
	public function index()
	{
		$TplSettings = $this->config;
		$data['tplpath'] = '/Templates/' . ucfirst($TplSettings['config']['tplname']);
		$data['pagetitle'] = 'Статьи - ' . $TplSettings['config']['sitename'];
		$data['description'] = $TplSettings['config']['description'];
		$data['keywords'] = $TplSettings['config']['keywords'];
		
		$getArticles = new \System\Application\Models\Articles;
		$currPage = 1;
		$pagination = new \System\Application\Models\Pagination($currPage, 10, $getArticles->countArticles());
		$data['pagination'] = $pagination->listPages;
		$data['currpage'] = $pagination->currentPage;
		$data['firstpage'] = $pagination->firstPage;
		$data['lastpage'] = $pagination->lastPage;
		$data['articles'] = $getArticles->getArticles($pagination);
		if (!empty($data['articles'])) {
			foreach ($data['articles'] as $articleKey => $articleVal) {
				$data['articles'][$articleKey]['title'] = trim(mb_strimwidth($articleVal['title'], 0, 70, "..."));
				$data['articles'][$articleKey]['create_at'] = date('d-m-Y H:i', $articleVal['create_at']);
			}
		}
		
		$data['breadcrumb'][0] = ['url' => '/', 'urlname' => 'Главная'];
		$data['breadcrumb'][1] = ['url' => '/articles/', 'urlname' => 'Статьи'];
		echo \System\Application\Views\FrontView::render('/articles_main.html', $data);
	}
	
	// Article single page
	public function post()
	{
		$getArticle = new \System\Application\Models\Articles;
		$data['article'] = $getArticle->getPost($this->route['alias']);
		$data['article']['title'] = trim(mb_strimwidth($data['article']['title'], 0, 70, "..."));
		$data['article']['tags'] = isset($data['article']['tags']) ? explode(',', $data['article']['tags']) : '';
		$data['article']['create_at'] = isset($data['article']['create_at']) ? date('d-m-Y H:i', $data['article']['create_at']) : '';
		$TplSettings = $this->config;
		$data['tplpath'] = '/Templates/' . ucfirst($TplSettings['config']['tplname']);
		$data['pagetitle'] = $data['article']['title'] . ' - Статьи TrueWeb.Dev';
		$data['description'] = !empty($data['article']['description']) ? $data['article']['description'] : $TplSettings['config']['description'];
		$data['keywords'] = !empty($data['article']['keywords']) ? $data['article']['keywords'] : $TplSettings['config']['keywords'];
		$data['breadcrumb'][0] = ['url' => '/', 'urlname' => 'Главная'];
		$data['breadcrumb'][1] = ['url' => '/articles/', 'urlname' => 'Статьи'];
		$data['breadcrumb'][2] = ['url' => '/articles/', 'urlname' => $data['article']['title']];
		echo \System\Application\Views\FrontView::render('/articles_post.html', $data);
	}
	
	public function page()
	{
		$TplSettings = $this->config;
		$data['tplpath'] = '/Templates/' . ucfirst($TplSettings['config']['tplname']);
		$data['pagetitle'] = 'Статьи - ' . $TplSettings['config']['sitename'];
		$data['description'] = $TplSettings['config']['description'];
		$data['keywords'] = $TplSettings['config']['keywords'];
		
		$getArticles = new \System\Application\Models\Articles;
		$currPage = !empty($this->route['alias']) ? (int)$this->route['alias'] : 1;
		$pagination = new \System\Application\Models\Pagination($currPage, 10, $getArticles->countArticles());
		$data['pagination'] = $pagination->listPages;
		$data['currpage'] = $pagination->currentPage;
		$data['firstpage'] = $pagination->firstPage;
		$data['lastpage'] = $pagination->lastPage;
		$data['articles'] = $getArticles->getArticles($pagination);
		if (!empty($data['articles'])) {
			foreach ($data['articles'] as $articleKey => $articleVal) {
				$data['articles'][$articleKey]['title'] = trim(mb_strimwidth($articleVal['title'], 0, 70, "..."));
				$data['articles'][$articleKey]['create_at'] = date('d-m-Y H:i', $articleVal['create_at']);
			}
		}
		
		$data['breadcrumb'][0] = ['url' => '/', 'urlname' => 'Главная'];
		$data['breadcrumb'][1] = ['url' => '/articles/', 'urlname' => 'Статьи'];
		echo \System\Application\Views\FrontView::render('/articles_main.html', $data);
	}
	
	// 
	public function categories()
	{
		//print_r($this->route['alias']);
	}
}
?>