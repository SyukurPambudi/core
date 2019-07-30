<?php
class MyAcl {
	public $_ci;
	
	public function __construct() {
		$this->_ci=&get_instance();
		
		//model
		$this->_ci->load->model('home/m_home');
	}
	
	public function getMyAcl($pt, $acc, $group_and_modul) {		
		$crud = $this->_ci->m_home->getAcl($pt, $acc, $group_and_modul);
				
		return $crud;		
	}
}