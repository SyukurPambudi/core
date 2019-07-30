<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Master_material extends MX_Controller {
    function __construct() {
        parent::__construct();
		$this->load->library('auth');
    }
    function index($action = '') {
    	$grid = new Grid;
		$grid->setTitle('Master Material Bahan Kemas');		
		$grid->setTable('packdev.pd_material');		
		$grid->setUrl('master_material');
		$grid->addList('vNama_mat','ldeleted');
		$grid->setSortBy('vNama_mat');
		$grid->setSortOrder('desc');
		$grid->addFields('vNama_mat','ldeleted');
		$grid->setFormWidth('vNama_mat',70);
		$grid->setLabel('vNama_mat', 'Nama Material');
		$grid->setLabel('ldeleted','Aktif');
		$grid->setSearch('vNama_mat','ldeleted');
		$grid->setRequired('vNama_mat','vsatuan','ldeleted');
		$grid->changeFieldType('ldeleted', 'combobox', '', array(''=>'-', 0=>'Aktif', 1=>'Tidak Aktif'));
		
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
			case 'delete':
				echo $grid->delete_row();
				break;
			default:
				$grid->render_grid();
				break;
		}
    }

	function before_insert_processor($row, $postData) {
		$now = date('Y-m-d H:i:s');
		$user = $this->auth->user();		
		$postData['tInsert'] = $now;
		$postData['cInsert'] = $user->gNIP;
		return $postData;
	}

	function before_update_processor($row, $postData) {
		$now = date('Y-m-d H:i:s');
		$user = $this->auth->user();
		$postData['tUpdate'] = $now;
		$postData['cUpdate'] = $user->gNIP;
		return $postData;
	}

	function output(){		
    	$this->index($this->input->get('action'));
    }
}