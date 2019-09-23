<?php
namespace System\Application\Controllers;
use System\Application\Controllers\Admin;

class Admin extends \System\Core\Controller
{
	public $DefaultAction = 'index';
	
	public function index()
	{
		echo \System\Application\Views\FrontView::render('/admin/main.html', $Data = ['test' => 'Welcome']);
		//print_r($this->route['alias']);
	}
	
	public function charts()
	{
		echo \System\Application\Views\FrontView::render('/admin/charts.html', $Data = ['test' => 'Welcome']);
		//print_r($this->route['alias']);
	}
	
	public function tables()
	{
		echo \System\Application\Views\FrontView::render('/admin/tables.html', $Data = ['test' => 'Welcome']);
		//print_r($this->route['alias']);
	}
	
	public function addArticle()
	{
		$TplSettings = $this->config;
		$data['tplpath'] = '/Templates/' . ucfirst($TplSettings['config']['tplname']);
		$data['pagetitle'] = 'Добавление статьи';
		$data['description'] = $TplSettings['config']['description'];
		$data['keywords'] = $TplSettings['config']['keywords'];
		
		if (\System\Core\HttpRequests::post('sendArticle') !== false) {
			$add['title'] = \System\Core\HttpRequests::post('articleTitle') !== false ? \System\Core\HttpRequests::post('articleTitle') : 'Заголовок не указан';
			$add['category_id'] = \System\Core\HttpRequests::post('articleCategory') !== false ? intval(\System\Core\HttpRequests::post('articleCategory')) : 0;
			$add['preview'] = \System\Core\HttpRequests::post('articleContent') !== false ? mb_strimwidth(\System\Core\HttpRequests::post('articleContent'), 0, 1000, "...") : 'Заголовок не указан';
			$add['content'] = \System\Core\HttpRequests::post('articleContent') !== false ? \System\Core\HttpRequests::post('articleContent') : '';
			$add['tags'] = \System\Core\HttpRequests::post('articleTags') !== false ? \System\Core\HttpRequests::post('articleTags') : $TplSettings['config']['keywords'];
			$add['description'] = \System\Core\HttpRequests::post('articleDescription') !== false ? \System\Core\HttpRequests::post('articleDescription') : $TplSettings['config']['description'];
			$add['keywords'] = \System\Core\HttpRequests::post('articleKeywords') !== false ? \System\Core\HttpRequests::post('articleKeywords') : $TplSettings['config']['keywords'];
			$add['uri'] = \System\Core\HttpRequests::post('articleUri') !== false ? \System\Core\HttpRequests::post('articleUri') : '';
			$add['user_id'] = 1;
			$add['create_at'] = strtotime((new \DateTime('now'))->format('Y-m-d H:i:s'));
			$createArticle = new \System\Application\Models\Articles;
			$createArticle->createArticle($add);
		}
		
		echo \System\Application\Views\FrontView::render('/admin/add_article.html', $data);
	}
	
	public function addNews()
	{
		$TplSettings = $this->config;
		$data['tplpath'] = '/Templates/' . ucfirst($TplSettings['config']['tplname']);
		$data['pagetitle'] = 'Добавление новости';
		$data['description'] = $TplSettings['config']['description'];
		$data['keywords'] = $TplSettings['config']['keywords'];
		
		if (\System\Core\HttpRequests::post('sendNews') !== false) {
			$add['title'] = \System\Core\HttpRequests::post('newsTitle') !== false ? \System\Core\HttpRequests::post('newsTitle') : 'Заголовок не указан';
			$add['category_id'] = \System\Core\HttpRequests::post('newsCategory') !== false ? intval(\System\Core\HttpRequests::post('newsCategory')) : 0;
			$add['preview'] = \System\Core\HttpRequests::post('newsContent') !== false ? mb_strimwidth(\System\Core\HttpRequests::post('newsContent'), 0, 1000, "...") : 'Заголовок не указан';
			$add['content'] = \System\Core\HttpRequests::post('newsContent') !== false ? \System\Core\HttpRequests::post('newsContent') : '';
			$add['tags'] = \System\Core\HttpRequests::post('newsTags') !== false ? \System\Core\HttpRequests::post('newsTags') : $TplSettings['config']['keywords'];
			$add['description'] = \System\Core\HttpRequests::post('newsDescription') !== false ? \System\Core\HttpRequests::post('newsDescription') : $TplSettings['config']['description'];
			$add['keywords'] = \System\Core\HttpRequests::post('newsKeywords') !== false ? \System\Core\HttpRequests::post('newsKeywords') : $TplSettings['config']['keywords'];
			$add['uri'] = \System\Core\HttpRequests::post('newsUri') !== false ? \System\Core\HttpRequests::post('newsUri') : '';
			$add['user_id'] = 1;
			$add['create_at'] = strtotime((new \DateTime('now'))->format('Y-m-d H:i:s'));
			$createNew = new \System\Application\Models\News;
			$createNew->createNew($add);
		}
		
		echo \System\Application\Views\FrontView::render('/admin/add_news.html', $data);
	}
	
	public function addPage()
	{
		$TplSettings = $this->config;
		$data['tplpath'] = '/Templates/' . ucfirst($TplSettings['config']['tplname']);
		$data['pagetitle'] = 'Добавление статической страницы';
		$data['description'] = $TplSettings['config']['description'];
		$data['keywords'] = $TplSettings['config']['keywords'];
		
		if (\System\Core\HttpRequests::post('sendPage') !== false) {
			$add['title'] = \System\Core\HttpRequests::post('pagesTitle') !== false ? \System\Core\HttpRequests::post('pagesTitle') : 'Заголовок не указан';
			//$add['category_id'] = \System\Core\HttpRequests::post('pagesCategory') !== false ? intval(\System\Core\HttpRequests::post('newsCategory')) : 0;
			$add['content'] = \System\Core\HttpRequests::post('pagesContent') !== false ? \System\Core\HttpRequests::post('pagesContent') : '';
			//$add['tags'] = \System\Core\HttpRequests::post('pagesTags') !== false ? \System\Core\HttpRequests::post('newsTags') : $TplSettings['config']['keywords'];
			$add['description'] = \System\Core\HttpRequests::post('pagesDescription') !== false ? \System\Core\HttpRequests::post('pagesDescription') : $TplSettings['config']['description'];
			$add['keywords'] = \System\Core\HttpRequests::post('pagesKeywords') !== false ? \System\Core\HttpRequests::post('pagesKeywords') : $TplSettings['config']['keywords'];
			$add['uri'] = \System\Core\HttpRequests::post('pagesUri') !== false ? \System\Core\HttpRequests::post('pagesUri') : '';
			//$add['user_id'] = 1;
			$add['create_at'] = strtotime((new \DateTime('now'))->format('Y-m-d H:i:s'));
			$createPage = new \System\Application\Models\StaticPages;
			$idPage = $createPage->createPage($add);
			$uriPage =  $idPage . '-' . \System\Core\HttpRequests::post('pagesUri');
			$update['uri'] = $uriPage;
			$params['id'] = $idPage;
			$updatePage = $createPage->updatePage($update, $params);
		}
		
		echo \System\Application\Views\FrontView::render('/admin/add_page.html', $data);
	}
}
?>