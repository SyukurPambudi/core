<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_change_password extends CI_Model{
	public $table;
	public $db;
	
	function __construct(){
		parent::__construct();
		$this->db	 = set_db('hrd', true);
		$this->load->library("jsonci");
	}
	
	function updatePassword($nip, $op, $np) {
		$old_pass = trim(md5($op));
		$new_pass = trim(md5($np));
		$cur_pass = '';
		
		$result	  = array();
		
		try{
			$sql 	= "SELECT cNip, vPassword FROM employee where cNip = '".$nip."' ;";		
			$query 	= $this->db->query($sql);
			$data  	= $query->result_array();
			
			foreach($data as $dt){			
				$cur_pass = $dt['vPassword'];
				if ($old_pass !== $cur_pass){
					$result = array('return'=> '0', 'text' => 'Wrong current password.');
				}else{
					$sqlUpdate 	 = "UPDATE employee SET vPassword = '$new_pass' WHERE cNip='".$nip."'";
					$queryUpdate = $this->db->query($sqlUpdate);
					$result 	 = array('return'=> '1', 'text' => 'Password updated.');
				}
			}
		}catch(Exception $e) {				
			$result = array('return'=> '2', 'text' => 'Error. '.$e);
		}
		
		$this->jsonci->sendJSONsuccess($result);
	}
	
}