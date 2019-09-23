<?php
try {
	// Debug mode functions
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	
	// System directories
	define ( 'ROOT_DIR', realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR) ); // get string real path: realpath(ROOT_DIR)
	define ( 'CORE_DIR', ROOT_DIR . DIRECTORY_SEPARATOR . 'System' );
	define ( 'CONFIG_DIR', CORE_DIR . DIRECTORY_SEPARATOR . 'Config' );
	define ( 'APP_DIR', CORE_DIR . DIRECTORY_SEPARATOR . 'Application' );
	define ( 'TPL_PATH', ROOT_DIR . DIRECTORY_SEPARATOR . 'Templates' );
	
	// Autoloading system
	require_once CORE_DIR . DIRECTORY_SEPARATOR . 'Core' . DIRECTORY_SEPARATOR . 'Psr4AutoloaderClass.php';
	$SysAutoLoader = new \System\Core\Psr4AutoloaderClass;
	$SysAutoLoader->addNamespace('System', CORE_DIR);
	$SysAutoLoader->addNamespace('Twig', APP_DIR . DIRECTORY_SEPARATOR . 'Libraries' . DIRECTORY_SEPARATOR . 'Twig');
	$SysAutoLoader->register();
	//throw new Exception("Какое-нибудь сообщение об ошибке", 123);
} catch (Exception $e) {
    echo $e->getMessage();
	//include ROOT_DIR . '/Templates/Default/index.html';
	
}
?>