<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends MX_Controller {
	public function __construct() {
		parent::__construct();		
		$this->load->library('MySession');
		$this->mysession->sess_check();
	}
	
	public function index() {
		$is_logged 	= Modules::run('login/is_logged');
		
		if( $is_logged ) {
			$get_URL	= explode('/', $_SERVER['REQUEST_URI']);
			$id_PT		= $get_URL[sizeOf($get_URL) - 1];
			
			$sess_auth  = new Zend_Session_Namespace('auth');
			$NIP 		= $sess_auth->gNIP;
			$NAME 		= $sess_auth->gName;
			$ComId 		= $sess_auth->gComId;
			$ComName 	= $sess_auth->gComName;
            $DIVID      = $sess_auth->gDivId;
            $DIV        = $sess_auth->gDiv;
            $DEPTID     = $sess_auth->gDeptId;
            $DEPT       = $sess_auth->gDept;
			
			$data = array('NIPUser' => $NIP,
						  'NameUser' => $NAME,
						  'ComId' => $ComId, 
						  'ComName' => $ComName,
                          'DivId' => $DIVID,
                          'DivName' => $DIV,
                          'DeptId' => $DEPTID,
                          'DeptName' => $DEPT,
						  'LogOut' => 'login/signout'
					);
			
			switch($id_PT){
				case 5:
					$this->mytemplate->setPathTpl( 'templates/orange' );
					break;
					
				default:
					$this->mytemplate->setPathTpl( 'templates/default' );
					break;	
			}
			
			$this->mytemplate->setPathTpl( 'templates/default' );
			$this->mytemplate->setContent( 'home/v_home', $data);
			$this->mytemplate->display();
			
		} else {
			echo Modules::run('login');
		}
	
	}
	
	public function timetest() {
		$time = strtotime('0000-00-00 00:00:00');
		if( $time == NULL ) echo 'NULL';
		
		$defaultNamespace = new Zend_Session_Namespace('Default');
		
		if(isset($defaultNamespace->username)) {
			echo 'Username = '.$defaultNamespace->username;
		}
		if(isset($defaultNamespace->password)) {
			echo 'Password = '.$defaultNamespace->password;
		}
	}
	
	public function zendtest() {
		 
		$defaultNamespace = new Zend_Session_Namespace('Default');
		
		if(!isset($defaultNamespace->username)) {
			$defaultNamespace->username = 'User Testing';
		} 
		
		if(!isset($defaultNamespace->password)) {
			$defaultNamespace->password = 'User Password';
		}
	}
}
?>