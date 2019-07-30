<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Jenis_Service extends CI_Model{
	
	function __construct(){
		parent::__construct();
		
	}
	
	public function getAllService() {
		$dbset = $this->load->database('hrd', true);
		
		$SQL = "Select id as id, cNama as name from ga_msservis where lDeleted = 0";
		$query = $dbset->query($SQL);
		$data = array();
	
		if ($query->num_rows > 0) {
			$result = $query->result_array();
		}
	
		return $result;
	}
	
	public function getServiceById($id) {
		$dbset = $this->load->database('hrd', true);
		
		$SQL = "Select cNama from ga_msservis where id = {$id}";
		$query = $dbset->query($SQL);
		$data = array();
	
		if ($query->num_rows > 0) {
			$row = $query->row();
			$x = $row->cNama;
		} else {
			$x = '';
		}
	
		return $x;
	}
	
	public function getJenisById($id) {
		$data = array('S'=>'Service', 'P'=>'Part Kendaraan', 'N'=>'Non Part Kendaraan');
		
		return $data[$id];
	}
}