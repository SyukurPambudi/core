<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_privi_sess_hist extends CI_Model{
	public $table;
	public $dbx;
	function __construct(){
		parent::__construct();
	
		$this->table = 'privi_session_log';
		//$this->db->close();
		//$this->dbx = $this->load->database('default',TRUE);
		//$this->dbx = set_db('default',true);
		$this->dbx = $this->db;
	}
	
	function select_where($select='*', $where=array('idprivi_session_hist'=>0), $single_row=false) {
		$this->dbx->select($select);
		$this->dbx->from($this->table);
		$this->dbx->where($where);
		
		$query = $this->dbx->get();
		if($query->num_rows()>0) {
			if($single_row) {
				return $query->row_array();
			} else {
				return $query->result_array();
			}
		}
		
		return false;
		
	}
	function update($data='',$where='') {
		if(is_array($data)) {
			$this->dbx->where( $where );
			$success =$this->dbx->update( $this->table, $data );
			return $success;
		}
		return false;
		
	}
	function insert($data='') {
		if(is_array($data)) {
			$success =$this->dbx->insert($this->table, $data);
			return $success;
		}
		return false;
	}
	
}