<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Employee extends CI_Model{
	
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
	
	public function getNameByNIP($cNIP) {
		$SQL = "SELECT concat_ws( ' - ', cNIP, vName ) as name from hrd.employee where cNIP = '{$cNIP}'";
		$query = $this->db->query($SQL);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$name = $row->name;			
		} else {
			$name = '';
		}
		
		return $name;
	}
	
	public function getStatusKaryawanById($id) {
		$data = array('A'=>'Aktif', 'C'=>'Cuti', 'O'=>'Off'); 
		
		return $data[$id];
	}
	
	public function getAllEmployee() {
		$this->load->library('datatables');
		
		$pk_id = 'cNip,vName';
		
		$this->datatables->select('cNip, vName');
		$this->datatables->from('hrd.employee');
		$this->datatables->where('dResign = \'0000-00-00\'');
		//$this->datatables->add_column('action', '<a href ="#" onclick="PilihRecord(\'$1\');">Edit</a> | <a href ="#" onclick="deleteRecord(\'$1\');">Delete</a>', 'idprivi_apps');
		$this->datatables->add_column('action', '<input type="radio" name="pilih" id="pilih" onclick="PilihRecord(\'$1|$2\', 1);">', $pk_id);
		
		return $this->datatables->generate();
	}
}