<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Level_Pendidikan extends CI_Model{
	
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
	
	public function getLevelPendidikanById($id) {
		$lformal = array(0=>'Tidak', 1=>'Ya');
		return $lformal[$id];
	}
}