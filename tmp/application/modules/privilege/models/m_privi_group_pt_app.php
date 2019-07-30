<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_privi_group_pt_app extends CI_Model{
	
	function __construct(){
		parent::__construct();
		
	}	
	
	public function getAllApplication() {
		$SQL = "SELECT a.iID_GroupApp, a.idprivi_apps, a.idprivi_group, a.vNamaGroup FROM privi_group_pt_app a where a.lDeleted = 0";
		$query = $this->db->query($SQL);
		$data = array();
	
		if ($query->num_rows > 0) {
			$result = $query->result_array();
		}
	
		return $result;
	}
	
	public function getApplicationById($id) {
		$SQL = "Select vAppName from privi_apps where idprivi_apps = {$id}";
		$query = $this->db->query($SQL);
		$data = array();
	
		if ($query->num_rows > 0) {
			$row = $query->row();
		}
	
		return $row->vAppName;
	}
	
	public function getGroupPTApp($id) {
		$SQL = "Select iID_GroupApp, vNamaGroup from privi_group_pt_app where idprivi_apps = {$id} and lDeleted = 0";
		$query = $this->db->query($SQL);
		$data = array();
		
		if ($query->num_rows > 0) {
			$result = $query->result_array();
		} else {$result = null;}
		
		return $result;
	}
}