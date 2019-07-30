<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Employee extends CI_Model{
	
	private $default;
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
		$dbx = $this->load->database('hrd', true);
		
		$SQL = "SELECT concat_ws( ' - ', cNip, vName ) as name from employee where cNip = '{$cNIP}'";
		$query = $dbx->query($SQL);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$name = $row->name;			
		} else {
			$name = '';
		}
		
		return $name;
	}
}