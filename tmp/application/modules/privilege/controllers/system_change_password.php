<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class System_Change_Password extends MX_Controller {
	
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
		$this->db    = 'hrd';
		$this->dbset = $this->load->database($this->db, true);
		$this->db_prefix = $this->dbset->database;
		
		
		$this->table1  = 'employee';
		$this->pk_id1  = 'cNIP';
		$this->fk_id   = '';
		
		//
		$this->url 	   = 'privilege/system_user_information';
		$this->view    = 'privilege/system_user_information/v_applications';
		$this->sort_by = 'vName';
		$this->caption = 'Employee Password';
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
						'label'  	 => 'NIP',
						'name'   	 => 'cNip',
						'width'  	 => 10,
						'size'   	 => 10,
						'adv_src'	 => FALSE,
						'type'	 	 => 'text',
						'showOnGrid' => TRUE,						
						'PK'         => TRUE
				),
				array(
						'label'  => 'Employee Name',
						'name'   => 'vName',
						'width'  => 100,
						'size'   => 20,
						'adv_src'=> FALSE,
						'type'	 => 'text',
						'showOnGrid' => TRUE,
				),
				array(
						'label'  => 'Password',
						'name'   => 'vPassword',
						'width'  => 100,
						'size'   => 50,
						'adv_src'=> FALSE,
						'type'	 => 'text',
						'showOnGrid' => FALSE
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
								, 'where_condition' => $this->db_prefix.'.'.$this->table1.'.dResign = "0000-00-00" '
							);
		
		
		$isi = $this->mygrid2->drawGrid($property);
		echo $isi;
	}
	
	public function processForm() {
		$row = array();
		$last_id = 0;		
		
		$this->load->model('m_company');
		$this->load->model('m_position');
		$this->load->model('m_division');
		
		$row = $this->m_utilitas->getData($this->pk_db1, $this->table1, $this->pk_id1, $this->param_id);
	
		$data = array(
				array(
						'label'  => 'NIP',
						'name'   => 'cNip',
						'width'  => 10,
						'size'   => 10,
						'value'  => $row['cNip'],
						'type'   => 'label',
						'maxlength' => 7,
						'style'  => '',
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 1,
						'required' => FALSE,
						'duplicated' => TRUE,
						'model' => 'm_employee',
						'method' => 'getNameByNIP',
				),
				array(
						'label'  => 'Employee Name',
						'name'   => 'vName',
						'width'  => 100,
						'size'   => 30,
						'maxlength' => 30,
						'value'  => $row['vName'],
						'type'   => 'hidden',
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
						'label'  => 'Old Password',
						'name'   => 'vOldPassword',
						'value'  => '',
						'type'   => 'password',
						'width'  => 100,
						'size'   => 50,
						'maxlength' => 50,
						'style'  => '',
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => TRUE,
						'duplicated' => TRUE,
						'info'		=> '<i style="color:red">Leave it blank, if you dont want to change the password</i>',
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => ''
				),
				array(
						'label'  => 'New Password',
						'name'   => 'vNewPassword',
						'value'  => '',
						'type'   => 'password',
						'width'  => 100,
						'size'   => 50,
						'maxlength' => 50,
						'style'  => '',
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => TRUE,
						'duplicated' => TRUE,
						'info'		=> '<i style="color:red">Leave it blank, if you dont want to change the password</i>',
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '', 
						'method' => ''
				),
		);
				
		//for draw your own button :)
		$button = array (
			array (
					//'id'    => 'btn_save',
					//'class' => 'btn_save',
					'name'  => 'btn_save',
					'type'  => 'button',
					'value' => 'Simpan',
					'content' => 'Simpan',
					'class'  => 'btn',
					'onclick' => ''
			),
			array (
					//'id'    => 'btn_cancel',
					//'class'  => 'btn_cancel',
					'name'  => 'btn_cancel',
					'type'  => 'button',
					'value' => 'Back',
					'content' => 'Back',
					'class'  => 'btn',
					'onclick' => ''
			),
		);
		
		print_r($group_and_modul);
		//
		$group_and_modul = array("group_id" => $_GET['group_id'], "module_id" => $_GET['modul_id'], "company_id" => $_GET['company_id'], "parent_id" => $this->param_id);		
		$modules =  Modules::run('privilege/system_change_password/output', $group_and_modul, 1);
		
		$property = array( 'url' 	 => $this->url
						 , 'view' 	 => $this->view
						 , 'proc'    => $_GET['proc']
						 , 'param_id'=> $_GET['id']
						 , 'parent_id' => $_GET['id']
						 , 'draw_dtl'=> false
						 , 'opt_dtl' => ''
					     , 'pk_id'   => $this->pk_id1						 
						 , 'table'   => $this->table1						 
						 , 'db'      => $this->db
						 , 'button'  => $button
					);
		$this->myform->drawForm($data, $property);
				
	}
	
	function savePassword() {
		/*
		 * Array
			(
			    [form_data] => Array
			        (
			            [employee_vName] => NUGROHO DJATI
			            [employee_group] => 1
			            [employee_module] => 382
			            [employee_lastUpdateAt] => 
			            [employee_lastUpdateBy] => 
			            [employee_st_update] => edit
			            [employee_id_process] => edit
			            [employee_cNip] => E00005
			            [employee_vPassword] => 
			        )
			
			)
		 */
		$form_data = $this->input->post('form_data');
		if(is_array($form_data) && count($form_data) > 0) {
			$vName = $form_data['employee_vName'];
			$cNip = $form_data['employee_cNip'];
			$vOldPassword = $form_data['employee_vOldPassword'];
			$vNewPassword = $form_data['employee_vNewPassword'];
			
			$data = '';
			
			if( !empty($vNewPassword) && !empty($cNip) ) {
				$vOldPasswordxx = md5( $vOldPassword );
				
				$vNewPasswordxx = md5( $vNewPassword );
				$data['vPassword'] = $vNewPasswordxx;
				
				$where = array( 'cNip'=>$cNip, 'vPassword'=>$vOldPasswordxx );
				$this->load->model('m_employee');
					
				$success = $this->m_employee->update( $data, $where );
				
				if($success) {
					echo json_encode( array('error'=>0,'message'=>'Data berhasil diupdate!'));
					return;
				}
			}
		}
		
		echo json_encode( array('error'=>1,'message'=>'Data gagal diupdate!'));
		return;
	}
}
?>