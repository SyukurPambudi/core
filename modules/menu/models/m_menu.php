<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_menu extends CI_Model{
	public $table;
	public $db;
	
	function __construct(){
		parent::__construct();
		$this->db	 = set_db('default', true);
	}
	
	function getAppmenu($nip, $pt) {
      	$sql = "SELECT    ( t1.cNIP ) AS 'nip'
						, ( t1.iCompanyId ) AS 'comId'
						, ( SELECT tx1.vCompName FROM hrd.company tx1 WHERE tx1.iCompanyId = t1.iCompanyId) AS 'compName'
						, ( t1.idprivi_apps)AS 'idApp'
						, ( SELECT tx2.vAppName FROM privi_apps tx2 WHERE tx2.idprivi_apps = t1.idprivi_apps) AS 'appName'
						, ( t1.idprivi_group)AS 'idGroup'
						, t2.isDeleted
				FROM
					privi_authlist t1
					LEFT JOIN 
					privi_apps t2 ON t1.idprivi_apps = t2.idprivi_apps
				WHERE
					t1.cNIP = '".$nip."'
					AND t1.isDeleted = '0'
					AND t2.isDeleted = '0' 
					AND	t1.iCompanyId 	= '".$pt."'
					ORDER BY t2.vAppName ASC";
      
		$query = $this->db->query($sql);
		
		if($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			$rtr = array('no_access');
			return $rtr;
		}
	}
	
	function getAppMenuModules($nip, $pt, $appId, $index, $group) {		
		
		$sql = "SELECT a.cNIP, (SELECT vCompName FROM hrd.company WHERE iCompanyId = a.iCompanyId) AS `Company`,
				(SELECT vAppName FROM privi_apps WHERE idprivi_apps = a.idprivi_apps) AS `AppName`,
				a.idprivi_apps AS `App_ID`, a.idprivi_group AS `group`, c.idprivi_modules AS `id`, d.idprivi_modules, c.iCrud,
				d.vCodeModule AS vCodeModule, d.vPathModule AS `Mod_Path`, d.iParent AS `parent_id`, d.vNameModule AS `text` 
				FROM privi_authlist a LEFT JOIN  privi_group_pt_app b ON  a.iCompanyId = b.iCompanyId AND a.idprivi_apps = b.idprivi_apps 
				AND a.idprivi_group = b.iID_GroupApp LEFT JOIN privi_group_pt_app_mod c ON 
				b.iCompanyId = c.iCompanyId AND b.idprivi_apps = c.idprivi_apps AND b.iID_GroupApp = c.idprivi_group LEFT JOIN 
				privi_modules d ON c.idprivi_apps = d.idprivi_apps AND c.idprivi_modules = d.idprivi_modules
				WHERE a.cNIP = '{$nip}' AND a.iCompanyId = '{$pt}' AND a.idprivi_group = '{$group}' 
				AND a.idprivi_apps = '{$appId}' AND a.isDeleted = '0' AND d.isDeleted = '0'  
				AND c.iCrud > 0 AND d.iParent = '{$index}' order by d.vCodeModule asc";
		
		//echo $sql;
		$q = $this->db->query($sql);
	    
	    if($q->num_rows() == 0) {
	        return false;
	    }
		
	    // User $tree instead of the $menu global as this way there shouldn't be any data duplication
	    $tree = $index > 0 ? '<ul>' : ''; // If we are on index 0 then we don't need the enclosing ul
	    
	    foreach($q->result_array() as $arr) {	    		    		
	    	
	    	$sql1 = "SELECT a.cNIP, (SELECT vCompName FROM hrd.company WHERE iCompanyId = a.iCompanyId) AS `Company`,
				(SELECT vAppName FROM privi_apps WHERE idprivi_apps = a.idprivi_apps) AS `AppName`,
				a.idprivi_apps AS `App_ID`, a.idprivi_group AS `group`, c.idprivi_modules AS `id`, d.idprivi_modules, c.iCrud,
				d.vCodeModule AS vCodeModule, d.vPathModule AS `Mod_Path`, d.iParent AS `parent_id`, d.vNameModule AS `text` 
				FROM privi_authlist a LEFT JOIN  privi_group_pt_app b ON  a.iCompanyId = b.iCompanyId AND a.idprivi_apps = b.idprivi_apps 
				AND a.idprivi_group = b.iID_GroupApp LEFT JOIN privi_group_pt_app_mod c ON 
				b.iCompanyId = c.iCompanyId AND b.idprivi_apps = c.idprivi_apps AND b.iID_GroupApp = c.idprivi_group LEFT JOIN 
				privi_modules d ON c.idprivi_apps = d.idprivi_apps AND c.idprivi_modules = d.idprivi_modules
				WHERE a.cNIP = '{$nip}' AND a.iCompanyId = '{$pt}' AND a.idprivi_group = '{$group}' 
				AND a.idprivi_apps = '{$appId}' AND a.isDeleted = '0' AND d.isDeleted = '0'  
				AND c.iCrud > 0 AND d.iParent = '{$arr['id']}' order by d.vCodeModule asc";
	    	
	        $subFileCount=$this->db->query($sql1);	        
	        if($subFileCount->num_rows() > 0){
	            $class = 'folder';
	        } else {
	            $class = 'file';
	        }
		        $tree .= '<li>';
		        $tree .= '<span class="'.$class.'" id="'.$arr['id'].'" rel="'.strtolower($arr['Mod_Path']).'" style="cursor:pointer;" group="'.$arr['group'].'">'.$arr['text'].'</span>';
		        $tree .= $this->getAppMenuModules($nip, $pt, $appId,"".$arr['id']."", "".$arr['group']."");
		        $tree .= '</li>'."\n";
	    }
	    
	    $tree .= $index > 0 ? '</ul>' : ''; // If we are on index 0 then we don't need the enclosing ul
	    	   
	
	    return $tree;
	}
}
