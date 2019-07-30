<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_infomodule extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}
	function getInfoModule($moduleId) {
		$sql = "SELECT idprivi_modules, vCodeModule, vNameModule, vPathModule FROM privi_modules
				WHERE lDeleted = 0 AND idprivi_modules = '{$moduleId}' LIMIT 1";
		$query = $this->db->query($sql);
		if($query->num_rows() >0) {
			return $query->row_array();
		} else {
			return false;
		}
		
	}
}