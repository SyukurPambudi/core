<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ga_master_supplier extends MX_Controller {
	
	private $dbset;
	private $table;
	private $data;
	private $param_id;
	
	//for header
	private $db;
	private $db_prefix;
	private $url;
	private $pk_db;
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
		
		$this->table  = 'ga_mssupplier';
		$this->pk_id  = 'id';
		
		//
		$this->url 	   = 'ga/ga_master_supplier';
		$this->view    = 'ga/ga_master_supplier/v_applications';
		$this->sort_by = 'cNamaSup';
		$this->caption = 'Supplier';
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

		$service = array('S'=>'Service', 'P'=>'Part Kendaraan', 'N'=>'Non Part Kendaraan');
		//
		$this->data = array(
				array(
						'label'  	 => 'id',
						'name'   	 => 'id',
						'width'  	 => 50,
						'size'   	 => 10,
						'adv_src'	 => FALSE,
						'type'	 	 => 'text',
						'showOnGrid' => FALSE,						
						'PK'         => TRUE
				),
				array(
						'label'  => 'Nama Supplier',
						'name'   => 'cNamaSup',
						'width'  => 100,
						'size'   => 50,
						'adv_src'=> TRUE,
						'type'	 => 'text',
						'showOnGrid' => TRUE,
				),
				array(
						'label'  => 'Owner',
						'name'   => 'cNamaBoss',
						'width'  => 100,
						'size'   => 50,
						'adv_src'=> FALSE,
						'type'	 => 'text',
						'showOnGrid' => FALSE
				),
				array(
						'label'  => 'Kontak',
						'name'   => 'cNamaKontak',
						'width'  => 100,
						'size'   => 50,
						'adv_src'=> FALSE,
						'type'	 => 'text',
						'showOnGrid' => TRUE
				),
				array(
						'label'  => 'Area',
						'name'   => 'cAreaCode',
						'width'  => 100,
						'size'   => 50,
						'adv_src'=> FALSE,
						'type'	 => 'text',
						'showOnGrid' => TRUE
				),
				array(
						'label'  => 'Telp. I',
						'name'   => 'cTelepon1',
						'width'  => 100,
						'size'   => 50,
						'adv_src'=> FALSE,
						'type'	 => 'text',
						'showOnGrid' => TRUE
				),
				array(
						'label'  => 'Telp. II',
						'name'   => 'cTelepon2',
						'width'  => 100,
						'size'   => 50,
						'adv_src'=> FALSE,
						'type'	 => 'text',
						'showOnGrid' => TRUE
				),
				array(
						'label'  => 'Fax I',
						'name'   => 'cFax',
						'width'  => 100,
						'size'   => 50,
						'adv_src'=> FALSE,
						'type'	 => 'text',
						'showOnGrid' => TRUE
				),
				array(
						'label'  => 'Fax II',
						'name'   => 'cFax2',
						'width'  => 100,
						'size'   => 50,
						'adv_src'=> FALSE,
						'type'	 => 'text',
						'showOnGrid' => TRUE
				),
				
		);
		
		$group_and_modul['parent_id'] = 0;
		
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
								, 'where_condition' => $this->db_prefix.'.'.$this->table.'.lDeleted = 0 and '.$this->db_prefix.'.'.$this->table.'.cPenFlag = "S" and '.$this->db_prefix.'.'.$this->table.'.cStatus = "A"'
							);
		
		
		$isi = $this->mygrid2->drawGrid($property);
		echo $isi;
	}
	
	public function processForm() {
		$row = array();	
		
		$this->load->model('m_jenis_service');
		
		$row = $this->m_utilitas->getData($this->db, $this->table, $this->pk_id, $_GET['id']);
	
		$data = array(
				array(
						'label'  => 'id',
						'name'   => 'id',
						'width'  => 10,
						'size'   => 10,
						'value'  => $row['id'],
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
						'label'  => 'Nama Supplier',
						'name'   => 'cNamaSup',
						'width'  => 220,
						'size'   => 50,
						'value'  => $row['cNamaSup'],
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
						'label'  => 'Owner',
						'name'   => 'cNamaBoss',
						'type'   => 'textbox',
						'width'  => 220,
						'size'   => 50,
						'style'  => '',
						'value'  => $row['cNamaBoss'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '', 
						'method' => ''
				),
				array(
						'label'  => 'Kontak',
						'name'   => 'cNamaKontak',
						'type'   => 'textbox',
						'width'  => 220,
						'size'   => 50,
						'style'  => '',
						'value'  => $row['cNamaKontak'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => ''
				),
				array(
						'label'  => 'Alamat I',
						'name'   => 'cAlamat1',
						'type'   => 'textarea',
						'width'  => 220,
						'size'   => 50,
						'style'  => '',
						'rows'   => 4,
						'cols'   => 60,
						'value'  => $row['cAlamat1'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => ''
				),
				array(
						'label'  => 'Alamat II',
						'name'   => 'cAlamat2',
						'type'   => 'textarea',
						'width'  => 220,
						'size'   => 50,
						'style'  => '',
						'rows'   => 4,
						'cols'   => 60,
						'value'  => $row['cAlamat2'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => ''
				),
				array(
						'label'  => 'Area',
						'name'   => 'cAreaCode',
						'type'   => 'label',
						'width'  => 220,
						'size'   => 5,
						'style'  => '',
						'value'  => $row['cAreaCode'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => ''
				),
				array(
						'label'  => 'Telepon I',
						'name'   => 'cTelepon1',
						'type'   => 'label',
						'width'  => 220,
						'size'   => 15,
						'style'  => '',
						'value'  => $row['cTelepon1'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => ''
				),
				array(
						'label'  => 'Telepon II',
						'name'   => 'cTelepon2',
						'type'   => 'hidden',
						'width'  => 220,
						'size'   => 15,
						'style'  => '',
						'value'  => $row['cTelepon2'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => ''
				),
				array(
						'label'  => 'Telepon III',
						'name'   => 'cTelepon3',
						'type'   => 'hidden',
						'width'  => 220,
						'size'   => 15,
						'style'  => '',
						'value'  => $row['cTelepon3'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => ''
				),
				array(
						'label'  => 'Telepon IV',
						'name'   => 'cTelepon4',
						'type'   => 'hidden',
						'width'  => 220,
						'size'   => 15,
						'style'  => '',
						'value'  => $row['cTelepon4'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => ''
				),
				array(
						'label'  => 'Telepon V',
						'name'   => 'cTelepon5',
						'type'   => 'hidden',
						'width'  => 220,
						'size'   => 15,
						'style'  => '',
						'value'  => $row['cTelepon5'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => ''
				),
				array(
						'label'  => 'Fax I',
						'name'   => 'cFax',
						'type'   => 'label',
						'width'  => 220,
						'size'   => 15,
						'style'  => '',
						'value'  => $row['cFax'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => ''
				),
				array(
						'label'  => 'Fax II',
						'name'   => 'cFax2',
						'type'   => 'hidden',
						'width'  => 220,
						'size'   => 15,
						'style'  => '',
						'value'  => $row['cFax2'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => ''
				),
				array(
						'label'  => 'Fax III',
						'name'   => 'cFax3',
						'type'   => 'hidden',
						'width'  => 220,
						'size'   => 15,
						'style'  => '',
						'value'  => $row['cFax3'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => ''
				),
				array(
						'label'  => 'Nama Bank',
						'name'   => 'cNamaBank',
						'type'   => 'hidden',
						'width'  => 220,
						'size'   => 40,
						'style'  => '',
						'value'  => $row['cNamaBank'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => ''
				),
				array(
						'label'  => 'Alamat Bank',
						'name'   => 'cAlamBank',
						'type'   => 'hidden',
						'width'  => 220,
						'size'   => 20,
						'style'  => '',
						'rows'   => 4,
						'cols'   => 40,
						'value'  => $row['cAlamBank'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => ''
				),
				array(
						'label'  => 'Kode Rekening I',
						'name'   => 'cAccNo1',
						'type'   => 'hidden',
						'width'  => 220,
						'size'   => 20,
						'style'  => '',
						'value'  => $row['cAccNo1'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => ''
				),
				array(
						'label'  => 'Kode Rekening II',
						'name'   => 'cAccNo2',
						'type'   => 'hidden',
						'width'  => 220,
						'size'   => 20,
						'style'  => '',
						'value'  => $row['cAccNo2'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => ''
				),
				array(
						'label'  => 'NPWP',
						'name'   => 'cNpwp',
						'type'   => 'label',
						'width'  => 220,
						'size'   => 30,
						'style'  => '',
						'value'  => $row['cNpwp'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => ''
				),
				array(
						'label'  => 'PKP',
						'name'   => 'cPkp',
						'type'   => 'hidden',
						'width'  => 220,
						'size'   => 30,
						'style'  => '',
						'value'  => $row['cPkp'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => ''
				),
				array(
						'label'  => 'Atas Nama',
						'name'   => 'cAn',
						'type'   => 'hidden',
						'width'  => 220,
						'size'   => 30,
						'style'  => '',
						'value'  => $row['cAn'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => ''
				),
				array(
						'label'  => 'Cabang I',
						'name'   => 'cCabang1',
						'type'   => 'hidden',
						'width'  => 220,
						'size'   => 30,
						'style'  => '',
						'value'  => $row['cCabang1'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => ''
				),
				array(
						'label'  => 'Cabang II',
						'name'   => 'cCabang2',
						'type'   => 'hidden',
						'width'  => 220,
						'size'   => 30,
						'style'  => '',
						'value'  => $row['cCabang2'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => ''
				),
				array(
						'label'  => 'Nama Bank II',
						'name'   => 'cNamaBank2',
						'type'   => 'hidden',
						'width'  => 220,
						'size'   => 30,
						'style'  => '',
						'value'  => $row['cNamaBank2'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => ''
				),
				array(
						'label'  => 'Cabang I',
						'name'   => 'cCab1',
						'type'   => 'hidden',
						'width'  => 220,
						'size'   => 30,
						'style'  => '',
						'value'  => $row['cCab1'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => ''
				),
				array(
						'label'  => 'Cabang II',
						'name'   => 'cCab2',
						'type'   => 'hidden',
						'width'  => 220,
						'size'   => 30,
						'style'  => '',
						'value'  => $row['cCab2'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => ''
				),
				array(
						'label'  => 'Atas Nama',
						'name'   => 'cAn2',
						'type'   => 'hidden',
						'width'  => 220,
						'size'   => 30,
						'style'  => '',
						'value'  => $row['cAn2'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => ''
				),

				array(
						'label'  => 'No. Rekening I',
						'name'   => 'cAccNom1',
						'type'   => 'hidden',
						'width'  => 220,
						'size'   => 30,
						'style'  => '',
						'value'  => $row['cAccNom1'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => ''
				),
				array(
						'label'  => 'No. Rekening II',
						'name'   => 'cAccNom2',
						'type'   => 'hidden',
						'width'  => 220,
						'size'   => 30,
						'style'  => '',
						'value'  => $row['cAccNom2'],
						'class'  => 'fieldTextBox',
						'disabled'	=> 0,
						'readonly'	=> 0,
						'required' => FALSE,
						'duplicated' => TRUE,
						//jika ada link ketabel lain boleh ditambahkan properti tabel dan method (yang sudah dibuat di model dari tabel trsebut
						'model'  => '',
						'method' => ''
				),
		);
			
		$property = array('multipart'  => FALSE
						 , 'url' 	   => $this->url
						 , 'view' 	   => $this->view
						 , 'proc'      => $_GET['proc']
						 , 'parent_id' => $_GET['id']
						 , 'param_id'  => $_GET['id']
						 , 'draw_dtl'  => false
						 , 'opt_dtl'   => ''
					     , 'pk_id'     => $this->pk_id
						 , 'table'     => $this->table
						 , 'db'        => $this->db
						 , 'button'    => ''//$button
					);
		$this->myform->drawForm($data, $property);
				
	}
}
?>