<?php
namespace System\Application\Models;
use System\Application\Models\News;
use System\Application\Models\Pagination;

class News extends \System\Core\Model
{
	public static function getPost($postId)
	{
		$LoadConfig = new \System\Core\Configurator;
		$settings = $LoadConfig->getConfig();
		if (!empty($postId)) {
			if ($settings['news']['url_type'] == 'id') {
				$params[$settings['news']['url_type']] = intval($postId);
			} elseif ($settings['news']['url_type'] == 'uri') {
				$params[$settings['news']['url_type']] = $postId;
			} else {
				return false;
			}
			$result = \System\Application\Models\PgSql::getRow('public.fw_news', '*', $params);
			return $result[0];
		} else {
			return false;
		}
	}
	
	public static function getNews($pagination)
	{
		$LoadConfig = new \System\Core\Configurator;
		$settings = $LoadConfig->getConfig();
		//$pagination = new \System\Application\Models\Pagination();
		$result = \System\Application\Models\PgSql::getAllRows('public.fw_news', $order = '1 DESC', $limit = $pagination->perPage, $offset = $pagination->getStart());
		if (!empty($result)) {
			return $result[0];
		} else {
			return false;
		}
	}
	
	public static function createNew($add)
	{
		$LoadConfig = new \System\Core\Configurator;
		$settings = $LoadConfig->getConfig();
		if (!empty($add)) {
			
			$result = \System\Application\Models\PgSql::insert('public.fw_news', $add);
			if ($result !== false) {
				return true;
			} else {
				return false;
			}
		}
	}
	
	public static function countNews()
	{
		$LoadConfig = new \System\Core\Configurator;
		$settings = $LoadConfig->getConfig();
		$result = \System\Application\Models\PgSql::countRows("public.fw_news");
		
		if (!empty($result)) {
			return $result[0];
		} else {
			return false;
		}
	}
}
?>