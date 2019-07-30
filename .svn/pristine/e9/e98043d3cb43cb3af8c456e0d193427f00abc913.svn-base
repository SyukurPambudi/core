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
		
		$result = $this->m_infomodule->getInfoModule($moduleId);
		if($result) {
			$sess_auth->gModul 	= $result['idprivi_modules'];
			$data['info']=$result['idprivi_modules'].'/'.$result['vPathModule'];
			
			$url = explode("/", $result['vPathModule']);
			
			//$sess_auth->gUrl = $url[0]."/".$url[1]."_".$url[2];
			$this->load->view('v_infomodule',$data);
		}
	}
}
?>