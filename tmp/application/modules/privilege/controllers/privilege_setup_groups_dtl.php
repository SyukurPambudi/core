<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Privilege_Setup_Groups_Dtl extends MX_Controller {
	
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
	private $dbprefix;
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
	
	private $parent_id;
	
	
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
		$this->load->model('m_groups');
		$this->load->model('m_modules');
		$this->load->model('m_privi_group_pt_app_mod');
		
		//database
		$this->db    = 'default';
		$this->dbset = $this->load->database($this->db, true);
		$this->db_prefix = $this->dbset->database;
		
		$this->pk_db1  = 'default';
		$this->table1  = 'privi_group_pt_app';
		$this->pk_id1  = 'iID_GroupApp';
		$this->fk_id   = '';
		
		//
		$this->url 	   = 'privilege/privilege_setup_groups_dtl';
		$this->view    = 'privilege/privilege_setup_groups/v_groups_dtl';
		$this->sort_by = 'vNamaGroup';
		$this->caption = 'Groups List';
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
		//echo 'No Urut : '.$urut;
		//die;
		//
		
		$this->data = array(
				array(						
						'label'  	 => 'Group ID',
						'name'   	 => 'iID_GroupApp',
						'width'  	 => 50,
						'size'   	 => 10,
						'adv_src'	 => FALSE,
						'type'	 	 => 'text',
						'showOnGrid' => FALSE,						
						'PK'         => TRUE
				),
				array(					
						'label'  => 'iCompanyId1',
						'name'   => 'iCompanyId',
						'width'  => 100,
						'size'   => 10,
						'adv_src'=> FALSE,
						'type'	 => 'text',
						'showOnGrid' => FALSE,
						'relationTo' => 'hrd.company.iCompanyID',
				),
				array(
						'prefix' => 'hrd',
						'table'  => 'company',
						'label'  => 'Company',
						'name'   => 'vCompName',
						'width'  => 100,
						'size'   => 10,
						'adv_src'=> FALSE,
						'type'	 => 'text',
						'showOnGrid' => TRUE,
						'relationTo' => 'privi_group_pt_app.iCompanyID',
				),
				array(
						'label'  => 'idprivi_apps',
						'name'   => 'idprivi_apps',
						'width'  => 0,
						'size'   => 10,
						'adv_src'=> FALSE,
						'type'	 => 'text',
						'showOnGrid' => FALSE,
						'FK'     => TRUE
				),
				array(
						'label'  => 'idprivi_group',
						'name'   => 'idprivi_group',
						'width'  => 0,
						'size'   => 10,
						'adv_src'=> FALSE,
						'type'	 => 'text',
						'showOnGrid' => FALSE,
				),
				array(
						'label'  => 'Group Name',
						'name'   => 'vNamaGroup',
						'width'  => 0,
						'size'   => 10,
						'adv_src'=> FALSE,
						'type'	 => 'text',
						'showOnGrid' => TRUE,
				),
				array(
						'label'  => 'Description',
						'name'   => 'txtDesc',
						'width'  => 0,
						'size'   => 10,
						'adv_src'=> FALSE,
						'type'	 => 'text',
						'showOnGrid' => TRUE,
				),
		);
		
		$button = array (
			/* array (
					'id'    => 'btn_add_detail_'.$this->module_id.$urut,
					'name'  => 'btn_add_detail_'.$this->module_id.$urut,
					'type'  => 'button',
					'value' => 'Add New Record',
					'content' => 'Add New Record',
					'class'  => 'btn',
					'onclick' => 'addRecord_'.$this->module_id.$urut.'()',
			), */
		);
		
		//print_r($group_and_modul);
		$group_and_modul["parent_id"] = $_GET['parent_id'];
		
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
								, 'detail'     => TRUE
				                , 'group_and_modul' => $group_and_modul
								, 'where_condition' => $this->db_prefix.'.'.$this->table1.'.lDeleted = 0 and '.$this->db_prefix.'.privi_group_pt_app.idprivi_apps="'.$_GET['parent_id'].'"'
								, 'button'     => ''//$button
								, 'urut'       => $_GET['urut']
							);
		
		$isi = $this->mygrid2->drawGrid($property); 
		
		echo $isi;
	}
	
	public function processForm() {
		$row = array();
		$idprivi_apps = $_GET['parent_id'];	
		$no_urut = $_GET['no_urut'];
		
		$this->load->model('m_company');
		$this->load->model('m_position');
		$this->load->model('m_division');
		
		$row = $this->m_utilitas->getData($this->db, $this->table1, $this->pk_id1, $_GET['id']);
	
		$data = array(
				array(
						'label'  => 'Group ID',
						'name'   => 'iID_GroupApp',
						'width'  => 10,
						'size'   => 10,
						'value'  => $row['iID_GroupApp'],
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
						'label'  => 'Company',
						'name'   => 'iCompanyId',
						'width'  => 220,
						'size'   => 50,
						'value'  => $row['iCompanyId'],
						'maxlength' => 50,
						'type'   => 'combobox',
						'style'  => '',
						'values' => $this->m_company->getAllCompanys(),
						'class'  	=> 'fieldTextBox',
						//'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => TRUE,
						'duplicated' => FALSE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => 'm_company', 
						'method' => 'getCompanyById',
				),
				array(
						'label'  => 'Application',
						'name'   => 'idprivi_apps',
						'width'  => 220,
						'size'   => 50,
						'value'  => $idprivi_apps,
						'maxlength' => 50,
						'type'   => 'label',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => TRUE,
						'duplicated' => FALSE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => 'm_applications',
						'method' => 'getApplicationById',
				),
				array(
						'label'  => 'idprivi_group',
						'name'   => 'idprivi_group',
						'width'  => 220,
						'size'   => 50,
						'value'  => $row['idprivi_group'],
						'maxlength' => 50,
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
						'label'  => 'Group Name',
						'name'   => 'vNamaGroup',
						'width'  => 220,
						'size'   => 30,
						'value'  => $row['vNamaGroup'],
						'maxlength' => 50,
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
				array(
						'label'  => 'Description',
						'name'   => 'txtDesc',
						'type'   => 'textarea',
						'width'  => 220,
						'size'   => 50,
						'style'  => '',
						'rows'   => '3',
						'cols'   => '40',
						'value'  => $row['txtDesc'],
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
		
		//for detail
		$i = 0;		
		
		//for draw your own button :)
		$button = array (
			array (
					'id'    => 'btn_save_'.$no_urut,
					'name'  => 'btn_save'.$no_urut,
					'type'  => 'button',
					'value' => 'Simpan',
					'content' => 'Simpan',
					'class'  => 'btn',
					'onclick' => ''
			),
			array (
					'id'    => 'btn_cancel_'.$no_urut,
					'name'  => 'btn_cancel_'.$no_urut,
					'type'  => 'button',
					'value' => 'Cancel',
					'content' => 'Cancel',
					'class'  => 'btn',
					'onclick' => ""
			),
		);
		
		$isi = ' <script>
					$(function() {
						$( "#tabs" ).tabs();
						$( "#grid_modules" ).dataTable({
							"sDom"			 : "<\'ui-helper-clearfix\'><\'headerTable\'f>rt<\'dataTables_footWrapper\'ipl>",
							"bJQueryUI":true,
							"sPaginationType":"full_numbers",
						});
					});
				 </script>
				
				<div id="tabs" style="height:500px;">
				<ul>
					<li><a href="#tabs-modules">Modules</a></li>
				</ul>
				<div id="tabs-modules">';
				
		$isi .= '<table id="grid_modules" width="100%" border="0" style="border:1px solid #dedede;">';		
		$isi .= '<thead>';
		$isi .= '<tr>';
		$isi .= '<th width="88%" rowspan="2">Nama Module</th>';
		$isi .= '<th width="3%" colspan="4" align="center" class="ui-state-default">CRUD</th>';
		$isi .= '</tr>';
		$isi .= '<tr>';
		$isi .= '<th width="3%">Read</th>';
		$isi .= '<th width="3%">Create</th>';
		$isi .= '<th width="3%">Update</th>';
		$isi .= '<th width="3%">Delete</th>';
		$isi .= '</tr>';
		$isi .= '</thead>';		
		$isi .= '<tbody>';
		
		$get_result = $this->m_modules->getAllModulesByAppId($idprivi_apps);
		//print_r($get_result);
		//$i = 0;
		if (sizeOf($get_result) > 0) {
			foreach($get_result as $val) {
				
				$crud = $this->m_privi_group_pt_app_mod->getModuleByAppGroupModId($row['iCompanyId'], $idprivi_apps, $row['iID_GroupApp'], $val['id']);
				//echo $crud;
				//C= 8 R=4 U=1 D=2
				if ($crud == 15) {
					$read   = ' checked';
					$create = ' checked';
					$update = ' checked';
					$delete = ' checked';
				} else if ($crud == 14) {
					$read   = ' checked';
					$create = ' checked';
					$update = '';
					$delete = ' checked';
				} else if ($crud == 13) {
					$read   = ' checked';
					$create = ' checked';
					$update = ' checked';
					$delete = '';
				} else if ($crud == 12) {
					$read   = ' checked';
					$create = ' checked';
					$update = '';
					$delete = '';
				} else if ($crud == 11) {
					$read   = '';
					$create = ' checked';
					$update = ' checked';
					$delete = ' checked';
				} else if ($crud == 10) {
					$read   = '';
					$create = ' checked';
					$update = '';
					$delete = ' checked';
				} else if ($crud == 9) {
					$read   = '';
					$create = ' checked';
					$update = ' checked';
					$delete = '';
				} else if ($crud == 8) {
					$read   = ' checked';
					$create = '';
					$update = '';
					$delete = '';
				} else if ($crud == 7) {
					$read   = ' checked';
					$create = '';
					$update = ' checked';
					$delete = ' checked';
				} else if ($crud == 6) {
					$read   = ' checked';
					$create = '';
					$update = '';
					$delete = ' checked';
				} else if ($crud == 5) {
					$read   = ' checked';
					$create = '';
					$update = ' checked';
					$delete = '';
				} else if ($crud == 4) {
					$read   = ' checked';
					$create = '';
					$update = '';
					$delete = '';
				} else if ($crud == 3) {
					$read   = '';
					$create = '';
					$update = ' checked';
					$delete = ' checked';
				} else if ($crud == 2) {
					$read   = '';
					$create = '';
					$update = '';
					$delete = ' checked';
				} else if ($crud == 1) {
					$read   = '';
					$create = '';
					$update = ' checked';
					$delete = '';
				} else {
					$read = '';
					$create = '';
					$update = '';
					$delete = '';
				}
				
				/* $cb_read   = "<input type='checkbox' name='cb_r_".$val['id']."' id='cb_r_".$val['id']."' value='4' $read/>";
				$cb_create = "<input type='checkbox' name='cb_c_".$val['id']."' id='cb_c_".$val['id']."' value='8' $create/>";
				$cb_update = "<input type='checkbox' name='cb_u_".$val['id']."' id='cb_u_".$val['id']."' value='1' $update/>";
				$cb_delete = "<input type='checkbox' name='cb_d_".$val['id']."' id='cb_d_".$val['id']."' value='2' $delete/>"; */
				$cb_read   = "<input type='checkbox' name='cb_r_".$val['id']."' id='cb_r_".$val['id']."' value='4' $read/>";
				$cb_create = "<input type='checkbox' name='cb_c_".$val['id']."' id='cb_c_".$val['id']."' value='8' $create/>";
				$cb_update = "<input type='checkbox' name='cb_u_".$val['id']."' id='cb_u_".$val['id']."' value='1' $update/>";
				$cb_delete = "<input type='checkbox' name='cb_d_".$val['id']."' id='cb_d_".$val['id']."' value='2' $delete/>";
				
				$isi .= '<tr>';
				$isi .= '<td align="justify">'.$val['name'].'</td>';
				$isi .= '<td align="center">'.$cb_read.'</td>';
				$isi .= '<td align="center">'.$cb_create.'</td>';
				$isi .= '<td align="center">'.$cb_update.'</td>';
				$isi .= '<td align="center">'.$cb_delete.'</td>';
				$isi .= '</tr>';
				
				//$i++;
			}
		}
		
		$isi .= '</tbody>';
		$isi .= '</table>';		
		$isi .= '</div>
				</div>';
		
		$optionsDtl = array(
				array(
						'title'=>'',
						'isi'=> $isi,
						'reset'=>true,
				),
		);
		
		$button = array(
					array (
						'id'    => 'btn_save',
						'name'  => 'btn_save',
						'type'  => 'button',
						'value' => 'Save Groups',
						'content' => 'Save Groups',
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
							'onclick' => ''
					),
				);
		 
		//print_r($draw_dtl);
		//$param = array(), $id_header, $url, $pk_id, $sort_by, $caption, $view, $urut, $group_and_modul
		$property = array( 'url' 	 => $this->url
						 , 'view' 	 => $this->view
						 , 'proc'    => $_GET['proc']
						 , 'draw_dtl'=> true
						 , 'opt_dtl' => $optionsDtl
					     , 'pk_id'   => $this->pk_id1
						 , 'param_id'=> $_GET['id']
						 , 'table'   => $this->table1
						 , 'db'      => $this->db
						 , 'parent_id' => $idprivi_apps
						 , 'button'  => $button
						 , 'no_urut' => 0
					);
		//$group_and_modul = array("group_id" => $_GET['group_id'], "module_id" => $_GET['modul_id'], "company_id" => $_GET['company_id']);
		//$this->myform->drawForm($data, $this->url, $this->view, $proc, true, $this->optionsDtl, $group_and_modul);
		$this->myform->drawForm($data, $property);
				
	}
	
	function deleteRecord() {
		$id = $_GET['id'];
		$this->load->model('m_groups');
		$this->m_groups->delGroup($id);
		
		$this->load->model('m_modules');
		$this->m_modules->delModulesByGroupId($id); 
	}
	
	function getData() {
		$id = $_POST['id'];
		echo $id;
	}
	
	function save() {

		$read = array();
		$create = array();
		$update = array();
		$delete = array();
		$all_id = array();
		
		$iCompanyId       = 0;
		$idprivi_apps     = 0;
		$idprivi_GroupApp = 0;
		$idprivi_group    = 0;
		$vtxtDesc         = '';
		$vNamaGroup       = '';

		//print_r($_POST);
		foreach($_POST as $value) {
			foreach($value as $key=>$val) {
				if(preg_match('/^cb_r_(.*)$/' , $key , $match)){
					$dtl_no = intval($match[1]);
					$read[$dtl_no] = intval($val);	

					if (!in_array($dtl_no, $all_id)) $all_id[] = $dtl_no;
				}
				
				if(preg_match('/^cb_c_(.*)$/' , $key , $match)){
					$dtl_no = intval($match[1]);
					$create[$dtl_no] = intval($val);
					
					if (!in_array($dtl_no, $all_id)) $all_id[] = $dtl_no;
				}
				
				if(preg_match('/^cb_u_(.*)$/' , $key , $match)){
					$dtl_no = intval($match[1]);
					$update[$dtl_no] = intval($val);
					
					if (!in_array($dtl_no, $all_id)) $all_id[] = $dtl_no;
				}
				
				if(preg_match('/^cb_d_(.*)$/' , $key , $match)){
					$dtl_no = intval($match[1]);
					$delete[$dtl_no] = intval($val);
					
					if (!in_array($dtl_no, $all_id)) $all_id[] = $dtl_no;
				}
				
				if ($key == 'privi_group_pt_app_idprivi_group') {
					$idprivi_group = $val;
				}
				
				if ($key == 'privi_group_pt_app_iCompanyId') {
					$iCompanyId = $val;
				}
				
				if ($key == 'privi_group_pt_app_idprivi_apps') {
					$idprivi_apps = $val;
				}
				
				if ($key == 'privi_group_pt_app_iID_GroupApp') {
					$idprivi_GroupApp = $val;
				}
				
				if ($key == 'privi_group_pt_app_vNamaGroup') {
					$vNamaGroup = $val;
				}
				
				if ($key == 'privi_group_pt_app_txtDesc') {
					$vtxtDesc = $val;
				}
			}
		}
		
		//print_r($read);
		//die('bbbb');
		
		$sess_auth 	= new Zend_Session_Namespace('auth');
		$tCreatedAt = date('Y-m-d', mktime());
		$tUpdatedAt = date('Y-m-d H:i:s', mktime());
		$cCreatedBy = $sess_auth->gNIP;
		
		//update headernya dulu
		if ($idprivi_GroupApp == 0 || $idprivi_GroupApp == '') {
			$SQL = "INSERT INTO privi_group_pt_app (iCompanyId, idprivi_apps, idprivi_group, vNamaGroup, txtDesc, dCreated, cCreatedBy) 
					VALUES ('{$iCompanyId}', '{$idprivi_apps}', '{$idprivi_group}', '{$vNamaGroup}', '{$vtxtDesc}', '{$tCreatedAt}', '{$cCreatedBy}')";
			
			
			$this->dbset->query($SQL);
			$last_id = $this->dbset->insert_id();
			
		} else {
			$SQL = "UPDATE privi_group_pt_app set iCompanyId = '{$iCompanyId}', 
			idprivi_apps = '{$idprivi_apps}', 
			idprivi_group = '{$idprivi_group}', 
			vNamaGroup = '{$vNamaGroup}', 
			txtDesc = '{$vtxtDesc}', 
			tUpdated = '{$tUpdatedAt}',
			cUpdatedBy = '{$cCreatedBy}' 
			WHERE iID_GroupApp = '{$idprivi_GroupApp}'";
			
			
			$this->dbset->query($SQL);
			
			$last_id = $idprivi_GroupApp;
		}
		

		$queries = array();
		
		//delete all record first
		/* $sql = "UPDATE privi_group_pt_app_mod set iCrud = 0 WHERE iCompanyId='{$iCompanyId}' 
						AND idprivi_group = '{$idprivi_group}' 
						AND idprivi_apps = '{$idprivi_apps}'";
		$this->db->query($sql); */
		
		foreach($all_id as $val) {
			 $total_crud =  (array_key_exists($val, $read) ? $read[$val] : 0) + 
			 				(array_key_exists($val, $create) ? $create[$val] : 0) + 
			 				(array_key_exists($val, $update) ? $update[$val] : 0) + 
			 				(array_key_exists($val, $delete) ? $delete[$val] : 0);
			 $sql = "SELECT count(iCrud) as `std`, lDeleted from privi_group_pt_app_mod 
					where iCompanyId='{$iCompanyId}' 
					AND idprivi_apps='{$idprivi_apps}' 
					AND idprivi_group='{$last_id}' 
					AND idprivi_modules='{$val}'";
	
			$query = $this->dbset->query($sql);
			if ( $query->num_rows > 0 ) {
				$row = $query->row();
				$std = $row->std;
				$lDeleted = $row->lDeleted;
				
				if ($std == 0) {
					$queries[] = "INSERT INTO privi_group_pt_app_mod 
									(iCompanyId, idprivi_group, idprivi_apps, idprivi_modules, iCrud, dCreated, cCreatedBy) 
								  VALUES ('{$iCompanyId}', '{$last_id}', '{$idprivi_apps}', '{$val}', '{$total_crud}', '{$tCreatedAt}', '{$cCreatedBy}')";
				} else {
						$queries[] = "UPDATE privi_group_pt_app_mod
						SET iCrud= '{$total_crud}',
						tUpdated = '{$tUpdatedAt}',
						cUpdatedBy='{$cCreatedBy}', 
						lDeleted = '0' 
						WHERE iCompanyId='{$iCompanyId}' 
						AND idprivi_group = '{$last_id}' 
						AND idprivi_apps = '{$idprivi_apps}' 
						AND idprivi_modules = '{$val}'";
				}
			} 
		}
		
		//print_r($queries);
		//die('a');
		if (sizeOf($queries) > 0) {
			foreach($queries as $q) {
				try {
					$this->dbset->query($q);
					$x = '1|'.$last_id;
				}catch(Exception $e) {
					$x = '0|'.$last_id;
					die('Error : '.$e->toString());
				}
			}
		} else {
			//berarti dia gak update app_mod
			$x = '1|'.$last_id;
		}
		
		echo $x;
	}
	
	function getLastGroupId() {		
		$iCompanyId   = $_GET['iCompanyId'];
		$idprivi_apps = $_GET['idprivi_apps'];
		
		$last_group_id = $this->m_groups->getLastGroupId($iCompanyId, $idprivi_apps);
		
		echo $last_group_id;
	}
	
	function checkDuplicate() {		
		$iCompanyId   = $_GET['iCompanyId'];
		$idprivi_apps = $_GET['idprivi_apps'];
		
		$last_group_id = $this->m_groups->checkDuplicate($iCompanyId, $idprivi_apps);
		
		echo $last_group_id;
	}
}
?>