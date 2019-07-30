<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Privilege_Setup_modules extends MX_Controller {
	
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
	private $dbset;
	private $db_prefix;
	private $pk_db;
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
		$this->load->model('m_modules');
		
		//database
		$this->db    = 'default';
		$this->dbset = $this->load->database($this->db, true);
		$this->db_prefix = $this->dbset->database;
		
		$this->table  = 'privi_modules';
		$this->model  = 'm_modules';
		$this->method = 'getAllModules';
		$this->pk_id  = 'idprivi_modules';
		
		//
		$this->url 	  = 'privilege/privilege_setup_modules';
		$this->view   = 'privilege/privilege_setup_modules/v_modules';
		$this->sort_by= 'vNameModule';
		$this->caption= 'Modules List';
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
		
		$urut = $_GET['urut'];
		
		//echo 'urut : '.$urut;
		
		$this->data = array(
						array(
							'label'  => 'Modules ID',
							'name'   => 'idprivi_modules',
							'width'  => 2,
							'size'   => 10,
							'adv_src'=> FALSE,
							'type'	 => 'text',
							'showOnGrid' => true,
							'PK'         => TRUE
						),
						array(
							'label'  => 'App ID',
							'name'   => 'idprivi_apps',
							'width'  => 2,
							'size'   => 10,
							'adv_src'=> FALSE,
							'type'	 => 'text',
							'showOnGrid' => false,
							'relationTo' => 'privi_apps.idprivi_apps',
						),
						array(
							'table'  => 'privi_apps',
							'label'  => 'Application',
							'name'   => 'vAppName',
							'width'  => 10,
							'size'   => 10,
							'adv_src'=> FALSE,
							'type'	 => 'text',
							'showOnGrid' => true,
							'relationTo' => 'privi_modules.idprivi_apps',
						),
						array(
							'label'  => 'Module Code',
							'name'   => 'vCodeModule',
							'width'  => 20,
							'size'   => 10,
							'adv_src'=> FALSE,
							'type'	 => 'text',
							'showOnGrid' => TRUE
						),
						array(
							'label'  => 'Module Name',
							'name'   => 'vNameModule',
							'width'  => 30,
							'size'   => 10,
							'adv_src'=> FALSE,
							'type'	 => 'text',
							'showOnGrid' => TRUE
						),
						array(
							'label'  => 'Module Path',
							'name'   => 'vPathModule',
							'width'  => 10,
							'size'   => 10,
							'adv_src'=> FALSE,
							'type'	 => 'text',
							'showOnGrid' => TRUE
						),
						array(
							'label'  => 'ParentId',
							'name'   => 'iParent',
							'width'  => 1,
							'size'   => 10,
							'adv_src'=> FALSE,
							'type'	 => 'text',
							'showOnGrid' => false
						),
						array(
							'label'  => 'Description',
							'name'   => 'txtDesc',
							'width'  => 20,
							'size'   => 10,
							'adv_src'=> FALSE,
							'type'	 => 'text',
							'showOnGrid' => TRUE
						),
						array(
							'label'  => 'Created At',
							'name'   => 'dCreated',
							'width'  => 0,
							'size'   => 10,
							'adv_src'=> FALSE,
							'type'	 => 'date',
							'showOnGrid' => FALSE
						),
						array(
							'label'  => 'Created By',
							'name'   => 'cCreatedBy',
							'width'  => 0,
							'size'   => 10,
							'adv_src'=> FALSE,
							'type'	 => 'date',
							'showOnGrid' => FALSE
						),
						array(
							'label'  => 'Updated At',
							'name'   => 'tUpdated',
							'width'  => 0,
							'size'   => 10,
							'adv_src'=> FALSE,
							'type'	 => 'date',
							'showOnGrid' => FALSE
						),
						array(
							'label'  => 'Updated By',
							'name'   => 'cUpdatedBy',
							'width'  => 0,
							'size'   => 10,
							'adv_src'=> FALSE,
							'type'	 => 'date',
							'showOnGrid' => FALSE
						),
						array(
							'label'  => 'Record Status',
							'name'   => 'lDeleted',
							'width'  => 0,
							'size'   => 10,
							'adv_src'=> FALSE,
							'type'	 => 'date',
							'showOnGrid' => FALSE
						),
				);
		
		//$group_and_modul['parent_id'] = $group_and_modul['parent_id'];
		
		$button = array (
			array (
					'id'    => 'btn_add_detail_'.$_GET['modul_id'].$urut,
					'name'  => 'btn_add_detail_'.$_GET['modul_id'].$urut,
					'type'  => 'button',
					'value' => 'Add New Record',
					'content' => 'Add New Record',
					'class'  => 'btn',
					'onclick' => 'addRecord_'.$_GET['modul_id'].$urut.'()',
			),
		);
		
		$group_and_modul["parent_id"] = $_GET['parent_id'];
		
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
								, 'detail'     => TRUE
				                , 'group_and_modul' => $group_and_modul
								, 'where_condition' => $this->db_prefix.'.'.$this->table.'.lDeleted = 0 and '.$this->db_prefix.'.privi_modules.idprivi_apps="'.$_GET['parent_id'].'"'
								, 'button'     => ''//$button
								, 'urut'       => $urut
							);
		
		
		$isi = $this->mygrid2->drawGrid($property);
		echo $isi;	
	}
	
	public function processForm() {
		$row = array();
		//$idprivi_apps = $_GET['idprivi_apps'];
		$idprivi_apps = $_GET['parent_id'];
		$no_urut = $_GET['no_urut'];
		
		//echo 'idprivi_apps : '.$idprivi_apps;
		
		$row = $this->m_utilitas->getData($this->db, $this->table, $this->pk_id, $_GET['id']);
	
		$data = array(
				array(
						'label'  => 'Module ID',
						'name'   => 'idprivi_modules',
						'width'  => 10,
						'size'   => 5,
						'value'  => $row['idprivi_modules'],
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
						'label'  => 'App ID',
						'name'   => 'idprivi_apps',
						'width'  => 10,
						'size'   => 5,
						'value'  => $idprivi_apps,
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
						'label'  => 'Module Code',
						'name'   => 'vCodeModule',
						'width'  => 220,
						'size'   => 50,
						'value'  => $row['vCodeModule'],
						'maxlength' => 50,
						'type'   => 'textbox',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => TRUE,
						'duplicated' => FALSE,
						'model' => '',
						'method' => '',
				),	
				array(
						'label'  => 'Module Name',
						'name'   => 'vNameModule',
						'width'  => 220,
						'size'   => 50,
						'value'  => $row['vNameModule'],
						'maxlength' => 50,
						'type'   => 'textbox',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => TRUE,
						'duplicated' => TRUE,
						'model' => '',
						'method' => '',
				),
				array(
						'label'  => 'Module Path',
						'name'   => 'vPathModule',
						'width'  => 220,
						'size'   => 50,
						'value'  => $row['vPathModule'],
						'maxlength' => 50,
						'type'   => 'textbox',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => TRUE,
						'duplicated' => FALSE,
						'model' => '',
						'method' => '',
				),
				array(
						'label'  => 'Parent ID',
						'name'   => 'iParent',
						'width'  => 10,
						'size'   => 5,
						'value'  => $row['iParent'],
						'type'   => 'combobox',
						'values' => $this->m_modules->getAllModules($idprivi_apps),
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
						'label'  => 'Application Description',
						'name'   => 'txtDesc',
						'type'   => 'textarea',
						'cols'   => 40,
						'rows'   => 3,
						'style'  => '',
						'value'  => $row['txtDesc'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => TRUE,
						'duplicated' => TRUE,
						'model' => '',
						'method' => '',
				),
		);
		
		//for draw your own button :)
		$button = array (
			array (
					'id'    => 'btn_save',
					'name'  => 'btn_save',
					'type'  => 'button',
					'value' => 'Save Modules',
					'content' => 'Save Modules',
					'class'  => 'btn',
					'onclick' => ''
			),
			array (
					'id'    => 'btn_cancel',
					'name'  => 'btn_cancel',
					'type'  => 'button',
					'value' => 'Back',
					'content' => 'Back',
					'class'  => 'btn',
					'onclick' => ""
			),
		);
		 
		$property = array( 'url' 	 => $this->url
						 , 'view' 	 => $this->view
						 , 'proc'    => $_GET['proc']
						 , 'draw_dtl'=> false
						 , 'opt_dtl' => ''
					     , 'pk_id'   => $this->pk_id
						 , 'param_id'=> $_GET['id']
						 , 'parent_id' => $idprivi_apps
						 , 'table'   => $this->table
						 , 'db'      => $this->db
						 , 'button'  => ''//$button
						 , 'no_urut' => $no_urut
					);
		$this->myform->drawForm($data, $property);
				
	}
	
	function deleteRecord() {
		$id = $_GET['id'];
		$this->load->model('m_modules');
		return $this->m_modules->delModules($id);
	}
	
	function save() {
		
		/*
		 * $idprivi_modules, $idprivi_apps, $vCodeModule, $vNameModule, $vPathModule, $iParent, $txtDesc, $tCreatedAt, $user, $st_updt
		 * idprivi_modules:idprivi_modules, 
		 * iParent:iParent, 
		 * idprivi_apps:idprivi_apps,
		 * vCodeModule:vCodeModule,
		 * vNameModule:vNameModule,
		 * vPathModule:vPathModule, 
		 * txtDesc:txtDesc,
		 * st_updt:st_updt
		 */
	
		$idprivi_modules = $_POST['idprivi_modules'];
		$idprivi_apps    = $_POST['idprivi_apps'];
		$vCodeModule     = $_POST['vCodeModule'];
		$vNameModule     = $_POST['vNameModule'];
		$vPathModule     = $_POST['vPathModule'];
		$iParent         = ($_POST['iParent'] == '-' ? 0 : $_POST['iParent']);
		$txtDesc         = $_POST['txtDesc'];
		$st_updt         = $_POST['st_updt'];
	
		$today = date('Y-m-d H:i:s', mktime());
		$date  = date('Y-m-d', mktime());
		$sess_auth 	= new Zend_Session_Namespace('auth');
		$user 	= $sess_auth->gNIP;
	
		//$idprivi_modules, $idprivi_apps, $vCodeModule, $vNameModule, $vPathModule, $iParent, $txtDesc, $tCreatedAt, $user, $st_updt
		$x = $this->m_modules->insupdtModules($idprivi_modules, $idprivi_apps, $vCodeModule, $vNameModule, $vPathModule, $iParent, $txtDesc, $date, $user, $st_updt);
	
		echo $x;
	
	}
	
	function checkDuplicate() {
		$txt   = $_GET['txt'];
		$idprivi_apps = $_GET['idprivi_apps'];
	
		$last_group_id = $this->m_modules->checkDuplicate($txt, $idprivi_apps);
	
		echo $last_group_id;
	}

}
?>