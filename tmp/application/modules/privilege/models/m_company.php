<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Company extends CI_Model{

	var $dbset;
	
	function __construct(){
		parent::__construct();
		$this->dbset = $this->load->database('hrd', true);
	}	
	
	public function getCompany() {
		$SQL = "SELECT iCompanyId, vCompName FROM privi_pt where lDeleted = 0";
		$query = $this->dbset->query($SQL);
		
		if ($query->num_rows() > 0)
		{
		   $row = $query->result_array();		   
		   return $row;
		} 
	}
	
	public function getAllCompanys() {
		$SQL = "Select iCompanyId as id, vCompName as name from company where lDeleted = 0";
		$query = $this->dbset->query($SQL);
		$data = array();
	
		if ($query->num_rows > 0) {
			$result = $query->result_array();
		}
	
		return $result;
	}
	
	public function getCompanyById($id) {
		$SQL = "Select vCompName from company where iCompanyid = {$id} AND lDeleted = 0";
		$query = $this->dbset->query($SQL);
		$data = array();
	
		if ($query->num_rows > 0) {
			$row = $query->row();
			return $row->vCompName;
		} else {
			return '';
		}
	
		
	}
}