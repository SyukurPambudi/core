<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Position extends MX_Controller {
	
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
		
		$this->table1  = 'position';
		$this->table2  = 'groupdept';
		$this->pk_id1  = 'iPostId';
		$this->fk_id   = '';
		
		//
		$this->url 	   = 'privilege/position';
		$this->view    = 'privilege/position/v_position';
		$this->sort_by = 'vName';
		$this->caption = 'Position List';
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
						'prefix'     => 'default',
						'table'      => 'position',
						'label'  	 => 'Position ID',
						'name'   	 => 'iPostId',
						'width'  	 => 50,
						'size'   	 => 10,
						'adv_src'	 => FALSE,
						'type'	 	 => 'text',
						'showOnGrid' => FALSE,						
						'PK'         => TRUE
				),
				array(
						'prefix'     => 'default',
						'table'  => 'position',
						'label'  => 'igrpdeptid',
						'name'   => 'igrpdeptid',
						'width'  => 100,
						'size'   => 10,
						'adv_src'=> FALSE,
						'type'	 => 'text',
						'showOnGrid' => FALSE,
						'relationTo' => 'default.groupdept.igrpdeptid',
				),
				array(
						'prefix'     => 'default',
						'table'  => 'groupdept',
						'label'  => 'Group Departemen',
						'name'   => 'vDescription',
						'width'  => 400,
						'size'   => 10,
						'adv_src'=> FALSE,
						'type'	 => 'text',
						'showOnGrid' => TRUE
				),
				array(
						'prefix'     => 'default',
						'table'  => 'position',
						'label'  => 'Posisi',
						'name'   => 'vDescription',
						'width'  => 450,
						'size'   => 10,
						'adv_src'=> FALSE,
						'type'	 => 'text',
						'showOnGrid' => TRUE
				),
				array(
						'prefix'     => 'default',
						'table'  => 'groupdept',
						'label'  => 'igrpdeptid2',
						'name'   => 'igrpdeptid',
						'width'  => 150,
						'size'   => 10,
						'adv_src'=> FALSE,
						'type'	 => 'text',
						'showOnGrid' => FALSE,
						'relationTo' => 'default.position.igrpdeptid',
				),
		);
				
		$this->f_columns = $this->mygrid2->getColumnsForGrid($this->data);
		//
		$this->group_id  = $_POST['group'];
		$this->module_id = $_POST['modul'];
		
		$group_and_modul = array("group_id" => $this->group_id , "module_id" => $this->module_id);
		
		$property		 = array('data'        => $this->data	
								, 'url' 	   => $this->url
								, 'pk_tbl'     => $this->table1
								, 'pk_id' 	   => $this->pk_id1
								, 'pk_db'      => 'default'
								, 'sort_by'    => $this->sort_by
								, 'caption'	   => $this->caption
								, 'view'	   => $this->view
								, 'adv_search' => TRUE
				                , 'group_and_modul' => $group_and_modul
								, 'where_condition' => 'default.'.$this->table1.'.lDeleted = 0'
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
		$db = 'default'; 
		
		$this->load->model('m_company');
		$this->load->model('m_position');
		$this->load->model('m_division');
		
		$row = $this->m_utilitas->getData($db, 'position', 'iPostId', $this->param_id);
	
		$data = array(
				array(
						'label'  => 'Position ID',
						'name'   => 'iPostId',
						'width'  => 10,
						'size'   => 10,
						//'value'  => (($proc == 'edit' || $proc == 'view') ? $row['cNip'] : ''),
						'value'  => $row['iPostId'],
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
						'label'  => 'Group Departemen',
						'name'   => 'igrpdeptid',
						'width'  => 220,
						'size'   => 80,
						//'value'  => (($proc == 'edit' || $proc == 'view') ? $row['vName'] : ''),
						'value'  => $row['igrpdeptid'],
						'maxlength' => 50,
						'type'   => 'label',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 1,//($proc == 'edit' ? 1 : 0),
						'required' => TRUE,
						'duplicated' => FALSE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => 'm_groupdept', 
						'method' => 'getGroupDeptById',
				),
				array(
						'label'  => 'Nama Posisi',
						'name'   => 'vDescription',
						'type'   => 'label',
						'width'  => 220,
						'size'   => 50,
						'style'  => '',
						//'value'  => (($proc == 'edit' || $proc == 'view') ? $row['iDeptID'] : ''),
						'value'  => $row['vDescription'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 1,//($proc == 'edit' ? 1 : 0),
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
							'onclick' => 'proses_simpan();'
						  ),
				);
		
		//for detail
		$i = 0;		
		
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
		 
		//print_r($draw_dtl);
		//$param = array(), $id_header, $url, $pk_id, $sort_by, $caption, $view, $urut, $group_and_modul
		$property = array( 'url' 	 => $this->url
						 , 'view' 	 => $this->view
						 , 'proc'    => $proc
						 , 'draw_dtl'=> false
						 , 'opt_dtl' => ''
					     , 'pk_id'   => $this->pk_id1
						 , 'param_id'=> $this->param_id
						 , 'table'   => $this->table1
						 , 'db'      => $db
						 , 'button'  => ''//$button
					);
		$group_and_modul = array("group_id" => $_GET['group'], "module_id" => $_GET['modul']);
		//$this->myform->drawForm($data, $this->url, $this->view, $proc, true, $this->optionsDtl, $group_and_modul);
		$this->myform->drawForm($data, $property, $group_and_modul);
				
	}
}
?>