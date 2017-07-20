<?php 
namespace Controllers;

use Codeframe\Controller;

class BaseController extends Controller {

	function pageNotFound(){
		return $this->template->build($this->theme, $this->makeView(), $this->html404());
	}
}
