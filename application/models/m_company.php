<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Company extends CI_Model {
	
	private $dbset;
	private $_ci;
	function __construct() {
		parent::__construct();		
		$this->_ci=&get_instance();
		
		$this->_ci->load->helper('callback');
		
	}
	
	function getAllCompany() {
		$dbset = $this->load->database('hrd', true);
		
		$SQL = "SELECT iCompanyId, vCompName FROM company WHERE lDeleted = 0";
		
		$query = $dbset->query($SQL);
		
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		} else {
			$result = false;
		}
		
		return $result;
	}
}