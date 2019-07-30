<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class System_log extends MX_Controller {
	
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
	private $dbset;
	private $db_prefix;
	private $url;
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
		
		$this->table1  = 'privi_session_log';
		$this->pk_id1  = 'idprivi_session_hist';
		$this->fk_id   = '';
		
		//
		$this->url 	   = 'privilege/system_log';
		$this->view    = 'privilege/system_log/v_log';
		$this->sort_by = 'dLogoutAt';
		$this->caption = 'Session Log';
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
		$this->data = array(
				array(
						'label'  	 => 'Log_ID',
						'name'   	 => 'idprivi_session_hist',
						'width'  	 => 50,
						'size'   	 => 10,
						'adv_src'	 => FALSE,
						'type'	 	 => 'text',
						'showOnGrid' => FALSE,						
						'PK'         => TRUE
				),
				array(
						'label'  	 => 'NIP',
						'name'   	 => 'cNIP',
						'width'  	 => 100,
						'size'   	 => 10,
						'adv_src'	 => FALSE,
						'type'	 	 => 'text',
						'showOnGrid' => TRUE,
						'relationTo' => 'hrd.employee.cNIP',
				),
				array(
						'prefix'	 => 'hrd',
						'table'  	 => 'employee',
						'label'  	 => 'Employee Name',
						'name'   	 => 'vName',
						'width'  	 => 400,
						'size'   	 => 10,
						'adv_src'	 => FALSE,
						'type'	 	 => 'text',
						'showOnGrid' => TRUE,
						'relationTo' => 'privi_session_log.cNIP',
				),
				array(
						'table'  	 => 'privi_session_log',
						'label'  	 => 'CompanyId',
						'name'   	 => 'iCompanyId',
						'width'  	 => 450,
						'size'   	 => 10,
						'adv_src'	 => FALSE,
						'type'	 	 => 'text',
						'showOnGrid' => FALSE,
						'relationTo' => 'hrd.company.iCompanyId',
				),
				array(
						'prefix'     => 'hrd',
						'table'  	 => 'company',
						'label'  	 => 'Company',
						'name'   	 => 'vCompName',
						'width'  	 => 450,
						'size'   	 => 10,
						'adv_src'	 => FALSE,
						'type'	 	 => 'text',
						'showOnGrid' => TRUE,
						'relationTo' => 'privi_session_log.iCompanyId',
				),
				array(
						'label'  	 => 'Login At',
						'name'  	 => 'dLoginAt',
						'width' 	 => 150,
						'size'  	 => 10,
						'adv_src'	 => FALSE,
						'type'	 	 => 'text',
						'showOnGrid' => TRUE,
						//'relationTo' => 'erp_privi.privi_apps.idprivi_apps',
				),
				array(
						'label'  	 => 'Logout At',
						'name'  	 => 'dLogoutAt',
						'width' 	 => 150,
						'size'  	 => 10,
						'adv_src'	 => FALSE,
						'type'	 	 => 'text',
						'showOnGrid' => TRUE,
						//'relationTo' => 'erp_privi.privi_authlist.idprivi_apps',
				),
				array(
						'label'  	 => 'IP',
						'name'  	 => 'vIPSource',
						'width' 	 => 150,
						'size'  	 => 10,
						'adv_src'	 => FALSE,
						'type'	 	 => 'text',
						'showOnGrid' => TRUE
				),
		);
		
		$group_and_modul["parent_id"] = 0;
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
							);
		$custom_delete 	= array(
								'custom_delete'		  => TRUE,
								'custom_confirm'	  => 'Kick from application',
								'custom_function'	  => 'doKickNow'
							);
	 	$property = array_merge($property, $custom_delete);
		
		$isi = $this->mygrid2->drawGrid($property);
	 	echo $isi;
	}

	public function processForm() {
		$row 		= array();		
		
		$this->load->model('m_company');
		$this->load->model('m_position');
		$this->load->model('m_division');
		
		$row = $this->m_utilitas->getData($this->db, 'privi_session_log', 'idprivi_session_hist', $_GET['id']);
		
		$data = array(
				array(
						'label'  	=> 'Log ID',
						'name'   	=> 'idprivi_session_hist',
						'width'  	=> 10,
						'size'   	=> 10,
						'value'  	=> $row['idprivi_session_hist'],
						'type'   	=> 'label',
						'maxlength' => 5,
						'style'  	=> '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 1,
						'required' 	=> FALSE,
						'duplicated'=> TRUE,
						'model' 	=> '',
						'method' 	=> '',
				),
				array(
						'label'  	=> 'NIP',
						'name'   	=> 'cNip',
						'width'  	=> 100,
						'size'   	=> 15,
						'value'  	=> $row['cNip'],
						'maxlength' => 50,
						'type'   	=> 'textbox',
						'style'  	=> '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' 	=> TRUE,
						'duplicated'=> FALSE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '', 
						'method' => '',
				),
				array(
						'label'  => 'Company',
						'name'   => 'iCompanyId',
						'type'   => 'textbox',
						'width'  => 100,
						'size'   => 15,
						'style'  => '',
						'value'  => $row['iCompanyId'],
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
						'label'  => 'Upload File',
						'name'   => 'upload_file',
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
		
		$property = array( 'url' 	   => $this->url
						 , 'form_type' => 'file'
						 , 'view' 	   => $this->view
						 , 'proc'      => $_GET['proc']
						 , 'draw_dtl'  => false
						 , 'opt_dtl'   => ''
					     , 'pk_id'     => $this->pk_id1
						 , 'param_id'  => $_GET['id']
						 , 'parent_id' => ''
						 , 'table'     => $this->table1
						 , 'db'      => $this->db //default
						 , 'button'    => ''
						 
					);
					
		$this->myform->drawForm($data, $property);
			
		$this->load->view( 'authlist/inc_authlist' );
	}
	
	
	
	function doKickNow(){
		$sess_auth = new Zend_Session_Namespace('auth');
		
		$field1  = 'vSessionID';
		$value1  = $this->generateRandomString();
		
		$field2  = 'dLogoutAt';
		$value2  = date('Y-m-d H:i:s');
		
		$field3  = 'tUpdatedAt';
		$value3  = date('Y-m-d H:i:s');
		
		$field4  = 'cUpdatedBy';
		$value4  = $sess_auth->gNIP;
		 
	 	$pktbl  = $_GET['pk_tbl'];
		$pkid   = $_GET['pk_id'];
		$pkdb   = $_GET['pk_db'];
		
		if ($pkdb == 'erp_privi') $pkdb = 'default';
		//DELETE QUERY
		try {
			$db_set = $this->load->database($pkdb, 'true');
			$param_id = $_GET['id'];
				
			$datax = array($field1 => $value1, $field2 => $value2, $field3 => $value3, $field4 => $value4);
		 	$db_set->where($pkid, $param_id);
			$db_set->update($pktbl, $datax);
		
			$x = 1;
		}catch(Exception $e) {
			$x = 0;
		}	
		echo $x;
	}
	
	function generateRandomString($length = 26) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}

}
?>