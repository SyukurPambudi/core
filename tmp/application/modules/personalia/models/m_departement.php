<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Departement extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}	
	
	public function getDivisionById($id) {
		$dbset = $this->load->database('hrd', true);
		$SQL = "Select vDescription from division where iDivID = {$id}";
		$query = $dbset->query($SQL);
		$data = array();
	
		if ($query->num_rows > 0) {
			$row = $query->row();
			return $row->vDescription;
		} else {
			return '';
		}
	}
	
	public function getAllDivisions() {
		$dbset = $this->load->database('hrd', true);
		$SQL = "Select iDivId as id, vDescription as name from division where lDeleted = 0 order by vDescription asc";
		$query = $dbset->query($SQL);
		$data = array();
	
		if ($query->num_rows > 0) {
			$result = $query->result_array();
		}
	
		return $result;
	}
}