<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Position extends CI_Model {
	
	private $dbset;
	private $_ci;
	function __construct() {
		parent::__construct();		
		$this->_ci=&get_instance();
		
		$this->_ci->load->helper('callback');
		
	}
	
	function getAllPosition() {
		$dbset = $this->load->database('hrd', true);
		
		$SQL = "SELECT * FROM position WHERE lDeleted = 0";
		
		$query = $dbset->query($SQL);
		
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		} else {
			$result = false;
		}
		
		return $result;
	}
	function getPostById($iDeptId='') {
		if($iDeptId=='') return false;
		
		$dbset = $this->load->database('hrd', true);
		
		$SQL = "SELECT iPostId, vDescription FROM position WHERE lDeleted=0 AND iPostId = '".$iDeptId."' LIMIT 1";
		
		$query = $dbset->query($SQL);
		
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		} else {
			$result = false;
		}
		
		return $result;
	}
}