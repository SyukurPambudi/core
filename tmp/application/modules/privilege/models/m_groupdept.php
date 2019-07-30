<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_GroupDept extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}
	
	function getGroupDeptById($id) {
		$SQL = "SELECT vDescription from default.groupdept where igrpdeptid = '{$id}'";
		$query = $this->db->query($SQL);
	
		if ($query->num_rows > 0) {
			$row = $query->row();
			return $row->vDescription;
		} else {
			return '';
		}
	}
	
}