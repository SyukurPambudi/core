<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Company extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}
	
	public function getAllCompany($paramArr) {
		$start = isset($paramArr['start'])?$paramArr['start']:NULL;
		$limit = isset($paramArr['limit'])?$paramArr['start']:NULL;
		$sortField = isset($paramArr['sortField'])?$paramArr['sortField']:'vCompName';
		$sortOrder = isset($paramArr['sortOrder'])?$paramArr['sortOrder']:'desc';
		$whereParam = isset($paramArr['whereParam'])?$paramArr['whereParam']:NULL;
		
		if(!empty($start) && !empty($limit)) $optLimit = "limit $start,$limit";
		else $optLimit = NULL;
		
		if(!empty($whereParam)) $whereParam = "and (".$whereParam.")";
		$whereClause = "where true ".$whereParam;
		//$whereClause .= "and lDeleted = 0";
		
		$SQL = "SELECT iCompanyId, vCompName FROM hrd.company $whereClause order by $sortField $sortOrder $optLimit ";		
		$result = $this->db->query($SQL);
		if($result->num_rows() > 0) {
			$appList = $result->result();
			return $appList;
		} else {
			return null;
		}
	}
	
	public function getCompany() {
		$SQL = "SELECT iCompanyId, vCompName FROM hrd.company order by vCompName asc";
		$query = $this->db->query($SQL);
		
		if ($query->num_rows() > 0)
		{
		   $row = $query->result_array();		   
		   return $row;
		} 
	}
	
	public function getAllCompanys() {
		$SQL = "Select iCompanyId as id, vCompName as name from hrd.company";
		$query = $this->db->query($SQL);
		$data = array();
	
		if ($query->num_rows > 0) {
			$result = $query->result_array();
		}
	
		return $result;
	}
	
	public function getCompanyById($id) {
		$SQL = "Select vCompName from hrd.company where iCompanyid = {$id}";
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