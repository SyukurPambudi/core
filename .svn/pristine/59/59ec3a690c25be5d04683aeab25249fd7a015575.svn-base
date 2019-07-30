<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Position extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}
	
	public function getAllPosition($paramArr) {
		$start = isset($paramArr['start'])?$paramArr['start']:NULL;
		$limit = isset($paramArr['limit'])?$paramArr['start']:NULL;
		$sortField = isset($paramArr['sortField'])?$paramArr['sortField']:'vDescription';
		$sortOrder = isset($paramArr['sortOrder'])?$paramArr['sortOrder']:'desc';
		$whereParam = isset($paramArr['whereParam'])?$paramArr['whereParam']:NULL;
		
		if(!empty($start) && !empty($limit)) $optLimit = "limit $start,$limit";
		else $optLimit = NULL;
		
		if(!empty($whereParam)) $whereParam = "and (".$whereParam.")";
		$whereClause = "where true ".$whereParam;
		$whereClause .= "and lDeleted = 0";
		
		$SQL = "SELECT iPostID, vDescription FROM default.position $whereClause order by $sortField $sortOrder $optLimit ";		
		$result = $this->db->query($SQL);
		if($result->num_rows() > 0) {
			$appList = $result->result();
			return $appList;
		} else {
			return null;
		}
	}
	
	public function getPositionById($id) {
		$SQL = "Select vDescription from default.position where iPostID = {$id}";
		$query = $this->db->query($SQL);
		$data = array();
	
		if ($query->num_rows > 0) {
			$row = $query->row();
			return $row->vDescription;
		} else {
			return '';
		}
	
		
	}
}