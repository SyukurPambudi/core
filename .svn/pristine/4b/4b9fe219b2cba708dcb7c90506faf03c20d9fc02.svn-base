<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Personalia_Master_Struktur_Departement_GroupDept extends MX_Controller {
	
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
		
		$this->table  = 'groupdept';
		$this->pk_id  = 'igrpdeptid';
		
		//
		$this->url 	  = 'personalia/personalia_master_struktur_departement_groupdept';
		$this->view   = 'personalia/personalia_master_groupdept/v_groupdept';
		$this->sort_by= 'vDescription';
		$this->caption= 'Group Departement List';
		
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
					'name'   => 'igrpdeptid',
					'width'  => 50,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => false,						
					'PK'         => TRUE
				),
				array(
					'label'  => 'Nama Group Departemen',
					'name'   => 'vDescription',
					'width'  => 100,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => TRUE,
				),
				array(
					'label'  => 'Marketing',
					'name'   => 'lMarketing',
					'width'  => 100,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => TRUE,
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
								, 'where_condition' => $this->db_prefix.'.groupdept.lDeleted = "0"'		
							);
		
		
		$isi = $this->mygrid2->drawGrid($property);
		echo $isi;
	}
	
	public function processForm() {
		$row = array();
		//$proc = $_GET['proc'];		
		//$this->param_id = (($proc == 'add' || $proc == 'save') ? '0' : $_GET['id']);
		//$readonly = ($proc == 'view' ? '1' : '0');
		$last_id = 0;
		$no_urut = 0;//$_GET['no_urut'];
		//$db = 'hrd';
		
		$row = $this->m_utilitas->getData($this->db, $this->table, $this->pk_id, $_GET['id']);
		
		$flag = array(0=>'Tidak', 1=>'Ya');
	
		$data = array(
				array(
						'label'  => 'Kode',
						'name'   => 'igrpdeptid',
						'width'  => 10,
						'size'   => 10,
						'value'  => $row['igrpdeptid'],
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
						'label'  => 'Nama Group',
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
						'label'  => 'Marketing',
						'name'   => 'lMarketing',
						'width'  => 220,
						'size'   => 80,
						'value'  => $row['lMarketing'],
						'values' => $flag,
						'maxlength' => 50,
						'type'   => 'combobox',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => TRUE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => 'm_groupdept',
						'method' => 'getGroupDeptById2',
						'relationAt' => TRUE
				),
		);
		
		$property = array( 'url' 	 => $this->url
						 , 'view' 	 => $this->view
						 , 'proc'    => $_GET['proc']
						 , 'draw_dtl'=> false
						 , 'opt_dtl' => ''//$optionsDtl
					     , 'pk_id'   => $this->pk_id
						 , 'param_id'=> $_GET['id']
						 , 'table'   => $this->table
						 , 'parent_id' => $_GET['id']
						 , 'db'      => $this->db
						 , 'button'  => ''
					);
		
		$this->myform->drawForm($data, $property);
				
	}
	
	function getDivision() {
		$this->load->model('m_division');
		$rslt = $this->m_division->getAllDepartement();
	
		echo $rslt;
	}
}
?>