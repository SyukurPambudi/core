<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_tools_business_type extends MX_Controller {
    function __construct() {
        parent::__construct();
    }
    function index($action = '') {
    	//Bikin Object Baru Nama nya $grid		
		$grid = new Grid;		
		$grid->setTitle('Business Process Type');		
		$grid->setTable('packdev.pd_biz_process_type');		
		$grid->setUrl('admin_tools_business_type');
		$grid->addList('vName');
		$grid->setSortBy('vName');
		$grid->setSortOrder('ASC'); //sort ordernya
		$grid->addFields('vName','tCreatedAt','bussiness_step','cCreatedBy','tUpdatedAt','cUpdatedBy');
		$grid->setLabel('vName', 'Type Name'); //Ganti Label
		$grid->setLabel('bussiness_step','Business Step');
		$grid->setSearch('vName');
		$grid->setRequired('vName');	//Field yg mandatori
		$grid->changeFieldType('tCreatedAt','hidden');
		$grid->changeFieldType('cCreatedBy','hidden');
		$grid->changeFieldType('tUpdatedAt','hidden');
		$grid->changeFieldType('cUpdatedBy','hidden');
		// $grid->changeFieldType('isDynamic','combobox','',array('' => '--Pilih--', 0=>'No',1=>"Yes"));
		$grid->setQuery('isDeleted', 0);
		$grid->setDeletedKey('isDeleted');
		
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
			case 'delete':
				echo $grid->delete_row();
				break;
			default:
				$grid->render_grid();
				break;
		}
    }
	function insertBox_admin_tools_business_type_bussiness_step($field, $id) {
		$this->db->where('isDeleted', 0);
		$this->db->order_by('idpd_biz_has_steps', 'ASC');
		$steps = $this->db->get('packdev.pd_biz_has_steps')->result_array();
		foreach($steps as $s) {
			$st[] = array('idpd_biz_has_steps'=>$s['idpd_biz_has_steps'],'vStepName'=>$s['vStepName'],'selected'=>'');
		}
		$data['steps'] = $st;
		return $this->load->view('admin_tools_business_type/step_proses',$data,TRUE);
	}
	function updateBox_admin_tools_business_type_bussiness_step($field, $id, $value, $rowData) {
		$rowId = $rowData['idpd_biz_process_type'];
		$this->db->where(array('isDeleted'=>0, 'idpd_biz_process_type'=>$rowId));
		$this->db->order_by('iUrutan', 'ASC');
		$proses = $this->db->get('packdev.pd_biz_process')->result_array();
		
		$this->db->where('isDeleted', 0);
		$this->db->order_by('idpd_biz_has_steps', 'ASC');
		$steps = $this->db->get('packdev.pd_biz_has_steps')->result_array();
		
		foreach($steps as $s) {
			$step[$s['idpd_biz_has_steps']] = $s['vStepName'];
		}
		$st = array();
		foreach($proses as $pro) {
			if(array_key_exists($pro['idpd_biz_has_steps'], $step)) {
				$st[$pro['idpd_biz_has_steps']] = array('idpd_biz_has_steps'=>$pro['idpd_biz_has_steps'],'vStepName'=>$step[$pro['idpd_biz_has_steps']],'selected'=>'selected');
			}
		}
		foreach($step as $s => $v) {
			if(!array_key_exists($s, $st)) {
				$st[$s] = array('idpd_biz_has_steps'=>$s,'vStepName'=>$v,'selected'=>'');
			}
		}
		//echo '<pre>';print_r($st);echo '</pre>';
		$data['steps'] = $st;
		return $this->load->view('admin_tools_business_type/step_proses',$data,TRUE);
	}
	
	function after_insert_processor ($row, $insertId, $postData) {
		$steps = $postData['steps'];
		$i=1;
		foreach($steps as $v) {
			$this->db->insert('packdev.pd_biz_process', array('idpd_biz_process_type'=>$insertId,'idpd_biz_has_steps'=>$v,'iUrutan'=>$i,'tCreatedAt'=>date('Y-m-d H:i:s'), 'cCreatedBy'=>$this->sess_auth->get_nip()));
			$i++;
		}
		return TRUE;
	}

	function after_update_processor ($row, $updateId, $postData, $old_data) {
		$this->db->where('idpd_biz_process_type', $updateId);
		$bis = $this->db->get('packdev.pd_biz_process')->result_array();
		$bp = array();
		foreach($bis as $b) {
			$bp[$b['idpd_biz_has_steps']] = $b;
		}		
		$steps = $postData['steps'];
		//print_r($postData);
		$i = 1;
		foreach($steps as $k => $v) {
			if(array_key_exists($v, $bp)) {
				$this->db->where('idpd_biz_process', $bp[$v]['idpd_biz_process']);
				if($this->db->update('packdev.pd_biz_process', array('iUrutan'=>$i, 'isDeleted'=>0, 'tUpdatedAt'=>date('Y-m-d H:i:s'), 'cUpdatedBy'=>$this->sess_auth->get_nip()))) {}
			}
			else {
				$this->db->insert('packdev.pd_biz_process', array('idpd_biz_process_type'=>$updateId,'idpd_biz_has_steps'=>$v, 'iUrutan'=>$i,'tCreatedAt'=>date('Y-m-d H:i:s'), 'cCreatedBy'=>$this->sess_auth->get_nip(), 'tUpdatedAt'=>date('Y-m-d H:i:s'), 'cUpdatedBy'=>$this->sess_auth->get_nip()));
			}
			$i++;
		}
		//print_r($bp);
		//print_r($steps);
		//yg ada di kiri itu yg isDeleted=1
		foreach($bp as $k => $v) {
			if(!in_array($k, $steps)) {
				$this->db->where('idpd_biz_process', $v['idpd_biz_process']);
				$this->db->update('packdev.pd_biz_process', array('isDeleted'=>1, 'tUpdatedAt'=>date('Y-m-d H:i:s'), 'cUpdatedBy'=>$this->sess_auth->get_nip()));
			}
		}
		return TRUE;
	}
	function output(){
    	$this->index($this->input->get('action'));
    }
}