<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Module extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}
	
	public function getAllApplications($paramArr) {
		$start = isset($paramArr['start'])?$paramArr['start']:NULL;
		$limit = isset($paramArr['limit'])?$paramArr['start']:NULL;
		$sortField = isset($paramArr['sortField'])?$paramArr['sortField']:'vAppName';
		$sortOrder = isset($paramArr['sortOrder'])?$paramArr['sortOrder']:'desc';
		$whereParam = isset($paramArr['whereParam'])?$paramArr['whereParam']:NULL;
		
		if(!empty($start) && !empty($limit)) $optLimit = "limit $start,$limit";
		else $optLimit = NULL;
		
		if(!empty($whereParam)) $whereParam = "and (".$whereParam.")";
		$whereClause = "where true ".$whereParam;
		
		$SQL = "SELECT idprivi_apps, vAppCode, vAppName, txtDesc FROM privi_apps $whereClause order by $sortField $sortOrder $optLimit ";		
		$result = $this->db->query($SQL);
		if($result->num_rows() > 0) {
			$appList = $result->result();
			return $appList;
		} else {
			return null;
		}
	}
	
	public function getEmployeeName() {		
		$sql = "Select vName from default.employee where cNip = 'N06081'";
		$query = $this->db2->query($sql);
		if ($query->num_rows > 0) {
			$row = $query->row_array();
			return $row['vName'];
		}
	}
	public function getModules() {
		$sql = "SELECT idprivi_modules, vCodeModule FROM privi_modules LIMIT 10";
		
		$result = $this->db->query($sql);
		
		if($result->num_rows() >0) {
			return $result->result_array();
		} else {
			return false;
		}
	}
}