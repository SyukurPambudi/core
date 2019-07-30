<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Division extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}
	
	public function getDepartementById($id) {
		$dbset = $this->load->database('hrd', true);
		$SQL = "Select concat_ws(' - ', iDeptId, vDescription) as vDescription from departement where iDeptID = {$id}";
		$query = $dbset->query($SQL);
		$data = array();
	
		if ($query->num_rows > 0) {
			$row = $query->row();
			return $row->vDescription;
		} else {
			return '';
		}
	}
	
	public function getAllDepartements() {
		$dbset = $this->load->database('hrd', true);
		$SQL = "Select iDeptId as id, vDescription as name from departement  where lDeleted = 0 order by vDescription asc";
		$query = $dbset->query($SQL);
		$data = array();
	
		if ($query->num_rows > 0) {
			$result = $query->result_array();
		}
	
		return $result;
	}
	
	public function getAllDepartement() {
		$dbset = $this->load->database('hrd', true);		
		$this->load->library('datatables');
	
		$pk_id = 'iDeptID,vDescription';
	
		$this->datatables->select('iDeptID, vDescription');
		$this->datatables->from($dbset->database.'.departement');
		//$this->datatables->where('dResign = \'0000-00-00\'');
		//$this->datatables->add_column('action', '<a href ="#" onclick="PilihRecord(\'$1\');">Edit</a> | <a href ="#" onclick="deleteRecord(\'$1\');">Delete</a>', 'idprivi_apps');
		$this->datatables->add_column('action', '<input type="radio" name="pilih" id="pilih" onclick="PilihRecord(\'$1|$2\', 1);">', $pk_id);
	
		return $this->datatables->generate();
	}
}