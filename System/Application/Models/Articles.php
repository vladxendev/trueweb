<?php
namespace System\Application\Models;
use System\Application\Models\Articles;

class Articles extends \System\Core\Model
{
	public static function getPost($postId)
	{
		$LoadConfig = new \System\Core\Configurator;
		$settings = $LoadConfig->getConfig();
		if (!empty($postId)) {
			if ($settings['articles']['url_type'] == 'id') {
				$params[$settings['articles']['url_type']] = intval($postId);
			} elseif ($settings['articles']['url_type'] == 'uri') {
				$params[$settings['articles']['url_type']] = $postId;
			} else {
				return false;
			}
			$result = \System\Application\Models\PgSql::getRow('public.fw_articles', '*', $params);
			return $result[0];
		} else {
			return false;
		}
	}
	
	public static function getArticles($pagination)
	{
		$LoadConfig = new \System\Core\Configurator;
		$settings = $LoadConfig->getConfig();
		$result = \System\Application\Models\PgSql::getAllRows('public.fw_articles', $order = '1 DESC', $limit = $pagination->perPage, $offset = $pagination->getStart());
		if (!empty($result)) {
			return $result[0];
		} else {
			return false;
		}
	}
	
	public static function createArticle($add)
	{
		$LoadConfig = new \System\Core\Configurator;
		$settings = $LoadConfig->getConfig();
		if (!empty($add)) {
			
			$result = \System\Application\Models\PgSql::insert('public.fw_articles', $add);
			if ($result !== false) {
				return true;
			} else {
				return false;
			}
		}
	}
	
	public static function countArticles()
	{
		$LoadConfig = new \System\Core\Configurator;
		$settings = $LoadConfig->getConfig();
		$result = \System\Application\Models\PgSql::countRows("public.fw_articles");
		
		if (!empty($result)) {
			return $result[0];
		} else {
			return false;
		}
	}
}
?>