<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_EduLevel extends CI_Model{
	
	private $hrd;
	function __construct(){
		parent::__construct();
		
	}
	public function update( $data='', $where='' ) {
		$dbx = $this->load->database('hrd', true);
		$dbx->where( $where );
		if(TRUE===$dbx->update( 'employee', $data ))
			return TRUE;
		else return 0;
	}
	
	public function getAllEduLevel() {
		$SQL = "Select iedulvlid as id, vedulvlname as name, 
				case 
					when lformal = 0 then 'Tidak'
					else 'Ya'
				end as lformal from hrd.edulevel where lDeleted = 0";
		$query = $this->db->query($SQL);
		$data = array();
	
		if ($query->num_rows > 0) {
			$result = $query->result_array();
		}
	
		return $result;
	}
	
	public function getNameById($edulvlId) {
		$SQL = "SELECT vDescription as name from hrd.religion where iReligionID = '{$edulvlId}'";
		$query = $this->db->query($SQL);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$name = $row->name;			
		} else {
			$name = '';
		}
		
		return $name;
	}
	
	public function getStatusById($id) {
		$data = array(0=>'Tidak', 1=>'Ya');
		
		return $data[$id];
	}
}