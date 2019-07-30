<?php
class Mytemplate {
	public $_ci;
	public $pathTpl;
	public $header;
	public $menu;
	public $content;
	public $footer;
	public $menuCompany;
	public $params=array();
	
	function __construct() {
		$this->_ci =& get_instance();
		$this->pathTpl ='templates/blue';
		$this->params['menu'] = Modules::run('menu');//$this->_ci->load->view('menu/v_menu','',TRUE);
		$this->params['menuHeader'] = Modules::run('menu/menu_header/index');
		$this->setInclude( 'home/inc_home' );
		$this->setInclude( 'menu/inc_menu' );
	}
	
	public function setPathTpl( $template ) {
		$this->pathTpl = $template;
	}
	
	public function setInclude( $include ) {
		if(isset($this->params['include'])) {
			$this->params['include'].="\n".$this->_ci->load->view($include, '', TRUE);
		} else {
			$this->params['include']=$this->_ci->load->view($include, '', TRUE);
		}
	}
	
	public function setContent( $content='', $data='' ) {
		if(is_array($data)) {
			$this->params['content']=$this->_ci->load->view($content, $data, TRUE);
		} else {
			$this->params['content']=$this->_ci->load->view($content, '', TRUE);
		}
	}
	
	public function setMenu( $menu ) {
		$this->params['menu']=$this->_ci->load->view($menu, '', TRUE);
	}
		
	public function display() {
		$this->_ci->load->view( $this->pathTpl.'/index', $this->params );
	}

}
?>
