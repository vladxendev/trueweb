<?php
namespace System\Application\Models;
use System\Application\Models\StaticPages;

class StaticPages extends \System\Core\Model
{
	public static function getPage($pageId)
	{
		$LoadConfig = new \System\Core\Configurator;
		$settings = $LoadConfig->getConfig();
		if (!empty($pageId)) {
			/*
			if ($settings['articles']['url_type'] == 'id') {
				$params[$settings['articles']['url_type']] = intval($postId);
			} elseif ($settings['articles']['url_type'] == 'uri') {
				$params[$settings['articles']['url_type']] = $postId;
			} else {
				return false;
			}
			*/
			$params['uri'] = $pageId;
			$result = \System\Application\Models\PgSql::getRow('public.fw_static_pages', '*', $params);
			return $result[0];
		} else {
			return false;
		}
	}
	
	public static function getPages()
	{
		$LoadConfig = new \System\Core\Configurator;
		$settings = $LoadConfig->getConfig();
		//$result = \System\Application\Models\PgSql::getAllRows('public.fw_static_pages');
		if (!empty($result)) {
			return $result[0];
		} else {
			return false;
		}
	}
	
	public static function createPage($add)
	{
		$LoadConfig = new \System\Core\Configurator;
		$settings = $LoadConfig->getConfig();
		if (!empty($add)) {
			
			$result = \System\Application\Models\PgSql::insertId('public.fw_static_pages', $add);
			if ($result !== false) {
				return $result;
			} else {
				return false;
			}
		}
	}
	
	public static function updatePage($update, $params)
	{
		$LoadConfig = new \System\Core\Configurator;
		$settings = $LoadConfig->getConfig();
		if (!empty($update) && !empty($params)) {
			
			$result = \System\Application\Models\PgSql::update('public.fw_static_pages', $update, $params);
			if ($result !== false) {
				return true;
			} else {
				return false;
			}
		}
	}
}
?>