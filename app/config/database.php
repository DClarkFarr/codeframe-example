<?php

return [
	'default_connection' => 'mysql',
	'connections' => [
		'mysql' => [
				'host'      => 'localhost',
		    'database'  => 'nitro_db',
		    'username'  => 'fb_admin',
		    'password'  => 'fb4m3!',
				'unix_socket' => '/Applications/MAMP/tmp/mysql/mysql.sock',
		],
	],
	'migrations' => [
		'namespace' => 'Migrations',
		'directory' => __DIR__ . '/database/migrations',
		'file' => __DIR__ . '/database/registered_migrations.php',
	],
];
