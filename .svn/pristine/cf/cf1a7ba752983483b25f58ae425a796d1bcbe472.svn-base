<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Personalia_Master_Struktur_Departement_Division extends MX_Controller {
	
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
	private $company_id;
	
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
		$this->load->model('m_groupdept');
		
		//database
		$this->db    = 'hrd';
		$this->dbset = $this->load->database($this->db, true);
		$this->db_prefix = $this->dbset->database;
		
		$this->table  = 'departement';
		$this->pk_id  = 'iDeptID';
		
		//
		$this->url 	  = 'personalia/personalia_master_struktur_departement_division';
		$this->view   = 'personalia/personalia_master_division/v_division';
		$this->sort_by= 'vDescription';
		$this->caption= 'Division List';
		
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
					'label'  => 'Kode',
					'name'   => 'iDeptID',
					'width'  => 50,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => false,						
					'PK'         => TRUE
				),
				array(
					'label'  => 'igrpdeptid',
					'name'   => 'igrpdeptid',
					'width'  => 100,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => FALSE,
					'relationTo' => 'groupdept.igrpdeptid'
				),
				array(
					'label'  => 'Group Dept',
					'name'   => 'vDescription',
					'width'  => 20,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => TRUE,
					'relationTo' => 'departement.igrpdeptid'
				),
				array(
					'label'  => 'Nama Divisi',
					'name'   => 'vDescription',
					'width'  => 20,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => TRUE
				),
				array(
					'label'  => 'Abbreviation',
					'name'   => 'vAbbreviation',
					'width'  => 20,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => TRUE
				),
				array(
					'label'  => 'cNipDept',
					'name'   => 'cNipDept',
					'width'  => 200,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => FALSE,
					'relationTo' => 'employee.cNip'
				),
				array(
					'table'  => 'employee',
					'label'  => 'Kepala Divisi',
					'name'   => 'vName',
					'width'  => 100,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => TRUE,
					'relationTo' => 'departement.cNipDept'
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
								, 'where_condition' => $this->db_prefix.'.departement.lDeleted = "0"'		
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
		
		$row = $this->m_utilitas->getData($this->db, $this->table, $this->pk_id, $_GET['id']);
	
		$data = array(
				array(
						'label'  => 'Kode Divisi',
						'name'   => 'iDeptID',
						'width'  => 10,
						'size'   => 10,
						'value'  => $row['iDeptID'],
						'type'   => 'label',
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
						'label'  => 'Group Departemen',
						'name'   => 'igrpdeptid',
						'width'  => 220,
						'size'   => 80,
						'value'  => $row['igrpdeptid'],
						'values' => $this->m_groupdept->getAllGroups(),
						'maxlength' => 50,
						'type'   => 'combobox',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => TRUE,
						'duplicated' => FALSE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => 'm_groupdept',
						'method' => 'getGroupDeptById',
				),
				array(
						'label'  => 'Nama Divisi',
						'name'   => 'vDescription',
						'width'  => 220,
						'size'   => 80,
						'value'  => $row['vDescription'],
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
						'label'  => 'Kepala Divisi',
						'name'   => 'cNipDept',
						'width'  => 220,
						'size'   => 80,
						'value'  => $row['cNipDept'],
						'maxlength' => 50,
						'type'   => 'lookup',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => TRUE,
						'duplicated' => FALSE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => 'm_employee', 
						'method' => 'getNameByNIP'
				),
				array(
						'label'  => 'Abbreviation',
						'name'   => 'vAbbreviation',
						'width'  => 50,
						'size'   => 30,
						'value'  => $row['vAbbreviation'],
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
							"sAjaxSource"	 : "'.$base_url.'personalia/personalia_master_struktur_departement_division/getEmployee",
							"aoColumns": [
								{"sClass": "cNip", "sTitle": "NIP", "sWidth": "1%", "bVisible" : true, "mData": 0},
								{"sClass": "vName", "sTitle": "Nama Employee", "sWidth": "98%", "mData": 1},
								{"sClass": "action","sTitle": "Action", "bSortable": false, "bSearchable": false, "sWidth": "1%", "mData": 2
								}
							],
						});
									
						$("#bt_departement_cNipDept").live("click", function() {
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
							$("#departement_cNipDept").attr("value", x[0]);
							$("#lookup_departement_cNipDept").attr("value", x[0]+" - "+x[1]);

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
		
		$property = array( 'url' 	 => $this->url
						 , 'view' 	 => $this->view
						 , 'proc'    => $_GET['proc']
						 , 'draw_dtl'=> true
						 , 'opt_dtl' => $optionsDtl
					     , 'pk_id'   => $this->pk_id
						 , 'param_id'=> $_GET['id']
						 , 'table'   => $this->table
						 , 'parent_id' => $_GET['proc']
						 , 'db'      => $this->db
						 , 'button'  => ''
					);
		$this->myform->drawForm($data, $property);
				
	}
	
	function getEmployee() {
		$this->load->model('m_employee');
		$rslt = $this->m_employee->getAllEmployee();
	
		echo $rslt;
	}
}
?>