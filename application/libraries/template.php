<?php
class Template {
    protected $_ci;
    var $sess_auth;
    function __construct() {
        $this->_ci=&get_instance();
        $this->_ci->load->library('Zend', 'Zend/Session/Namespace');
        $this->sess_auth = new Zend_Session_Namespace('auth');
       
        //echo 'NIP : '.$this->sess_auth->gNIP;
    }
    function display($template='home', $data=null) {    	
		//Set Theme
    	$theme = 'default';
		//Set Variabel
		$data['base_url'] = base_url();
		$data['_theme']=base_url().'application/views/themes/'.$theme.'/';
		
		//$this->_ci->load->library('acl',array('userID'=>$this->_ci->session->userdata('userID')));
		$this->_ci->load->library('acl',array('userID'=>$this->sess_auth->gNip));		
		$acl_test = $this->_ci->uri->segment(1).'-';
		$acl_test .= ($this->_ci->uri->segment(2) == "" || $this->_ci->uri->segment(2) == "index") ? '' : $this->_ci->uri->segment(2);
		
		$parm=explode('-', $acl_test);
		$parm2 = $parm[1] != '' ? $parm[1] : 'view';		
		
		if ($this->sess_auth->logged) {
			if(!$this->_ci->acl->hasPermission($parm[0],$parm2)) {
				//$this->_ci->session->userdata('userID');
				$data['_content'] = $this->_ci->load->view('themes/'.$theme.'/template/forbiden_menu',$data,TRUE);
			}
			else {
				$this->_ci->session->userdata('userID');
				//echo $this->_ci->acl->hasPermission($acl_test);
				$data['_content'] = $this->_ci->load->view('themes/'.$theme.'/content/'.$template,$data,TRUE);
			}		
			
	    	if($this->_ci->input->is_ajax_request()) {
				$this->_ci->load->view('themes/'.$theme.'/content/'.$template,$data);
			}
			else {
				$this->_ci->load->view('themes/'.$theme.'/template',$data);
			}
		} else {
				//$data['_meta_login_css']  = $this->_ci->load->view('themes/'.$theme.'/template/login_css',$data,TRUE);
				//$data['_meta_login_js']  = $this->_ci->load->view('themes/'.$theme.'/template/login_js',$data,TRUE);
				//$this->_ci->load->view('themes/'.$theme.'/template/login',$data);
				echo Modules::run('login');
		}
    }
}
/*
 * End of Template Class
 * Location application/libraries
 * */