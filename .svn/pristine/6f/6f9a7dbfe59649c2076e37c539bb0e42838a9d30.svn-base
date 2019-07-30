<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class groups extends MX_Controller {
	
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
		$this->load->library('MyGrid');
		$this->load->library('MyForm');
		$this->load->helper('jqgrid_helper');
		$this->load->helper('url_helper');
		
		//session
		$this->load->library('Zend', 'Zend/Session/Namespace');
		
		$this->load->library('MySession');
		$this->mysession->sess_check();
		
		//model
		$this->load->model('m_utilitas');
		
		$this->table  = 'privi_group_pt_app';
		$this->model  = 'm_groups';
		$this->method = 'getAllGroups';
		$this->pk_id  = 'idprivi_group';
		
		//
		$this->url 	  = 'privilege/groups';
		$this->view   = 'privilege/v_groups';
		$this->sort_by= 'vNamaGroup';
		$this->caption= 'Group List';
		
		$this->f_columns = array( 'idprivi_group', 'iCompanyId', 'idprivi_apps', 'vNamaGroup', 'txtDesc', 'tUpdateAt', 'cUpdateBy');
		$this->data = array(
				array(
						'label'  => 'Group ID',
						'name'   => $this->f_columns[0],
						'width'  => 50,
						'size'   => 10,
						'adv_src'=> FALSE,
						'type'	 => 'text'
				),
				array(
						'label'  => 'Company Name',
						'name'   => $this->f_columns[1],
						'width'  => 220,
						'size'   => 10,
						'adv_src'=> FALSE,
						'type'	 => 'text'
				),
				array(
						'label'  => 'Application ID',
						'name'   => $this->f_columns[2],
						'width'  => 400,
						'size'   => 10,
						'adv_src'=> FALSE,
						'type'	 => 'text'
				),
				array(
						'label'  => 'Group Name',
						'name'   => $this->f_columns[3],
						'width'  => 400,
						'size'   => 10,
						'adv_src'=> FALSE,
						'type'	 => 'text'
				),
				array(
						'label'  => 'Group Description',
						'name'   => $this->f_columns[4],
						'width'  => 400,
						'size'   => 10,
						'adv_src'=> FALSE,
						'type'	 => 'text'
				),
				array(
						'label'  => 'Updated At',
						'name'   => $this->f_columns[5],
						'width'  => 70,
						'size'   => 10,
						'adv_src'=> TRUE,
						'type'	 => 'date'
				),
				array(
						'label'  => 'Updated By',
						'name'   => $this->f_columns[6],
						'width'  => 100,
						'size'   => 10,
						'adv_src'=> TRUE,
						'type'	 => 'date'
				)
			);
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
		$this->load->view( 'privilege/inc_groups' );
		
		$property		 = array( 'url' 	   => $this->url
								, 'pk_tbl'     => $this->table
								, 'pk_id' 	   => $this->pk_id
								, 'sort_by'    => $this->sort_by
								, 'caption'	   => $this->caption
								, 'view'	   => $this->view
								, 'adv_search' => TRUE );
		$this->group_id  = $_POST['group'];
		$this->module_id = $_POST['modul'];
		
		$group_and_modul = array("group_id" => $this->group_id , "module_id" => $this->module_id);
		
		//$this->mygrid->drawGrid($this->data, $this->controller, $this->pk_id, $this->sort_by, $this->title, $this->view, $GroupAndModul);
		$this->mygrid->drawGrid($this->data, $property, $group_and_modul);
	}
	
	public function drawGrid() {
		buildGridData(
				array(
						'model'   => $this->model,
						'method'  => $this->method,
						'pkid'    => $this->pk_id,
						'columns' => $this->f_columns,
				)
		);
	}
	
	public function processForm() {
		$row = array();
		$proc = $_GET['proc'];		
		$param_id = ($proc == 'add' ? '0' : $_GET['id']);
		$readonly = ($proc == 'view' ? '1' : '0');
		$last_id = 0;
		
		$SQL = "SELECT * FROM {$this->table} WHERE {$this->pk_id} = '{$param_id}'";
		$query = $this->db->query($SQL);
		$num_rows = $query->num_rows();

		if ($num_rows > 0)
		{
			$row = $query->row_array();
		}	
		
		$data = array(
				array(
						'label'  => 'Group ID',
						'name'   => $this->f_columns[0],
						'width'  => 10,
						'size'   => 5,
						'value'  => (($proc == 'edit' || $proc == 'view') ? $row[$this->f_columns[0]] : ''),
						'type'   => (($proc == 'edit' || $proc == 'add') ? 'textbox' : 'label'),
						'maxlength' => 5,
						'style'  => '',
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 1,
						'required' => FALSE
				),						
				array(
						'label'  => 'Company Name',
						'name'   => $this->f_columns[1],
						'width'  => 220,
						'size'   => 50,
						'value'  => (($proc == 'edit' || $proc == 'view') ? $row[$this->f_columns[1]] : ''),
						'maxlength' => 50,
						'type'   => (($proc == 'edit' || $proc == 'add') ? 'textbox' : 'label'),
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> $readonly,//($proc == 'edit' ? 1 : 0),
						'required' => TRUE
				),
				array(
						'label'  => 'Application ID',
						'name'   => $this->f_columns[2],
						'width'  => 220,
						'size'   => 50,
						'value'  => (($proc == 'edit' || $proc == 'view') ? $row[$this->f_columns[1]] : ''),
						'maxlength' => 50,
						'type'   => (($proc == 'edit' || $proc == 'add') ? 'textbox' : 'label'),
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> $readonly,//($proc == 'edit' ? 1 : 0),
						'required' => TRUE
				),
				array(
						'label'  => 'Group Name',
						'name'   => $this->f_columns[3],
						'width'  => 220,
						'size'   => 50,
						'value'  => (($proc == 'edit' || $proc == 'view') ? $row[$this->f_columns[1]] : ''),
						'maxlength' => 50,
						'type'   => (($proc == 'edit' || $proc == 'add') ? 'textbox' : 'label'),
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> $readonly,//($proc == 'edit' ? 1 : 0),
						'required' => TRUE
				),
				array(
						'label'  => 'Group Description',
						'name'   => $this->f_columns[4],
						'width'  => 220,
						'size'   => 50,
						'value'  => (($proc == 'edit' || $proc == 'view') ? $row[$this->f_columns[1]] : ''),
						'maxlength' => 50,
						'type'   => (($proc == 'edit' || $proc == 'add') ? 'textarea' : 'label'),
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> $readonly,//($proc == 'edit' ? 1 : 0),
						'required' => TRUE
				)
		);		
		
		$property = array( 'url' 	 => $this->url
						 , 'view' 	 => $this->view
						 , 'proc'    => $proc
						 , 'draw_dtl'=> FALSE
						 , 'opt_dtl' => $this->optionsDtl
					     , 'pk_id'   => $this->pk_id
						 , 'table'   => $this->table
					);
		$group_and_modul = array("group_id" => $_GET['group'], "module_id" => $_GET['modul']);
		//$this->myform->drawForm($data, $this->url, $this->view, $proc, true, $this->optionsDtl, $group_and_modul);
		$this->myform->drawForm($data, $property, $group_and_modul);
				
	}

}
?>