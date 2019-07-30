<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Infomodule extends MX_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('Zend','Zend/Session/Namespace');
	}
	function index() {
		$sess_auth = new Zend_Session_Namespace('auth');
		
		$this->load->model('m_infomodule');
		$moduleId = $this->input->post('moduleId');
		$reset_   = $this->input->post('reset_');
		
		//tambahan
		$hostname = $this->get_client_ip();//gethostname();
		$nip = $sess_auth->gNIP;
		
		$result = $this->m_infomodule->getInfoModule($moduleId);
		
		if ($reset_ != '') {
			//die("woiiii");
			//tambahan
			$this->m_infomodule->saveInfoModule($result['vPathModule'], $nip, $hostname, 1);
			//tambahan
		} else {
			//echo $moduleId;
			//print_r($result);		
			if($result) {
				$sess_auth->gModul 	= $result['idprivi_modules'];
				$data['info']=$result['idprivi_modules'].'/'.$result['vPathModule'];
				
				//tambahan				
				$this->m_infomodule->saveInfoModule($result['vPathModule'], $nip, $hostname);
				//tambahan
				
				$url = explode("/", $result['vPathModule']);
				
				//$sess_auth->gUrl = $url[0]."/".$url[1]."_".$url[2];
				$this->load->view('v_infomodule',$data);
			}
		}
	}
	
	function get_client_ip() {
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
}
?>