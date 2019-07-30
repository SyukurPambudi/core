<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Position extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}
	
	public function getPositionById($id) {
		$dbset = $this->load->database('hrd', true);
		$SQL = "Select vDescription from position where iPostID = {$id}";
		$query = $dbset->query($SQL);
		$data = array();
	
		if ($query->num_rows > 0) {
			$row = $query->row();
			return $row->vDescription;
		} else {
			return '';
		}
	}
	
	public function getAllPositions() {
		$dbset = $this->load->database('hrd', true);
		$result  = array();
		$SQL = "SELECT a.iPostId AS id, 
				CONCAT_WS(' - ', b.vDescription, a.vDescription) 
				AS `name` FROM position a, 
				groupdept b WHERE a.igrpdeptid = b.igrpdeptid 
				AND a.lDeleted = 0 ORDER BY b.igrpdeptid, a.vDescription";
		$query = $dbset->query($SQL);
		$data = array();
	
		if ($query->num_rows > 0) {
			$result = $query->result_array();
		}
	
		return $result;
	}
}