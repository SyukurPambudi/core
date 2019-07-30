<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Authlist extends MX_Controller {
	
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
		
		$this->table1  = 'privi_authlist';
		$this->table2  = 'company';
		$this->pk_id1  = 'iID_Authlist';
		$this->fk_id   = '';
		
		//
		$this->url 	   = 'privilege/authlist';
		$this->view    = 'privilege/authlist/v_authlist';
		$this->sort_by = 'cNIP';
		$this->caption = 'Auth List';
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
			
		//
		$this->data = array(
				array(
						'prefix'     => 'erp_privi',
						'table'      => 'privi_authlist',
						'label'  	 => 'Auth ID',
						'name'   	 => 'iID_Authlist',
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
						'relationTo' => 'employee.cNip',
				),
				array(
						'prefix'     => 'hrd',
						'table'  	 => 'employee',
						'label'  	 => 'Name',
						'name'   	 => 'vName',
						'width'  	 => 400,
						'size'   	 => 10,
						'adv_src'	 => FALSE,
						'type'	 	 => 'text',
						'showOnGrid' => TRUE,
						'relationTo' => 'erp_privi.privi_authlist.cNIP',
				),
				array(
						'prefix'     => 'erp_privi',
						'table'  	 => 'privi_authlist',
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
						'relationTo' => 'erp_privi.privi_authlist.iCompanyId',
				),
				array(
						'prefix'     => 'erp_privi',
						'table'  	 => 'privi_authlist',
						'label'  	 => 'idprivi_apps',
						'name'  	 => 'idprivi_apps',
						'width' 	 => 150,
						'size'  	 => 10,
						'adv_src'	 => FALSE,
						'type'	 	 => 'text',
						'showOnGrid' => FALSE,
						'relationTo' => 'erp_privi.privi_apps.idprivi_apps',
				),
				array(
						'prefix'     => 'erp_privi',
						'table'  	 => 'privi_apps',
						'label'  	 => 'application',
						'name'  	 => 'vAppName',
						'width' 	 => 150,
						'size'  	 => 10,
						'adv_src'	 => FALSE,
						'type'	 	 => 'text',
						'showOnGrid' => TRUE,
						'relationTo' => 'erp_privi.privi_authlist.idprivi_apps',
				),
				array(
						'prefix'     => 'erp_privi',
						'table'  	 => 'privi_authlist',
						'label'  	 => 'idprivi_group',
						'name'  	 => 'idprivi_group',
						'width' 	 => 150,
						'size'  	 => 10,
						'adv_src'	 => FALSE,
						'type'	 	 => 'text',
						'showOnGrid' => TRUE
				),
		);
				
		$this->f_columns = $this->mygrid2->getColumnsForGrid($this->data);
		//
		$this->group_id  = (isset($_POST['group']) ? $_POST['group'] : $_GET['group']);
		$this->module_id = (isset($_POST['modul']) ? $_POST['modul'] : $_GET['modul']);
		
		$group_and_modul = array("group_id" => $this->group_id , "module_id" => $this->module_id);
		
		$property		 = array('data'        => $this->data	
								, 'url' 	   => $this->url
								, 'pk_tbl'     => $this->table1
								, 'pk_id' 	   => $this->pk_id1
								, 'pk_db'      => 'erp_privi'
								, 'sort_by'    => $this->sort_by
								, 'caption'	   => $this->caption
								, 'view'	   => $this->view
								, 'adv_search' => TRUE
				                , 'group_and_modul' => $group_and_modul
							);
		
		
		$isi = $this->mygrid2->drawGrid($property);
	 	echo $isi;
	}

	public function processForm() {
		$row 		= array();		
		$proc 		= $_GET['proc'];
		$readonly 	= ($proc == 'view' ? '1' : '0');
		$last_id 	= 0;
		$db 		= 'default'; 
		$this->param_id = (($proc == 'add' || $proc == 'save') ? '0' : $_GET['id']);
		
		$this->load->model('m_company');
		$this->load->model('m_position');
		$this->load->model('m_division');
		
		$row = $this->m_utilitas->getData($db, 'privi_authlist', 'iID_Authlist', $this->param_id);
		
		$data = array(
				array(
						'label'  	=> 'Auth ID',
						'name'   	=> 'iID_Authlist',
						'width'  	=> 10,
						'size'   	=> 10,
						'value'  	=> $row['iID_Authlist'],
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
						'name'   	=> 'cNIP',
						'width'  	=> 100,
						'size'   	=> 15,
						'value'  	=> $row['cNIP'],
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
						'label'  => 'Application',
						'name'   => 'idprivi_apps',
						'type'   => 'textarea',
						'width'  => 100,
						'size'   => 15,
						'style'  => '',
						'value'  => $row['idprivi_apps'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0, 
						'required' => TRUE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => 'm_applications',
						'method' => 'getApplicationById'
				),
				array(
						'label'  => 'File',
						'name'   => 'tAttachment',
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
						 , 'proc'      => $proc
						 , 'draw_dtl'  => false
						 , 'opt_dtl'   => ''
					     , 'pk_id'     => $this->pk_id1
						 , 'param_id'  => $this->param_id
						 , 'parent_id' => ''
						 , 'table'     => $this->table1
						 , 'db'        => $db
						 , 'button'    => ''
						 
					);
		
		$group_and_modul = array("group_id" => $_GET['group'], "module_id" => $_GET['modul']);
	 	$this->myform->drawForm($data, $property, $group_and_modul);
	 	
		$this->load->view( 'authlist/inc_authlist' );
	}
	
	
	function get_employee($term){
		$row = $this->m_utilitas->getData($term);
		echo '<pre>'; print_r($row);
	} 
	
	
	
	
	
	
	
	
	//================
	function save_employee() {
		$employee_cNip = $_POST['employee_cNip'];
		$groups        = explode(',', $_POST['groups']);
		$apps          = explode(',', $_POST['apps']);	
		$dbset = $this->load->database('default', 'true');
		$sess_auth 	= new Zend_Session_Namespace('auth');
		$nip = $sess_auth->gNIP;
		$companyId = $sess_auth->gComId;
		$today = date('Y-m-d H:i:s', mktime());
		$date  = date('Y-m-d', mktime());
		$SQL_QUERY = array();
				
		foreach($apps as $i=>$p) {
			$SQL = "SELECT idPrivi_Authlist FROM privi_authlist WHERE cNIP = '{$employee_cNip}' AND idprivi_apps = '{$p}' AND idprivi_group='".$groups[$i]."'";				
			$result = $dbset->query($SQL);
			if($result->num_rows() > 0) {
				foreach ($result->result() as $row)
				{
					$SQL_QUERY[] = "UPDATE privi_authlist set idprivi_group = '{$groups[$i]}', tUpdated = '{$today}', cUpdatedBy = '{$nip}' where idPrivi_Authlist = '{$row->idPrivi_Authlist}'";
				}				 
			} else {
				$SQL_QUERY[] = "INSERT INTO privi_authlist (cNIP, iCompanyId, idprivi_apps, idprivi_group, dCreated, cCreatedBy) VALUES ('{$nip}', '{$companyId}', '{$p}', '{$groups[$i]}', '{$date}', '{$nip}')";
			}			
		}
		
		foreach($SQL_QUERY as $Q) {
			try {
				$dbset->query($Q);		
				echo 1;
			}catch(Exception $e) {
				echo 0;
				die ('Error : '.$e);
				
			}
		}
	}

}
?>