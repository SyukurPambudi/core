<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Utilitas extends CI_Model {
	
	private $dbset;
	private $_ci;
	function __construct() {
		parent::__construct();		
		$this->_ci=&get_instance();
		
		$this->_ci->load->helper('callback');
		
	}
	
	function getLastUpdated($db, $pk_id, $id, $table) {
		$this->dbset = $this->load->database($db, 'true');
		$SQL = "SELECT tUpdatedAt, cUpdatedBy from {$table} where {$pk_id} = '{$id}'";
				
		$result = $this->dbset->query($SQL);
		if($result->num_rows() > 0) {
			$rslt = $result->row_array();
		} else {
			$rslt = array('tUpdatedAt'=>'', 'cUpdatedBy'=>'');
		}
		
		return $rslt;
	}

	function isAlreadyEdited($db, $pk_id, $id, $table, $tUpdateAt, $cUpdateBy) {
		$today = date('Y-m-d H:i:s', mktime());
		$this->dbset = $this->load->database($db, TRUE);

		$SQL = "SELECT TIMESTAMPDIFF(SECOND,  '".$tUpdateAt."', (SELECT tUpdatedAt from {$table} where {$pk_id} = '{$id}')) as selisih";
		$query = $this->dbset->query($SQL);
		foreach ($query->result() as $row)
		{
			$x = $row->selisih.'|'.$this->getName($db, $cUpdateBy);
		}
		
		return $x;
	}
	
	function getName($db, $nip) {
		$this->dbset = $this->load->database('hrd', 'true');
		$SQL = "SELECT concat_ws(' - ', a.vName, a.cNip) as lastUpdate from employee a where a.cNip = '".$nip."'";
		$query = $this->dbset->query($SQL);
		
		if ($query->num_rows() > 0) {
			foreach($query->result() as $row) {
				$x = $row->lastUpdate;
			}
		} else {$x = '';}
		return $x;
	}
	
	function showColumns($table) {
		$f_columns = array();
		
		$SQL = "SHOW COLUMNS FROM {$table}";
		$query = $this->db->query($SQL);
		foreach($query->result_array() as $row) {
			$f_columns[] = $row['Field']; 
		}
		
		return $f_columns;
	}
	
	function getData($db, $table, $pk_id, $id) {
		$this->dbset = $this->load->database($db, true);
		
		$SQL = "SELECT * FROM {$table} WHERE {$pk_id} = '{$id}'";
		$query = $this->dbset->query($SQL);
		$num_rows = $query->num_rows();
		
		if ($num_rows > 0)
		{
			$row = $query->row_array();
		} else {
			$row = null;
		}
		
		return $row;
		
	}
	
	function getPrimaryKey($db, $table) {
		$this->dbset = $this->load->database($db, true);
		
		$SQL = "SHOW KEYS FROM {$table} WHERE Key_name = 'PRIMARY'";
		$query = $this->dbset->query($SQL);
		$num_rows = $query->num_rows();
		
		if ($num_rows > 0) {
			$row = $query->row_array();
			$pk = $row['Column_name'];
		} else {
			$pk = null;
		}
		
		return $pk;
		
	}
	
	function m_get_employee($term){
		$list_employee = array();
		$SQL = "SELECT cNIP, vName
				FROM privi_password
				WHERE (cNip LIKE '%$term%' OR vName LIKE '%$term%')
				";
		$result   = $this->db->query($SQL);
		$emp_list = $result->result_array();
	
		foreach($emp_list as $dt){
			$nip 	= $dt['cNip'];
			$name 	= ucwords(strtolower($dt['vName']));
			$list_employee[] = array( 'value'=> $nip, 'label'=> $name );
		}
		return $list_employee;
	}
	
	function getCompModel(){
		$result	= '';
		$data	= array();
		$DB2 	= $this->load->database('default', TRUE);
	
		$table	= 'privi_pt';
		$sql	= "SELECT iCompanyId, vCompName, vAcronim, lDeleted  FROM $table WHERE  lDeleted =  0 " ;
		$query 	= $this->db->query($sql);
		$data  	= $query->result_array();
		if($data){
			foreach ($data as $row){
				$idComp 	= $row['iCompanyId'];
				$exp 		= explode(".", $row['vCompName']);
				$nameComp	= $exp[0].'. '.ucwords(strtolower($exp[1]));
				$codeComp	= $row['vAcronim'];
				$company[] = array( 
						  'idComp'	=> $idComp
						, 'nameComp'=> $nameComp
						, 'codeComp'=> $codeComp  );
			}
		}else{
			$company[] = array( 
					  'idComp'	=> '0'
					, 'nameComp'=> ''
					, 'codeComp'=> ''  );
		}
		return $company;
	}	
	
	function save_activity_log($nip, $company_id, $app_id, $module_id, $session_id, $query) {
		$SQL = "INSERT INTO privi_activity_log (cNip, iCompanyId, idprivi_apps, idprivi_modules, vSessionID, txtQuery) 
				VALUES ('{$nip}', '{$company_id}', '{$app_id}', '{$module_id}', '{$session_id}', '{$query}')";
		$this->db->query($SQL);
	}
	
	function getDataForDataTables() {
	
		//echo $_GET['sWhere1'];
		//echo $_GET['sWhere'];
		$sWhere = '';
		$list_field1 = array();
		$list_table1 = array();
		$list_qriteria = array();
		$list_kriteria = array();
		$wherenya = array();
		$sWh = explode(',', $_GET['sWhere']);
		$sWh1 = explode(',', $_GET['sWhere1']);
		$sWh2 = explode(',', $_GET['advSrc_Type']);
		//print_r($sWh);
		
		//echo $_GET['list_field'];
		$lf = explode(',', $_GET['list_field']);
		
		//print_r($lf);
		foreach($lf as $v) {
			$lff = explode('.', $v);
			//echo $lff[2].',';
			$lfff = explode('AS', $lff[2]);
			$list_field1[] = $lfff[0];
			$list_table1[] = $lff[1];
			$list_qriteria[] = $lff[1].'_'.$lfff[0];
			$list_kriteria[] = $lff[0].'.'.$lff[1].'.'.$lfff[0];
		}
		
		//print_r($list_field1);
		//print_r($list_table1);
		//print_r($list_kriteria);
		foreach($list_qriteria as $key=>$q) {
			foreach($sWh as $s) {
				$ss = substr($s, 2, strlen($s));
				//echo $ss;
				$pos = strpos($q, $ss);
				if ($pos === FALSE) {
					//do nothing
				} else {
					//echo 'test : '.$q;
					$wherenya[] = $list_kriteria[$key];
				}
			}
		}

		//print_r($sWh1);
		foreach($wherenya as $key=>$val) {
			if ($sWh2[$key] == "date") {
				//$SQL1 .= "'".date('Y-m-d', strtotime($var_valu[$i]))."',";
				$sNilai = (empty($sWh1[$key]) && $sWh1[$key] == null) ? '' : date('Y-m-d', strtotime($sWh1[$key]));
				$sValue = "LIKE '%".addslashes($sNilai)."%'";
			} else if ($sWh2[$key] == "date") {
				$sNilai = (empty($sWh1[$key]) && $sWh1[$key] == null) ? '' : date('Y-m-d H:i:s', strtotime($sWh1[$key]));
				$sValue = "LIKE '%".addslashes($sNilai)."%'";
			} else if ($sWh2[$key] == "combobox") {
				$sNilai = $sWh1[$key];
				$sValue = "='".addslashes($sNilai)."'";
			} else {
				$sNilai = $sWh1[$key];
				$sValue = "LIKE '%".addslashes($sNilai)."%'";
			}
			
			//echo 'Nilai : '.$sNilai;
			//$sWhere .= $val."LIKE '%".addslashes($sWh1[$key])."%' AND ";
			$sWhere .= (empty($sNilai) && $sNilai == null) ? "" : $val.$sValue." AND ";
		}

		$sWhere = substr($sWhere, 0, strlen($sWhere) - 4);
		
		$this->load->library('datatables');
		
		$this->datatables->select($_GET['list_field']);
		$this->datatables->from($_GET['list_table']);
		
		if (strlen($_GET['list_relation']) > 0) {
			$list_relation = explode(',', $_GET['list_relation']);
			$list_tbl_relations = array();
			if (sizeOf($list_relation) > 0) {
				foreach($list_relation as $lr) {
					$table = explode('.', $lr);
					$i=0;
					
					if ($table[0].'.'.$table[1] != $_GET['list_table']) {
						if (!($i%2)) {
							if (!in_array($table[0].'.'.$table[1], $list_tbl_relations)) $list_tbl_relations[] = $table[0].'.'.$table[1];
						}
					}
					
					$i++;
				}
			}
			
			$list_table = explode('.', $_GET['list_table']);

			//menghitung jumlah tabel yang akan direlasikan
			$where = explode(',', $_GET['list_relation']);
			$tabelnya = array(); 
			$jml_tabel = 0;
			foreach($where as $val) {
				$value = explode('.', $val);
				if ($value[0] != $list_table[1]) {
					$jml_tabel++;
				}
			}
			
			/* $registered_field = array();
			$registered_tabel = explode('.', $_GET['list_table']);
			
			foreach($where as $key=>$val) {
				if (!in_array($val, $registered_field)) {
					$nama_tabel = explode('.', $val);
					if ($nama_tabel[1] != $registered_tabel[1]) {
						$registered_field[$nama_tabel[1]] = $val;
					} 
				}	
			} */
			
			$i = 0;
			$j = 1;
			foreach($list_tbl_relations as $ltr) {			
				if ($jml_tabel == 1) {				
					$this->datatables->join($ltr, $where[0].'='.$where[1], 'left');
					break;					
				} else {
					$this->datatables->join($ltr, $where[$i*2].'='.$where[($i*2)+1], 'left');
				}
				$i++;
			}
		}
		
		$field_PK = $_GET['field_PK'];
		$group_and_module = explode(',', $_GET['group_and_module']);		
		
		//session
		$this->_ci->load->library('Zend', 'Zend/Session/Namespace');				
		$this->_ci->load->library('MyAcl');		
		$sess_auth 	= new Zend_Session_Namespace('auth');
		$no_urut = $group_and_module[1];//$sess_auth->gModul;
		
		$GroupAndModul = array("group_id" => $group_and_module[0] , "module_id" => $group_and_module[1]);

		$id_PT = isset($_GET['company_id']) ? ($_GET['company_id']) : false;
		
		if (empty($id_PT)){
			$acl = $this->_ci->myacl->getMyAcl($sess_auth->gComId, $sess_auth->gAccess, $GroupAndModul);
		}else{
			$acl = $this->_ci->myacl->getMyAcl($id_PT, $sess_auth->gAccess, $GroupAndModul);
		}
		//echo 'Acl : '.$acl;
		
		/* echo $sess_auth->gComId;
		print_r($sess_auth->gAccess);
		print_r($sess_auth->gApps);
		print_r($GroupAndModul); */
		
		$is_detail = $_GET['is_detail'];
		$urutan   = $_GET['no_urut'];
		
		$butt_add    = '';						
		$butt_view   = '<a href ="#" onclick="viewRecord_'.$no_urut.$urutan.'(\'$1\', \''.$is_detail.'\', \''.$id_PT.'\' );"   class="ui-button ui-widget ui-state-default ui-corner-all" title="View"><span class="ui-icon ui-icon-arrowreturnthick-1-e ">&nbsp;</span></a>';
		$butt_edt    = '<a href ="#" onclick="editRecord_'.$no_urut.$urutan.'(\'$1\', \''.$is_detail.'\', $(this), \''.$id_PT.'\' );"   class="ui-button ui-widget ui-state-default ui-corner-all" title="Edit"><span class="ui-icon ui-icon-pencil">&nbsp;</span></a>';
		$butt_del    = '<a href ="#" onclick="deleteRecord_'.$no_urut.$urutan.'(\'$1\');" class="ui-button ui-widget ui-state-default ui-corner-all" title="Delete"><span class="ui-icon ui-icon-trash">&nbsp;</span></a>';
		
		
		$action = '';
		switch($acl) {
			case 1 :
				$action .= $butt_edt;
				break;
			case 2 :
				$action .= $butt_del;
				break;
			case 3 :
				$action .= $butt_edt.'&nbsp;'.$butt_del;
				break;
			case 4 :
				$action .= $butt_view;
				break;
			case 5 :
				$action .= $butt_view.'&nbsp;'.$butt_edt;
				break;
			case 6 :
				$action .= $butt_view.'&nbsp;'.$butt_del;
				break;
			case 7 :
				$action .= $butt_view.'&nbsp;'.$butt_edt.'&nbsp;'.$butt_del;
				break;
			case 8 :
				$action .= $butt_add;
				break;
			case 9 :
				$action .= $butt_add.$butt_edt;
				break;
			case 10 :
				$action .= $butt_add.$butt_del;
				break;
			case 11 :
				$action .= $butt_add.$butt_edt.'&nbsp;'.$butt_del;
				break;
			case 12 :
				$action .= $butt_view.$butt_add;
				break;
			case 13 :
				$action .= $butt_add.$butt_view.'&nbsp;'.$butt_edt;
				break;
			case 14 :
				$action .= $butt_add.$butt_view.'&nbsp;'.$butt_del;
				break;
			case 15 :
				$action .= $butt_add.$butt_view.'&nbsp;'.$butt_edt.'&nbsp;'.$butt_del;
				break;
			default :
					
					
		}
		//echo 'where : '.$sWhere;
		//echo strlen($sWhere);
		$wrap_action = '<div style="padding-top:3px; padding-left:5px;">'.$action.'</div>';		
		$where_condition = $_GET['list_where_condition'];		
		if ((!empty($sWhere) || $sWhere != null) && (!empty($where_condition) || $where_condition != null)) {
			$where_condition .= ' AND '.$sWhere;
		} else {
			$where_condition .= $sWhere;
		}
		
		if (strlen(trim($where_condition)) > 0) {
			//	echo 'b';
			$this->datatables->where($where_condition);
		}
		
		//echo $where_condition;
		
		$this->datatables->add_column('action', $wrap_action, $field_PK);
		
		if (!empty($_GET['list_relation1']) || $_GET['list_relation1'] != null || $_GET['list_relation1'] != '') {
			$list_relation1 = explode(',', $_GET['list_relation1']);
			if (sizeOf($list_relation1) > 0) {
				foreach ($list_relation1 as $val) {
					$this->datatables->edit_column($val, "$1", "func_".$val."($val, $field_PK)");
				}
			}
		}
		//$this->datatables->add_column('action', '$1', $field_PK);
		
		return $this->datatables->generate(); 
	}
}