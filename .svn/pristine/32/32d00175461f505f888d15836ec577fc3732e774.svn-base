<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Groups extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}
	
	function getLastGroupId($iCompanyId, $idprivi_apps) {
		
		$SQL = "Select MAX(a.idprivi_group) as idprivi_group from privi_group_pt_app a 
			where a.iCompanyId = '{$iCompanyId}' and a.idprivi_apps = '{$idprivi_apps}'";

		$query = $this->db->query($SQL);
		if ( $query->num_rows > 0 ) {
			$row = $query->row();
			$last_group_id = $row->idprivi_group + 1;
		} else {
			$last_group_id = 1;
		}
		
		return $last_group_id;
	}
	
	function checkDuplicate($iCompanyId, $idprivi_apps) {
		
		$SQL = "Select a.vNamaGroup as idprivi_group from privi_group_pt_app a 
			where a.iCompanyId = '{$iCompanyId}' and a.idprivi_apps = '{$idprivi_apps}'";

		$query = $this->db->query($SQL);
		if ( $query->num_rows > 0 ) {
			$row = $query->row();
			$last_group_id = $row->idprivi_group;
		} else {
			$last_group_id = '';
		}
		
		return $last_group_id;
	}
	
	function insupdtGroup($iID_GroupApp, $iCompanyId, $idprivi_apps, $idprivi_group, $vNamaGroup, $txtDesc, $tCreatedAt, $user, $st_updt) {
		if ($st_updt == 'add') {					
			$SQL = "INSERT INTO privi_group_pt_app (iCompanyId, idprivi_apps, idprivi_group, vNamaGroup, txtDesc, dCreated, cCreatedBy) 
					VALUES ('{$iCompanyId}', '{$idprivi_apps}', '{$idprivi_group}', '{$vNamaGroup}', '{$txtDesc}', '{$tCreatedAt}', '{$user}')";
			
			try {
				$this->db->query($SQL);
				$last_id = $this->db->insert_id();
				$x = '1|'.$last_id;
			}catch(Exception $e) {
				$x = '0|0';	
			}
			
		} else {
			$today = date("Y-m-d H:i:s", mktime());
			$SQL = "UPDATE privi_group_pt_app set vNamaGroup = '{$vNamaGroup}', txtDesc='{$txtDesc}', tUpdated = '{$today}', cUpdatedBy='{$user}' 
					WHERE iID_GroupApp = '{$iID_GroupApp}'";
			
			try {
				$this->db->query($SQL);
				$last_id = $iID_GroupApp;
				$x = '1|'.$last_id;
			}catch(Exception $e) {
				$x = '0|0';
			}
		}
		
		return $x;
	}
	
	function delGroup($iID_GroupApp) {
		$data = array(
               'lDeleted' => 1
            );

		$this->db->where('iID_GroupApp', $iID_GroupApp);
		$this->db->update('privi_group_pt_app', $data); 
	}
	
	public function getGroupsDT($companyId, $aplikasiId) {
		$this->load->library('datatables');
		$pk_id = 'iID_GroupApp,vNamaGroup';
	
		$this->datatables->select('iID_GroupApp, vNamaGroup');
		$this->datatables->from('privi_group_pt_app');
		$this->datatables->where('lDeleted = 0 and iCompanyId = '.($companyId == "" ? 0 : $companyId).' and idprivi_apps = '.($aplikasiId == "" ? 0 : $aplikasiId));
		$this->datatables->add_column('action', '<input type="radio" name="pilih" id="pilih" onclick="PilihRecord(\'$1|$2\', 2);">', $pk_id);
	
		return $this->datatables->generate();
	}
	
	public function getGroupById($id) {
		$SQL = "Select vNamaGroup from privi_group_pt_app where iID_GroupApp = {$id}";
		$query = $this->db->query($SQL);
		$data = array();
	
		if ($query->num_rows > 0) {
			$row = $query->row();
			$x = $row->vNamaGroup;
		} else {
			$x = '';
		}
	
		return $x;
	}
}