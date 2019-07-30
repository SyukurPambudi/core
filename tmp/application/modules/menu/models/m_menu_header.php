<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_menu_header extends CI_Model{
	public $db;
	
	function __construct(){
		parent::__construct();
		$this->db = set_db('default', true);
	}
	
	function getFirstMenuComp($g_nip, $g_com_id, $com_id_sess){
		$list_id_pt = "' '";
		$query_and	= "";
		$sql1	= "SELECT iCompanyId
					FROM privi_authlist
					WHERE cNIP = '".$g_nip."'
					AND lDeleted = 0   ";
		
		$query1 = $this->db->query($sql1);
		$data1  = $query1->result_array();
		foreach($data1 as $dt1) {
			$list_id_pt .= ", '".$dt1['iCompanyId']."'";
		}
		
		if ($list_id_pt !=  "' '"){
			$query_and = " AND iCompanyId IN (".$list_id_pt.") ";
		}
		
		$this->db = set_db('hrd', true);				
		$sql2 	  = "SELECT iCompanyId AS `idPT`
					, vCompName AS `vNamaPT`
					, vAcronim
					, lDeleted
					FROM company
					WHERE lDeleted =  b'0' 
					$query_and ";
		
		$query2	= $this->db->query($sql2);
		if($query2->num_rows() > 0) {
			return $query2->result_array();
		} else {
			$rtr = array('empty');
			return $rtr;
		}
	}
	
	function getOpenCompany($g_com_id){
		if(empty($g_com_id)){
			$g_com_id = '3';
		}
		$sql 		= "SELECT a.vCompName FROM hrd.company a WHERE a.iCompanyId = '".$g_com_id."' ";
		$query		= $this->db->query($sql);
		$data		= $query->result_array();
		$vCompName  = '';
		
		foreach($data as $dt){
			$vCompName = explode(".", $dt['vCompName']);
			$vCompName = $vCompName[0].'. '.ucwords(strtolower($vCompName[1]));
		}
		return $vCompName;
	}
}
