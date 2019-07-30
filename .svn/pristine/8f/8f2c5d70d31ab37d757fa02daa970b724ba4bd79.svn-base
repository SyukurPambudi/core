<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class RS_Master_Data_Pribadi_Pelamar extends MX_Controller {
	
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
		
		$this->load->model('Personalia/m_employee', 'prs_employee');
		$this->load->model('Personalia/m_propinsi', 'prs_propinsi');
		
		//database
		$this->db    = 'hrd';
		$this->dbset = $this->load->database($this->db, true);
		$this->db_prefix = $this->dbset->database;		
		
		$this->table  = 'rs_applicant';
		$this->pk_id  = 'iRegID';
		
		//
		$this->url 	  = 'rs/rs_master_data_pribadi_pelamar';
		$this->view   = 'rs/rs_master_data_pribadi_pelamar/v_application';
		$this->sort_by= 'vApplication';
		$this->caption= 'Applicant List';
		
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
					'label'  => 'No. Registrasi',
					'name'   => 'iRegID',
					'width'  => 50,
					'size'   => 30,
					'adv_src'=> TRUE,
					'type'	 => 'text',
					'showOnGrid' => false,						
					'PK'         => TRUE
				),
				array(
					'label'  => 'Nama Pelamar',
					'name'   => 'vApplicant',
					'width'  => 200,
					'size'   => 50,
					'adv_src'=> TRUE,
					'type'	 => 'text',
					'showOnGrid' => TRUE
				),
				array(
					'label'  => 'Jns. Kelamin',
					'name'   => 'cSex',
					'width'  => 10,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => TRUE,
					'relationAt' => TRUE
				),
				array(
					'label'  => 'Tempat Lahir',
					'name'   => 'vBirthPlace',
					'width'  => 200,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => TRUE
				),
				array(
					'label'  => 'iPostID',
					'name'   => 'iPostID',
					'width'  => 200,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => FALSE,
					'relationTo' => 'position.iPostID',
				),
				array(
					'table'  => 'position',
					'label'  => 'Posisi/Jabatan',
					'name'   => 'vDescription',
					'width'  => 200,
					'size'   => 50,
					'adv_src'=> TRUE,
					'type'	 => 'text',
					'showOnGrid' => TRUE,
					'relationTo' => 'rs_applicant.iPostID',
				),
				array(
					'label'  => 'Tgl. Lahir',
					'name'   => 'dBirthDay',
					'width'  => 10,
					'size'   => 10,
					'adv_src'=> TRUE,
					'type'	 => 'date',
					'showOnGrid' => TRUE,
					'relationAt' => TRUE,
				),
				array(
					'label'  => 'iAreaID',
					'name'   => 'iAreaID',
					'width'  => 10,
					'size'   => 10,
					'adv_src'=> FALSE,
					'type'	 => 'text',
					'showOnGrid' => FALSE,
					'relationTo' => 'area.iAreaID',						
				),
				array(
					'table'  => 'area',
					'label'  => 'Area',
					'name'   => 'VAreaName',
					'width'  => 10,
					'size'   => 50,
					'adv_src'=> TRUE,
					'type'	 => 'text',
					'showOnGrid' => TRUE,
					'relationTo' => 'rs_applicant.iAreaID',
				),
				array(
					'label'  => 'Tgl. Psikotest',
					'name'   => 'dPsiko1',
					'width'  => 10,
					'size'   => 10,
					'adv_src'=> TRUE,
					'type'	 => 'date',
					'showOnGrid' => TRUE,
					'relationAt' => TRUE,
				),
				
		);
		
		$group_and_modul["parent_id"] = 0;
		
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
								, 'group_and_modul' => $group_and_modul
								, 'where_condition' => $this->db_prefix.'.'.$this->table.'.lDeleted = "0"'		
							);
		
		
		$isi = $this->mygrid2->drawGrid($property);
		echo $isi;
	}
	
	public function processForm() {
		$row = array();
		
		$no_urut = 0;
		
		$row = $this->m_utilitas->getData($this->db, $this->table, $this->pk_id, $_GET['id']);
		
		$sex = array('W'=>'Wanita', 'P'=>'Pria');
		$tipe = array(1=>'Calon Karyawan', 2=>'Karyawan Promosi');
		$sumber = array(1=>'Kirim Langsung', 2=>'Walk In', 3=>'Pengumuman', 4=>'Iklan', 5=>'Referensi');
	
		$data = array(	
				array(
						'label'  => 'No. Registrasi',
						'name'   => 'iRegID',
						'width'  => 10,
						'size'   => 10,
						'value'  => $row['iRegID'],
						'type'   => 'hidden',
						'maxlength' => 5,
						'style'  => '',
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 1,
						'required' => TRUE,
						'duplicated' => TRUE,
						'model' => '',
						'method' => '',
				),
				array(
						'label'  => 'User yang mengajukan',
						'name'   => 'cUser1',
						'width'  => 10,
						'size'   => 50,
						'value'  => $row['cUser1'],
						'type'   => 'lookup',
						'maxlength' => 5,
						'style'  => '',
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 1,
						'required' => TRUE,
						'duplicated' => TRUE,
						'model' => 'm_employee',
						'method' => 'getNameByNIP',
				),
				array(
						'label'  => 'Nama Pelamar',
						'name'   => 'vApplicant',
						'width'  => 220,
						'size'   => 80,
						'value'  => $row['vApplicant'],
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
						'label'  => 'Jenis Kelamin',
						'name'   => 'cSex',
						'width'  => 220,
						'size'   => 80,
						'values' => $sex,
						'value'  => $row['cSex'],
						'maxlength' => 50,
						'type'   => 'combobox',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => TRUE,
						'duplicated' => FALSE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => 'm_applicant',
						'method' => 'getSexById',
						'relationAt' => TRUE,
				),
				array(
						'label'  => 'Tempat Lahir',
						'name'   => 'vBirthPlace',
						'width'  => 220,
						'size'   => 80,
						'value'  => $row['vBirthPlace'],
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
						'label'  => 'Tgl. Lahir',
						'name'   => 'dBirthDay',
						'width'  => 220,
						'size'   => 12,
						'value'  => date('d-m-Y', strtotime($row['dBirthDay'])),
						'maxlength' => 50,
						'type'   => 'date',
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
						'label'  => 'Alamat Sekarang',
						'name'   => 'vStAddress',
						'width'  => 220,
						'size'   => 80,
						'rows'   => 6,
						'cols'   => 40,
						'value'  => $row['vStAddress'],
						'maxlength' => 50,
						'type'   => 'textarea',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => '',
				),
				array(
						'label'  => 'Blok',
						'name'   => 'vStBlock',
						'width'  => 220,
						'size'   => 10,
						'value'  => $row['vStBlock'],
						'maxlength' => 50,
						'type'   => 'textbox',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => '',
				),
				array(
						'label'  => 'Lot/Kavling',
						'name'   => 'vStLot',
						'width'  => 220,
						'size'   => 10,
						'value'  => $row['vStLot'],
						'maxlength' => 50,
						'type'   => 'textbox',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => '',
				),
				array(
						'label'  => 'No. Rumah',
						'name'   => 'vStHomeNo',
						'width'  => 220,
						'size'   => 10,
						'value'  => $row['vStHomeNo'],
						'maxlength' => 50,
						'type'   => 'textbox',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => '',
				),
				array(
						'label'  => 'RT',
						'name'   => 'vStRT',
						'width'  => 220,
						'size'   => 5,
						'value'  => $row['vStRT'],
						'maxlength' => 50,
						'type'   => 'textbox',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => '',
				),
				array(
						'label'  => 'RW',
						'name'   => 'vStRW',
						'width'  => 220,
						'size'   => 5,
						'value'  => $row['vStRW'],
						'maxlength' => 50,
						'type'   => 'textbox',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => '',
				),
				array(
						'label'  => 'Kelurahan',
						'name'   => 'vStKelurahan',
						'width'  => 220,
						'size'   => 20,
						'value'  => $row['vStKelurahan'],
						'maxlength' => 50,
						'type'   => 'textbox',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => '',
				),
				array(
						'label'  => 'Kecamatan',
						'name'   => 'vStKecamatan',
						'width'  => 220,
						'size'   => 20,
						'value'  => $row['vStKecamatan'],
						'maxlength' => 50,
						'type'   => 'textbox',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => '',
				),
				array(
						'label'  => 'Kota',
						'name'   => 'vStKota',
						'width'  => 220,
						'size'   => 20,
						'value'  => $row['vStKota'],
						'maxlength' => 50,
						'type'   => 'textbox',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => '',
				),
				array(
						'label'  => 'Propinsi',
						'name'   => 'iProvID',
						'width'  => 220,
						'size'   => 20,
						'values' => $this->prs_propinsi->getAllPropinsi(),
						'value'  => $row['iProvID'],
						'maxlength' => 50,
						'type'   => 'combobox',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => 'prs_propinsi',
						'method' => 'getNameById',
				),
				array(
						'label'  => 'Kode Pos',
						'name'   => 'vStPostal',
						'width'  => 220,
						'size'   => 20,
						'value'  => $row['vStPostal'],
						'maxlength' => 50,
						'type'   => 'textbox',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => '',
				),
				array(
						'label'  => 'Kode Area (Telp.)',
						'name'   => 'vStPhoneCode',
						'width'  => 220,
						'size'   => 20,
						'value'  => $row['vStPhoneCode'],
						'maxlength' => 50,
						'type'   => 'textbox',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => '',
				),
				array(
						'label'  => 'No. Telepon',
						'name'   => 'vStPhoneNumber',
						'width'  => 220,
						'size'   => 20,
						'value'  => $row['vStPhoneNumber'],
						'maxlength' => 50,
						'type'   => 'textbox',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => '',
				),
				array(
						'label'  => 'No. HP',
						'name'   => 'vHP',
						'width'  => 220,
						'size'   => 20,
						'value'  => $row['vHP'],
						'maxlength' => 50,
						'type'   => 'textbox',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => '',
				),
				array(
						'label'  => 'Tipe Psikotest',
						'name'   => 'iType',
						'width'  => 220,
						'size'   => 20,
						'value'  => $row['iType'],
						'values' => $tipe,
						'maxlength' => 50,
						'type'   => 'combobox',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => TRUE,
						'duplicated' => true,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => 'm_applicant',
						'method' => 'getTipePsikoById',
						'relationAt' => TRUE,
				),				
				array(
						'label'  => 'NIP Karyawan Promosi',
						'name'   => 'cRef',
						'width'  => 10,
						'size'   => 50,
						'value'  => $row['cRef'],
						'type'   => 'lookup',
						'maxlength' => 5,
						'style'  => '',
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 1,
						'required' => TRUE,
						'duplicated' => TRUE,
						'model' => 'm_employee',
						'method' => 'getNameByNIP',
				),
				array(
						'label'  => 'Sumber Informasi Pelamar',
						'name'   => 'iSourceData',
						'width'  => 220,
						'size'   => 80,
						'values' => $sumber,
						'value'  => $row['iSourceData'],
						'maxlength' => 50,
						'type'   => 'combobox',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => TRUE,
						'duplicated' => FALSE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => 'm_applicant',
						'method' => 'getSumberById',
						'relationAt' => TRUE,
				),				
				array(
						'label'  => 'Nama Media',
						'name'   => 'vMedia',
						'width'  => 220,
						'size'   => 60,
						'value'  => $row['vMedia'],
						'maxlength' => 50,
						'type'   => 'textbox',
						'style'  => '',
						'class'  	=> 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => '',
				),
		);
		
		$property = array( 'url' 	 => $this->url
						 , 'view' 	 => $this->view
						 , 'proc'    =>  $_GET['proc']
						 , 'draw_dtl'=> false
						 , 'opt_dtl' => ''
					     , 'pk_id'   => $this->pk_id
						 , 'param_id'=>  $_GET['id']
						 , 'table'   => $this->table
						 , 'parent_id' =>  $_GET['id']
						 , 'db'      => $this->db
						 , 'button'  => ''
					);
		$this->myform->drawForm($data, $property);
				
	}
}
?>