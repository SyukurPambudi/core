<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Processor extends MX_Controller {
	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->load->helper('url');
		$url = uri_string();
		$page = _url_module($url); //MY_url_helper extends dari system/helper/url_helper
		
		
		$x = Modules::run( $page );
		if($x) {
			echo $x;
		} else {
			echo '<p>Error 404 page not found/no output.<br/><font color="red">'.$page.'</font></p>';
		}
		
	}
}
?>