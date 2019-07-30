<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_home extends CI_Model{
	public $table;
	public $db;
	
	function __construct(){
		parent::__construct();
		
		$this->table = 'privi_group_pt_app_mod';
		$this->db = set_db('default',true);
	}
	
	public function getAcl($pt, $acc, $group_and_modul) {
		$this->load->database('hrd', FALSE);
		$this->load->database('default', TRUE);
		
		if (is_array($group_and_modul)) {
			$group_id  = $group_and_modul['group_id'];		
			$module_id = $group_and_modul['module_id'];
		} else {
			$group_id  = 0;		
			$module_id = 0;
		}
		
		$appId	   = '';
		
		$sqlGetApp = "SELECT idprivi_apps 
					 FROM erp_privi.privi_modules 
					 WHERE idprivi_modules = '{$module_id}'";
		 
		$queryApp 	= $this->db->query($sqlGetApp);
	 	if ($queryApp->num_rows() > 0){
			$rowApp 	= $queryApp->row_array();
			$appId 		= $rowApp['idprivi_apps'];
		}
		 
		$sql = "SELECT iCrud, idprivi_modules 
			 	FROM `".$this->table."` 
		 		WHERE iCompanyId = '{$pt}' 
				AND idprivi_apps = '{$appId}' 
				AND idprivi_group = '{$group_id}'
				AND idprivi_modules = '{$module_id}'";		
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			$row = $query->row_array();
			return $row['iCrud'];
		} else {
			return 0;
		}
		
	}
	
}
?>