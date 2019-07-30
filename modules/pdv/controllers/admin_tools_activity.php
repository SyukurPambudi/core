<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_tools_activity extends MX_Controller {
    function __construct() {
        parent::__construct();
    }
    function index($action = '') {
    	//Bikin Object Baru Nama nya $grid		
		$grid = new Grid;		
		$grid->setTitle('Activity');		
		$grid->setTable('packdev.pd_activity');		
		$grid->setUrl('admin_tools_activity');
		$grid->addList('idpd_activity','vActivityName');
		$grid->setSortBy('vActivityName');
		$grid->setSortOrder('ASC');
		$grid->setWidth('idpd_activity', '50');
		$grid->addFields('vActivityName','tCreatedAt','cCreatedBy','tUpdatedAt','cUpdatedBy');
		$grid->setLabel('vActivityName', 'Activity Name');
		$grid->setLabel('idpd_activity', 'Activity ID');
		$grid->setSearch('vActivityName');
		$grid->setRequired('vActivityName');
		$grid->setAlign('idpd_activity', 'center');
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
			case 'delete':
				echo $grid->delete_row();
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
