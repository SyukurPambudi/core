<?php
class Menu {
 	private $_ci;
	private $_menu_table = 'perm_data';
	private $_menu_parent = 'parent';
	function __construct() {
        $this->_ci=&get_instance();
    }
	public function render($parent=0) {
		$p_menu = $this->get_menu($parent)->result_array();
		$items = array();
		foreach($p_menu as $menu) {
			if($this->_ci->acl->hasPermission($menu['permKey'],'view')) {
				$items[]=array('label'=>$menu['permName'],'url'=>$menu['permKey'],'class_icon'=>$menu['class_icon'],'sub_menu'=>$this->render($menu['ID']));
			}			
		}
		return $items;
	}
	private function get_menu($p = 0) {
		$sql = "SELECT * FROM ".$this->_ci->db->dbprefix($this->_menu_table)." p 
				WHERE p.deleted = 0 AND status=1 AND p.parent = '".$p."'
				ORDER BY p.bobot ASC";
		return $this->_ci->db->query($sql);
	}
}
