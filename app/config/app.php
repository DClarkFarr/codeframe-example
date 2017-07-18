<?php 

return [
	
	'environment' => 'development', //or production

	'debug' => 1, // or 0

	'router' => array(
		'default_name' => 'default',
	),
	'cache' => array(
		'path' => realpath(__DIR__ . '/../') . '/storage/cache/',
	),
	'paths' => array(
		'root' => coalesce(ifGlobal('APP_PATHS_ROOT'), $_SERVER['DOCUMENT_ROOT']),
		'application' => coalesce(ifGlobal('APP_PATHS_APPLICATION'), realpath(__DIR__ . '/../')),
		'routes' => coalesce(ifGlobal('APP_PATHS_ROUTES'), realpath(__DIR__ . '/../routes')),
		'controllers' => coalesce(ifGlobal('APP_PATHS_CONTROLLERS'), realpath(__DIR__ . '/../Controllers')),
		'models' => realpath( __DIR__ . '/../Models'),
		'services' => realpath( __DIR__ . '/../Services'),
		'utils' => realpath( __DIR__ . '/../Utils'),
		'templates' => realpath(__DIR__ . '/../templates'),
		'views' => realpath(__DIR__ . '/../views'),
	),
];