<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Privilege_Setup_Group_Access extends MX_Controller {
	
	private $table1;
	private $table2;
	private $model;
	private $method;
	private $f_columns;
	private $f_columns_dtl;
	private $data;
	private $data_dtl;
	private $param_id;

	private $group_id;
	private $module_id;
	
	//for header
	private $url;
	private $db;
	private $dbset;
	private $db_prefix;
	private $pk_db1;
	private $pk_id1;
	private $pk_id2;
	private $fk_id;
	private $sort_by;
	private $caption;
	private $view;
	
	//for detail
	private $optionsDtl;
	private $controllerDtl;
	private $viewDtl;
	private $sortByDtl;
	private $titleDtl;
	
	private $parent_id;
	
	
	public function __construct() {
		parent::__construct();
		$this->load->library('MyTemplate');
		$this->load->library('MyGrid2');
		$this->load->library('MyForm');
		
		//session
		$this->load->library('Zend', 'Zend/Session/Namespace');
		
		$this->load->library('MySession');
		$this->mysession->sess_check();
		
		//model
		$this->load->model('m_utilitas');
		$this->load->model('m_groups');
		$this->load->model('m_modules');
		$this->load->model('m_privi_group_pt_app_mod');
		$this->load->model('m_authlist');
		
		//set database yang ingin digunakan.
		//database
		$this->db    = 'default';
		$this->dbset = $this->load->database($this->db, true);
		$this->db_prefix = $this->dbset->database;
		//
		$this->table1    = 'privi_authlist';
		$this->pk_id1    = 'iID_Authlist';
		$this->fk_id     = '';
		
		//
		$this->url 	   = 'privilege/privilege_setup_group_access';
		$this->view    = 'privilege/privilege_employee/v_group_access';
		$this->sort_by = 'iID_Authlist';
		$this->caption = 'Group Access List';
	}


	public function index() {
		$is_logged 	= Modules::run('login/is_logged');
		if( $is_logged ) {
			$this->load->view('privilege/v_setup');
		} else {
			echo Modules::run('login');
		}
	}

	public function output($group_and_modul='', $urut=''){	
		$this->load->view('templates/default/header');
		$this->load->view( 'privilege/inc_applications' );
		//
		$this->data = array(
				array(
						'label'  	 => 'Authlist ID',
						'name'   	 => 'iID_Authlist',
						'width'  	 => 50,
						'size'   	 => 10,
						'adv_src'	 => FALSE,
						'type'	 	 => 'text',
						'showOnGrid' => FALSE,						
						'PK'         => TRUE
				),
				array(
						'label'  => 'cNIP1',
						'name'   => 'cNIP',
						'width'  => 100,
						'size'   => 10,
						'adv_src'=> FALSE,
						'type'	 => 'text',
						'showOnGrid' => FALSE,
						'relationTo' => 'hrd.employee.cNip',
				),
				array(
						'prefix' => 'hrd',
						'table'  => 'employee',
						'label'  => 'Employee',
						'name'   => 'vName',
						'width'  => 100,
						'size'   => 10,
						'adv_src'=> FALSE,
						'type'	 => 'text',
						'showOnGrid' => false,
						'relationTo' => 'privi_authlist.cNIP',
				),
				array(
						'label'  => 'iCompanyId1',
						'name'   => 'iCompanyId',
						'width'  => 100,
						'size'   => 10,
						'adv_src'=> FALSE,
						'type'	 => 'text',
						'showOnGrid' => FALSE,
						'relationTo' => 'hrd.company.iCompanyId',
				),
				array(
						'prefix' => 'hrd',
						'table'  => 'company',
						'label'  => 'Company',
						'name'   => 'vCompName',
						'width'  => 100,
						'size'   => 10,
						'adv_src'=> FALSE,
						'type'	 => 'text',
						'showOnGrid' => TRUE,
						'relationTo' => 'privi_authlist.iCompanyId',
				),
				array(
						'label'  => 'idprivi_apps',
						'name'   => 'idprivi_apps',
						'width'  => 0,
						'size'   => 10,
						'adv_src'=> FALSE,
						'type'	 => 'text',
						'showOnGrid' => FALSE,
						'relationTo' => 'privi_apps.idprivi_apps',
				),
				array(
						'table'  => 'privi_apps',
						'label'  => 'Application',
						'name'   => 'vAppName',
						'width'  => 0,
						'size'   => 10,
						'adv_src'=> FALSE,
						'type'	 => 'text',
						'showOnGrid' => TRUE,
						'relationTo' => 'privi_authlist.idprivi_apps',
				),
				array(
						'label'  => 'idprivi_group',
						'name'   => 'idprivi_group',
						'width'  => 0,
						'size'   => 10,
						'adv_src'=> FALSE,
						'type'	 => 'text',
						'showOnGrid' => FALSE,
						'relationTo' => 'privi_group_pt_app.iID_GroupApp',
				),
				array(
						'table'  => 'privi_group_pt_app',
						'label'  => 'Group Name',
						'name'   => 'vNamaGroup',
						'width'  => 0,
						'size'   => 10,
						'adv_src'=> FALSE,
						'type'	 => 'text',
						'showOnGrid' => TRUE,
						'relationTo' => 'privi_authlist.idprivi_group',
				),
		);
		
		$group_and_modul["parent_id"] = $_GET['parent_id'];
		$urut = $_GET['urut'];
		
		$property		 = array('data'        => $this->data	
								, 'url' 	   => $this->url
								, 'pk_tbl'     => $this->table1
								, 'pk_id' 	   => $this->pk_id1
								, 'pk_db'      => $this->db_prefix
								, 'pk_prefix'  => $this->db
								, 'sort_by'    => $this->sort_by
								, 'caption'	   => $this->caption
								, 'view'	   => $this->view
								, 'adv_search' => TRUE
								, 'detail'     => TRUE
				                , 'group_and_modul' => $group_and_modul
								, 'where_condition' => $this->db_prefix.'.'.$this->table1.'.lDeleted = 0 and '.$this->db_prefix.'.privi_authlist.cNIP="'.$_GET['parent_id'].'"'
								, 'button'     => ''//$button
								, 'urut'       => $urut
							);
		
		$isi = $this->mygrid2->drawGrid($property); 
		
		echo $isi;
	}
	
	public function processForm() {
				
		$row = array();
		
		$no_urut = $_GET['no_urut'];
		
		$this->load->model('m_company');
		$this->load->model('m_position');
		$this->load->model('m_division');
		
		$row = $this->m_utilitas->getData($this->db, $this->table1, $this->pk_id1, $_GET['id']);

		$data = array(
				 array(
						'label'  => 'Authlist ID',
						'name'   => 'iID_Authlist',
						'width'  => 10,
						'size'   => 10,
						'value'  => $row['iID_Authlist'],
						'type'   => 'hidden',
						'maxlength' => 5,
						'style'  => '',
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 1,
						'required' => FALSE,
						'duplicated' => TRUE,
						'model' => '',
						'method' => '',
				),
				array(
						'label'  => 'NIP',
						'name'   => 'cNIP',
						'width'  => 220,
						'size'   => 50,
						'value'  => $_GET['parent_id'],
						//'selected'  => $row['iCompanyId'],
						'maxlength' => 50,
						'type'   => 'hidden',
						'style'  => '',
						//'values' => $this->m_company->getAllCompanys(),
						'class'  	=> 'fieldTextBox',
						//'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => TRUE,
						'duplicated' => FALSE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => 'm_employee',
						'method' => 'getNameByNIP',
				),
				array(
						'label'  => 'Company',
						'name'   => 'iCompanyId',
						'width'  => 220,
						'size'   => 50,
						'value'  => $row['iCompanyId'],
						'maxlength' => 50,
						'type'   => 'combobox',
						'style'  => '',
						'values' => $this->m_company->getAllCompanys(),
						'class'  	=> 'fieldTextBox',
						//'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => TRUE,
						'duplicated' => FALSE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => 'm_company', 
						'method' => 'getCompanyById',
				),
				array(
						'label'  => 'Application',
						'name'   => 'idprivi_apps',
						'width'  => 220,
						'size'   => 47,
						'value'  => $row['idprivi_apps'],
						'maxlength' => 50,
						'type'   => 'lookup',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => TRUE,
						'duplicated' => FALSE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => 'm_applications',
						'method' => 'getApplicationById',
				),
				array(
						'label'  => 'Group Name',
						'name'   => 'idprivi_group',
						'width'  => 220,
						'size'   => 47,
						'value'  => $row['idprivi_group'],
						'maxlength' => 50,
						'type'   => 'lookup',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => TRUE,
						'duplicated' => FALSE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => 'm_groups',
						'method' => 'getGroupById',
				),
		);
		
		//for detail
		$i = 0;		
		
		//for draw your own button :)
		$button = array (
			array (
					'id'    => 'btn_save_'.$no_urut,
					'name'  => 'btn_save'.$no_urut,
					'type'  => 'button',
					'value' => 'Save Detail',
					'content' => 'Save Detail',
					'class'  => 'btn',
					'onclick' => ''
			),
			array (
					'id'    => 'btn_cancel_'.$no_urut,
					'name'  => 'btn_cancel_'.$no_urut,
					'type'  => 'button',
					'value' => 'Back',
					'content' => 'Back',
					'class'  => 'btn',
					'onclick' => ""
			),
		);
		
		$base_url = base_url();
		$isi = '<script type="text/javascript">
					var oTable;
					$(document).ready(function() {
						$("#listapps").dataTable({
							"bJQueryUI"		 : true,
							"bSortClasses"	 : false,
							"bProcessing"	 : false,
							"bServerSide"	 : true,
							"sPaginationType": "full_numbers",
							"sAjaxSource"	 : "'.$base_url.'privilege/privilege_setup_group_access/getApplication",
							"aoColumns": [
								{"sClass": "idprivi_apps", "sTitle": "ID", "sWidth": "1%", "bVisible" : false, "mData": 0},
								{"sClass": "vAppName", "sTitle": "Application", "sWidth": "98%", "mData": 1},
								{"sClass": "action","sTitle": "Action", "bSortable": false, "bSearchable": false, "sWidth": "1%", "mData": 2
								}
							],
						});

						$("#bt_privi_authlist_idprivi_group").click(function() {									
									
							var companyId  = $("#privi_authlist_iCompanyId option:selected").val();
							var aplikasiId = $("#privi_authlist_idprivi_apps").val();

							if (companyId == "" || companyId == 0) {
								alert("Lengkapi Kode Perusahaan Anda");
								$("#privi_authlist_iCompanyId").focus();

								return false;
							}
									
							if (aplikasiId == "" || aplikasiId == 0) {
								alert("Lengkapi Kode Aplikasi Anda");
								$("#privi_authlist_idprivi_apps").focus();

								return false;
							}
									
							getGroup(companyId, aplikasiId);
							//oTable.fnDraw();		
						});
						
					});
									
					function PilihRecord(id, st) {
						var x = id.split("|");
						if (st == 1) {
							$("#privi_authlist_idprivi_apps").attr("value", x[0]);
							$("#lookup_privi_authlist_idprivi_apps").attr("value", x[1]);
									
							$( "#list_apps" ).dialog( "close" );
						} else {
							$("#privi_authlist_idprivi_group").attr("value", x[0]);
							$("#lookup_privi_authlist_idprivi_group").attr("value", x[1]);
							
							$( "#list_groups" ).dialog( "close" );
						}
					}
									
					function getGroup(companyId, aplikasiId) {
						oTable = $("#listgroups").dataTable({
							"bJQueryUI"		 : true,
							"bSortClasses"	 : false,
							"bProcessing"	 : false,
							"bServerSide"	 : true,
							"bDestroy"	     : true,
							"sPaginationType": "full_numbers",
							"sAjaxSource"	 : "'.$base_url.'privilege/privilege_setup_group_access/getGroups",
							"aoColumns": [
								{"sClass": "iID_GroupApp", "sTitle": "ID", "sWidth": "1%", "bVisible" : false, "mData": 0},
								{"sClass": "vNamaGroup", "sTitle": "Group", "sWidth": "98%", "mData": 1},
								{"sClass": "action","sTitle": "Action", "bSortable": false, "bSearchable": false, "sWidth": "1%", "mData": 2
								}
							],
							"fnServerParams" : function(aoData) {
									aoData.push(
										{"name":"companyId", "value":companyId},
										{"name":"aplikasiId", "value":aplikasiId});
									},
						});
					}
				</script>
				
				<div id="list_apps" style="display:none;">
					<table id="listapps" width="100%">
					</table>
				</div>
				<div id="list_groups" style="display:none;">
					<table id="listgroups" width="100%">
					</table>
				</div>';
		
		$optionsDtl = array(
				array(
						'title'=>'',
						'isi'=> $isi,
						'reset'=>true,
				),
		);

		$property = array( 'url' 	   => $this->url
						 , 'view' 	   => $this->view
						 , 'proc'      => $_GET['proc']
						 , 'parent_id' => $_GET['parent_id']
						 , 'param_id'  => $_GET['id']
						 , 'draw_dtl'  => true
						 , 'opt_dtl'   => $optionsDtl
					     , 'pk_id'     => $this->pk_id1						 
						 , 'table'     => $this->table1
						 , 'db'        => $this->db
						 , 'button'    => $button
						 , 'no_urut'   => 0
					);
					
		$this->myform->drawForm($data, $property);
				
	}
	
	function deleteRecord() {
		$id = $_GET['id'];
		$this->load->model('m_groups');
		$this->m_groups->delGroup($id);
		
		$this->load->model('m_modules');
		$this->m_modules->delModulesByGroupId($id); 
	}
	
	function getData() {
		$id = $_POST['id'];
		echo $id;
	}
	
	function save() {
		$sess_auth 	= new Zend_Session_Namespace('auth');
		$tCreatedAt = date('Y-m-d', mktime());
		$tUpdatedAt = date('Y-m-d H:i:s', mktime());
		$cCreatedBy = $sess_auth->gNIP;
		
		$dbset = $this->load->database($this->db, 'true');
		
		$queries = array();
		$x = '0|0';

		foreach($_POST as $p) {			
			if ($p['privi_authlist_st_update'] == 'add') {
				$SQL = "INSERT INTO privi_authlist (cNIP, iCompanyId, idprivi_apps, idprivi_group, dCreated, cCreatedBy) 
						VALUES ('".$p['privi_authlist_cNIP']."', '".$p['privi_authlist_iCompanyId']."', '".$p['privi_authlist_idprivi_apps']."',
								 '".$p['privi_authlist_idprivi_group']."', '".$tCreatedAt."', '".$cCreatedBy."')";
				try {
					$dbset->query($SQL);
					$last_id = $dbset->insert_id();
					$x = '1|'.$last_id;
				}catch(Exception $e) {
					$x = '0|0';
				}
				
				
			} else {
				$SQL = "UPDATE privi_authlist set 
						idprivi_group = '".$p['privi_authlist_idprivi_group']."', 
						tUpdated = '".$tUpdatedAt."',
						cUpdatedBy='".$cCreatedBy."' 
						where iID_Authlist = '".$p['privi_authlist_iID_Authlist']."'";
				
				try {
					$dbset->query($SQL);
					$last_id = $p['privi_authlist_iID_Authlist'];
					$x = '1|'.$last_id;
				}catch(Exception $e) {
					$x = '0|0';
				}
				
			}
			 
		}
		
		echo $x;
		
	}
	
	function getLastGroupId() {		
		$iCompanyId   = $_GET['iCompanyId'];
		$idprivi_apps = $_GET['idprivi_apps'];
		
		$last_group_id = $this->m_groups->getLastGroupId($iCompanyId, $idprivi_apps);
		
		echo $last_group_id;
	}
	
	function checkDuplicate() {		
		//'cNip='+cNip+'&companyId='+companyId+'&aplikasiId='+aplikasiId+'&groupId='+groupId,
		$cNip         = $_GET['cNip'];
		$companyId    = $_GET['companyId'];
		$aplikasiId   = $_GET['aplikasiId'];
		$groupId      = $_GET['groupId'];
		
		$last_group_id = $this->m_authlist->checkDuplicate($cNip, $companyId, $aplikasiId, $groupId);
		
		echo $last_group_id;
	}
	
	function getApplication() {
		$this->load->model('m_applications');
		$rslt = $this->m_applications->getApplicationDT();
		
		echo $rslt;
	}
	
	function getGroups() {	
		$this->load->model('m_groups');
		$rslt = $this->m_groups->getGroupsDT($_GET['companyId'], $_GET['aplikasiId']);
		
		echo $rslt;		
	}
}
?>