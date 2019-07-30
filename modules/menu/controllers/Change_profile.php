<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Change_profile extends MX_Controller{
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
		$this->load->model('m_Change_profile');
		$data_emp = $this->m_Change_profile->getEmployeeProfile($sess_auth->gNIP);
		$data_emp['MyURI'] = $this->url ;
		$this->load->view("v_change_profile", $data_emp);		
	}
	
	function action(){
		$post = $this->input->post();
		$sess_auth = new Zend_Session_Namespace('auth');
		$this->load->model('m_Change_profile');
		$update_password = $this->m_Change_profile->updateProfile($sess_auth->gNIP, $post);
	}
	
	
}