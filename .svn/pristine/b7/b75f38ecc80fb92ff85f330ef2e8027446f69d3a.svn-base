<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Worklocation extends CI_Model {
	
	private $dbset;
	private $_ci;
	function __construct() {
		parent::__construct();		
		$this->_ci=&get_instance();
		
		$this->_ci->load->helper('callback');
		
	}
	
	function getAllWorkLoc() {
		$dbset = $this->load->database('hrd', true);
		
		$SQL = "SELECT i_location_id, v_location_name FROM worklocation WHERE l_deleted = 0";
		
		$query = $dbset->query($SQL);
		
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		} else {
			$result = false;
		}
		
		return $result;
	}
}