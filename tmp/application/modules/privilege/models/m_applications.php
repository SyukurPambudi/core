<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Applications extends CI_Model{
	
	function __construct(){
		parent::__construct();
		
	}
	public function getAllApplicationxx() {
		$SQL = "Select idprivi_apps, vAppName from privi_apps where lDeleted = 0";
		$query = $this->db->query($SQL);
		$data = array();
		
		if ($query->num_rows > 0) {
			$result = $query->result_array();
			foreach($result as $row) {
				$data[$row['idprivi_apps']] = $row['vAppName'];
			}			
		}
		
		return $data;
	}
	
	public function getAllApplication() {
		$SQL = "Select idprivi_apps as id, vAppName as name from privi_apps where lDeleted = 0";
		$query = $this->db->query($SQL);
		$data = array();
	
		if ($query->num_rows > 0) {
			$result = $query->result_array();
		}
	
		return $result;
	}
	
	public function getApplicationById($id) {
		$SQL = "Select vAppName from erp_privi.privi_apps where idprivi_apps = {$id}";
		$query = $this->db->query($SQL);
		$data = array();
	
		if ($query->num_rows > 0) {
			$row = $query->row();
			$x = $row->vAppName;
		} else {
			$x = '';
		}
	
		return $x;
	}
	
	public function getGroupPTApp($id) {
		$SQL = "Select a.iCompanyId, (select vCompName from company where iCompanyId = a.iCompanyId) as vCompName, 
				a.iID_GroupApp, a.idprivi_group, a.vNamaGroup from erp_privi.privi_group_pt_app a 
				where a.idprivi_apps = {$id} and a.lDeleted = 0";
		$query = $this->db->query($SQL);
		$data = array();
		
		if ($query->num_rows > 0) {
			$result = $query->result_array();
		} else {$result = null;}
		
		return $result;
	}
	
	public function getApplicationDT() {
		$this->load->library('datatables');
		$pk_id = 'idprivi_apps,vAppName';
	
		$this->datatables->select('idprivi_apps, vAppName');
		$this->datatables->from('privi_apps');
		$this->datatables->where('lDeleted = 0');
		//$this->datatables->add_column('action', '<a href ="#" onclick="PilihRecord(\'$1\');">Edit</a> | <a href ="#" onclick="deleteRecord(\'$1\');">Delete</a>', 'idprivi_apps');
		$this->datatables->add_column('action', '<input type="radio" name="pilih" id="pilih" onclick="PilihRecord(\'$1|$2\', 1);">', $pk_id);
	
		return $this->datatables->generate();
	}
}