<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_GroupDept extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}
	
	function getGroupDeptById($id) {
		$SQL = "SELECT vDescription from hrd.groupdept where igrpdeptid = '{$id}' and lDeleted = 0";
		$query = $this->db->query($SQL);
	
		if ($query->num_rows > 0) {
			$row = $query->row();
			return $row->vDescription;
		} else {
			return '';
		}
	}
	
	public function getAllGroups() {
		$SQL = "Select igrpdeptid as id, vDescription as name from hrd.groupdept order by vDescription asc";
		$query = $this->db->query($SQL);
		$data = array();
	
		if ($query->num_rows > 0) {
			$result = $query->result_array();
		}
	
		return $result;
	}
	
	public function getGroupDeptById2($id) {
		$data = array('0'=>'Tidak', '1'=>'Ya');
	
		return $data[$id];
	}
	
}