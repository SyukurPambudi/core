<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Division extends CI_Model {
	
	private $dbset;
	private $_ci;
	function __construct() {
		parent::__construct();		
		$this->_ci=&get_instance();
		
		$this->_ci->load->helper('callback');
		
	}
	
	function getAllDiv() {
		$dbset = $this->load->database('hrd', true);
		
		$SQL = "SELECT * FROM msdivision WHERE lDeleted = 0 ORDER BY vDescription";
		
		$query = $dbset->query($SQL);
		
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		} else {
			$result = false;
		}
		
		return $result;
	}
	function getDivById($iDivID='') {
		if($iDivID=='') return false;
		
		$dbset = $this->load->database('hrd', true);
		
		$SQL = "SELECT iDivID, vAbbreviation as vInitial, vDescription FROM msdivision WHERE lDeleted=0 AND iDivID = '".$iDivID."' LIMIT 1";
		
		$query = $dbset->query($SQL);
		
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		} else {
			$result = false;
		}
		
		return $result;
	}
}