<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class change_profile0 extends MX_Controller{
	private $sess_auth;
	private $dbset;
	
	public function __construct(){
		parent::__construct();
		
		$this->load->library('Zend','Zend/Session/Namespace'); 
    $this->load->library('MyInput');
    $this->url 				= 'Change_profile';
		$this->sess_auth 	= new Zend_Session_Namespace('auth'); 

	}
	
	public function index(){
		 
	}
	
	public function output(){
		$sess_auth = new Zend_Session_Namespace('auth');
		$this->load->model('m_change_profile0');
		$data_emp = $this->m_change_profile0->getEmployeeProfile($sess_auth->gNIP);
		$data_emp['MyURI'] = $this->url ;
		$this->load->view("v_change_profile", $data_emp);		
	}
	
	function action(){
		$post = $this->input->post();
		$sess_auth = new Zend_Session_Namespace('auth');
		$this->load->model('m_change_profile0');
		$update_password = $this->m_change_profile0->updateProfile($sess_auth->gNIP, $post);
	}
	
	
}