<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_tools_business_process_sub extends MX_Controller {
    function __construct() {
        parent::__construct();
    }
    function index($action = '') {
    	$grid = new Grid;		
		$grid->setTitle('Business Process Sub');		
		$grid->setTable('packdev.pd_biz_process_sub');		
		$grid->setUrl('admin_tools_business_process_sub');
		$grid->addList('idpd_biz_process','idpd_activity','iteam_id');
		$grid->setSortBy('idpd_biz_process');
		$grid->setSortOrder('ASC');
		$grid->setWidth('iSLA', '75');
		$grid->setWidth('idpd_div2_structure', '100');
		$grid->addFields('idpd_biz_process','idpd_activity','iteam_id','vModule');
		$grid->setLabel('iteam_id','Stakeholder Stucture');
		$grid->setLabel('idpd_activity','Activity');
		$grid->setLabel('vModule','Module');
		$grid->setLabel('idpd_biz_process','Bussiness Proccess');
		$grid->setSearch('idpd_biz_process','idpd_activity','iteam_id');
		$grid->setRequired('idpd_biz_process','idpd_activity','iteam_id');
		$grid->setRelation('idpd_activity', 'packdev.pd_activity', 'idpd_activity', 'vActivityName');
		$grid->setRelation('iteam_id', 'packdev.pd_team', 'iteam_id', 'vteam','divStruktur');
		$grid->setRelation('vModule', 'erp_privi.privi_modules', 'idprivi_modules', 'vNameModule','','left','idprivi_apps=5');
		$grid->changeFieldType('tCreatedAt','hidden');
		$grid->changeFieldType('cCreatedBy','hidden');
		$grid->changeFieldType('tUpdatedAt','hidden');
		$grid->changeFieldType('cUpdatedBy','hidden');
		
		$grid->searchOperand('idpd_biz_process', 'eq');
		
		$grid->setQuery('pd_biz_process_sub.lDeleted', 0);		
		
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
			case 'delete':
				echo $grid->delete_row();
				break;
			case 'view':
				$grid->render_form($this->input->get('id'),TRUE);
				break;
			case 'updateproses':
				echo $grid->updated_form();
				break;
			default:
				$grid->render_grid();
				break;
		}
    }
	function get_action() {
		$id = $this->input->post('sub_id');
		$this->db->where('idpd_biz_process_sub', $id);
		$acs = $this->db->get('pd_biz_process_sub')->row_array();
		$act_id = $acs['idpd_activity'];
		
		$this->db->where('idpd_activity', $act_id);
		$stats = $this->db->get('packdev_status')->result_array();
		$echo = '<select class="" name="action[]">';
		$echo .= '<option value="">-- None --</option>';
		foreach($stats as $s) {
			$echo .= '<option value="'.$s['idpd_status'].'">'.$s['vCaption'].'</option>';
		}
		$echo .= '</select>';
		$response['status'] = TRUE;
		echo json_encode($response);
		$response['source'] = $echo;
	}
	function listBox_admin_tools_business_process_sub_idpd_biz_process($value, $id, $column, $row) {
		//return $value;
		$sql = "SELECT b.idpd_biz_process, t.vName, s.vStepName FROM packdev.pd_biz_process b
				INNER JOIN packdev.pd_biz_process_type t ON b.idpd_biz_process_type=t.idpd_biz_process_type
				INNER JOIN packdev.pd_biz_has_steps s ON b.idpd_biz_has_steps=s.idpd_biz_has_steps
				WHERE s.isDeleted = 0 AND b.idpd_biz_process = '".$value."'
				";
		$row = $this->db->query($sql)->row_array();
		return $row['vName'].' > '.$row['vStepName'].' ('.$value.')';
	}
	function searchBox_admin_tools_business_process_sub_idpd_biz_process($fields, $id) {
		$sql = "SELECT b.idpd_biz_process, t.vName, s.vStepName FROM packdev.pd_biz_process b
				INNER JOIN packdev.pd_biz_process_type t ON b.idpd_biz_process_type=t.idpd_biz_process_type
				INNER JOIN packdev.pd_biz_has_steps s ON b.idpd_biz_has_steps=s.idpd_biz_has_steps
				WHERE s.isDeleted = 0 ORDER BY b.idpd_biz_process_type ASC, b.iUrutan ASC
				";
		$rows = $this->db->query($sql)->result_array();
		$echo = '<select class="combobox" id="'.$id.'">';
		$echo .= '<option value="">-- None --</option>';
		foreach($rows as $r) {
			$echo .= '<option value="'.$r['idpd_biz_process'].'">'.$r['vName'].' > '.$r['vStepName'].'('.$r['idpd_biz_process'].')</option>';
		}
		$echo .= '</select>';
		//return $this->db->last_query();
		return $echo;
	}
	
	function insertBox_admin_tools_business_process_sub_idpd_biz_process($field, $id) {
		$sql = "SELECT b.idpd_biz_process, t.vName, s.vStepName FROM packdev.pd_biz_process b
				LEFT JOIN packdev.pd_biz_process_type t ON b.idpd_biz_process_type=t.idpd_biz_process_type
				LEFT JOIN packdev.pd_biz_has_steps s ON b.idpd_biz_has_steps=s.idpd_biz_has_steps
				WHERE s.isDeleted = 0 ORDER BY b.idpd_biz_process_type ASC, b.iUrutan ASC
				";
		$rows = $this->db->query($sql)->result_array();
		$echo = '<select class="combobox" name="'.$id.'" id="'.$id.'">';
		$echo .= '<option value="">-- None --</option>';
		foreach($rows as $r) {
			$echo .= '<option value="'.$r['idpd_biz_process'].'">'.$r['vName'].' > '.$r['vStepName'].'</option>';
		}
		$echo .= '</select>';
		//return $this->db->last_query();
		return $echo;
	}
	function updateBox_admin_tools_business_process_sub_idpd_biz_process($field, $id, $value, $rowData) {
		$sql = "SELECT b.idpd_biz_process, t.vName, s.vStepName FROM packdev.pd_biz_process b
				LEFT JOIN packdev.pd_biz_process_type t ON b.idpd_biz_process_type=t.idpd_biz_process_type
				LEFT JOIN packdev.pd_biz_has_steps s ON b.idpd_biz_has_steps=s.idpd_biz_has_steps
				WHERE b.isDeleted = 0 ORDER BY b.idpd_biz_process_type ASC, b.iUrutan ASC
				";
		$rows = $this->db->query($sql)->result_array();
		$echo = '<select class="combobox" name="'.$id.'" id="'.$id.'">';
		$echo .= '<option value="">-- None --</option>';
		foreach($rows as $r) {
			$selected = $r['idpd_biz_process'] == $value ? 'selected' : '';
			$echo .= '<option '.$selected.' value="'.$r['idpd_biz_process'].'">'.$r['vName'].' > '.$r['vStepName'].'</option>';
		}
		$echo .= '</select>';
		//return $this->db->last_query();
		return $echo;
	}
	function output(){
    	$this->index($this->input->get('action'));
    }
}