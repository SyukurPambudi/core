<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_PT extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}	
	
	public function getCompany() {
		$SQL = "SELECT iCompanyId, vCompName FROM privi_pt";
		$query = $this->db->query($SQL);
		
		if ($query->num_rows() > 0)
		{
		   $row = $query->result_array();		   
		   return $row;
		} 
	}
	
	public function getAllCompanys() {
		$SQL = "Select iCompanyId as id, vCompName as name from privi_pt";
		$query = $this->db->query($SQL);
		$data = array();
	
		if ($query->num_rows > 0) {
			$result = $query->result_array();
		}
	
		return $result;
	}
	
	public function getCompanyById($id) {
		$SQL = "Select vCompName from privi_pt where iCompanyid = {$id}";
		$query = $this->db->query($SQL);
		$data = array();
	
		if ($query->num_rows > 0) {
			$row = $query->row();
			return $row->vCompName;
		} else {
			return '';
		}
	
		
	}
}