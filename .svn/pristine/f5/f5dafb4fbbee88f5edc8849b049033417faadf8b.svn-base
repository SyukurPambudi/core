<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Privilege_Setup_Groups extends MX_Controller {
	
	private $dbset;
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
	private $db;
	private $db_prefix;
	private $url;
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
		
		//database
		$this->db    = 'default';
		$this->dbset = $this->load->database($this->db, true);
		$this->db_prefix = $this->dbset->database;
		
		$this->table1  = 'privi_apps';
		$this->pk_id1  = 'idprivi_apps';
		$this->fk_id   = '';
		
		//
		$this->url 	   = 'privilege/privilege_setup_groups';
		$this->view    = 'privilege/privilege_setup_groups/v_applications';
		$this->sort_by = 'vAppName';
		$this->caption = 'Application List';
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
		//
		$this->data = array(
				array(
						'label'  	 => 'Application ID',
						'name'   	 => 'idprivi_apps',
						'width'  	 => 50,
						'size'   	 => 10,
						'adv_src'	 => FALSE,
						'type'	 	 => 'text',
						'showOnGrid' => FALSE,						
						'PK'         => TRUE
				),
				array(
						'label'  => 'Application Name',
						'name'   => 'vAppName',
						'width'  => 100,
						'size'   => 10,
						'adv_src'=> FALSE,
						'type'	 => 'text',
						'showOnGrid' => TRUE,
				),
				array(
						'label'  => 'Description',
						'name'   => 'txtDesc',
						'width'  => 400,
						'size'   => 10,
						'adv_src'=> FALSE,
						'type'	 => 'text',
						'showOnGrid' => TRUE
				),
		);
		
		$group_and_modul['parent_id'] = 0;
		
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
				                , 'group_and_modul' => $group_and_modul
								, 'where_condition' => $this->db_prefix.'.'.$this->table1.'.lDeleted = 0'
								, 'reset_add_button' => TRUE
							);
		
		
		$isi = $this->mygrid2->drawGrid($property);
		echo $isi;
	}
	
	public function processForm() {
		$row = array();	
		
		$this->load->model('m_company');
		$this->load->model('m_position');
		$this->load->model('m_division');
		
		$row = $this->m_utilitas->getData($this->db, $this->table1, $this->pk_id1, $_GET['id']);

		$data = array(
				array(
						'label'  => 'Application ID',
						'name'   => 'idprivi_apps',
						'width'  => 10,
						'size'   => 10,
						'value'  => $row['idprivi_apps'],
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
						'label'  => 'Application Name',
						'name'   => 'vAppName',
						'width'  => 220,
						'size'   => 50,
						'value'  => $row['vAppName'],
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
						'label'  => 'Description',
						'name'   => 'txtDesc',
						'type'   => 'textarea',
						'width'  => 220,
						'size'   => 50,
						'style'  => '',
						'rows'   => '3',
						'cols'   => '40',
						'value'  => $row['txtDesc'],
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
				
		//for draw your own button :)
		$button = array (
			array (
					'id'    => 'btn_save',
					'name'  => 'btn_save',
					'type'  => 'button',
					'value' => 'Simpan',
					'content' => 'Simpan',
					'class'  => 'btn',
					'onclick' => ''
			),
		);
		
		$group_and_modul["parent_id"] = $_GET['id'];
		//$modules =  Modules::run('privilege/privilege_setup_modules/output', $group_and_modul, 1);
		
		$optionsDtl = array(
				 array(
						'title'=>'Groups',
						'isi'=>'<iframe id="groups" src="'.base_url().'privilege/privilege_setup_groups_dtl/output?group_id='.$_GET['group_id'].'&modul_id='.$_GET['modul_id'].'&company_id='.$_GET['company_id'].'&parent_id='.$_GET['id'].'&urut=0&idprivi_apps='.$row['idprivi_apps'].'" scrolling="auto" height="400" width="100%">
								</iframe>'
				)
		);
		
		$property = array('multipart'  => FALSE
						 , 'url' 	   => $this->url
						 , 'view' 	   => $this->view
						 , 'proc'      => $_GET['proc']
						 , 'parent_id' => $_GET['id']
						 , 'param_id'  => $_GET['id']
						 , 'draw_dtl'  => true
						 , 'opt_dtl'   => $optionsDtl
					     , 'pk_id'     => $this->pk_id1
						 , 'table'     => $this->table1
						 , 'db'        => $this->db
						 , 'button'    => ''//$button
					);
		$this->myform->drawForm($data, $property);
				
	}
}
?>