<?php 

class App extends Codeframe\App {

	static function bootstrap($app_root = null){

		parent::bootstrap(__DIR__ . '/config');
	
	}
}