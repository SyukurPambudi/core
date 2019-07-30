<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Departement extends CI_Model {
	
	private $dbset;
	private $_ci;
	function __construct() {
		parent::__construct();		
		$this->_ci=&get_instance();
		
		$this->_ci->load->helper('callback');
		
	}
	
	function getAllDept() {
		$dbset = $this->load->database('hrd', true);
		
		$SQL = "SELECT * FROM departement WHERE lDeleted = 0 ORDER BY vDescription";
		
		$query = $dbset->query($SQL);
		
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		} else {
			$result = false;
		}
		
		return $result;
	}
	function getDeptById($iDeptId='') {
		if($iDeptId=='') return false;
		
		$dbset = $this->load->database('hrd', true);
		
		$SQL = "SELECT iDeptId, vAbbreviation as vInitial, vDescription FROM departement WHERE lDeleted=0 AND iDeptId = '".$iDeptId."' LIMIT 1";
		
		$query = $dbset->query($SQL);
		
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		} else {
			$result = false;
		}
		
		return $result;
	}
}