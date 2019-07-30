<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Applicant extends CI_Model{
	
	private $hrd;
	function __construct(){
		parent::__construct();
		
	}
	
	public function getSexById($id) {
		$data = array('W'=>'Wanita', 'P'=>'Pria', ''=>'');
	
		return $data[$id];
	}
	
	public function getTipePsikoById($id) {
		$data = array(0=>'', 1=>'Calon Karyawan', 2=>'Karyawan Promosi');
	
		return $data[$id];
	}
	
	public function getSumberById($id) {
		$data = array(0=>'', 1=>'Kirim Langsung', 2=>'Walk In', 3=>'Pengumuman', 4=>'Iklan', 5=>'Referensi');
	
		return $data[$id];
	}
	
	
}