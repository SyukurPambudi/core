<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class acl {
	/* Actions::::
	* Create 1
	* Read 2
	* Update 4
	* Delete 8
	* The allowance is made by a sum of the actions allowed.
	* Ex.: user can read and update (2+4)=6 … so ill put 6 instead of 1 or 0.
	*
	* if(!$this->acl->hasPermission('entries_complete_access')) {
			echo "No no";
		} else
	* 		echo "yeah";
		}
	*
	*/
	
	var $perms = array(); //Array : Stores the permissions for the user
	var $userID; //Integer : Stores the ID of the current user
	var $userRoles = array(); //Array : Stores the roles of the current user
	var $ci;
	public $_insertPrivilege;
	public $_updatePrivilege;
	public $_deletePrivilege;
	
	var $sess_auth;
	
	function __construct($config=array()) {
		$this->ci = &get_instance();
		
		$this->ci->load->library('Zend', 'Zend/Session/Namespace');
		$this->sess_auth 	= new Zend_Session_Namespace('auth');
		
		//print_r($this->sess_auth);
		//echo $this->sess_auth->gNIP;
		/*
		 * $sess_auth->gNIP 	= $NIP;
					$sess_auth->gName 	= ucwords(strtolower($NAME));
					$sess_auth->gComId 	= $company;
					$sess_auth->gComName= $COMP;
					$sess_auth->logged 	= TRUE;
					$sess_auth->gAccess = $group_access;
					$sess_auth->timestamp = date('Y-m-d H:i:s');
					$sess_auth->sess_life = time();
					$sess_auth->lang	= 'english';
		 */
		
		//$usID = $this->ci->session->userdata('userID') ? $this->ci->session->userdata('userID') : '0';
		$usID   = $this->sess_auth->gNIP ? $this->sess_auth->gNIP : '0';
		$this->userID = $usID;
		//$this->userRoles = $this->getUserRoles();
		//$this->buildACL();
	}
	
	/*
	 * //session
                $this->load->library('Zend', 'Zend/Session/Namespace');
                
                $this->load->library('MySession');
                $this->mysession->sess_check();
	 */
	
	function buildACL() {
		//first, get the rules for the user's role
		if (count($this->userRoles) > 0) {
			$this->perms = array_merge($this->perms, $this->getRolePerms($this->userRoles));
		}
		//then, get the individual user permissions
		$this->perms = array_merge($this->perms, $this->getUserPerms($this->sess_auth->gNIP));	
	}
	
	function getPermKeyFromID($permID) {
		//$strSQL = "SELECT `permKey` FROM `".DB_PREFIX."permissions` WHERE `ID` = " . floatval($permID) . " LIMIT 1″;
		$this->ci->db->select('permKey');
		$this->ci->db->where('id', floatval($permID));
		$sql = $this->ci->db->get('perm_data', 1);
		$data = $sql->result();
		return $data[0]->permKey;
	}
	
	function getPermNameFromID($permID) {
		//$strSQL = "SELECT `permName` FROM `".DB_PREFIX."permissions` WHERE `ID` = " . floatval($permID) . " LIMIT 1″;
		$this->ci->db->select('permName');
		$this->ci->db->where('id', floatval($permID));
		$sql = $this->ci->db->get('perm_data', 1);
		$data = $sql->result();
		return $data[0]->permName;
	}
	
	function getRoleNameFromID($roleID) {
		//$strSQL = "SELECT `roleName` FROM `".DB_PREFIX."roles` WHERE `ID` = " . floatval($roleID) . " LIMIT 1″;
		$this->ci->db->select('roleName');
		$this->ci->db->where('id', floatval($roleID), 1);
		$sql = $this->ci->db->get('role_data');
		$data = $sql->result();
		return $data[0]->roleName;
	}
	
	/* function getUserRoles() {
		//$strSQL = "SELECT * FROM `".DB_PREFIX."user_roles` WHERE `userID` = " . floatval($this->userID) . " ORDER BY `addDate` ASC";
		
		$this->ci->db->where(array('userID' => floatval($this->userID)));
		$this->ci->db->order_by('addDate', 'asc');
		$sql = $this->ci->db->get('user_roles');
		$data = $sql->result();
		
		$resp = array();
		foreach ($data as $row) {		
			$resp[] = $row->roleID;
		}
		return $resp;
	} */
	
	function getUserRoles() {
		
	}
	
	function getAllRoles($format='ids') {
		$format = strtolower($format);
		//$strSQL = "SELECT * FROM `".DB_PREFIX."roles` ORDER BY `roleName` ASC";
		$this->ci->db->order_by('roleName', 'asc');
		$sql = $this->ci->db->get('role_data');
		$data = $sql->result();
		
		$resp = array();
		foreach ($data as $row) {
			if ($format == 'full') {
				$resp[] = array("id" => $row->ID, "name" => $row->roleName);
			} 
			else {
				$resp[] = $row->ID;
			}
		}
		return $resp;
	}
	
	function getAllPerms($format='ids') {
		$format = strtolower($format);
		//$strSQL = "SELECT * FROM `".DB_PREFIX."permissions` ORDER BY `permKey` ASC";
		
		$this->ci->db->order_by('permKey', 'asc');
		$sql = $this->ci->db->get('perm_data');
		$data = $sql->result();
		
		$resp = array();
		foreach ($data as $row) {
			if ($format == 'full') {
				$resp[$row->permKey] = array('id' => $row->ID, 'name' => $row->permName, 'key' => $row->permKey);
			} 
			else {
				$resp[] = $row->ID;
			}
		}
		return $resp;
	}
	
	function getRolePerms($role) {
		if (is_array($role)) {
			//$roleSQL = "SELECT * FROM `".DB_PREFIX."role_perms` WHERE `roleID` IN (" . implode(",",$role) . ") ORDER BY `ID` ASC";
			$this->ci->db->where_in('roleID', $role);
		} 
		else {
			//$roleSQL = "SELECT * FROM `".DB_PREFIX."role_perms` WHERE `roleID` = " . floatval($role) . " ORDER BY `ID` ASC";
			$this->ci->db->where(array('roleID' => floatval($role)));
		}
		$this->ci->db->order_by('id', 'asc');
		$sql = $this->ci->db->get('role_perms'); //$this->db->select($roleSQL);
		$data = $sql->result();
		$perms = array();
		foreach ($data as $row) {
			$pK = strtolower($this->getPermKeyFromID($row->permID));
			
			if ($pK == '') {
				continue;
			}
			/*if ($row->value == '1') {
			$hP = true;
			} else {
			$hP = false;
			}*/
			if ($row->value == '0') {
				$hP = false;
			} 
			else {
				$hP = $row->value ;
			}
		
			$perms[$pK] = array('perm' => $pK, '1inheritted' => true, 'value' => $hP, 'name' => $this->getPermNameFromID($row->permID), 'id' => $row->permID);
		}
	return $perms;
	}
	
	function getUserPerms($userID) {
		//$strSQL = "SELECT * FROM `".DB_PREFIX."user_perms` WHERE `userID` = " . floatval($userID) . " ORDER BY `addDate` ASC";
		
		$this->ci->db->where('userID', floatval($userID));
		$this->ci->db->order_by('addDate', 'asc');
		$sql = $this->ci->db->get('user_perms');
		$data = $sql->result();
		
		$perms = array();
		foreach ($data as $row) {
			$pK = strtolower($this->getPermKeyFromID($row->permID));
			if ($pK == '') {
				continue;
			}
			/*if ($row->value == '1') {
			$hP = true;
			} else {
			$hP = false;
			}*/
			if ($row->value == '0') {
				$hP = false;
			} 
			else {
				$hP = $row->value ;
			}
			
			$perms[$pK] = array('perm' => $pK, '2inheritted' => false, 'value' => $hP, 'name' => $this->getPermNameFromID($row->permID), 'id' => $row->permID);
		}
		return $perms;
	}
	
	function hasRole($roleID) {
		foreach ($this->userRoles as $k => $v) {
			if (floatval($v) === floatval($roleID)) {
				return true;
			}
		}
		return false;
	}
	
	function actionPerm($value, $wanted) {
	
		//echo $wanted.' ';
	
		//echo 'wanted : '.$wanted;
		/* Actions::::
		* View, 8
		* Create 4
		* Update, 2
		* Delete 1
		*/
		/* $action['view'] = array('8', '9', '10', '12', '14', '13','11','15'); //8
		$action['create'] = array('4', '12', '14', '13', '15'); //4
		$action['update'] = array('2', '10', '14', '11', '15'); //2
		$action['delete'] = array('1', '9', '13', '11', '15'); //1
		$action['all'] = array('15'); */
		
		//CRUD 8 4 1 2
                //$default = array('create', 'view', 'delete', 'update', 'all');
		//$action = array();
                $action['create'] = array('8', '9', '10', '11', '12', '13', '14', '15'); //8
                $action['view'] = array('4', '5', '6', '7', '12', '13', '14', '15'); //4
                $action['delete'] = array('2', '3', '6', '7', '10', '11', '14','15'); //2
                $action['update'] = array('1', '3', '5', '7', '9', '11', '13', '15'); //1
                $action['all'] = array('15');
                $action[$wanted][] = array();
                
                //print_r($action);
                //exit;
                //echo $value;
                //if (!in_array($wanted, $action)) {  
                //    $action['ga'] = array();
                //}
                //print_r($action);
		//$action['plc'] = array();
                //echo $wanted;
		//$action['ga'] = array();
		//$action['pm'] = array();
		//$action['priv2'] = array();		
                //$action['personalia'] = array();
		//print_r($action);
		//($action);
		//die;
		
		//$passes = array('createproses','updateproses','deleteproses','login','inproses','logout','signup','upproses');
		//echo $value;
		//echo '<pre>';
		//print_r($action['update']);
		//echo '</pre>';
		//if(in_array($wanted, $passes)) return TRUE;
		
		//if (in_array($value, $action[$wanted], true)) {
                //print_r($action[$wanted]);
		if (in_array($value, $action[$wanted], true)) {
			return true;
		} 
		else {
			return false;
		}
	}
	function hasPermission($permKey, $action = 'all') {		
	    if (is_array($permKey))
			$id_PT = $permKey['company_id'];
		else $id_PT = '';
		
		if (empty($id_PT)){
			$acl = $this->ci->myacl->getMyAcl($this->sess_auth->gComId, $this->sess_auth->gAccess, $permKey);
		}else{
			$acl = $this->ci->myacl->getMyAcl($id_PT, $this->sess_auth->gAccess, $permKey);
		}
		
		/*if($permKey == '' || $permKey == 'login') {
			return true;
		}*/
		//if($this->ci->session->userdata('userID') && $this->ci->session->userdata('userID')) {
		//echo $this->userID;
		//if ($this->userID != 0) {		
		
		
		if (!empty($this->sess_auth->gNIP) || $this->sess_auth->gNIP != null) {
			//$permKey = strtolower($permKey);
			
			//if (array_key_exists($permKey, $this->perms)) {
			if ($this->actionPerm($acl, $action)) {			
				return true;
			} 
			else {
				return false;
			}
			//} 
			//else {
			//	return false;
			//}
		}
		else {
			return false;
		}
	}
	public function setUpdatePrivilege($v) {
		$this->_updatePrivilege=$v;
	}
	public function setDeletePrivilege($v) {
		$this->_deletePrivilege=$v;	
	}
	public function setInsertPrivilege($v) {
		$this->_insertPrivilege=$v; 
	}
	public function getUpdatePrivilege() {
		return $this->_updatePrivilege;
	}
	public function getDeletePrivilege() {
		return $this->_deletePrivilege;
	}
	public function getInsertPrivilege() {
		return $this->_insertPrivilege;
	}
}