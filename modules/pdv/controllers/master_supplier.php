<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Master_supplier extends MX_Controller {
    function __construct() {
        parent::__construct();
		$this->load->library('auth');
    }
    function index($action = '') {
    	$grid = new Grid;
		$grid->setTitle('Master Supplier');		
		$grid->setTable('packdev.pd_supplier');		
		$grid->setUrl('master_supplier');
		$grid->addList('cNamaSup','cNamaBoss','cNamaKontak','cTelepon1');
		$grid->setSortBy('cNamaSup');
		$grid->setSortOrder('asc');
		$grid->addFields('cNamaSup','cNamaBoss','cNamaKontak','cAlamat1','cTelepon1','cTelepon2','cTelepon3');
		$grid->addFields('cFax','cFax2','cNamaBank','cAlamBank','cAccNom1','cAccNom2','cNpwp','cCab1','cCab2');
		$grid->setLabel('cNamaBoss', 'Nama Pemilik');
		$grid->setLabel('cNamaSup', 'Suppplier');
		$grid->setLabel('cNamaKontak', 'Contact Person');
		$grid->setLabel('cAlamat1', 'Alamat 1');
		$grid->setLabel('cAlamat2', 'Alamat 2');
		$grid->setLabel('cTelepon1', 'Telepon 1');
		$grid->setLabel('cTelepon2', 'Telepon 2');
		$grid->setLabel('cTelepon3', 'Telepon 3');
		$grid->setLabel('cFax', 'Fax 1');
		$grid->setLabel('cFax2', 'Fax 2');
		$grid->setLabel('cNamaBank', 'Nama Bank');
		$grid->setLabel('cAlamBank', 'Alamat Bank');
		$grid->setLabel('cAccNom1', 'Nomor Rekening 1');
		$grid->setLabel('cAccNom2', 'Nomor Rekening 2');
		$grid->setLabel('cNpwp', 'Nomor NPWP');
		$grid->setLabel('cCab1', 'Cabang 1');
		$grid->setLabel('cCab2', 'Cabang 2');
		$grid->setSearch('cNamaSup','cNamaBoss','cNamaKontak','cAlamat1');
		$grid->setRequired('cNamaSup','cNamaKontak','cAlamat1','cTelepon1');
		$grid->changeFieldType('cAlamat1', 'text');
		$grid->changeFieldType('cAlamat2', 'text');
		$grid->changeFieldType('cAlamBank', 'text');
		
		$grid->setGridView('grid');
		
		switch ($action) {
			case 'json':
				$grid->getJsonData();
				break;			
			case 'create':
				$grid->render_form();
				break;
			case 'createproses':
				echo $grid->saved_form();
				break;
			case 'update':
				$grid->render_form($this->input->get('id'));
				break;
			case 'view':
				$grid->render_form($this->input->get('id'),TRUE);
				break;
			case 'updateproses':
				echo $grid->updated_form();
				break;
			default:
				$grid->render_grid();
				break;
		}
    }

	function output(){
    	$this->index($this->input->get('action'));
    }
}