<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Change_password extends MX_Controller{
	
	public function __construct(){
		parent::__construct();
		
		$this->load->library('Zend','Zend/Session/Namespace');
	}
	
	public function index(){
		 
	}
	
	public function output(){
		$this->load->view("v_change_password");		
	}
	
	function action(){
		$this->load->model('m_change_password');
		$sess_auth = new Zend_Session_Namespace('auth');
	 	
		$old_pass = $_POST['old_pass'];
		$new_pass = $_POST['new_pass'];
		$update_password = $this->m_change_password->updatePassword($sess_auth->gNIP, $old_pass, $new_pass);
	}
	
	
}