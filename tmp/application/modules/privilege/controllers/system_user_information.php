<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class System_User_Information extends MX_Controller {
	
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
		$this->pk_id1  = 'cNip';
		$this->fk_id   = '';
		
		//
		$this->url 	   = 'privilege/system_user_information';
		$this->view    = 'privilege/system_user_information/v_applications';
		$this->sort_by = 'vName';
		$this->caption = 'User Information';
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
				array(
						'label'  => 'Email',
						'name'   => 'vEmail',
						'width'  => 100,
						'size'   => 50,
						'adv_src'=> FALSE,
						'type'	 => 'text',
						'showOnGrid' => TRUE
				),
				array(
						'label'  => 'Status Record',
						'name'   => 'lDeleted',
						'width'  => 100,
						'size'   => 50,
						'adv_src'=> FALSE,
						'type'	 => 'text',
						'showOnGrid' => TRUE,
						'relationAt' => TRUE
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
								//, 'where_condition' => 'default.'.$this->table1.'.dResign = "0000-00-00" '
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
		
		$this->load->model('m_company');
		$this->load->model('m_position');
		$this->load->model('m_division');
		
		$row = $this->m_utilitas->getData($this->db, $this->table1, $this->pk_id1, $_GET['id']);
	
		$data = array(
				array(
						'label'  => 'NIP',
						'name'   => 'cNip',
						'width'  => 10,
						'size'   => 40,
						'value'  => $row['cNip'],
						'type'   => 'textbox',
						'maxlength' => 7,
						'style'  => '',
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> ($_GET['proc'] == 'add' ? 0 : 1),
						'required' => TRUE,
						'duplicated' => TRUE,
						//'model' => 'm_employee',
						//'method' => 'getNameByNIP',
				),
				array(
						'label'  => 'Employee Name',
						'name'   => 'vName',
						'width'  => 100,
						'size'   => 60,
						'maxlength' => 30,
						'value'  => $row['vName'],
						'type'   => 'textbox',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> ($_GET['proc'] == 'add' ? 0 : 1),
						'required' => TRUE,
						'duplicated' => FALSE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '', 
						'method' => '',
				),
				array(
						'label'  => 'Password',
						'name'   => 'vPassword1',
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
						'label'  => 'Confirm Password',
						'name'   => 'vPassword2',
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
						'label'  => 'Email',
						'name'   => 'vEmail',
						'width'  => 100,
						'size'   => 30,
						'maxlength' => 30,
						'value'  => $row['vEmail'],
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
		);
				
		//for draw your own button :)
		$button = array (
			array (
					'id'  => 'btn_save',
					'name'  => 'btn_save',
					'type'  => 'button',
					'value' => 'Save',
					'content' => 'Save',
					'class'  => 'btn',
					'onclick' => ''
			),
			array (
					'id'  => 'btn_cancel',
					'name'  => 'btn_cancel',
					'type'  => 'button',
					'value' => 'Back',
					'content' => 'Back',
					'class'  => 'btn',
					'onclick' => ''
			),
		);
		
		//
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
	
	function save_information() {
		
		/*Array
(
    [parameter] => Array
        (
            [employee_group] => 1
            [employee_module] => 382
            [employee_company] => 1
            [employee_lastUpdateAt] => 
            [employee_lastUpdateBy] => 
            [employee_st_update] => edit
            [employee_id_process] => edit
            [employee_cNIP] => admin
            [employee_vName] => Administrator
            [employee_vPassword1] => 
            [employee_vPassword2] => 
            [employee_vEmail] => admin@master_erp.com
            [select-company] => 0
        )

)
		*/		
		$dbset = $this->load->database($this->db, 'true');
		
		$form_data = $this->input->get('parameter');
		if (is_array($form_data) && count($form_data) >0) {
			$cNip  = $form_data['employee_cNip'];
			$vName = $form_data['employee_vName']; 
			$pass1 = $form_data['employee_vPassword1'];
			$pass2 = $form_data['employee_vPassword2'];
			$email = $form_data['employee_vEmail'];
			
			$stUpdate = $form_data['employee_st_update'];
			
			$sess_auth 	= new Zend_Session_Namespace('auth');
			$today = date('Y-m-d H:i:s', mktime());
			$date  = date('Y-m-d', mktime());
			$user = $sess_auth->gNIP;
		
			if ($stUpdate == 'add') {
				$SQL = "INSERT INTO employee (cNIP, vName, vPassword, vEmail, dCreated, cCreatedBy) 
						VALUES ('{$cNip}', '{$vName}', md5('{$pass1}'), '{$email}', '{$date}', '{$user}')";
				
			} else {
				$SQL = "UPDATE employee SET vName = '{$vName}', vEmail = '{$email}', 
						tUpdated='{$today}', cUpdatedBy='{$user}'";
				if (!empty($pass1)) {
					$SQL .= ", vPassword=md5('{$pass1}')";
				}
				
				$SQL .= " Where cNIP='{$cNip}'";
			}
			
			//echo $SQL;
			
			try {
				$dbset->query($SQL);
				$x = '1|'.$cNip;
			}catch(Exception $e) {
				$x = '0|0';
				die('ERRor : '.$e);
			}
			
			echo $x;
		}
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