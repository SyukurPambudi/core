<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Personalia_Master_Employee extends MX_Controller {
	
	private $table;
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
	private $db;
	private $db_prefix;	
	private $url;
	private $pk_id;
	private $sort_by;
	private $caption;
	private $view;
	
	//for detail
	private $optionsDtl;
	private $controllerDtl;
	private $viewDtl;
	private $sortByDtl;
	private $titleDtl;
	
	
	public function __construct() {
		parent::__construct();
		$this->load->library('MyTemplate');
		$this->load->library('MyGrid2');
		$this->load->library('MyForm');
		$this->load->helper('jqgrid_helper');
		$this->load->helper('url_helper');
		
		//session
		$this->load->library('Zend', 'Zend/Session/Namespace');
		
		$this->load->library('MySession');
		$this->mysession->sess_check();
		
		//model
		$this->load->model('m_utilitas');
		$this->load->model('m_division');
		
		//database
		$this->db    = 'hrd';
		$this->dbset = $this->load->database($this->db, true);
		$this->db_prefix = $this->dbset->database;
		
		$this->table  = 'employee';
		$this->pk_id  = 'cNip';
		
		//
		$this->url 	  = 'personalia/personalia_master_employee';
		$this->view   = 'personalia/personalia_master_employee/v_employee';
		$this->sort_by= 'vName';
		$this->caption= 'Employee List';
		
	}


	public function index() {
		$is_logged 	= Modules::run('login/is_logged');
		if( $is_logged ) {
			$this->load->view('privilege/v_setup');
		} else {
			echo Modules::run('login');
		}
	}

	public function output(){
		$this->load->view( 'privilege/inc_applications' );
		
		$this->data = array(
				array(
					'label'  => 'NIP',
					'name'   => 'cNip',
					'width'  => 50,
					'size'   => 10,
					'adv_src'=> TRUE,
					'type'	 => 'text',
					'showOnGrid' => TRUE,						
					'PK'         => TRUE
				),
				array(
					'label'  => 'Employee Name',
					'name'   => 'vName',
					'width'  => 200,
					'size'   => 80,
					'adv_src'=> TRUE,
					'type'	 => 'text',
					'showOnGrid' => TRUE
				),
				array(
					'label'  => 'iDeptID',
					'name'   => 'iDeptID',
					'width'  => 150,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => false,
					'relationTo' => 'departement.iDeptID',
				),
				array(
					'table'      => 'departement',
					'label'  => 'Division',
					'name'   => 'vDescription',
					'width'  => 150,
					'size'   => 50,
					'adv_src'=> TRUE,
					'type'	 => 'text',
					'showOnGrid' => TRUE,
					'relationTo' => 'employee.iDeptID',
				),
				array(
					'label'  => 'iPostID',
					'name'   => 'iPostID',
					'width'  => 150,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => false,
					'relationTo' => 'position.iPostID',
				),
				array(
					'table'      => 'position',
					'label'  => 'Position',
					'name'   => 'vDescription',
					'width'  => 150,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => TRUE,
					'relationTo' => 'employee.iPostID',
				),
				array(
					'label'  => 'iCompanyID',
					'name'   => 'iCompanyID',
					'width'  => 150,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => FALSE,
					'relationTo' => 'company.iCompanyID',
				),
				array(
					'table'      => 'company',
					'label'  => 'Company',
					'name'   => 'vCompName',
					'width'  => 150,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => TRUE,
					'relationTo' => 'employee.iCompanyID',
				),
				array(
					'label'  => 'Upper',
					'name'   => 'cUpper',
					'width'  => 100,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => TRUE
				),
				array(
					'table'  => 'employee',
					'label'  => 'Status Karyawan',
					'name'   => 'cFlag',
					'width'  => 100,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => FALSE,
					'relationAt' => TRUE
				),
		);

		$group_and_modul["parent_id"] = 0;
		
		$property		 = array('data'        => $this->data 
								, 'url' 	   => $this->url
								, 'pk_tbl'     => $this->table
								, 'pk_id' 	   => $this->pk_id
								, 'pk_db'      => $this->db_prefix
								, 'pk_prefix'  => $this->db
								, 'sort_by'    => $this->sort_by
								, 'caption'	   => $this->caption
								, 'view'	   => $this->view
								, 'adv_search' => TRUE 
								, 'group_and_modul' => $group_and_modul
								//, 'where_condition' => '`hrd`.`employee`.`cNIP` = "N06081"'		
							);
		
		
		$isi = $this->mygrid2->drawGrid($property);
		echo $isi;
	}
	
	public function processForm() {
		$row = array();
		//$proc = $_GET['proc'];		
		//$this->param_id = (($proc == 'add' || $proc == 'save') ? '0' : $_GET['id']);
		//$readonly = ($proc == 'view' ? '1' : '0');
		//$last_id = 0;
		$no_urut = 0;//$_GET['no_urut'];
		//$db = 'hrd';
		
		$this->load->model('m_company');
		$this->load->model('m_position');
		$this->load->model('m_division');
		
		$row = $this->m_utilitas->getData($this->db, $this->table, $this->pk_id, $_GET['id']);
		
		$flag = array('A'=>'Aktif', 'C'=>'Cuti', 'O'=>'Off');
	
		$data = array(
				array(
						'required' => 0,
						'name'   => 'image',
						'duplicated' => 0,
						'type'   => 'free',
						'object' => '
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td align="right" rowspan="4">
										<img src="'.base_url().$this->getImage("./files/personalia/personalia_master_employee/".$_GET['id']."/").'" alt="'.$_GET['id'].'"/>
									</td>
								</tr>
							</table>
						'
				),
				array(
						'label'  => 'NIP',
						'name'   => 'cNip',
						'width'  => 10,
						'size'   => 10,
						'value'  => $row['cNip'],
						'type'   => 'textbox',
						'maxlength' => 5,
						'style'  => '',
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 1,
						'required' => TRUE,
						'duplicated' => TRUE,
						'model' => '',
						'method' => '',
				),
				array(
						'label'  => 'Nama',
						'name'   => 'vName',
						'width'  => 220,
						'size'   => 80,
						'value'  => $row['vName'],
						'maxlength' => 50,
						'type'   => 'textbox',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => TRUE,
						'duplicated' => FALSE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => '',
				),
				array(
						'label'  => 'Company',
						'name'   => 'iCompanyID',
						'type'   => 'combobox',
						'width'  => 220,
						'size'   => 50,
						'style'  => '',
						'values' => $this->m_company->getAllCompanys(),
						'value'  => $row['iCompanyID'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => TRUE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => 'm_company',
						'method' => 'getCompanyById'
				),
				array(
						'label'  => 'Divisi',
						'name'   => 'iDeptID',
						'type'   => 'combobox',
						'width'  => 220,
						'size'   => 50,
						'style'  => '',
						'values' => $this->m_division->getAllDepartements(),
						'value'  => $row['iDeptID'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => TRUE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => 'm_division', 
						'method' => 'getDepartementById'
				),
				
				array(
						'label'  => 'Posisi',
						'name'   => 'iPostID',
						'type'   => 'combobox',
						'width'  => 220,
						'size'   => 50,
						'style'  => '',
						'values' => $this->m_position->getAllPositions(),
						'value' => $row['iPostID'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => TRUE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => 'm_position', 
						'method' => 'getPositionById'
				),
				array(
						'label'  => 'Atasan YBS',
						'name'   => 'cUpper',
						'type'   => 'lookup',
						'width'  => 220,
						'size'   => 50,
						'style'  => '',
						'value'  => $row['cUpper'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,//($proc == 'edit' ? 1 : 0),
						'required' => TRUE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => 'm_employee', 
						'method' => 'getNameByNIP'
				),
				array(
						'label'  => 'Tgl. Lahir',
						'name'   => 'dBirthday',
						'type'   => 'date',
						'width'  => 220,
						'size'   => 12,
						'style'  => '',
						'value'  => date('d-m-Y', strtotime($row['dBirthday'])),
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,//($proc == 'edit' ? 1 : 0),
						'required' => TRUE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => ''
				),				
				array(
						'label'  => 'Status Karyawan',
						'name'   => 'cFlag',
						'width'  => 220,
						'size'   => 80,
						'value'  => $row['cFlag'],
						'values' => $flag,
						'maxlength' => 50,
						'type'   => 'combobox',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => TRUE,
						'duplicated' => FALSE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => 'm_employee',
						'method' => 'getStatusKaryawanById',
						'relationAt' => TRUE
				),
				array(
						'label'  => 'File',
						'name'   => 'tAttachment',
						'type'   => 'file',
						'width'  => 100,
						'size'   => 15,
						'style'  => '',
						'value'  => '',
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => TRUE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => ''
				),
		);
		
		$base_url = base_url();
		$isi = '<script type="text/javascript">
					var oTable;
					$(document).ready(function() {		
						$("#list'.$this->table.'").dataTable({
							"bJQueryUI"		 : true,
							"bSortClasses"	 : false,
							"bProcessing"	 : false,
							"bServerSide"	 : true,
							"sPaginationType": "full_numbers",
							"sAjaxSource"	 : "'.$base_url.'personalia/personalia_master_employee/getEmployee",
							"aoColumns": [
								{"sClass": "cNip", "sTitle": "NIP", "sWidth": "1%", "bVisible" : true, "mData": 0},
								{"sClass": "vName", "sTitle": "Nama Employee", "sWidth": "98%", "mData": 1},
								{"sClass": "action","sTitle": "Action", "bSortable": false, "bSearchable": false, "sWidth": "1%", "mData": 2
								}
							],
						});
									
						$("#bt_employee_cUpper").live("click", function() {
							 $( "#list_'.$this->table.'" ).dialog({
								height: "auto",
								width: "auto",
								modal: true,
								title: "Employee",
							 });
						});
					});
					
					function PilihRecord(id, st) {
						var x = id.split("|");
						if (st == 1) {
							$("#employee_cUpper").attr("value", x[0]);
							$("#lookup_employee_cUpper").attr("value", x[0]+" - "+x[1]);

							$( "#list_'.$this->table.'" ).parent().html("");
							$( "#list_'.$this->table.'" ).dialog( "close" );							
						} 
					}
									
				</script>
		
				<div id="list_'.$this->table.'" style="display:none;">
					<table id="list'.$this->table.'" width="100%">
					</table>
				</div>';
		
		$optionsDtl = array(
				array(
						'title'=>'',
						'isi'=> $isi,
						'reset'=>true,
				),
		);
		
		//for draw your own button :)
		$button = array (				
			array (
					'id'    => 'btn_save_1',
					'name'  => 'btn_save_1',
					'type'  => 'button',
					'value' => 'Simpan',
					'content' => 'Simpan',							
					'class'  => 'btn',
					'onclick' => ''
				  ),
			array (
					'id'    => 'btn_cancel_1',
					'name'  => 'btn_cancel_1',
					'type'  => 'button',
					'value' => 'Cancel',
					'content' => 'Cancel',							
					'class'  => 'btn',
					'onclick' => ''
				  ),
		);
		
		$property = array( 'url' 	 => $this->url
						 , 'view' 	 => $this->view
						 , 'proc'    => $_GET['proc']
						 , 'draw_dtl'=> true
						 , 'opt_dtl' => $optionsDtl
					     , 'pk_id'   => $this->pk_id
						 , 'param_id'=> $_GET['id']
						 , 'table'   => $this->table
						 , 'parent_id' => $_GET['id']
						 , 'db'      => $this->db
						 , 'button'  => ''//$button
					);
		$this->myform->drawForm($data, $property);
				
	}
	
	function save_employee() {
		$employee_cNip = $_POST['employee_cNip'];
		$groups        = explode(',', $_POST['groups']);
		$apps          = explode(',', $_POST['apps']);	
		$dbset = $this->load->database('default', 'true');
		$sess_auth 	= new Zend_Session_Namespace('auth');
		$nip = $sess_auth->gNIP;
		$companyId = $sess_auth->gComId;
		$today = date('Y-m-d H:i:s', mktime());
		$date  = date('Y-m-d', mktime());
		$SQL_QUERY = array();
				
		foreach($apps as $i=>$p) {
			$SQL = "SELECT iID_Authlist FROM privi_authlist WHERE cNIP = '{$employee_cNip}' AND idprivi_apps = '{$p}' AND idprivi_group='".$groups[$i]."'";				
			$result = $dbset->query($SQL);
			if($result->num_rows() > 0) {
				foreach ($result->result() as $row)
				{					
					$SQL_QUERY[] = "UPDATE privi_authlist set idprivi_group = '{$groups[$i]}', tUpdated = '{$today}', cUpdatedBy = '{$nip}' where iID_Authlist = '{$row->iID_Authlist}'";					
				}				 
			} else {
				$SQL_QUERY[] = "INSERT INTO privi_authlist (cNIP, iCompanyId, idprivi_apps, idprivi_group, dCreated, cCreatedBy) 
								VALUES ('{$employee_cNip}', '{$companyId}', '{$p}', '{$groups[$i]}', '{$date}', '{$nip}')";
				$SQL_QUERY[] = "UPDATE privi_authlist set lDeleted = '1', cUpdatedBy = '{$nip}'
				where cNIP = '{$employee_cNip}' AND idprivi_group != '{$groups[$i]}'
				AND idprivi_apps = '{$p}'";
			}			
		}
		
		foreach($SQL_QUERY as $Q) {
			try {
				$dbset->query($Q);						
				echo 1;
			}catch(Exception $e) {
				echo 0;
				die ('Error : '.$e);				
			}
		}
	}
	
	function getImage($dir) {
		$images = glob($dir . "*.*");
		if (sizeOf($images) > 0) {
			return $images[0];
		} else return '';
	}
	
	function getEmployee() {
		$this->load->model('m_employee');
		$rslt = $this->m_employee->getAllEmployee();
	
		echo $rslt;
	}

}
?>