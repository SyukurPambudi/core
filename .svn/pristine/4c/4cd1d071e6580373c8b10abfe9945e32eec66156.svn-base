<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller {
	private $idleTimeout = 7200; //expired login time 10 seconds
	public function __construct() {
		parent::__construct(); 
		$this->load->library('Zend','Zend/Session/Namespace');
		$this->load->library("jsonci");
		$this->load->library('MyTemplate');
		$this->load->library('MySession');
                $this->load->library('MyInput');
		$this->lang->load('display', 'english'); 
	}
	
	public function index() {
		if( $this->is_logged() ) {
			redirect('home');
		} else {
			$data['getCompany']=$this->getComp(false);//gak pake ngajax
			$this->mytemplate->setPathTpl( 'templates/login' );
			$this->mytemplate->setContent( 'login/v_login', $data );
			$this->mytemplate->display();
		}
	}
	public function modal() {
		$data['getCompany']=$this->getComp(false);//gak pake ngajax
		$this->load->view('login/v_login_ajax',$data);
	}
	
	public function is_logged() {
		$sess_auth = new Zend_Session_Namespace('auth');
		if(isset($sess_auth->sess_life)) { // ada session
			$session_life = time() - $sess_auth->sess_life; // calculate 
			if( $session_life > $this->idleTimeout ) { // waktu idle sudah lewat
				return FALSE;
			} else {
				$sess_auth->sess_life = time(); // perbarui time
				return TRUE;
			}
		} 
		
		return FALSE;
	}
	
	public function signin() {
		//$username = $this->security->xss_clean($this->input->post('username'));
		//$password = $this->security->xss_clean($this->input->post('password'));                
		//$company  = $this->security->xss_clean($this->input->post('company'));
            
            /*print_r($_POST);
            exit;*/
                $username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', FALSE);
		$company  = $this->input->post('company', TRUE);
		
		if(!empty($username) && !empty($password)) {
			$sess_auth = new Zend_Session_Namespace('auth');
			
			$this->load->model('m_login');
			$check	= $this->m_login->validate($username, $password, $company);
                        
                        //print_r($check);
			
			$ID	= $check['ID'];
			$NIP	= $check['C_NIP'];
			$NAME	= $check['V_NAME'];
			$COMP 	= $check['COMP'];
                        $DIVID  = $check['DIVID'];
                        $DIV    = $check['DIV']; 
                        $DEPTID = $check['DEPTID'];
                        $DEPT   = $check['DEPT'];
			$valid 	= $check['validated'];
			$group_access = $check['GROUP'];
			
			switch($valid){
				case 1 : 
					$sess_auth->gNIP 	= $NIP;
					$sess_auth->gName 	= ucwords(strtolower($NAME));
					$sess_auth->gComId 	= $company;
					$sess_auth->gComName    = $COMP;
                                        $sess_auth->gDivId      = $DIVID;
                                        $sess_auth->gDiv        = $DIV;
                                        $sess_auth->gDeptId     = $DEPTID;
                                        $sess_auth->gDept       = $DEPT;
					$sess_auth->logged 	= TRUE;
					$sess_auth->gAccess     = $group_access;
					$sess_auth->timestamp   = date('Y-m-d H:i:s');
					$sess_auth->sess_life   = time();
					$sess_auth->lang	= 'english';
					
					$this->mysession->sess_in_log();
					
					$data = array('stat'=>1, 'message'=>'Successfully.');
					$this->jsonci->sendJSONsuccess($username, $data);
					break;
				case 2 : //wrong password
					$data = array('stat'=>2, 'message'=>'Wrong password.');
					$this->jsonci->sendJSONfailure($username, $data);
					break;
				case 3 : //not registered
					$data = array('stat'=>3, 'message'=>'Not registered.');
					$this->jsonci->sendJSONfailure($username, $data);
					break;
				  
			}
			
		} else {
			$data['message'] = 'error';
			$data['form_url']=site_url('login/signin');
			$data['getCompany']=$this->getComp(false);//gak pake ngajax
			$this->load->view('v_login',$data);
			$result = '0';
		}
		  
	}
	
	public function signout() {
		$this->mysession->sess_out_log();
		
		Zend_Session::destroy();
		Zend_Session::regenerateId();
		header('Location: login');
		exit();
	}
	
	public function getComp($ajax=true){
		$storeComp = array();
		$this->load->model('m_login');
		$checkComp		= $this->m_login->getCompModel();
		
		if($ajax) {
			foreach($checkComp as $dt){
				$storeComp['comp'][] = array('name' => $dt['nameComp'], 'value' => $dt['idComp']);
			}
			$this->jsonci->sendJSONNormal($storeComp);	
		} else {
			$options='';
			foreach($checkComp as $dt) {
				$selected=($dt['idComp']==3)?'selected="selected"':'';
				$options.='<option value="'.$dt['idComp'].'" '.$selected.'>'.$dt['nameComp'].'</option>';
			}
			return $options;
		} 
	}
}
?>