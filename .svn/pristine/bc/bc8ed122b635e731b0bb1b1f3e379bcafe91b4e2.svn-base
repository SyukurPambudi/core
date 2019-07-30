<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Module extends MX_Controller {
	
	private $db;
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
		
		$this->db     = 'default';
		$this->table  = 'privi_group_pt_app';
		$this->model  = 'm_privi_group_pt_app';
		$this->method = 'getAllApplication';
		$this->pk_id  = 'iID_GroupApp';
		
		//
		$this->url 	  = 'privilege/module';
		$this->view   = 'privilege/module/v_module';
		$this->sort_by= 'vNamaGroup';
		$this->caption= 'Application List';
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
					'prefix'     => 'erp_privi',
					'table'      => 'privi_group_pt_app',
					'label'  => 'Group ID',
					'name'   => 'iID_GroupApp',
					'width'  => 50,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => FALSE,						
					'PK'         => TRUE
				),
				array(
					'prefix'     => 'erp_privi',
					'table'      => 'privi_group_pt_app',
					'label'  => 'idprivi_apps',
					'name'   => 'idprivi_apps',
					'width'  => 200,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => FALSE,
					'relationTo' => 'erp_privi.privi_apps.idprivi_apps',
				),
				array(
					'prefix'     => 'erp_privi',
					'table'      => 'privi_apps',
					'label'  => 'Application',
					'name'   => 'vAppName',
					'width'  => 200,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => TRUE,
					'relationTo' => 'erp_privi.privi_group_pt_app.idprivi_apps',
				),
				array(
					'prefix'     => 'erp_privi',
					'table'      => 'privi_group_pt_app',
					'label'  => 'Nama Group',
					'name'   => 'vNamaGroup',
					'width'  => 150,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => true,
				),
		);
		
		$this->f_columns = $this->mygrid2->getColumnsForGrid($this->data);	
		
		$this->group_id  = $_POST['group'];
		$this->module_id = $_POST['modul'];
		
		$group_and_modul = array("group_id" => $this->group_id , "module_id" => $this->module_id, "parent_id"=>0);
		
		$property		 = array('data'        => $this->data 
								, 'url' 	   => $this->url
								, 'pk_tbl'     => $this->table
								, 'pk_id' 	   => $this->pk_id
								, 'pk_db'      => 'erp_privi'
								, 'sort_by'    => $this->sort_by
								, 'caption'	   => $this->caption
								, 'view'	   => $this->view
								, 'adv_search' => TRUE 
								, 'group_and_modul' => $group_and_modul
								, 'where_condition' => ""
		
							);
		
		
		$isi = $this->mygrid2->drawGrid($property);
		echo $isi;
	}
	
	public function processForm() {
		$row = array();
		$proc = $_GET['proc'];		
		$this->param_id = (($proc == 'add' || $proc == 'save') ? '0' : $_GET['id']);
		$readonly = ($proc == 'view' ? '1' : '0');
		$last_id = 0;
		$no_urut = $_GET['no_urut'];
		
		$row = $this->m_utilitas->getData($this->db, $this->table, $this->pk_id, $this->param_id);		
		
		$data = array(
				array(
						'label'  => 'Group ID',
						'name'   => 'iID_GroupApp',
						'width'  => 10,
						'size'   => 5,
						'value'  => $row['iID_GroupApp'],
						'type'   => 'hidden',
						'maxlength' => 5,
						'style'  => '',
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 1,
						'required' => FALSE,
						'duplicated'=>FALSE,
						'model' => '',
						'method' => '',
				),						
				array(
						'label'  => 'Application',
						'name'   => 'idprivi_apps',
						'width'  => 220,
						'size'   => 50,
						'value'  => $row['idprivi_apps'],
						'maxlength' => 50,
						'type'   => 'label',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> $readonly,//($proc == 'edit' ? 1 : 0),
						'required' => TRUE,
						'duplicated'=>FALSE,
						'model' => 'm_applications',
						'method' => 'getApplicationById',
				),
				array(
						'label'  => 'Nama Group',
						'name'   => 'vNamaGroup',
						'type'   => 'label',
						'style'  => '',
						'value'  => $row['vNamaGroup'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> $readonly,//($proc == 'edit' ? 1 : 0),
						'required' => TRUE,
						'duplicated'=>FALSE,
						'model' => '',
						'method' => '',
				)
		);
		
		
		/* $this->optionsDtl = array(
				array(
						'columns'=>$this->f_columns_dtl,
						'data'=>$this->data_dtl,
						'parentId'=>$param_id,
						'controller'=>$this->controllerDtl,
						'view'=>$this->viewDtl,
						'pk_id'=>$this->f_columns_dtl['0'],
						'sort_by'=>$this->f_columns_dtl[2],
						'caption'=>'Modules'),
				array(
						'columns'=>$this->f_columns_dtl,
						'data'=>$this->data_dtl,
						'parentId'=>$param_id,
						'controller'=>$this->controllerDtl,
						'view'=>$this->viewDtl,
						'pk_id'=>$this->f_columns_dtl['0'],
						'sort_by'=>$this->f_columns_dtl[2],
						'caption'=>'ModulesXXX'),
		); */
		
		$property = array( 'url' 	 => $this->url
						 , 'view' 	 => $this->view
						 , 'proc'    => $proc
						 , 'draw_dtl'=> false
						 , 'opt_dtl' => ''
					     , 'pk_id'   => $this->pk_id
						 , 'param_id'=> $this->param_id
						 , 'table'   => $this->table
						 , 'db'      => $this->db
						 , 'button'  => ''//$button
						 , 'no_urut' => $no_urut
					);
		$group_and_modul = array("group_id" => $_GET['group'], "module_id" => $_GET['modul'], "parent_id" => $this->param_id);
		$this->myform->drawForm($data, $property, $group_and_modul);
	}

}
?>