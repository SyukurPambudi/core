<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ga_master_service_jenis extends MX_Controller {
	
	private $dbset;
	private $table;
	private $data;
	private $param_id;
	
	//for header
	private $db;
	private $db_prefix;
	private $url;
	private $pk_db;
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
		
		//session
		$this->load->library('Zend', 'Zend/Session/Namespace');
		
		$this->load->library('MySession');
		$this->mysession->sess_check();
		
		//model
		$this->load->model('m_utilitas');
		
		//database
		$this->db    = 'hrd';
		$this->dbset = $this->load->database($this->db, true);
		$this->db_prefix = $this->dbset->database;
		
		$this->table  = 'ga_msservis';
		$this->pk_id  = 'id';
		
		//
		$this->url 	   = 'ga/ga_master_service_jenis';
		$this->view    = 'ga/ga_master_service_jenis/v_applications';
		$this->sort_by = 'cNama';
		$this->caption = 'Jenis Service';
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

		$service = array('S'=>'Service', 'P'=>'Part Kendaraan', 'N'=>'Non Part Kendaraan');
		//
		$this->data = array(
				array(
						'label'  	 => 'id',
						'name'   	 => 'id',
						'width'  	 => 50,
						'size'   	 => 10,
						'adv_src'	 => FALSE,
						'type'	 	 => 'text',
						'showOnGrid' => FALSE,						
						'PK'         => TRUE
				),
				array(
						'label'  => 'Jenis',
						'name'   => 'cJenis',
						'width'  => 100,
						'size'   => 10,
						'values' => $service,
						'adv_src'=> TRUE,
						'type'	 => 'combobox',
						'showOnGrid' => TRUE,
						'relationAt' => TRUE
				),
				array(
						'label'  => 'Keterangan',
						'name'   => 'cNama',
						'width'  => 400,
						'size'   => 50,
						'adv_src'=> TRUE,
						'type'	 => 'text',
						'showOnGrid' => TRUE
				),
		);
		
		$group_and_modul['parent_id'] = 0;
		
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
								, 'where_condition' => $this->db_prefix.'.'.$this->table.'.lDeleted = 0'
							);
		
		
		$isi = $this->mygrid2->drawGrid($property);
		echo $isi;
	}
	
	public function processForm() {
		$row = array();	
		
		$this->load->model('m_jenis_service');
		
		$row = $this->m_utilitas->getData($this->db, $this->table, $this->pk_id, $_GET['id']);
		
		$service = array('S'=>'Service', 'P'=>'Part Kendaraan', 'N'=>'Non Part Kendaraan');
	
		$data = array(
				array(
						'label'  => 'id',
						'name'   => 'id',
						'width'  => 10,
						'size'   => 10,
						'value'  => $row['id'],
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
						'label'  => 'Jenis',
						'name'   => 'cJenis',
						'width'  => 220,
						'size'   => 50,
						'value'  => $row['cJenis'],
						'maxlength' => 50,
						'values' => $service,
						'type'   => 'combobox',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => TRUE,
						'duplicated' => FALSE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '', 
						'method' => '',
						'relationAt' => TRUE
				),
				array(
						'label'  => 'Keterangan',
						'name'   => 'cNama',
						'type'   => 'textbox',
						'width'  => 220,
						'size'   => 50,
						'style'  => '',
						'rows'   => '3',
						'cols'   => '40',
						'value'  => $row['cNama'],
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
			
		$property = array('multipart'  => FALSE
						 , 'url' 	   => $this->url
						 , 'view' 	   => $this->view
						 , 'proc'      => $_GET['proc']
						 , 'parent_id' => $_GET['id']
						 , 'param_id'  => $_GET['id']
						 , 'draw_dtl'  => false
						 , 'opt_dtl'   => ''
					     , 'pk_id'     => $this->pk_id
						 , 'table'     => $this->table
						 , 'db'        => $this->db
						 , 'button'    => ''//$button
					);
		$this->myform->drawForm($data, $property);
				
	}
}
?>