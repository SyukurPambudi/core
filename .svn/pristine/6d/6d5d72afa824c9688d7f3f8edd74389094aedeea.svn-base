<?php
class MyForm_Save extends MX_Controller {
	
	//private $_pktbl;
	//private $_pkid;
	private $_f_columns;
	public function __construct() {
		parent::__construct();		
		
		
		//session
		$this->load->library('Zend', 'Zend/Session/Namespace');
		
		//model
		$this->load->model('m_utilitas');
		
	}
	
	function index() {
		
	}
	
	function getData() {
		echo $this->m_utilitas->getDataForDataTables(); 
	}
	
	function save() {
		$pktbl = $_POST['pk_tbl'];
		$pkid  = $_POST['pk_id'];
		$pkdb  = $_POST['pk_db'];
		$var_field_name = array();
		//
		$var_name = $_POST['var_name'];
		$var_valu = str_replace('"', '', $_POST['var_valu']);
		
		$var_type = $_POST['var_type'];
		
		//print_r($var_type);
		
		foreach($var_name as $v) {
			if (strpos($v, $pktbl) !== false) {
				$var_field_name[] = substr($v, strlen($pktbl) + 1);
			}
		}
		
		//
		$par_name = $_POST['par_name'];
		$par_valu = str_replace('"', '', $_POST['par_valu']);
	
		$action = str_replace('"', '', $par_valu[4]);
		
		$today = date('Y-m-d H:i:s', mktime());
		$sess_auth 	= new Zend_Session_Namespace('auth');
		$nip = $sess_auth->gNIP;
	
		if ($action == 'edit') {
	
			//Test Proses Update
			$SQL = "Update {$pktbl} set ";
			$i = 0;
			
			foreach($var_field_name as $col) {
				if ( $i != 0) {
					$var_valu[$i] = addslashes($var_valu[$i]);
					if ($var_type[$i] == 'date') {
						$SQL .= $col ."='".date('Y-m-d', strtotime($var_valu[$i]))."',";
					} else if ($var_type[$i] == 'datetime') { 
						$SQL .= $col ."='".date('Y-m-d H:i:s', strtotime($var_valu[$i]))."',";
					} else {
						$SQL .= $col ."='".$var_valu[$i]."',";
					}
				} else {
					$UPDATE = ", tUpdatedAt='{$today}', tUpdatedAt='{$nip}'";
					$WHERE  = " Where ".$var_field_name[0] ."='" .$var_valu[0]."'";
				}
				$i++;
			}
	
			$last_id = $var_valu[0];
			$SQL = substr($SQL, 0, strlen($SQL) - 1);
			$query =  $SQL.$UPDATE.$WHERE;	

			//echo $query;
			//die('test');
			//print_r($par_valu);
			//echo $pkdb.','.$pkid.','.$last_id.','.$pktbl.','.$par_valu[2].','.$par_valu[3];
			//die;
			$isOk = explode('|', $this->m_utilitas->isAlreadyEdited($pkdb, $pkid, $last_id, $pktbl, $par_valu[2], $par_valu[3]));
			
	
			try {
				if ($isOk[0] > 0 ) {
					$x = '99|'.$last_id.'|'.$par_valu[0].'|'.$par_valu[1].'|'.$isOk[1];
				} else {
					$db_set = $this->load->database($pkdb, 'true');
					$db_set->query($query);
					$x = '1|'.$last_id.'|'.$par_valu[0].'|'.$par_valu[1].'|'.$isOk[1];
				}
			}catch(Exception $e) {
				$x = '0|0|'.$par_valu[0].'|'.$par_valu[1].'|'.$isOk[1];
			}
	
			echo $x;
	
		} else if ($action == 'add') {
	
			//Test Proses Insert
			$SQL = "Insert into {$pktbl} (";
			$SQL1 = " VALUES (";
			$i = 0;
			
			foreach($var_field_name as $col) {
				if ( $i != 0 ) {
					$SQL .= $col .",";
					$var_valu[$i] = addslashes($var_valu[$i]);
					if ($var_type[$i] == 'date') {
						$SQL1 .= "'".date('Y-m-d', strtotime($var_valu[$i]))."',";
					} else if ($var_type[$i] == 'datetime') {
						$SQL1 .= "'".date('Y-m-d H:i:s', strtotime($var_valu[$i]))."',";
					} else {
						$SQL1 .= "'".$var_valu[$i]."',";
					}
				} else {
					//do nothing.
				}
				$i++;
			}
	
			$SQL = substr($SQL, 0, strlen($SQL) - 1);
			$SQL .= ",tCreatedAt,cCreatedBy)";
	
			$SQL1 = substr($SQL1, 0, strlen($SQL1) - 1);
			$SQL1 .= ",'".$today."','".$nip."')";
	
			$query = $SQL.$SQL1;
			
			//echo $query;
			///die('a');
	
			try {
				$db_set = $this->load->database($pkdb, 'true');
				$db_set->query($query);
				$last_id = $db_set->insert_id();
				$x = '1|'.$last_id.'|'.$par_valu[0].'|'.$par_valu[1].'|0';
			}catch(Exception $e) {
				$x = '0|0|'.$par_valu[0].'|'.$par_valu[1].'|0';
			}
	
			echo $x;
		} else {
			die('No Procedure Define...');
		}
	}
	
	function delete() {
		$pktbl = $_GET['pk_tbl'];
		$pkid  = $_GET['pk_id'];
		$pkdb  = $_GET['pk_db'];
		
		if ($pkdb == 'erp_privi') $pkdb = 'default';
		//DELETE QUERY
		try {
			$db_set = $this->load->database($pkdb, 'true');
			$param_id = $_GET['id'];
			
			$datax = array('lDeleted' => '1');
			$db_set->where($pkid, $param_id);
			$db_set->update($pktbl, $datax);
				
			$x = 1;
		}catch(Exception $e) {
				
			$x = 0;
		}
			
		echo $x;
	}
	
	function checkDuplicateData() {
		$pktbl = $_GET['pk_tbl'];
		$pkdb  = $_GET['pk_db'];
		$var   = $_GET['v_var'];
		$val   = $_GET['v_val'];
		
		try {
			$SQL = "SELECT count(*) as `std` from {$pktbl} where {$var} = '{$val}' and lDeleted = 0";
			$query = $pkdb->query($SQL);
			
			$row = $query->row();
			
			$x = $row->std;
			
		}catch(Exception $e) {
			$x =  1;
		}
		
		echo $x;
	}
	
	function uploadFile($app_folder, $mod_folder, $id_folder){
		 
		
		$parameter = array(
					  'app_folder'=> $app_folder
					, 'mod_folder' => $mod_folder
					, 'id_folder' => $id_folder);
		
		 $this->load->library('MyUploadHandler',$parameter);
	}
	
}