<?php
// Including Framework Core
require_once __DIR__ . DIRECTORY_SEPARATOR . 'System' . DIRECTORY_SEPARATOR . 'Bootstrap.php';

// Application Routers
// Specified routes
System\Core\Router::addRoute('^admin/?(?P<action>[a-z-]+)?$', ['controller' => 'admin']);
System\Core\Router::addRoute('^news/?(?P<action>[a-z-]+)?$', ['controller' => 'news']);
System\Core\Router::addRoute('^articles/?(?P<action>[a-z-]+)?$', ['controller' => 'articles']);
//System\Core\Router::addRoute('^pages/?(?P<action>[a-z-]+)?$', ['controller' => 'user']); // action page style
//System\Core\Router::addRoute('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller' => 'user']);
//System\Core\Router::addRoute('^page/(?P<alias>[a-z-]+)$', ['controller' => 'user', 'action' => 'index']); // static pages style
// General routes
System\Core\Router::addRoute('^$', ['controller' => 'main', 'action' => 'index']);
System\Core\Router::addRoute('^(?P<action>[a-z-]+)$', ['controller' => 'main']); // \d+
//System\Core\Router::addRoute('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?/?(?P<alias>[\d+]+)?$');
//System\Core\Router::addRoute('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?/?(?P<alias>[a-z-]+)?$');
System\Core\Router::addRoute('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?/?(?P<alias>[a-z-\d+_]+)?$');
System\Core\Router::addRoute('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');
System\Core\Router::run();

// Debug functions
//print_r(get_declared_classes());
//print_r(System\Core\Router::getRoutes());
//print_r(System\Core\Router::getRoute()); /[а-яёА-ЯЁ]+/u
?>