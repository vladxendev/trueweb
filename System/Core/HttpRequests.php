<?php
namespace System\Core;
use System\Core\HttpRequests;

class HttpRequests extends \System\Core\Singleton
{
	public static function get($queryKey = null)
	{
		$query = filter_input(INPUT_GET, $queryKey, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		if (!empty($query)) {
			return $query;
		} else {
			return false;
		}
	}
	
	public static function post($queryKey = null)
	{
		$query = filter_input(INPUT_POST, $queryKey, FILTER_SANITIZE_STRING);
		if (!empty($query)) {
			return $query;
		} else {
			return false;
		}
	}
	
	public static function session($queryKey = null)
	{
		$query = filter_var($_SESSION[$queryKey], FILTER_SANITIZE_STRING);
		if (!empty($query)) {
			return $query;
		} else {
			return false;
		}
	}
	
	public static function cookie($queryKey = null)
	{
		$query = filter_input(INPUT_COOKIE, $queryKey, FILTER_SANITIZE_STRING);
		if (!empty($query)) {
			return $query;
		} else {
			return false;
		}
	}
}
?>