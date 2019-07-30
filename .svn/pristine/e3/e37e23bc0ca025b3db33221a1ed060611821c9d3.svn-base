<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Propinsi extends CI_Model{
	
	private $hrd;
	private $dbset;
	function __construct(){
		parent::__construct();
		$this->dbset = $this->load->database('hrd', true);
		
	}
	public function update( $data='', $where='' ) {
		$this->dbset->where( $where );
		if(TRUE===$this->dbset->update( 'employee', $data ))
			return TRUE;
		else return 0;
	}
	
	public function getAllPropinsi() {
		$SQL = "Select iProvId as id, vProvName as name from provinsi where lDeleted = 0";
		$query = $this->dbset->query($SQL);
		$data = array();
	
		if ($query->num_rows > 0) {
			$result = $query->result_array();
		}
	
		return $result;
	}
	
	public function getNameById($religionId) {
		$SQL = "SELECT vProvName as name from provinsi where iProvId = '{$religionId}'";
		$query = $this->dbset->query($SQL);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$name = $row->name;			
		} else {
			$name = '';
		}
		
		return $name;
	}
}