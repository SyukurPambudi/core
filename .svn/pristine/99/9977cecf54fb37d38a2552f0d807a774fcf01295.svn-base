<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_privi_group_pt_app_mod extends CI_Model{
	
	function __construct(){
		parent::__construct();
		
	}

	function getModuleByAppGroupModId($iCompanyId, $ipriviApp, $ipriviGroup, $ipriviMod) {
		$SQL = "SELECT idprivi_modules, iCrud FROM privi_group_pt_app_mod 
				WHERE iCompanyId = '{$iCompanyId}'
				AND idprivi_apps = '{$ipriviApp}' 
				AND idprivi_group = '{$ipriviGroup}'
				AND idprivi_modules = '{$ipriviMod}'";
	
		$query = $this->db->query($SQL);
		if ( $query->num_rows > 0 ) {
			$row = $query->row();
			$crud = $row->iCrud;
		} else {
			$crud = 0;
		}
	
		return $crud;
	}
}