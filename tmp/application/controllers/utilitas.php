<?php
class Utilitas extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	function index() {
		 
	}
	
	function getEmployee(){
		$list_employee = array(); 
		$this->load->model('m_utilitas');
		$term = $this->input->get('term');
		$data = $this->m_utilitas->m_get_employee($term);
		if($data){
			$i = 1; 
			$total = count($data);
			foreach($data as $dt){
				$list_employee['kry'][] = array(
								'value'=>$dt['value']
								,'label'=>$dt['label'] 
						);
			}
		}		
		echo json_encode($list_employee);
	}
	
	function getCompany(){
		$storeComp = array();
		$this->load->model('m_utilitas');
		$checkComp = $this->m_utilitas->getCompModel();
		$options='';
		foreach($checkComp as $dt) {
			$selected =($dt['idComp']==3) ? 'selected="selected"' : '';
			$options .='<option value="'.$dt['idComp'].'" '.$selected.'>'.$dt['nameComp'].'</option>';
		}
		return $options;	
	}
	
}
/* end of file employee.php */