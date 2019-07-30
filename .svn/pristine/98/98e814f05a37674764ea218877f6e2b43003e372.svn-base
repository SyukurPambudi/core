<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Privilege_Employee extends MX_Controller {
        
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
				
				//database
				$this->db    = 'hrd';
				$this->dbset = $this->load->database($this->db, true);
				$this->db_prefix = $this->dbset->database;
                
                $this->table  = 'employee';
                $this->pk_id  = 'cNIP';
                
                //
                $this->url        = 'privilege/privilege_employee';
                $this->view   	  = 'privilege/privilege_employee/v_employee';
                $this->sort_by	  = 'vName';
                $this->caption	  = 'Authorization';
                
        }


        public function index() {
                $is_logged      = Modules::run('login/is_logged');
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
                                        'label'  => 'NIP',
                                        'name'   => 'cNIP',
                                        'width'  => 50,
                                        'size'   => 10,
                                        'adv_src'=> TRUE,
                                        'type'   => 'text',
                                        'showOnGrid' => TRUE,                                           
                                        'PK'         => TRUE
                                ),
                                array(
                                        'label'  => 'Employee Name',
                                        'name'   => 'vName',
                                        'width'  => 200,
                                        'size'   => 50,
                                        'adv_src'=> TRUE,
                                        'type'   => 'text',
                                        'showOnGrid' => TRUE
                                ),
                );
				
				$group_and_modul["parent_id"] = 0;
                
				$property   = array('data' => $this->data 
										, 'url'        => $this->url
										, 'pk_tbl'     => $this->table
										, 'pk_id'      => $this->pk_id
										, 'pk_db'      => $this->db_prefix
										, 'pk_prefix'  => $this->db
										, 'sort_by'    => $this->sort_by
										, 'caption'    => $this->caption
										, 'view'       => $this->view
										, 'adv_search' => TRUE 
										, 'group_and_modul' => $group_and_modul
										, 'where_condition' => $this->db_prefix.'.'.$this->table.'.lDeleted = 0'
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

                $row = $this->m_utilitas->getData($this->db, $this->table, $this->pk_id, $_GET['id']);

                $data = array(
							array(
								'label'  		=> 'NIP',
								'name'   		=> 'cNip',
								'width'  		=> 10,
								'size'   		=> 10,
								'value'  		=> $row['cNip'],
								'type'   		=> 'label',
								'maxlength'		=> 5,
								'style'  		=> '',
								'class'  		=> 'fieldTextBox',
								'disabled'      => 0,
								'readonly'      => 1,
								'required' 		=> FALSE,
								'duplicated' 	=> TRUE,
								'model' 		=> '',
								'method' 		=> '',
							),
							array(
								'label'  		=> 'Employee Name',
								'name'   		=> 'vName',
								'width'  		=> 220,
								'size'   		=> 80,
								'value'  		=> $row['vName'],
								'maxlength' 	=> 50,
								'type'   		=> 'label',
								'style'  		=> '',
								'class'         => 'fieldTextBox',
								'disabled'      => 0,
								'readonly'      => 1,
								'required' 		=> TRUE,
								'duplicated' 	=> FALSE,
								//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
								'model'  		=> '', 
								'method' 		=> '',
							),
                );
				
                //for draw your own button :)
                $button = array (                               
                        array (
                                        'id'    => 'btn_save_1',
                                        'name'  => 'btn_save_1',
                                        'type'  => 'button',
                                        'value' => 'Simpan',
                                        'content' => 'Simpan',                                                  
                                        'class'  => 'btn',
                                        'onclick' => ''
                                  ),
                        array (
                                        'id'    => 'btn_cancel_1',
                                        'name'  => 'btn_cancel_1',
                                        'type'  => 'button',
                                        'value' => 'Cancel',
                                        'content' => 'Cancel',                                                  
                                        'class'  => 'btn',
                                        'onclick' => ''
                                  ),
                );
                
                $optionsDtl = array(
                                array(
									'title'=>'Groups',
									'isi'=>'<iframe id="group_access" src="'.base_url().'privilege/privilege_setup_group_access/output?group_id='.$_GET['group_id'].'&modul_id='.$_GET['modul_id'].'&company_id='.$_GET['company_id'].'&parent_id='.$_GET['id'].'&urut=0&cNip='.$row['cNip'].'" scrolling="auto" height="500" width="900">
											</iframe>'
                                ),
                );

				$property = array( 'multipart'  => FALSE
								 , 'url' => $this->url
								 , 'view'      => $this->view
								 , 'proc'      => $_GET['proc']
								 , 'param_id'  => $_GET['id']
								 , 'parent_id' => $_GET['id']
								 , 'draw_dtl'  => true
								 , 'opt_dtl'   => $optionsDtl
								 , 'pk_id'     => $this->pk_id								 
								 , 'table'     => $this->table								 
								 , 'db'        => $this->db
								 , 'button'    => ''//$button
										);				
                $this->myform->drawForm($data, $property);
                                
        }
        
        function save_employee() {
                $employee_cNip = $_POST['employee_cNip'];
                $groups        = explode(',', $_POST['groups']);
                $apps          = explode(',', $_POST['apps']);  
                $sess_auth      = new Zend_Session_Namespace('auth');
                $nip = $sess_auth->gNIP;
                $companyId = $sess_auth->gComId;
                $today = date('Y-m-d H:i:s', mktime());
				$date  = date('Y-m-d', mktime());
                $SQL_QUERY = array();
                                
                foreach($apps as $i=>$p) {
                        $SQL = "SELECT iID_Authlist FROM privi_authlist WHERE cNIP = '{$employee_cNip}' AND idprivi_apps = '{$p}' AND idprivi_group='".$groups[$i]."'";                         
                        $result = $this->dbset->query($SQL);
                        if($result->num_rows() > 0) {
                                foreach ($result->result() as $row)
                                {                                       
                                        $SQL_QUERY[] = "UPDATE privi_authlist set idprivi_group = '{$groups[$i]}', tUpdated = '{$today}', cUpdatedBy = '{$nip}' where iID_Authlist = '{$row->iID_Authlist}'";                                  
                                }                                
                        } else {
                                $SQL_QUERY[] = "INSERT INTO privi_authlist (cNIP, iCompanyId, idprivi_apps, idprivi_group, dCreated, cCreatedBy) 
                                                                VALUES ('{$employee_cNip}', '{$companyId}', '{$p}', '{$groups[$i]}', '{$date}', '{$nip}')";
                                $SQL_QUERY[] = "UPDATE privi_authlist set lDeleted = '1', cUpdatedBy = '{$nip}'
                                where cNIP = '{$employee_cNip}' AND idprivi_group != '{$groups[$i]}'
                                AND idprivi_apps = '{$p}'";
                        }                       
                }
				
                foreach($SQL_QUERY as $Q) {
                        try {
                                $this->dbset->query($Q);                                              
                                echo 1;
                        }catch(Exception $e) {
                                echo 0;
                                die ('Error : '.$e);
                                
                        }
                }
        }

}
?>