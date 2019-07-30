<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Authlist extends CI_Model{
	
	function __construct(){
		parent::__construct();
		
	}
		
	
	public function getIDPrivi_Group($idprivi_apps, $cNip, $iCompanyId) {
		$SQL = "SELECT a.idprivi_group FROM privi_authlist a
				where a.idprivi_apps = '".$idprivi_apps."'
				AND a.cNIP = '".$cNip."' AND a.lDeleted = '0'";
		$result = $this->db->query($SQL);
		if ($result->num_rows() > 0) {
			foreach($result->result() as $row) {
				$idprivi_group = $row->idprivi_group;				
			}
		} else {
			$idprivi_group = 0;
		}
		
		return $idprivi_group;
	}
	
	function checkDuplicate($cNip, $companyId, $aplikasiId, $groupId) {
		
		/*$SQL = "SELECT COUNT(iID_Authlist) AS `std` FROM privi_authlist 
				WHERE cNip = '{$cNip}' AND iCompanyId = '{$companyId}' 
				AND idprivi_apps = '{$aplikasiId}' AND idprivi_group = '{$groupId}' and lDeleted = 0";
		*/
		$SQL = "SELECT COUNT(iID_Authlist) AS `std` FROM privi_authlist 
				WHERE cNip = '{$cNip}' AND iCompanyId = '{$companyId}' 
				AND idprivi_apps = '{$aplikasiId}' AND lDeleted = 0";

		$query = $this->db->query($SQL);
		if ( $query->num_rows > 0 ) {
			$row = $query->row();
			$last_group_id = $row->std;
		} else {
			$last_group_id = 0;
		}
		
		return $last_group_id;
	}
	

}