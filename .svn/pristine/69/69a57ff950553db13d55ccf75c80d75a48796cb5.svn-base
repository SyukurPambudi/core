<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_header extends MX_Controller {
	var $sess_auth;
	public function __construct() {
		parent::__construct();
		$this->load->library('Zend','Zend/Session/Namespace');
		$this->sess_auth = new Zend_Session_Namespace('auth');
	}
	
	function index() {		
		$this->load->model('m_menu_header');
		$menuComp		= array();
		$drawMenuComp 	= array();
		$g_nip			= $this->sess_auth->gNIP;
		$g_com_id		= $this->sess_auth->gComId;
		
		$get_URL		= explode('/', $_SERVER['REQUEST_URI']);
		$id_PT			= $get_URL[sizeOf($get_URL) - 1];
		
		if (!empty($id_PT)){$g_com_id = $id_PT;}
		
		$menuComp 		= $this->m_menu_header->getFirstMenuComp($g_nip, $g_com_id,  $this->sess_auth->gComId);
		 
		if (sizeOf($menuComp) > 0) {
			foreach($menuComp as $key => $val) {
				$drawMenuComp[] = array('menuComp'=>$val);
			}
		}
		
		$data['glob_id_pt']	  = $id_PT;
		$data['arrMenuComp']  = $drawMenuComp;
		$data['open_company'] = $this->m_menu_header->getOpenCompany($id_PT);
		$data['gNIP']=$g_nip;

		/*Tambahan Untuk Mengecek Jumlah Message UnRead*/
        $sql='select * from gps_msg.erp_inbox_details i where i.ldeleted=0 and i.istatus_read=0 and i.cnip like "%'.$g_nip.'%"';
		$data['count_inbox_erp']=$this->db->query($sql)->num_rows();
		
		$this->load->view('v_menu_header', $data);
	}
}
