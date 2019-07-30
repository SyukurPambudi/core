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
						, t2.lDeleted
				FROM
					privi_authlist t1
					LEFT JOIN 
					privi_apps t2 ON t1.idprivi_apps = t2.idprivi_apps
				WHERE
					t1.cNIP = '".$nip."'
					AND t1.lDeleted = '0'
					AND t2.lDeleted = '0' 
					AND	t1.iCompanyId 	= '".$pt."' ;";
      
		$query = $this->db->query($sql);
		
		if($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			$rtr = array('no_access');
			return $rtr;
		}
	}
	
	function getAppMenuModules($nip, $pt, $appId, $index, $group) {		
		/*$sql ="SELECT ( t1.cNIP ) AS 'NIP'
					, ( SELECT tx1.vCompName FROM hrd.company tx1 WHERE tx1.iCompanyId = t1.iCompanyId ) AS 'Company'
					, (	SELECT tx2.vAppName FROM privi_apps tx2 WHERE tx2.idprivi_apps = t1.idprivi_apps) AS 'AppName'
					##
					, t4.idprivi_apps AS `App_ID`
					, t4.idprivi_modules AS `id`
					, t4.iparent AS `parent_id`
					, t4.vNameModule AS `text`
					, t4.vCodeModule
					, t4.vPathModule AS `Mod_Path`
					, t1.idprivi_group AS `group`
					
				FROM
					privi_authlist t1
					
					LEFT JOIN					
					privi_group_pt_app t2 ON t2.iCompanyId = t1.iCompanyId AND t2.idprivi_apps = t1.idprivi_apps
					
					LEFT JOIN					
					privi_group_pt_app_mod t3 ON t3.iCompanyId = t1.iCompanyId AND t3.idprivi_apps = t1.idprivi_apps AND t3.idprivi_group = t2.iID_GroupApp
					##
					LEFT JOIN
					privi_modules t4 ON t4.idprivi_apps = t3.idprivi_apps AND t4.idprivi_modules = t3.idprivi_modules
				WHERE
					t1.cNIP = '{$nip}'
					AND
					t1.iCompanyId 	= '{$pt}'
					AND
					t1.idprivi_apps = '{$appId}' 
					AND
					t2.iID_GroupApp =  '{$group}' 
					AND 
					t4.iparent = '{$index}' 
					AND
					t4.lDeleted = 0 
	    			AND 
	    			t1.lDeleted = 0 
					AND 
					t3.iCrud > 0";
		*/
		/* $sql ="SELECT c.cNIP AS NIP, (SELECT vCompName FROM hrd.company WHERE iCompanyId = c.iCompanyID) AS `Company`,
				(SELECT vAppName FROM privi_apps WHERE idprivi_apps = c.idprivi_apps) AS `AppName`,  
				c.idprivi_apps AS `App_ID`, c.idprivi_group AS `group`, 
				f.idprivi_modules AS `id`, f.iParent AS `parent_id`, f.vNameModule AS `text`, 
				f.vCodeModule AS vCodeModule, f.vPathModule AS `Mod_Path` FROM privi_authlist c 
				LEFT JOIN privi_group_pt_app d ON c.idprivi_group = d.iID_GroupApp 
				LEFT JOIN privi_group_pt_app_mod e ON e.iCompanyId = d.iCompanyId AND e.idprivi_apps = d.idprivi_apps 
				AND e.idprivi_group = d.idprivi_group LEFT JOIN privi_modules f 
				ON e.idprivi_apps = f.idprivi_apps 
				WHERE c.cNIP = '{$nip}' AND c.iCompanyID = '{$pt}' 
				AND c.idprivi_apps = '{$appId}' AND c.idprivi_group = '{$group}' AND 
				f.iParent = '{$index}' 
				AND f.lDeleted = '0'
				AND c.lDeleted = 0 
				AND e.iCrud > 0 
				GROUP BY f.idprivi_modules"; */
				//AND e.idprivi_modules = f.idprivi_modules
	
		$sql = "SELECT a.cNIP, (SELECT vCompName FROM hrd.company WHERE iCompanyId = a.iCompanyId) AS `Company`,
				(SELECT vAppName FROM privi_apps WHERE idprivi_apps = a.idprivi_apps) AS `AppName`,
				a.idprivi_apps AS `App_ID`, a.idprivi_group AS `group`, c.idprivi_modules AS `id`, d.idprivi_modules, c.iCrud,
				d.vCodeModule AS vCodeModule, d.vPathModule AS `Mod_Path`, d.iParent AS `parent_id`, d.vNameModule AS `text` 
				FROM privi_authlist a LEFT JOIN  privi_group_pt_app b ON  a.iCompanyId = b.iCompanyId AND a.idprivi_apps = b.idprivi_apps 
				AND a.idprivi_group = b.iID_GroupApp LEFT JOIN privi_group_pt_app_mod c ON 
				b.iCompanyId = c.iCompanyId AND b.idprivi_apps = c.idprivi_apps AND b.iID_GroupApp = c.idprivi_group LEFT JOIN 
				privi_modules d ON c.idprivi_apps = d.idprivi_apps AND c.idprivi_modules = d.idprivi_modules
				WHERE a.cNIP = '{$nip}' AND a.iCompanyId = '{$pt}' AND a.idprivi_group = '{$group}' 
				AND a.idprivi_apps = '{$appId}' AND a.lDeleted = '0' AND d.lDeleted = '0'  
				AND c.iCrud > 0 AND d.iParent = '{$index}' order by d.vCodeModule asc";
		
		//echo $sql;
		$q = $this->db->query($sql);
	    
	    if($q->num_rows() == 0) {
	        return false;
	    }
		
	    // User $tree instead of the $menu global as this way there shouldn't be any data duplication
	    $tree = $index > 0 ? '<ul>' : ''; // If we are on index 0 then we don't need the enclosing ul
	    
	    foreach($q->result_array() as $arr) {	    		    		
	    	/*$sql1 = "SELECT	( t1.cNIP ) AS 'NIP'
					, ( SELECT tx1.vCompName FROM hrd.company tx1 WHERE tx1.iCompanyId = t1.iCompanyId ) AS 'Company'
					, (	SELECT tx2.vAppName FROM privi_apps tx2 WHERE tx2.idprivi_apps = t1.idprivi_apps) AS 'AppName'
					##
					, t4.idprivi_apps AS `App_ID`
					, t4.idprivi_modules AS `id`
					, t4.iparent AS `parent_id`
					, t4.vNameModule AS `text`
					, t4.vCodeModule
					, t4.vPathModule AS `Mod_Path`
					, t1.idprivi_group AS `group`
					
				FROM
					privi_authlist t1
					
					LEFT JOIN					
					privi_group_pt_app t2 ON t2.iCompanyId = t1.iCompanyId AND t2.idprivi_apps = t1.idprivi_apps
					
					LEFT JOIN					
					privi_group_pt_app_mod t3 ON t3.iCompanyId = t1.iCompanyId AND t3.idprivi_apps = t1.idprivi_apps AND t3.idprivi_group = t2.iID_GroupApp
					##
					LEFT JOIN
					privi_modules t4 ON t4.idprivi_apps = t3.idprivi_apps AND t4.idprivi_modules = t3.idprivi_modules
				WHERE
					t1.cNIP = '{$nip}'
					AND
					t1.iCompanyId 	= '{$pt}'
					AND
					t1.idprivi_apps = '{$appId}' 
					AND
					t2.iID_GroupApp =  '{$group}' 
					AND 
					t4.iparent = '{$arr['id']}' 
	    			AND
					t4.lDeleted = 0 
	    			AND 
	    			t1.lDeleted = 0";*/
	    	 /* $sql1 = "SELECT c.cNIP AS NIP, (SELECT vCompName FROM hrd.company WHERE iCompanyId = c.iCompanyID) AS `Company`,
				(SELECT vAppName FROM privi_apps WHERE idprivi_apps = c.idprivi_apps) AS `AppName`,  
				c.idprivi_apps AS `App_ID`, c.idprivi_group AS `group`, 
				f.idprivi_modules AS `id`, f.iParent AS `parent_id`, f.vNameModule AS `text`, 
				f.vCodeModule AS vCodeModule, f.vPathModule AS `Mod_Path` FROM privi_authlist c 
				LEFT JOIN privi_group_pt_app d ON c.idprivi_group = d.iID_GroupApp 
				LEFT JOIN privi_group_pt_app_mod e ON e.iCompanyId = d.iCompanyId AND e.idprivi_apps = d.idprivi_apps 
				AND e.idprivi_group = d.idprivi_group LEFT JOIN privi_modules f 
				ON e.idprivi_apps = f.idprivi_apps 
				WHERE c.cNIP = '{$nip}' AND c.iCompanyID = '{$pt}' 
				AND c.idprivi_apps = '{$appId}' AND c.idprivi_group = '{$group}' AND 
				f.iParent = '{$arr['id']}' 
				AND f.lDeleted = '0'
				AND c.lDeleted = 0 
				AND e.iCrud > 0 
	    		GROUP BY f.idprivi_modules"; */ 
			    //AND e.idprivi_modules = f.idprivi_modules
	    
	       //if ($arr['id'] == '2332') {
	       //		echo $sql1;
	       //}
	    
	    	$sql1 = "SELECT a.cNIP, (SELECT vCompName FROM hrd.company WHERE iCompanyId = a.iCompanyId) AS `Company`,
				(SELECT vAppName FROM privi_apps WHERE idprivi_apps = a.idprivi_apps) AS `AppName`,
				a.idprivi_apps AS `App_ID`, a.idprivi_group AS `group`, c.idprivi_modules AS `id`, d.idprivi_modules, c.iCrud,
				d.vCodeModule AS vCodeModule, d.vPathModule AS `Mod_Path`, d.iParent AS `parent_id`, d.vNameModule AS `text` 
				FROM privi_authlist a LEFT JOIN  privi_group_pt_app b ON  a.iCompanyId = b.iCompanyId AND a.idprivi_apps = b.idprivi_apps 
				AND a.idprivi_group = b.iID_GroupApp LEFT JOIN privi_group_pt_app_mod c ON 
				b.iCompanyId = c.iCompanyId AND b.idprivi_apps = c.idprivi_apps AND b.iID_GroupApp = c.idprivi_group LEFT JOIN 
				privi_modules d ON c.idprivi_apps = d.idprivi_apps AND c.idprivi_modules = d.idprivi_modules
				WHERE a.cNIP = '{$nip}' AND a.iCompanyId = '{$pt}' AND a.idprivi_group = '{$group}' 
				AND a.idprivi_apps = '{$appId}' AND a.lDeleted = '0' AND d.lDeleted = '0'  
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