<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Change_password extends MX_Controller {
	
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
		
		$this->table  = 'employee';
		$this->model  = 'm_employee';
		$this->method = 'getAllEmployee';
		$this->pk_id  = 'cNip';
		
		//
		$this->url 	  = 'system/change_password';
		$this->view   = 'system/v_change_password';
		$this->sort_by= 'vName';
		$this->caption= 'User List';
		
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
					'prefix'     => 'hrd',
					'table'      => 'employee',
					'label'  => 'NIP',
					'name'   => 'cNip',
					'width'  => 50,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => TRUE,						
					'PK'         => TRUE
				),
				array(
				'prefix'     => 'hrd',
					'table'      => 'employee',
					'label'  => 'Nama',
					'name'   => 'vName',
					'width'  => 200,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => TRUE
				),
				array(
				'prefix'     => 'hrd',
					'table'      => 'employee',
					'label'  => 'iDeptID',
					'name'   => 'iDeptID',
					'width'  => 150,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => false,
					'relationTo' => 'hrd.departement.iDeptID',
				),
				array(
					'prefix'     => 'hrd',
					'table'      => 'departement',
					'label'  => 'Divisi',
					'name'   => 'vDescription',
					'width'  => 150,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => TRUE,
					'relationTo' => 'hrd.employee.iDeptID',
				),
				array(
					'prefix'     => 'hrd',
					'table'      => 'employee',
					'label'  => 'iPostID',
					'name'   => 'iPostID',
					'width'  => 150,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => false,
					'relationTo' => 'hrd.position.iPostID',
				),
				array(
					'prefix'     => 'hrd',
					'table'      => 'position',
					'label'  => 'Posisi',
					'name'   => 'vDescription',
					'width'  => 150,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => TRUE,
					'relationTo' => 'hrd.employee.iPostID',
				),
				array(
				'prefix'     => 'hrd',
					'table'      => 'employee',
					'label'  => 'iCompanyID',
					'name'   => 'iCompanyID',
					'width'  => 150,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => FALSE,
					'relationTo' => 'hrd.company.iCompanyID',
				),
				array(
					'prefix'     => 'hrd',
					'table'      => 'company',
					'label'  => 'Company',
					'name'   => 'vCompName',
					'width'  => 150,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => TRUE,
					'relationTo' => 'hrd.employee.iCompanyID',
				),
				array(
					'prefix'     => 'hrd',
					'table'  => 'employee',
					'label'  => 'NIP Atasan',
					'name'   => 'cUpper',
					'width'  => 100,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => TRUE
				),
		);
		
		$this->f_columns = $this->mygrid2->getColumnsForGrid($this->data);	
		
		$this->group_id  = $_GET['group'];
		$this->module_id = $_GET['modul'];
		
		$group_and_modul = array("group_id" => $this->group_id , "module_id" => $this->module_id, "parent_id"=>0);
		
		$property		 = array('data'        => $this->data 
								, 'url' 	   => $this->url
								, 'pk_tbl'     => $this->table
								, 'pk_id' 	   => $this->pk_id
								, 'pk_db'      => 'hrd'
								, 'sort_by'    => $this->sort_by
								, 'caption'	   => $this->caption
								, 'view'	   => $this->view
								, 'adv_search' => TRUE 
								, 'group_and_modul' => $group_and_modul
								, 'where_condition' => '`hrd`.`employee`.`cNIP` = "N06081"'		
							);
		
		
		$isi = $this->mygrid2->drawGrid($property);
		echo $isi;
	}
	
	public function processForm() {
		echo 'hore';
		exit();
		$row = array();
		$proc = $_GET['proc'];		
		$this->param_id = (($proc == 'add' || $proc == 'save') ? '0' : $_GET['id']);
		$readonly = ($proc == 'view' ? '1' : '0');
		$last_id = 0;
		$no_urut = $_GET['no_urut'];
		$db = 'hrd';
		
		$this->load->model('m_company');
		$this->load->model('m_position');
		$this->load->model('m_division');
		
		$row = $this->m_utilitas->getData($db, $this->table, $this->pk_id, $this->param_id);
	
		$data = array(
				array(
						'label'  => 'NIP',
						'name'   => 'cNip',
						'width'  => 10,
						'size'   => 10,
						'value'  => $row['cNip'],
						'type'   => 'label',
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
						'label'  => 'Nama',
						'name'   => 'vName',
						'width'  => 220,
						'size'   => 80,
						'value'  => $row['vName'],
						'maxlength' => 50,
						'type'   => 'label',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 1,
						'required' => TRUE,
						'duplicated' => FALSE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '', 
						'method' => '',
				),
				array(
						'label'  => 'Divisi',
						'name'   => 'iDeptID',
						'type'   => 'label',
						'width'  => 220,
						'size'   => 50,
						'style'  => '',
						'value'  => $row['iDeptID'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 1,
						'required' => TRUE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => 'm_division', 
						'method' => 'getDepartementById'
				),
				
				array(
						'label'  => 'Posisi',
						'name'   => 'iPostID',
						'type'   => 'label',
						'width'  => 220,
						'size'   => 50,
						'style'  => '',
						'value'  => $row['iPostID'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 1,
						'required' => TRUE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => 'm_position', 
						'method' => 'getPositionById'
				),

				array(
						'label'  => 'Company',
						'name'   => 'iCompanyID',
						'type'   => 'label',
						'width'  => 220,
						'size'   => 50,
						'style'  => '',
						'value'  => $row['iCompanyID'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 1,
						'required' => TRUE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => 'm_company', 
						'method' => 'getCompanyById'
				),

				array(
						'label'  => 'NIP Atasan',
						'name'   => 'cUpper',
						'type'   => 'label',
						'width'  => 220,
						'size'   => 50,
						'style'  => '',
						'value'  => $row['cUpper'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 1,//($proc == 'edit' ? 1 : 0),
						'required' => TRUE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => 'm_employee', 
						'method' => 'getNameByNIP'
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
		 
		//print_r($draw_dtl);
		//$param = array(), $id_header, $url, $pk_id, $sort_by, $caption, $view, $urut, $group_and_modul
		$property = array( 'url' 	 => $this->url
						 , 'view' 	 => $this->view
						 , 'proc'    => $proc
						 , 'draw_dtl'=> false
						 , 'opt_dtl' => ''
					     , 'pk_id'   => $this->pk_id
						 , 'param_id'=> $this->param_id
						 , 'table'   => $this->table
						 , 'parent_id' => $this->param_id
						 , 'db'      => $db
						 , 'button'  => ''//$button
					);
		$group_and_modul = array("group_id" => $_GET['group'], "module_id" => $_GET['modul'], "parent_id" => $this->param_id);
		$this->myform->drawForm($data, $property, $group_and_modul);
				
	}

}
?>