<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Employee extends CI_Model {
	
	private $dbset;
	private $_ci;
	private $where_resign='';
	private $table;
	function __construct() {
		parent::__construct();		
		$this->_ci=&get_instance();
		
		$this->_ci->load->helper('callback');
		
		$this->table = 'employee a';
		$this->where_resign =" ( a.dResign='0000-00-00' OR a.dResign > '".date('Y-m-d')."' ) ";
	}
	
	function get_all_superior( $nip='' ) {
		$dbset = $this->load->database('hrd', true);
		/*$SQL = "SELECT a.cUpper cUpper1, b.cUpper cUpper2, 
				c.cUpper cUpper3, d.cUpper cUpper4, 
				e.cUpper cUpper5, f.cUpper cUpper6, g.cUpper cUpper7
				FROM employee a
				LEFT JOIN employee b ON b.cNip = a.cUpper
				LEFT JOIN employee c ON c.cNip = b.cUpper
				LEFT JOIN employee d ON d.cNip = c.cUpper
				LEFT JOIN employee e ON e.cNip = d.cUpper
				LEFT JOIN employee f ON b.cNip = e.cUpper
				LEFT JOIN employee g ON c.cNip = f.cUpper
				WHERE a.cNip = '$nip';";*/
		$SQL="SELECT 
					IF((b.dResign='0000-00-00' OR b.dResign > CURRENT_DATE()),b.cNip,NULL) upper1, 
					IF((c.dResign='0000-00-00' OR c.dResign > CURRENT_DATE()),c.cNip,NULL) upper2,
					IF((d.dResign='0000-00-00' OR d.dResign > CURRENT_DATE()),d.cNip,NULL) upper3,
					IF((e.dResign='0000-00-00' OR e.dResign > CURRENT_DATE()),e.cNip,NULL) upper4,
					IF((f.dResign='0000-00-00' OR f.dResign > CURRENT_DATE()),f.cNip,NULL) upper5,
					IF((g.dResign='0000-00-00' OR g.dResign > CURRENT_DATE()),g.cNip,NULL) upper6
				FROM employee a
				LEFT JOIN employee b ON b.cNip = a.cUpper 
				LEFT JOIN employee c ON c.cNip = b.cUpper 
				LEFT JOIN employee d ON d.cNip = c.cUpper 
				LEFT JOIN employee e ON e.cNip = d.cUpper 
				LEFT JOIN employee f ON f.cNip = e.cUpper 
				LEFT JOIN employee g ON g.cNip = f.cUpper 
				WHERE a.cNip = '$nip'";
		
		$query = $dbset->query($SQL);
		
		if ($query->num_rows() >0) {
			$result = $query->result_array();
		} else {
			$result = false;
		}
		
		return $result;
	}
	function getEmployeeByTerm($term='', $where='') {
		$dbset = $this->load->database('hrd', true);
		
		$SQL = "SELECT a.cNip,a.vName,a.iPostId,a.iDeptId,a.iDivId FROM employee a WHERE {$this->where_resign} AND ( a.cNip LIKE '%$term%' OR a.vName LIKE '%$term%' )";
		/*if($where) {
			foreach($where as $field => $value) {
				$SQL.=" AND $field = '$value' ";
			}
		}*/
		if($where) {
			$SQL.= " AND ".$where;
		}
		
		$query = $dbset->query($SQL);
		
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		} else {
			$result = false;
		}
		
		return $result;
	}
	function getEmployeeByNip($nip='') {
		$dbset = $this->load->database('hrd', true);
		$this->where_resign = " 1 = 1";
		//$SQL = "SELECT cNip,vName,iPostId,iDeptId,iDivId, iWorkArea FROM employee WHERE cNip ='$nip' LIMIT 1";
		$SQL = "SELECT a.cNip,a.cUpper,a.vName,a.iDeptId,a.iPostId,a.iDivId,a.iWorkArea,b.vDescription,b.iLvlemp,a.vEmail  
				FROM hrd.employee a
				JOIN hrd.`position` b ON b.iPostId = a.iPostId 
				WHERE {$this->where_resign} AND a.cNip='$nip' LIMIT 1";
		$query = $dbset->query($SQL);
	
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		} else {
			$result = false;
		}
	
		return $result;
	}
	function getEmployeeByDeptPos($iDeptId='', $iLvlemp='') {
		$dbset = $this->load->database('hrd', true);
	
		//$SQL = "SELECT cNip,vName,iPostId,iDeptId,iDivId, iWorkArea FROM employee WHERE cNip ='$nip' LIMIT 1";
		$SQL = "SELECT a.cNip, a.vName,a.vEmail, b.iPostId,a.iDeptId,a.iDivId,a.iWorkArea, b.iLvlemp,b.vDescription FROM employee a 
				JOIN `position` b ON b.iPostId = a.iPostId
				WHERE {$this->where_resign} 
				AND a.iDeptId = '$iDeptId'
				AND b.iLvlemp >= '$iLvlemp'";
		$query = $dbset->query($SQL);
	
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		} else {
			$result = false;
		}
	
		return $result;
	}
	function select($where='', $orderby='') {
		$dbset = $this->load->database('hrd', true);
		$SQL = "SELECT * FROM {$this->table} ";
		if($where) {
			$SQL.= " WHERE {$this->where_resign} ";
			foreach($where as $field=>$val) {
				$SQL.= " AND $field = '".$val."' ";
			}
			
			if($orderby) {
				$SQL.= " $orderby";
			}
		} else {
			$SQL.= "LIMIT 1;";
		}
	
		$query = $dbset->query($SQL);
	
		if ( $query->num_rows()>0 ) {
			return $query->result_array();
		}
	
		return false;
	}
	function custom($sql='') {
		if($sql=='') return false;
		
		$dbset = $this->load->database('hrd',true);
		$query = $dbset->query($sql);
		if( $query->num_rows()>0 ) {
			return $query->result_array();
		}
		
		return false;
	}
}