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
		'models' => realpath( __DIR__ . '/../Models'),
		'services' => realpath( __DIR__ . '/../Services'),
		'utils' => realpath( __DIR__ . '/../Utils'),
		'routes' => coalesce(ifGlobal('APP_PATHS_ROUTES'), realpath(__DIR__ . '/../Http/routes')),
		'controllers' => coalesce(ifGlobal('APP_PATHS_CONTROLLERS'), realpath(__DIR__ . '/../Http/Controllers')),
		'templates' => realpath(__DIR__ . '/../Http/templates'),
		'views' => realpath(__DIR__ . '/../Http/views'),
	),
	'timezones' => array(
		'server_default' => 'UTC',
	),
];