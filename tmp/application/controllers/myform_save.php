<?php
class MyForm_Save extends MX_Controller {
	
	//private $_pktbl;
	//private $_pkid;
	private $_f_columns;
	private $_last_id_save; 
	
	
	public function __construct() {
		parent::__construct();		
		 
		//session
		$this->load->library('Zend', 'Zend/Session/Namespace'); 
		
		//model
		$this->load->model('m_utilitas');
		
		//library
		$this->load->library("jsonci");
		$this->load->helper('directory');
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
		
		//echo 'PK DB '.$pkdb;
	 	$var_field_name = array();
	 	
		$sess_auth = new Zend_Session_Namespace('auth');
		unset($sess_auth->last_id_save);
		
		$var_name = $_POST['var_name'];
		$var_valu = str_replace('"', '', $_POST['var_valu']);
		
		$var_type = $_POST['var_type'];
		
		foreach($var_name as $v) {
			if (strpos($v, $pktbl) !== false) {
				$var_field_name[] = substr($v, strlen($pktbl) + 1);
			}
		}
		
		//
		$par_name = $_POST['par_name'];
		$par_valu = str_replace('"', '', $_POST['par_valu']);
		
		$action = str_replace('"', '', $par_valu[5]);
		
		$today = date('Y-m-d H:i:s', mktime());
		$date  = date('Y-m-d', mktime());
		$sess_auth 	= new Zend_Session_Namespace('auth');
		$nip = $sess_auth->gNIP;
	
		if ($action == 'edit') {
	
			//Test Proses Update
			$SQL = "Update {$pktbl} set ";
			$i = 0;
			
			foreach($var_field_name as $col) {
				if ( $i != 0) {
					$var_valu[$i] = addslashes($var_valu[$i]);
//					echo $var_type;
					if ($var_type[$i] == 'date') {
						//echo 'Fieldx : '.$var_valu[$i];
						$SQL .= $col ."='".date('Y-m-d', strtotime($var_valu[$i]))."',";
					} else if ($var_type[$i] == 'datetime') { 
						$SQL .= $col ."='".date('Y-m-d H:i:s', strtotime($var_valu[$i]))."',";
					} else {
						//echo 'Field : '.$var_valu[$i];
						$SQL .= $col ."='".$var_valu[$i]."',";
					}
				} else {
					$UPDATE = ", tUpdated='{$today}', cUpdatedBy='{$nip}'";
					//$UPDATE = ", cUpdatedAt='{$nip}'";
					$WHERE  = " Where ".$var_field_name[0] ."='" .$var_valu[0]."'";
				}
				$i++;
			}
			
			//echo $SQL;
	
			$last_id = $var_valu[0];
			$SQL = substr($SQL, 0, strlen($SQL) - 1);
			$query =  $SQL.$UPDATE.$WHERE;	

			$isOk = explode('|', $this->m_utilitas->isAlreadyEdited($pkdb, $pkid, $last_id, $pktbl, $par_valu[2], $par_valu[3]));
			
	
			try {
				if ($isOk[0] > 0 ) {
					$x = '99|'.$last_id.'|'.$par_valu[0].'|'.$par_valu[1].'|'.$isOk[1];
				} else {
					$db_set = $this->load->database($pkdb, 'true');
					$db_set->query($query);
					
					//
					//$this->m_utilitas->save_activity_log($nip, $company_id, $app_id, $module_id, $session_id, $query);
					//
					$x = '1|'.$last_id.'|'.$par_valu[0].'|'.$par_valu[1].'|'.$isOk[1];
					
					$sess_auth->last_id_save 	= $last_id;
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
			$SQL .= ",dCreated,cCreatedBy)";
	
			$SQL1 = substr($SQL1, 0, strlen($SQL1) - 1);
			$SQL1 .= ",'".$date."','".$nip."')";
	
			$query = $SQL.$SQL1;
			
			//echo $query;
			///die('a');
	
			try {
				$db_set = $this->load->database($pkdb, 'true');
				$db_set->query($query);
				$last_id = $db_set->insert_id();
				$x = '1|'.$last_id.'|'.$par_valu[0].'|'.$par_valu[1].'|0';
				$sess_auth->last_id_save 	= $last_id;
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
		$pkprefix = $_GET['pk_prefix'];
		
		//if ($pkdb == 'erp_privi') $pkdb = 'default';
		//DELETE QUERY
		try {
			$db_set = $this->load->database($pkprefix, 'true');
			
			$datax = array('lDeleted' => '1');
			$db_set->where($pkid, $_GET['id']);
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
		$var_w  = substr($var, strlen($pktbl) + 1);
		//echo $var_w;
		
		$db_set = $this->load->database($pkdb, 'true');
		
		try {
			$SQL = "SELECT count(*) as `std` from {$pktbl} where {$var_w} = '{$val}' and lDeleted = 0";
			$query = $db_set->query($SQL);
			
			$row = $query->row();
			
			$x = $row->std;
			
		}catch(Exception $e) {
			$x =  1;
		}
		
		echo $x;
	}
	
	function uploadFileXX($app_folder, $mod_folder, $id_folder){
	  	
		$parameter = array(
					  'app_folder'=> $app_folder
					, 'mod_folder' => $mod_folder
					, 'id_folder' => $id_folder);
		
		 $this->load->library('MyUploadHandler',$parameter);
	}
	
	function upload_file($app_folder, $mod_folder, $id_folder){
		
		$sess_auth = new Zend_Session_Namespace('auth');
		$id_folder = $sess_auth->last_id_save;
				
	 	$uploader  = $this->load->library('MyFileUploader');
		
		// Specify the list of valid extensions, ex. array("jpeg", "xml", "bmp")
		$uploader->allowedExtensions = array();
		
		// Specify max file size in bytes.
		$uploader->sizeLimit = 10 * 1024 * 1024;
		
		// Specify the input name set in the javascript.
		$uploader->inputName = 'qqfile';
		
		// If you want to use resume feature for uploader, specify the folder to save parts.
		$uploader->chunksFolder = 'chunks';
		
		// To save the upload with a specified name, set the second parameter.
		$folder_uniq = 'files/'.$app_folder.'/'.$mod_folder.'/'.$id_folder;
		if (!is_dir($folder_uniq)) {
			mkdir($folder_uniq, 0755, true);
		}
		$dateNow = date('dmy');
		$result  = $uploader->handleUpload($folder_uniq , $dateNow.'_'.$uploader->getName());
		
		//echo 'Uniq : '.$folder_uniq;
		//die('aaa');
		
		// To return a name used for uploaded file you can use the following line.
		$result['uploadName'] = $uploader->getUploadName();
 	 	
		header("Content-Type: text/plain");
		echo json_encode($result); 
	}
	
	function read_file($app_folder, $mod_folder, $id_folder){
		$list_file = directory_map('./files/'.$app_folder.'/'.$mod_folder.'/'.$id_folder);
		
		$data = array('list_file' => $list_file);
		$this->jsonci->sendJSONsuccess($data);		 
	}
	
	function delete_file(){
		$file_path 	= $_GET['path'];
		$file_name	= $_GET['file'];
		$file		= $file_path.'/'.$file_name;
		$data 		= array();
		
		if (is_file($file)){
		 	unlink($file);
		 	$data = array('return'=> '1', 'file_name' => $file_name, 'text' => $file_name.'. Deleted success.');
		}else{
			$data = array('return'=> '0', 'file_name' => $file_name, 'text' => $file_name.'. Deleted fail.');
		}
		$this->jsonci->sendJSONsuccess($data);
	}
}