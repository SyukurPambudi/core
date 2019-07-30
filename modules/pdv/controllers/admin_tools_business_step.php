<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_tools_business_step extends MX_Controller {
    function __construct() {
        parent::__construct();
    }
    function index($action = '') {
    	//Bikin Object Baru Nama nya $grid		
		$grid = new Grid;		
		$grid->setTitle('Business Steps');		
		$grid->setTable('packdev.pd_biz_has_steps');		
		$grid->setUrl('admin_tools_business_step');
		$grid->addList('vStepName');
		$grid->setSortBy('vStepName');
		$grid->setSortOrder('ASC'); //sort ordernya
		$grid->setWidth('vCode', '100'); // width nya
		$grid->addFields('vStepName','tCreatedAt','cCreatedBy','tUpdatedAt','cUpdatedBy');
		$grid->setLabel('vStepName', 'Step Name'); //Ganti Label
		$grid->setSearch('vStepName');
		$grid->setRequired('vStepName');	//Field yg mandatori
		$grid->changeFieldType('tCreatedAt','hidden');
		$grid->changeFieldType('cCreatedBy','hidden');
		$grid->changeFieldType('tUpdatedAt','hidden');
		$grid->changeFieldType('cUpdatedBy','hidden');
		$grid->setQuery('isDeleted', 0);
		$grid->setDeletedKey('isDeleted');		
		
		//Set View Gridnya (Default = grid)
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