<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Modules extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}
	
	function delModules($id) {
		$data = array(
				'lDeleted' => 1
		);
	
		$this->db->where('idprivi_modules', $id);
		$this->db->update('privi_modules', $data);
	}
	
	function insupdtModules($idprivi_modules, $idprivi_apps, $vCodeModule, $vNameModule, $vPathModule, $iParent, $txtDesc, $tCreatedAt, $user, $st_updt) {
		if ($st_updt == 'add') {
			$SQL = "INSERT INTO privi_modules (idprivi_apps, vCodeModule, vNameModule, vPathModule, iParent, txtDesc, dCreated, cCreatedBy)
			VALUES ('{$idprivi_apps}', '{$vCodeModule}', '{$vNameModule}', '{$vPathModule}', '{$iParent}', '{$txtDesc}', '{$tCreatedAt}', '{$user}')";
				
			try {
				$this->db->query($SQL);
				$last_id = $this->db->insert_id();
				$x = '1|'.$last_id;
			}catch(Exception $e) {
				$x = '0|0';
			}
			
		} else {
			$today = date('Y-m-d H:i:s', mktime());
			$SQL = "UPDATE privi_modules set vCodeModule = '{$vCodeModule}', vNameModule = '{$vNameModule}', 
			vPathModule = '{$vPathModule}', iParent = '{$iParent}', txtDesc='{$txtDesc}', tUpdated = '{$today}', 
			cUpdatedBy='{$user}'
			WHERE idprivi_modules = '{$idprivi_modules}'";
				
			try {
				$this->db->query($SQL);
				$last_id = $idprivi_modules;
				$x = '1|'.$last_id;
			}catch(Exception $e) {
				$x = '0|0';
			}
		}

		return $x;
	}
	
	public function getAllModules($idprivi_apps) {
		$SQL = "Select a.idprivi_modules as id, concat_ws(' - ', a.vCodeModule, a.vNameModule) as name from privi_modules a where a.idprivi_apps = '{$idprivi_apps}' and lDeleted = 0";
		$query = $this->db->query($SQL);
		$data = array();
	
		if ($query->num_rows > 0) {
			$result = $query->result_array();
			//print_r($result);
		} else {
			$result = array(
				array('id'=>0, 'name'=>'Pilih Modules')
			);
		}
	
		return $result;
	}
	
	function checkDuplicate($txt, $idprivi_apps) {
	
		$SQL = "Select count(idprivi_modules) as std from privi_modules a
		where a.idprivi_apps = '{$idprivi_apps}' and (a.vCodeModule = '{$txt}' OR a.vNameModule = '{$txt}')";
	
		$query = $this->db->query($SQL);
		if ( $query->num_rows > 0 ) {
			$row = $query->row();
			$last_group_id = $row->std;
		} else {
			$last_group_id = 0;
		}
	
		return $last_group_id;
	}
	
	public function getAllModulesByAppId($idprivi_apps) {
		$SQL = "Select a.idprivi_modules as id, concat_ws(' - ', a.vCodeModule, a.vNameModule) as name 
				from privi_modules a 
				where a.idprivi_apps = '{$idprivi_apps}' 
				AND a.lDeleted = 0";
		$query = $this->db->query($SQL);
		$data = array();
	
		$result = $this->db->query($SQL);
		if($result->num_rows() > 0) {
			$appList = $result->result_array();
			return $appList;
		} else {
			return null;
		}
	
		return $result;
	}
	
	function delModulesByAppId($iID_GroupApp) {
		$data = array(
				'lDeleted' => 1
		);
	
		$this->db->where('idprivi_apps', $iID_GroupApp);
		$this->db->update('privi_group_pt_app_mod', $data);
	}
}