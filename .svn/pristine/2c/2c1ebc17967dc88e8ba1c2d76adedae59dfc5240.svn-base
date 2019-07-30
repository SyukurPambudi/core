<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_infomodule extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}
	function getInfoModule($moduleId) {
		$sql = "SELECT idprivi_modules, vCodeModule, vNameModule, vPathModule FROM privi_modules
				WHERE isDeleted = 0 AND idprivi_modules = '{$moduleId}' LIMIT 1";
		$query = $this->db->query($sql);
		if($query->num_rows() >0) {
			return $query->row_array();
		} else {
			return false;
		}
		
	}
	
	function getIdActiLog($module, $nip, $hostname, $today) {		
		$sql = "SELECT id from privi_actilog where date_format(tStart, '%Y-%m-%d') = '".$today."' and  
				cNip = '".$nip."' and cIp = '".$hostname."' and cModule='".$module."' 
				and tEnd IS NULL";
		$query = $this->db->query($sql);
		if($query->num_rows() >0) {
			$row = $query->row();
			$id = $row->id;
		} else {
			$id = 0;
		}
		
		return $id;
	}
	
	function saveInfoModule($module, $nip, $hostname, $tEnd=NULL) {
		$today = date('Y-m-d H:i:s', mktime());
		$today1 = date('Y-m-d', mktime());
		$idActiLog = $this->getIdActiLog($module, $nip, $hostname, $today1);
		
		if ($idActiLog == 0) {
			$sql = "INSERT INTO privi_actilog (tStart, cNip, cModule, iCounter, cIp) values 
					('".$today."', '".$nip."', '".$module."', 1, '".$hostname."')";
		} else {
			if ($tEnd != NULL) {
				$sql = "UPDATE privi_actilog set tEnd='".$today."'	WHERE id = '".$idActiLog."'";
			} else {
				$sql = "UPDATE privi_actilog set tStart='".$today."', iCounter = iCounter + 1 
						WHERE id = '".$idActiLog."'";
			}
		}
		$this->db->query($sql);
	}
}