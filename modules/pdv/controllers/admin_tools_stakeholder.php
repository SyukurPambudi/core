<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_tools_stakeholder extends MX_Controller {
    function __construct() {
        parent::__construct();
		$this->load->library('auth');
    }
    function index($action = '') {
    	$action = $this->input->get('action');
    	//Bikin Object Baru Nama nya $grid		
		$grid = new Grid;
		$grid->setTitle('Stakeholder');		
		$grid->setTable('packdev.pd_team');		
		$grid->setUrl('admin_tools_stakeholder');
		$grid->addList('vteam','vnip','cDeptId','iStatus');
		$grid->setSortBy('vteam');
		$grid->setSortOrder('asc'); //sort ordernya
		$grid->setWidth('vnip', '100'); // width nya
		$grid->addFields('vteam','vnip','cDeptId','iStatus','team');
		$grid->setLabel('vnip', 'Manager'); //Ganti Label
		$grid->setLabel('vteam','Nama Team');
		$grid->setLabel('cDeptId','Departemen');
		$grid->setLabel('iStatus','Status');
		$grid->setSearch('vteam','vnip','cDeptId','iStatus');
		$grid->setRequired('vteam','vnip','cDeptId','iStatus');	//Field yg mandatori
		$grid->setQuery('ldeleted', 0);
		$grid->setDeletedKey('ldeleted');
		
		$grid->changeFieldType('iStatus','combobox','',array(''=>'Pilih',1=>'Aktif',0=>'Tidak aktif'));
		
		//Set View Gridnya (Default = grid)
		$grid->setGridView('grid');
		
		switch ($action) {
			case 'json':
				$grid->getJsonData();
				break;			
			case 'create':
				$grid->render_form();
				break;
			case 'createproses':
				echo $grid->saved_form();
				break;
			case 'update':
				$grid->render_form($this->input->get('id'));
				break;
			case 'view':
				$grid->render_form($this->input->get('id'),TRUE);
				break;
			case 'updateproses':
				echo $grid->updated_form();
				break;
			case 'employee_list':
				$this->employee_list();
			default:
				$grid->render_grid();
				break;
		}
    }

	function searchBox_admin_tools_stakeholder_vteam($name, $id) {
		return '<input id="'.$id.'" type="text" />';
	}

	function insertCheck_admin_tools_stakeholder_vteam($value, $field, $rows) {
		$this->db->where('vteam', $value);
		$j = $this->db->count_all_results('packdev.pd_team');
		if($j > 0) {
			return 'Nama Team '.$value.' sudah ada yg insert!';
		} 
		else {
			return TRUE;
		}
	}

	function insertBox_admin_tools_stakeholder_team($field, $id) {
		return $this->load->view('admin_tools_stakeholder_team_struktur_member','',TRUE);
	}
	
	function updateBox_admin_tools_stakeholder_team($field, $id, $value, $rowData) {
		$rowId = $rowData['iteam_id'];
		$this->db->select(array('packdev.pd_team_item.*', 'hrd.employee.vName'), false);
		$this->db->where(array('iteam_id' => $rowId, 'packdev.pd_team_item.ldeleted' => 0));
		$this->db->order_by('packdev.pd_team_item.iteami_id', 'ASC');
		$this->db->join('hrd.employee', 'packdev.pd_team_item.vnip = hrd.employee.cNip', 'inner');
		$data['member'] = $this->db->get('packdev.pd_team_item')->result_array();
		//echo $this->db->last_query();
		
		return $this->load->view('admin_tools_stakeholder_team_struktur_member',$data,TRUE); 
	}
	
	function insertBox_admin_tools_stakeholder_cDeptId($field, $id) {
		$this->load->config('pdv_config');
		$conf_dept = $this->config->item('pdv_dept');
		$return = '<select name="'.$id.'" id="'.$id.'">';
		$return .= '<option value="">--select--</option>';
		foreach($conf_dept as $d) {
			$return .= '<option value="'.$d.'">'.$d.'</option>';
		}
		$return .= '</select>';
		return $return;
	}
	
	function updateBox_admin_tools_stakeholder_cDeptId($field, $id, $value) {
		$this->load->config('pdv_config');
		$conf_dept = $this->config->item('pdv_dept');
		$return = '<select name="'.$id.'" id="'.$id.'">';
		$return .= '<option value="">--select--</option>';
		foreach($conf_dept as $d) {
			$selected = $value == $d ? 'selected' : '';
			$return .= '<option '.$selected.' value="'.$d.'">'.$d.'</option>';
		}
		$return .= '</select>';
		return $return;
	}
	
	function searchBox_admin_tools_stakeholder_cDeptId($field, $id) {
		$this->load->config('pdv_config');
		$conf_dept = $this->config->item('pdv_dept');
		$return = '<select name="'.$id.'" id="'.$id.'">';
		$return .= '<option value="">--select--</option>';
		foreach($conf_dept as $d) {
			$return .= '<option value="'.$d.'">'.$d.'</option>';
		}
		$return .= '</select>';
		return $return;
	}
	
	function before_insert_processor($row, $postData) {
		$user = $this->auth->user();
		unset($postData['nip']);
		unset($postData['name']);
		unset($postData['team']);
		$postData['cnip'] = $user->gNIP;
		$postData['tupdate'] = date('Y-m-d H:i:s');
		return $postData;
	}
	
	function after_insert_processor ($row, $insertId, $postData) {
		$user = $this->auth->user();
		$nip = $postData['nip'];
		foreach($nip as $k => $v) {
			$this->db->insert('packdev.pd_team_item', array('iteam_id'=>$insertId,'vnip'=>$v,'ccreated'=>$user->gNIP,'tcreated'=>date('Y-m-d H:i:s')));
		}
		return TRUE;
	}
	
	function before_update_processor($row, $postData) {
		$user = $this->auth->user();
		unset($postData['nip']);
		unset($postData['name']);
		unset($postData['team']);
		$postData['cupdate'] = $user->gNIP;
		$postData['tupdate'] = date('Y-m-d H:i:s');
		return $postData;
	}
	
	function after_update_processor ($row, $updateId, $postData) {
		$user = $this->auth->user();
		$nip = $postData['nip'];
		//$level = $postData['iLevel'];
		$this->db->where('iteam_id', $updateId);
		if($this->db->update('packdev.pd_team_item', array('ldeleted'=>1,'cupdated'=>$user->gNIP,'tupdated'=>date('Y-m-d H:i:s')))) {
			foreach($nip as $k => $v) {
				$this->db->insert('packdev.pd_team_item', array('iteam_id'=>$updateId,'vnip'=>$v,'ccreated'=>$user->gNIP,'tcreated'=>date('Y-m-d H:i:s')));
			}
		}
		return TRUE;
	}

	function employee_list() {
		$term = $this->input->get('term');
		$return_arr = array();
		$this->db->like('cNip',$term);
		$this->db->or_like('vName',$term);
		$this->db->limit(50);
		$lines = $this->db->get('hrd.employee')->result_array();
		//$sql="SELECT * FROM hrd.employee WHERE  `cNip`  LIKE '%N12%' OR  `vName`  LIKE '%N12%'";
		//echo $this->db->last_query();
		//print_r($lines);
		$i=0;
		foreach($lines as $line) {
			$row_array["value"] = trim($line["vName"]).' - '.trim($line["cNip"]);
			$row_array["id"] = trim($line["cNip"]);
			array_push($return_arr, $row_array);
		}
		echo json_encode($return_arr);exit();
	}
	
    function output(){
    	$this->index($this->input->get('action'));
    }
}