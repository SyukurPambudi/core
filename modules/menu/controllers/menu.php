<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MX_Controller {
	var $sess_auth;
	public function __construct() {
		parent::__construct();
		$this->load->library('Zend','Zend/Session/Namespace');
		$this->sess_auth = new Zend_Session_Namespace('auth');
	}
	
	function index() {
		$lang = isset($_POST['lang']) ? $_POST['lang'] : $this->sess_auth->lang ;
		$this->sess_auth->lang = $lang;
		$this->lang->load('display', $this->sess_auth->lang);
		
		$this->load->model('m_menu');
		$menu 		 = array();
		$draw_menu 	 = array();
		
		$get_URL	 = explode('/', $_SERVER['REQUEST_URI']);
		$id_PT		 = $get_URL[sizeOf($get_URL) - 1];
		 
		if (!empty($id_PT)){
			$menu = $this->m_menu->getAppmenu($this->sess_auth->gNIP, $id_PT);
		}else{
			$menu = $this->m_menu->getAppmenu($this->sess_auth->gNIP, $this->sess_auth->gComId);
		}
		
		if (sizeOf($menu) > 0) {
			foreach($menu as $key=>$val) {
				$draw_menu[] = array('menu'=>$val);
			}
		}
		
		$data['arrmenu'] = $draw_menu;
		$this->load->view('v_menu', $data);
	}
	
	function getMenuByApp() {
		$this->load->model('m_menu');
		$sess_auth 	= new Zend_Session_Namespace('auth');
		
		$ajaxMode 	= $this->input->post('ajaxMode');
		$appId 		= $this->input->post('iAppId');
		$nip 		= $this->input->post('nip');
		$pt 		= $this->input->post('ptId');
		$group 		= $this->input->post('group');
		
		$sess_auth->gApps= $appId;
		
		//variable $menu must be defined before the function call
		$renderMenu = $this->m_menu->getAppMenuModules($nip, $pt, $appId, 0, $group);
		
		$menu = '
			<script language="text/javascript">
				$(document).ready(function() {
					var appId = "'.$appId.'";								
					$("#browser_"+appId).treeview({
						collapsed: true
					});
				})
				
			</script>
		';
		$menu .= '<ul id="browser_'.$appId.'" class="filetree tree-app">'."\n";
			if (!empty($renderMenu)){
				$menu .= $renderMenu;
			}else{
				$menu .="<span class='padding-5 ui-state-highlight'>empty</span>";
			}
		$menu .= '</ul>';
		echo $menu;
	}
	
}
?>