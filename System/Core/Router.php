<?php
namespace System\Core;
use System\Core\Router;

class Router extends \System\Core\Singleton
{
	protected static $routes = [];
	protected static $route = [];
	protected static $rules = [];
	protected static $rule = [];
	
	public static function addRoute($regexp, $route = [])
	{
		self::$routes[$regexp] = $route;
	}
	
	public static function getRoute()
	{
		return self::$route;
	}
	
	public static function getRoutes()
	{
		return self::$routes;
	}
	
	public static function handle($url)
	{
		$url = self::getUriParse($url);
		
		foreach (self::$routes as $pattern => $route) {
			
			if (preg_match("#$pattern#i", $url, $matches)) {
				
				foreach ($matches as $RouteKey => $RouteVal) {
					
					if (is_string($RouteKey)) {
						$route[$RouteKey] = $RouteVal;
					}
				}
				
				if (!isset($route['action'])) {
					$route['action'] = 'index';
				}
				self::$route = $route;
				return true;
			}
		}
		return false;
	}
	
	public static function controllerParse($ControllerName)
	{
		return $ControllerName = str_ireplace(' ', '', ucwords(str_ireplace('-', ' ', $ControllerName)));
	}
	
	public static function getUriParse($UriParse)
	{
		if ($UriParse) {
			$params = explode('?', $UriParse, 2);
			if (strpos($params[0], '=') === false) {
				return rtrim($params[0], '/');
			} else {
				return '';
			}
			//print_r($params);
		}
	}
	
	public static function run()
	{
		if (self::handle(ltrim(rtrim($_SERVER['REQUEST_URI'], '/'), '/')) === true) {
			$Controller = '\System\Application\Controllers\\' . ucfirst(self::controllerParse(self::$route['controller']));
			if (class_exists($Controller)) {
				$ControllerObject = new $Controller(self::$route);
				$ControllerAction = lcfirst(self::controllerParse(self::$route['action']));
				
				if (method_exists($ControllerObject, $ControllerAction)) {
					if (isset(self::$route['alias'])) {
						$ControllerObject->$ControllerAction(self::$route['alias']);
					} else {
						$ControllerObject->$ControllerAction();
					}
				} else {
					$IndexAction = $ControllerObject->DefaultAction;
					if (isset(self::$route['alias'])) {
						$ControllerObject->$IndexAction(self::$route['alias']);
					} else {
						$ControllerObject->$IndexAction();
					}
				}
				
			} else {
				echo '404 Page not found';
				http_response_code(404);
			}
		} else {
			echo '404 Page not found';
			http_response_code(404);
		}
	}
}
?>