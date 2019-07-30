<?php 
class MyGrid {
	
	public $_ci;
	public $slider_page;
	
	function __construct() {
		$this->_ci =& get_instance();		
		$this->_ci->load->helper('jqgrid_helper');
		
		//session
		$this->_ci->load->library('Zend', 'Zend/Session/Namespace');
		
		//acl
		$this->_ci->load->library('MyAcl');
	}
	public function set_slider_page($v_slider) {
		$this->slider_page = $v_slider;
	}
	//public function drawGrid($param = array(), $url, $pk_id, $sort_by, $caption, $view, $GroupAndModul) {//, $model, $method, $module_id, $source, $sort, $sort, $add_url, $edit_url, $del_url, $caption, $pk, $grid_height) {
	public function drawGrid($param = array(), $property, $GroupAndModul) {
		
		/* Rule for parameter (variable $param):
		   'label'   => 'App ID', // for label
			'name'   => $this->f_columns[0], // for field name on table
			'width'  => 50, //width coloumn
			'size'   => 10,
			'adv_src'=> FALSE, //if true, advance search will   activated
			'type'	 => 'text' //type of field for searchin
		 */
		
		$paramx = array();
		foreach($param as $para) {			
			if ($para['showOnGrid'] == 1) {	
				$paramx[] = $para;
			}
		}
		
		$url_base  = base_url();
		
		//set grup and modul
		$group_id 	= $GroupAndModul['group_id'];
		$module_id 	= $GroupAndModul['module_id'];		
		
		//set properti
		$url 		= $property['url'];
		$pk_tbl     = $property['pk_tbl'];
		$pk_id		= $property['pk_id'];
		$prt_id     = isset($property['parent_id']) ? $property['parent_id'] : 0 ;
		$pk_db      = isset($property['pk_db']) ? $property['pk_db'] : FALSE;
		$sort_by	= $property['sort_by'];
		$caption	= $property['caption'];
		$view		= $property['view'];		
		$adv_search = isset($property['adv_search']) ? $property['adv_search'] : FALSE;
		if (isset($property['slider_page']) && !empty($property['slider_page']) ) {
			$this->set_slider_page($property['slider_page']);
		}
		//privilege/setup_applications/drawList
		$sess_auth 	= new Zend_Session_Namespace('auth');
		$no_grid 	= $sess_auth->gModul;
		$n_grid     = 'grid_'.$no_grid.'_'.$prt_id;
		$p_grid     = 'pager_'.$no_grid.'_'.$prt_id;		
		$pager_name = $no_grid.'_'.$prt_id;

		//getAcl
		$acl = $this->_ci->myacl->getMyAcl($sess_auth->gComId, $sess_auth->gAccess, $sess_auth->gApps, $GroupAndModul);		
				
		$aData = array(
			'set_columns'  => $paramx,
			'div_name'     => 'grid_'.$pager_name,
			'source'       => $url.'/drawGrid',//.$param_for_grid_data,
			'sort_name'    => $sort_by,
			'pager'		   => 'pager_'.$pager_name,
			'add_url'      => 'index.php/'.$url.'/create',
			'edit_url'     => 'index.php/'.$url.'/update',
			'delete_url'   => 'index.php/'.$url.'/delete',
			'caption'      => $caption,
			'primary_key'  => $pk_id,
			'grid_height'  => 250,
			'pager_name'   => $pager_name
		);
		
		//echo $acl;
		if ($acl != 0) {			
			$data['appGrid']  = "<table id='grid_".$pager_name."'></table>";
			$data['appGrid'] .= "<div id='pager_".$pager_name."'></div>";
			$data['appGrid'] .= buildGrid($aData);
			
			$data['appGrid'] .= "<table cellpadding='3' cellspacing='0' border='0'>";
			$data['appGrid'] .= "<tr>";
			
			$butt_view = "<td><button name='view_crud_".$pager_name."' id='view_crud_".$pager_name."'>View</button></td>";
			$butt_add  = "<td><button name='add_crud_".$pager_name."' id='add_crud_".$pager_name."'>Add</button></td>";
			$butt_edt  = "<td><button name='edit_crud_".$pager_name."' id='edit_crud_".$pager_name."'>Edit</button></td>";
			$butt_del  = "<td><button name='delete_crud_".$pager_name."' id='delete_crud_".$pager_name."'>Delete</button></td>
						<td><span style='height:20px; border:solid 1px #CCC;'></span></td>
						"; 
			
			switch($acl) {									
				case 1 :
					$data['appGrid'] .= $butt_edt;
					break;
				case 2 :
					$data['appGrid'] .= $butt_del;
					break;
				case 3 :
					$data['appGrid'] .= $butt_edt.$butt_del;
					break;
				case 4 :
					$data['appGrid'] .= $butt_view;
					break;	
				case 5 :
					$data['appGrid'] .= $butt_view.$butt_edt;
					break;	
				case 6 :
					$data['appGrid'] .= $butt_view.$butt_del;
					break;
				case 7 :
					$data['appGrid'] .= $butt_view.$butt_edt.$butt_del;
					break;
				case 8 :
					$data['appGrid'] .= $butt_add;
					break;
				case 9 :
					$data['appGrid'] .= $butt_add.$butt_edt;
					break;
				case 10 :
					$data['appGrid'] .= $butt_add.$butt_del;
					break;
				case 11 :
					$data['appGrid'] .= $butt_add.$butt_edt.$butt_del;
					break;
				case 12 :
					$data['appGrid'] .= $butt_view.$butt_add;
					break;
				case 13 :
					$data['appGrid'] .= $butt_view.$butt_add.$butt_edt;
					break;
				case 14 :
					$data['appGrid'] .= $butt_view.$butt_add.$butt_del;
					break;
				case 15 :
					$data['appGrid'] .= $butt_view.$butt_add.$butt_edt.$butt_del;
					break;
				default :
					
					
			}
			
			//searching		
				$data['appGrid'] .= "<td><input type='text' name='searchgrid_".$pager_name."' id='searchgrid_".$pager_name."' value='' placeholder='search...' class='fieldTextBox' /></td>";
				$data['appGrid'] .= "<td><button name='search_crud_".$pager_name."' id='search_crud_".$pager_name."'>Search</button></td>";
				
			//advanced searching
			if ($adv_search){
				$data['appGrid'] .= "<td><span style='height:20px; border:solid 1px #CCC;'></span></td>";
				$data['appGrid'] .= "<td><button name='search_adv_crud_".$pager_name."' id='search_adv_crud_".$pager_name."'>Advanced Search</button></td>";
			}
			//button
			
			$data['appGrid'] .= "</tr></table>";
			
			//box advanced search
			if ($adv_search){
				$data['appGrid'] .= "<div id='search_adv_box_".$pager_name."'  title='Search...'>";				
					for($i=0; $i < sizeof($param); $i++){
						if($param[$i]['adv_src']){
							$data['appGrid'] .= $param[$i]['label'].":<br />";
							if($param[$i]['type'] == 'date'){
								$data['appGrid'] .= "From <input type='text' name='dt_adv_box_1_". $param[$i]['name']."'  id='dt_adv_box_1_". $param[$i]['name']."' class='fieldTextBox' readonly='readonly'>";
								$data['appGrid'] .= "To <input type='text' name='dt_adv_box_2_". $param[$i]['name']."'  id='dt_adv_box_2_". $param[$i]['name']."' class='fieldTextBox' readonly='readonly'>";
							}else{
								$data['appGrid'] .= "<input type='text' name='adv_box_". $param[$i]['label']."'  id='adv_box_". $param[$i]['label']."' class='fieldTextBox'>";
							}
						}
					}				
				$data['appGrid'] .= "</div>";
			}
			
			//Init Javascript
			$data['appGrid'] .= "<script language='text/javascript'>";
			
			//Init variable javascript
			$data['appGrid'] .= "var ret = '';  ";
			
			$data['appGrid'] .= "$(document).ready(function() { 
									var no_grid = '".$pager_name."';
									var pk_tbl  = '".$pk_tbl."';
									var pk_id   = '".$pk_id."';
									var pk_db   = '".$pk_db."';";
	
									
									
			$data['appGrid'] .= " 	$( '#view_crud_".$pager_name."' ).button({icons: { primary: 'ui-icon-document'} })
									$( '#add_crud_".$pager_name."' ).button({icons: { primary: 'ui-icon-plus'} })
									$( '#edit_crud_".$pager_name."' ).button({icons: { primary: 'ui-icon-pencil'} })
									$( '#delete_crud_".$pager_name."' ).button({icons: { primary: 'ui-icon-trash'} })
									$( '#search_crud_".$pager_name."' ).button({icons: { primary: 'ui-icon-search'}, text: false })
									$( '#search_adv_crud_".$pager_name."' ).button({icons: { primary: 'ui-icon-search'} })
								";
			
			//View JS Button
			$data['appGrid'] .= "			
						$('#view_crud_'+no_grid).click(function() {
							var id = jQuery('#grid_'+no_grid).jqGrid('getGridParam','selrow'); 	
							if (id) { 								
								$.ajax({
									'url'  : '".$url_base.$url."/processForm',
									'data' : 'id='+id+'&proc=view&group=".$group_id."&modul=".$module_id."',
									'success' : function(data) {
										";
			if(isset($this->slider_page) && $this->slider_page) {
				$data['appGrid'].= " cycleClear_$module_id();
									cycleAdd_$module_id(data); ";
			} else {
				$data['appGrid'].= " $('#tab_'+no_grid).html(data); ";
			}
			$data['appGrid'] .="
									}
								});
							} else { 
								alert_box('Please select row');
								return false;
							}
						}); ";
			
			//Add New JS Button
			$data['appGrid'] .= "			
						$('#add_crud_'+no_grid).click(function() {
							$.ajax({
								'url' : '".$url_base.$url."/processForm',
								'data' : 'proc=add&group=".$group_id."&modul=".$module_id."',
								'success' : function(data) {									
									";
			if(isset($this->slider_page) && $this->slider_page) {
				$data['appGrid'].= " cycleClear_$module_id();
									cycleAdd_$module_id(data); ";
			} else {
				$data['appGrid'].= " $('#tab_'+no_grid).html(data); ";
			}
			$data['appGrid'] .="
								}
							});
						}); ";
			
			//Edit JS Button
			$data['appGrid'] .= "			
						$('#edit_crud_'+no_grid).click(function() {
							var id = jQuery('#grid_'+no_grid).jqGrid('getGridParam','selrow'); 	
							if (id) { 								
								$.ajax({
									'url'  : '".$url_base.$url."/processForm',
									'data' : 'id='+id+'&proc=edit&group=".$group_id."&modul=".$module_id."',
									'success' : function(data) {
										";
			if(isset($this->slider_page) && $this->slider_page) {
				$data['appGrid'].= " cycleClear_$module_id();
									cycleAdd_$module_id(data); ";
			} else {
				$data['appGrid'].= " $('#tab_'+no_grid).html(data); ";
			}
			$data['appGrid'] .="
									}
								});
							} else { 
								alert_box('Please select row');
								return false;
							}
						}); ";
			
			//Delete JS Button
			$data['appGrid'] .= "				
						$('#delete_crud_'+no_grid).click(function() {
							var id = jQuery('#grid_'+no_grid).jqGrid('getGridParam','selrow'); 	
							
							if (id) {
								var txt_conf = 'These items will be deleted. Are you sure?';
								var url 	 = '".$url_base."myform_save/delete';
								var data	 = 'id='+id+'&proc=delete&pk_tbl='+pk_tbl+'&pk_id='+pk_id+'&pk_db='+pk_db+'&group=".$group_id."&modul=".$module_id."';
								var num_grid = no_grid;
								confirm_delete_box(txt_conf, url, data, num_grid);
								
								/*var jwb = confirm('Anda yakin ingin menghapus data ?');
								if (jwb == 1) {
									$.ajax({
										'url'  : '".$url_base."myform_save/delete',
										'data' : 'id='+id+'&proc=delete&pk_tbl='+pk_tbl+'&pk_id='+pk_id+'&pk_db='+pk_db+'&group=".$group_id."&modul=".$module_id."',
										'success' : function(data) {
											if (data > 0) {
												jQuery('#grid_'+no_grid).trigger('reloadGrid');
											} else {
												alert('Data gagal dihapus');
												return false;
											}
										}
									});
								}*/
								
							} else {
								alert_box('Please select row');
								return false;
							}
						});";
			
			//Search JS Button
			$data['appGrid'] .= "
						$('#search_crud_'+no_grid).click(function() {
							var srcText = $('#searchgrid_'+no_grid).val();
							$('#grid_'+no_grid).trigger('reloadGrid');
						});	
						
						$('#searchgrid_'+no_grid).keypress(function(e){ 
						    var code = e.which; 
						    if(code==13)e.preventDefault();
						    if(code==32||code==13||code==188||code==186){
						    	var srcText = $(this).val();
								$('#grid_'+no_grid).trigger('reloadGrid');
						    }
						});	";
			
			
			//Search JS Advanced 
			if ($adv_search){
				$data['appGrid'] .="
							$( '#search_adv_box_'+no_grid).dialog({
								autoOpen: false,
								modal: true,
								resizable:false,
								buttons: {
					                'Search': function() {
					                    alert('searching..');
					                },
					                Cancel: function() {
					                    $( this ).dialog( 'close' );
					                }
					            }
							});
							
							$('#search_adv_crud_'+no_grid).click(function() {
								$( '#search_adv_box_'+no_grid ).dialog( 'open' );
							});	";
				
				for($i=0; $i < sizeof($param); $i++){
					if($param[$i]['adv_src']){						
						if($param[$i]['type'] == 'date'){
							$label_name = $param[$i]['name'];
							$idBox1 = "dt_adv_box_1_".$label_name;
							$idBox2 = "dt_adv_box_2_".$label_name;
							 
							$data['appGrid'] .= "$('#".$idBox1."').datepicker({ dateFormat: 'dd-mm-yy', maxDate: \"0d\" });";
							$data['appGrid'] .= "$('#".$idBox2."').datepicker({ dateFormat: 'dd-mm-yy', maxDate: \"0d\" });";
						} 
					}
				}
				
			}
			//End Init Javascript
			$data['appGrid'] .= "});	</script>";
			$data['appGrid'] .= "</tr></table>";
		} else {
			$data['appGrid'] = "Sorry you have no access right";
		}
		
		//return $data['appGrid'];
		//$data['appGrid'] = "</div>";
		if( $this->slider_page ) {
			$data['id'] = $sess_auth->gModul;
			$this->_ci->load->view($this->slider_page, $data);
		} else {
			$this->_ci->load->view($view, $data);
		}
	}
	
	public function drawGrid_old($param = array(), $property, $GroupAndModul) {
		
		/* Rule for parameter (variable $param):
		   'label'   => 'App ID', // for label
			'name'   => $this->f_columns[0], // for field name on table
			'width'  => 50, //width coloumn
			'size'   => 10,
			'adv_src'=> FALSE, //if true, advance search will   activated
			'type'	 => 'text' //type of field for searchin
		 */
		
		$paramx = array();
		foreach($param as $para) {			
			if ($para['showOnGrid'] == 1) {	
				$paramx[] = $para;
			}
		}
		
		$url_base  = base_url();
		
		//set grup and modul
		$group_id 	= $GroupAndModul['group_id'];
		$module_id 	= $GroupAndModul['module_id'];		
		
		//set properti
		$url 		= $property['url'];
		$pk_tbl     = $property['pk_tbl'];
		$pk_id		= $property['pk_id'];
		$pk_db      = isset($property['pk_db']) ? $property['pk_db'] : FALSE;
		$sort_by	= $property['sort_by'];
		$caption	= $property['caption'];
		$view		= $property['view'];		
		$adv_search = isset($property['adv_search']) ? $property['adv_search'] : FALSE;
		$this->slider_page = (isset($property['slider_page']) && !empty($property['slider_page']) ) ? $property['slider_page'] : FALSE;
		
		//privilege/setup_applications/drawList
		$sess_auth 	= new Zend_Session_Namespace('auth');
		$no_grid 	= $sess_auth->gModul;
		$pager_name = $no_grid;

		//getAcl
		$acl = $this->_ci->myacl->getMyAcl($sess_auth->gComId, $sess_auth->gAccess, $sess_auth->gApps, $GroupAndModul);		
				
		$aData = array(
			'set_columns'  => $paramx,
			'div_name'     => 'grid_'.$no_grid,
			'source'       => $url.'/drawGrid',//.$param_for_grid_data,
			'sort_name'    => $sort_by,
			'pager'		   => 'pager_'.$no_grid,
			'add_url'      => 'index.php/'.$url.'/create',
			'edit_url'     => 'index.php/'.$url.'/update',
			'delete_url'   => 'index.php/'.$url.'/delete',
			'caption'      => $caption,
			'primary_key'  => $pk_id,
			'grid_height'  => 250,
			'pager_name'   => $pager_name
		);
		
		//echo $acl;
		if ($acl != 0) {			
			$data['appGrid']  = "<table id='grid_".$no_grid."'></table>";
			$data['appGrid'] .= "<div id='pager_".$no_grid."'></div>";
			$data['appGrid'] .= buildGrid($aData);
			
			$data['appGrid'] .= "<table cellpadding='3' cellspacing='0' border='0'>";
			$data['appGrid'] .= "<tr>";
			
			$butt_view = "<td><button name='view_crud_".$no_grid."' id='view_crud_".$no_grid."'>View</button></td>";
			$butt_add  = "<td><button name='add_crud_".$no_grid."' id='add_crud_".$no_grid."'>Add</button></td>";
			$butt_edt  = "<td><button name='edit_crud_".$no_grid."' id='edit_crud_".$no_grid."'>Edit</button></td>";
			$butt_del  = "<td><button name='delete_crud_".$no_grid."' id='delete_crud_".$no_grid."'>Delete</button></td>
						<td><span style='height:20px; border:solid 1px #CCC;'></span></td>
						"; 
			
			switch($acl) {									
				case 1 :
					$data['appGrid'] .= $butt_edt;
					break;
				case 2 :
					$data['appGrid'] .= $butt_del;
					break;
				case 3 :
					$data['appGrid'] .= $butt_edt.$butt_del;
					break;
				case 4 :
					$data['appGrid'] .= $butt_view;
					break;	
				case 5 :
					$data['appGrid'] .= $butt_view.$butt_edt;
					break;	
				case 6 :
					$data['appGrid'] .= $butt_view.$butt_del;
					break;
				case 7 :
					$data['appGrid'] .= $butt_view.$butt_edt.$butt_del;
					break;
				case 8 :
					$data['appGrid'] .= $butt_add;
					break;
				case 9 :
					$data['appGrid'] .= $butt_add.$butt_edt;
					break;
				case 10 :
					$data['appGrid'] .= $butt_add.$butt_del;
					break;
				case 11 :
					$data['appGrid'] .= $butt_add.$butt_edt.$butt_del;
					break;
				case 12 :
					$data['appGrid'] .= $butt_view.$butt_add;
					break;
				case 13 :
					$data['appGrid'] .= $butt_view.$butt_add.$butt_edt;
					break;
				case 14 :
					$data['appGrid'] .= $butt_view.$butt_add.$butt_del;
					break;
				case 15 :
					$data['appGrid'] .= $butt_view.$butt_add.$butt_edt.$butt_del;
					break;
				default :
					
					
			}
			
			//searching		
				$data['appGrid'] .= "<td><input type='text' name='searchgrid_".$no_grid."' id='searchgrid_".$no_grid."' value='' placeholder='search...' class='fieldTextBox' /></td>";
				$data['appGrid'] .= "<td><button name='search_crud_".$no_grid."' id='search_crud_".$no_grid."'>Search</button></td>";
				
			//advanced searching
			if ($adv_search){
				$data['appGrid'] .= "<td><span style='height:20px; border:solid 1px #CCC;'></span></td>";
				$data['appGrid'] .= "<td><button name='search_adv_crud_".$no_grid."' id='search_adv_crud_".$no_grid."'>Advanced Search</button></td>";
			}
			//button
			
			$data['appGrid'] .= "</tr></table>";
			
			//box advanced search
			if ($adv_search){
				$data['appGrid'] .= "<div id='search_adv_box_".$no_grid."'  title='Search...'>";				
					for($i=0; $i < sizeof($param); $i++){
						if($param[$i]['adv_src']){
							$data['appGrid'] .= $param[$i]['label'].":<br />";
							if($param[$i]['type'] == 'date'){
								$data['appGrid'] .= "From <input type='text' name='dt_adv_box_1_". $param[$i]['name']."'  id='dt_adv_box_1_". $param[$i]['name']."' class='fieldTextBox' readonly='readonly'>";
								$data['appGrid'] .= "To <input type='text' name='dt_adv_box_2_". $param[$i]['name']."'  id='dt_adv_box_2_". $param[$i]['name']."' class='fieldTextBox' readonly='readonly'>";
							}else{
								$data['appGrid'] .= "<input type='text' name='adv_box_". $param[$i]['label']."'  id='adv_box_". $param[$i]['label']."' class='fieldTextBox'>";
							}
						}
					}				
				$data['appGrid'] .= "</div>";
			}
			
			//Init Javascript
			$data['appGrid'] .= "<script language='text/javascript'>";
			
			//Init variable javascript
			$data['appGrid'] .= "var ret = '';  ";
			
			$data['appGrid'] .= "$(document).ready(function() { 
									var no_grid = '".$no_grid."';
									var pk_tbl  = '".$pk_tbl."';
									var pk_id   = '".$pk_id."';
									var pk_db   = '".$pk_db."';";
	
									
									
			$data['appGrid'] .= " 	$( '#view_crud_".$no_grid."' ).button({icons: { primary: 'ui-icon-document'} })
									$( '#add_crud_".$no_grid."' ).button({icons: { primary: 'ui-icon-plus'} })
									$( '#edit_crud_".$no_grid."' ).button({icons: { primary: 'ui-icon-pencil'} })
									$( '#delete_crud_".$no_grid."' ).button({icons: { primary: 'ui-icon-trash'} })
									$( '#search_crud_".$no_grid."' ).button({icons: { primary: 'ui-icon-search'}, text: false })
									$( '#search_adv_crud_".$no_grid."' ).button({icons: { primary: 'ui-icon-search'} })
								";
			
			//View JS Button
			$data['appGrid'] .= "			
						$('#view_crud_'+no_grid).click(function() {
							var id = jQuery('#grid_'+no_grid).jqGrid('getGridParam','selrow'); 	
							if (id) { 								
								$.ajax({
									'url'  : '".$url_base.$url."/processForm',
									'data' : 'id='+id+'&proc=view&group=".$group_id."&modul=".$module_id."',
									'success' : function(data) {
										";
			if(isset($this->slider_page) && $this->slider_page) {
				$data['appGrid'].= " cycleClear_$module_id();
									cycleAdd_$module_id(data); ";
			} else {
				$data['appGrid'].= " $('#tab_'+no_grid).html(data); ";
			}
			$data['appGrid'] .="
									}
								});
							} else { 
								alert_box('Please select row');
								return false;
							}
						}); ";
			
			//Add New JS Button
			$data['appGrid'] .= "			
						$('#add_crud_'+no_grid).click(function() {
							$.ajax({
								'url' : '".$url_base.$url."/processForm',
								'data' : 'proc=add&group=".$group_id."&modul=".$module_id."',
								'success' : function(data) {									
									";
			if(isset($this->slider_page) && $this->slider_page) {
				$data['appGrid'].= " cycleClear_$module_id();
									cycleAdd_$module_id(data); ";
			} else {
				$data['appGrid'].= " $('#tab_'+no_grid).html(data); ";
			}
			$data['appGrid'] .="
								}
							});
						}); ";
			
			//Edit JS Button
			$data['appGrid'] .= "			
						$('#edit_crud_'+no_grid).click(function() {
							var id = jQuery('#grid_'+no_grid).jqGrid('getGridParam','selrow'); 	
							if (id) { 								
								$.ajax({
									'url'  : '".$url_base.$url."/processForm',
									'data' : 'id='+id+'&proc=edit&group=".$group_id."&modul=".$module_id."',
									'success' : function(data) {
										";
			if(isset($this->slider_page) && $this->slider_page) {
				$data['appGrid'].= " cycleClear_$module_id();
									cycleAdd_$module_id(data); ";
			} else {
				$data['appGrid'].= " $('#tab_'+no_grid).html(data); ";
			}
			$data['appGrid'] .="
									}
								});
							} else { 
								alert_box('Please select row');
								return false;
							}
						}); ";
			
			//Delete JS Button
			$data['appGrid'] .= "				
						$('#delete_crud_'+no_grid).click(function() {
							var id = jQuery('#grid_'+no_grid).jqGrid('getGridParam','selrow'); 	
							
							if (id) {
								var txt_conf = 'These items will be deleted. Are you sure?';
								var url 	 = '".$url_base."myform_save/delete';
								var data	 = 'id='+id+'&proc=delete&pk_tbl='+pk_tbl+'&pk_id='+pk_id+'&pk_db='+pk_db+'&group=".$group_id."&modul=".$module_id."';
								var num_grid = no_grid;
								confirm_delete_box(txt_conf, url, data, num_grid);
								
								/*var jwb = confirm('Anda yakin ingin menghapus data ?');
								if (jwb == 1) {
									$.ajax({
										'url'  : '".$url_base."myform_save/delete',
										'data' : 'id='+id+'&proc=delete&pk_tbl='+pk_tbl+'&pk_id='+pk_id+'&pk_db='+pk_db+'&group=".$group_id."&modul=".$module_id."',
										'success' : function(data) {
											if (data > 0) {
												jQuery('#grid_'+no_grid).trigger('reloadGrid');
											} else {
												alert('Data gagal dihapus');
												return false;
											}
										}
									});
								}*/
								
							} else {
								alert_box('Please select row');
								return false;
							}
						});";
			
			//Search JS Button
			$data['appGrid'] .= "
						$('#search_crud_'+no_grid).click(function() {
							var srcText = $('#searchgrid_'+no_grid).val();
							$('#grid_'+no_grid).trigger('reloadGrid');
						});	
						
						$('#searchgrid_'+no_grid).keypress(function(e){ 
						    var code = e.which; 
						    if(code==13)e.preventDefault();
						    if(code==32||code==13||code==188||code==186){
						    	var srcText = $(this).val();
								$('#grid_'+no_grid).trigger('reloadGrid');
						    }
						});	";
			
			
			//Search JS Advanced 
			if ($adv_search){
				$data['appGrid'] .="
							$( '#search_adv_box_'+no_grid).dialog({
								autoOpen: false,
								modal: true,
								resizable:false,
								buttons: {
					                'Search': function() {
					                    alert('searching..');
					                },
					                Cancel: function() {
					                    $( this ).dialog( 'close' );
					                }
					            }
							});
							
							$('#search_adv_crud_'+no_grid).click(function() {
								$( '#search_adv_box_'+no_grid ).dialog( 'open' );
							});	";
				
				for($i=0; $i < sizeof($param); $i++){
					if($param[$i]['adv_src']){						
						if($param[$i]['type'] == 'date'){
							$label_name = $param[$i]['name'];
							$idBox1 = "dt_adv_box_1_".$label_name;
							$idBox2 = "dt_adv_box_2_".$label_name;
							 
							$data['appGrid'] .= "$('#".$idBox1."').datepicker({ dateFormat: 'dd-mm-yy', maxDate: \"0d\" });";
							$data['appGrid'] .= "$('#".$idBox2."').datepicker({ dateFormat: 'dd-mm-yy', maxDate: \"0d\" });";
						} 
					}
				}
				
			}
			//End Init Javascript
			$data['appGrid'] .= "});	</script>";
			
		} else {
			$data['appGrid'] = "Sorry you have no access right";
		}
		//$data['appGrid'] = "</div>";
		if( $this->slider_page ) {
			$data['id'] = $sess_auth->gModul;
			$this->_ci->load->view($this->slider_page, $data);
		} else {
			$this->_ci->load->view($view, $data);
		}
	}
	
	/*public function drawGridDtl($param = array(), $id_header=null, $url=null, $pk_id=null, $sort_by=null, $caption=null, $view=null, $urut=null, $group_and_modul) {//, $model, $method, $module_id, $source, $sort, $sort, $add_url, $edit_url, $del_url, $caption, $pk, $grid_height) {
		$paramx = array();
		$data   = array();
		foreach($param as $para) {
			$paramx[] = $para;
		}
		
		$url_base  = base_url();
		
		//privilege/setup_applications/drawList
		$sess_auth 	= new Zend_Session_Namespace('auth');
		$no_grid 	= $sess_auth->gModul;
		$n_grid     = 'detail_grid_'.$no_grid.'_'.$urut;
		$p_grid     = 'detail_pager_'.$no_grid.'_'.$urut;
	
		//getAcl
		$acl = $this->_ci->myacl->getMyAcl($sess_auth->gComId, $sess_auth->gAccess, $sess_auth->gApps, $group_and_modul);
	
		$aData = array(
				'set_columns'  => $paramx,
				'div_name'     => $n_grid,
				'source'       => 'index.php/'.$url.'/drawGridDtl/?appId='.$id_header,//.$param_for_grid_data,
				'sort_name'    => $sort_by,
				'pager'		   => $p_grid,
				'add_url'      => 'index.php/'.$url.'/create',
				'edit_url'     => 'index.php/'.$url.'/update',
				'delete_url'   => 'index.php/'.$url.'/delete',
				'caption'      => $caption,
				'primary_key'  => $pk_id,
				'grid_height'  => 250
		);
	
		//if ($acl != 0) {
			$isi = "<div id='tabs_detail_".$no_grid."_".$urut."' style='z-index:-1;'>";
				$isi .= "<table id='".$n_grid."'></table>";
				$isi .= "<div id='".$p_grid."'></div>";
				$isi .= buildGrid($aData);
					$isi .= "<div id='nav_crud'>";
					$isi .= "<table><tr>";
			
					//button
					//if ($acl == 8 && $acl == 9 && $acl == 12 && $acl == 15) {
						$isi .= "<td><input type='button' name='add_dtl_".$n_grid."' id='add_dtl_".$n_grid."' value='Create' class='btn'/></td>";
					//}
					//if ($acl == 1 && $acl == 3 && $acl == 5 && $acl == 9 && $acl == 15) {
						$isi .= "<td><input type='button' name='edit_dtl_".$n_grid."' id='edit_dtl_".$n_grid."' value='Edit' class='btn'/>";
					//}
						
					//if ($acl == 2 && $acl == 3 && $acl == 6 && $acl == 10 && $acl == 15) {
						$isi .= "<td><input type='button' name='delete_dtl_".$n_grid."' id='delete_dtl_".$n_grid."' value='Delete' class='btn'/></td>";
					//}
						
						$isi .= "<td><input type='button' name='search_dtl_".$n_grid."' id='search_dtl_".$n_grid."' value='Searching' class='btn'/></td>";
						
					//button
					$isi .= "</tr></table>";
				$isi .= "</div>";
		
		$isi .= "<div id='dtl_view_".$n_grid."'></div>";		
			
		//Init variable javascript 
		$isi .= "<script language='text/javascript'>
					var ret = '';
					$(document).ready(function() {
						var no_grid = '".$no_grid."';
						var n_grid  = '".$n_grid."';
						$('.btn').button();";
		
			$isi .= " $('#view_'+n_grid).click(function() {
						$.ajax({
							'url' : '".$url_base.$url."/processForm',
							'data' : 'proc=view',
							'success' : function(data) {
								$( '#dtl_view_'+n_grid ).html(data);
								$( '#dtl_view_'+n_grid ).dialog({
						            height: 'auto',
						            width: 'auto',
						            title:'View',
						            modal: true
						        });
							}
						});
					 });";
		
			$isi .= " $('#add_'+n_grid).click(function() {
						$.ajax({
							'url' : '".$url_base.$url."/processForm',
							'data' : 'proc=add',
							'success' : function(data) {
								$( '#dtl_view_'+n_grid ).html(data);
								$( '#dtl_view_'+n_grid ).dialog({
						            height: 'auto',
						            width: 'auto',
						            title:'Create',
						            modal: true
						        });
							}
						});
					 });";
		
			$isi .=" $('#edit_'+n_grid).click(function() {
						var id = jQuery('#'+n_grid).jqGrid('getGridParam','selrow');
						if (id) {
							$.ajax({
								'url'  : '".$url_base.$url."/processForm',
								'data' : 'id='+id+'&proc=edit',
								'success' : function(data) {
									$('#tab_'+no_grid).html(data);
								}
							});
						} else {
							alert_box('Please select row');
							return false;
						}
					}); ";
		
			$isi .=" $('#delete_'+n_grid).click(function() {
						var id = jQuery('#'+n_grid).jqGrid('getGridParam','selrow');
						if (id) {
							var jwb = confirm('Anda yakin ingin menghapus data ?');
							if (jwb == 1) {
								$.ajax({
									'url' : 'index.php/".$url."/processForm',
									'data' : 'id='+id+'&proc=delete',
									'success' : function(data) {
										if (data > 0) {
											jQuery('#'+n_grid).trigger('reloadGrid');
												//jQuery('#grid_'+no_grid).jqGrid('editGridRow',id,{height:280,reloadAfterSubmit:false});
											} else {
												alert('Data gagal dihapus');
												return false;
											}
										}
								});
							}
						} else {
							alert_box('Please select row');
							return false;
						}
					});";
			
		$isi .=" });
		</script>	";
	
		//} else {
		//	$data['appGrid'] = "Sorry you have no access right";
		//}
		$isi .= "</div>";
		//$data['appGridDtl'] = $isi;
		//$data['appGridDtl'] .= "</div>";
	
		//$this->_ci->load->view($view, $data);		
		return $isi;
	}
	*/
	
	function drawGridDtl($no_grid, $urut, $data, $group_and_modul) {
				
		$isi = "<div id='tabs_detail_".$no_grid."_".$urut."' style='z-index:1;overflow:auto;'>";
		$isi .= $data; 
		$isi .= "</div>";

		return $isi;
	}
	
	function drawForGridDtl($param = array(), $property, $GroupAndModul) {
		$paramx = array();
		foreach($param as $para) {
			if ($para['showOnGrid'] == 1) {
				$paramx[] = $para;
			}
		}
		
		$base_url = base_url();
		
		$url 		= $property['url'];
		$pk_tbl     = $property['pk_tbl'];
		$pk_id		= $property['pk_id'];
		$prt_id     = isset($property['parent_id']) ? $property['parent_id'] : 0 ;
		$pk_db      = isset($property['pk_db']) ? $property['pk_db'] : FALSE;
		$sort_by	= $property['sort_by'];
		$caption	= $property['caption'];
		$view		= $property['view'];
		$adv_search = isset($property['adv_search']) ? $property['adv_search'] : FALSE;
		
		$sess_auth 	= new Zend_Session_Namespace('auth');
		$no_grid 	= $sess_auth->gModul;
		$n_grid     = 'grid_'.$no_grid.'_'.$prt_id;
		$p_grid     = 'pager_'.$no_grid.'_'.$prt_id;		
		$pager_name = $no_grid.'_'.$prt_id;
				
		//getAcl
		$acl = $this->_ci->myacl->getMyAcl($sess_auth->gComId, $sess_auth->gAccess, $sess_auth->gApps, $GroupAndModul);	
		
		$aData = array(
				'set_columns'  => $paramx,
				'div_name'     => $n_grid,
				'source'       => $url.'/drawForDataGridDtl?parentId='.$prt_id,
				'sort_name'    => $sort_by,
				'pager'		   => $pager_name,
				'add_url'      => 'index.php/'.$url.'/create',
				'edit_url'     => 'index.php/'.$url.'/update',
				'delete_url'   => 'index.php/'.$url.'/delete',
				'caption'      => $caption,
				'primary_key'  => $pk_id,
				'grid_height'  => 250,
				'pager_name'   => $pager_name
		);
		
		
		
		$url_base  = base_url();
		
		//set grup and modul
		$group_id 	= $GroupAndModul['group_id'];
		$module_id 	= $GroupAndModul['module_id'];
		
		//echo $acl;
		if ($acl != 0) {			
			$isi  = "<table id='grid_".$pager_name."'></table>";
			$isi .= "<div id='pager_".$pager_name."'></div>";
			$isi .= buildGrid($aData);
			
			$isi .= "<table cellpadding='3' cellspacing='0' border='0'>";
			$isi .= "<tr>";
			
			$butt_view = "<td><button name='view_crud_".$pager_name."' id='view_crud_".$pager_name."'>View</button></td>";
			$butt_add  = "<td><button name='add_crud_".$pager_name."' id='add_crud_".$pager_name."'>Add</button></td>";
			$butt_edt  = "<td><button name='edit_crud_".$pager_name."' id='edit_crud_".$pager_name."'>Edit</button></td>";
			$butt_del  = "<td><button name='delete_crud_".$pager_name."' id='delete_crud_".$pager_name."'>Delete</button></td>
						<td><span style='height:20px; border:solid 1px #CCC;'></span></td>
						"; 
			
			switch($acl) {									
				case 1 :
					$isi .= $butt_edt;
					break;
				case 2 :
					$isi .= $butt_del;
					break;
				case 3 :
					$isi .= $butt_edt.$butt_del;
					break;
				case 4 :
					$isi .= $butt_view;
					break;	
				case 5 :
					$isi .= $butt_view.$butt_edt;
					break;	
				case 6 :
					$isi .= $butt_view.$butt_del;
					break;
				case 7 :
					$isi .= $butt_view.$butt_edt.$butt_del;
					break;
				case 8 :
					$isi .= $butt_add;
					break;
				case 9 :
					$isi .= $butt_add.$butt_edt;
					break;
				case 10 :
					$isi .= $butt_add.$butt_del;
					break;
				case 11 :
					$isi .= $butt_add.$butt_edt.$butt_del;
					break;
				case 12 :
					$isi .= $butt_view.$butt_add;
					break;
				case 13 :
					$isi .= $butt_view.$butt_add.$butt_edt;
					break;
				case 14 :
					$isi .= $butt_view.$butt_add.$butt_del;
					break;
				case 15 :
					$isi .= $butt_view.$butt_add.$butt_edt.$butt_del;
					break;
				default :
					
					
			}
			
			//searching		
				$isi .= "<td><input type='text' name='searchgrid_".$pager_name."' id='searchgrid_".$pager_name."' value='' placeholder='search...' class='fieldTextBox' /></td>";
				$isi .= "<td><button name='search_crud_".$pager_name."' id='search_crud_".$pager_name."'>Search</button></td>";
				
			//advanced searching
			if ($adv_search){
				$isi .= "<td><span style='height:20px; border:solid 1px #CCC;'></span></td>";
				$isi .= "<td><button name='search_adv_crud_".$pager_name."' id='search_adv_crud_".$pager_name."'>Advanced Search</button></td>";
			}
			//button
			
			$isi .= "</tr></table>";
			
			//box advanced search
			if ($adv_search){
				$isi .= "<div id='search_adv_box_".$pager_name."'  title='Search...'>";				
					for($i=0; $i < sizeof($param); $i++){
						if($param[$i]['adv_src']){
							$isi .= $param[$i]['label'].":<br />";
							if($param[$i]['type'] == 'date'){
								$isi .= "From <input type='text' name='dt_adv_box_1_". $param[$i]['name']."'  id='dt_adv_box_1_". $param[$i]['name']."' class='fieldTextBox' readonly='readonly'>";
								$isi .= "To <input type='text' name='dt_adv_box_2_". $param[$i]['name']."'  id='dt_adv_box_2_". $param[$i]['name']."' class='fieldTextBox' readonly='readonly'>";
							}else{
								$isi .= "<input type='text' name='adv_box_". $param[$i]['label']."'  id='adv_box_". $param[$i]['label']."' class='fieldTextBox'>";
							}
						}
					}				
				$isi .= "</div>";
			}
			
			//Init Javascript
			$isi .= "<script language='text/javascript'>";
			
			//Init variable javascript
			$isi .= "var ret = '';  ";
			
			$isi .= "$(document).ready(function() { 
									var no_grid = '".$pager_name."';
									var pk_tbl  = '".$pk_tbl."';
									var pk_id   = '".$pk_id."';
									var pk_db   = '".$pk_db."';";
	
									
									
			$isi .= " 	$( '#view_crud_".$pager_name."' ).button({icons: { primary: 'ui-icon-document'} })
									$( '#add_crud_".$pager_name."' ).button({icons: { primary: 'ui-icon-plus'} })
									$( '#edit_crud_".$pager_name."' ).button({icons: { primary: 'ui-icon-pencil'} })
									$( '#delete_crud_".$pager_name."' ).button({icons: { primary: 'ui-icon-trash'} })
									$( '#search_crud_".$pager_name."' ).button({icons: { primary: 'ui-icon-search'}, text: false })
									$( '#search_adv_crud_".$pager_name."' ).button({icons: { primary: 'ui-icon-search'} })
								";
			
			//View JS Button
			$isi .= "			
						$('#view_crud_'+no_grid).click(function() {
							var id = jQuery('#grid_'+no_grid).jqGrid('getGridParam','selrow'); 	
							if (id) { 								
								$.ajax({
									'url'  : '".$url_base.$url."/processForm',
									'data' : 'id='+id+'&proc=view&group=".$group_id."&modul=".$module_id."',
									'success' : function(data) {
										";
			if(isset($this->slider_page) && $this->slider_page) {
				$isi .= " cycleClear_$module_id();
									cycleAdd_$module_id(data); ";
			} else {
				$isi .= " $('#tab_'+no_grid).html(data); ";
			}
			$isi .="
									}
								});
							} else { 
								alert_box('Please select row');
								return false;
							}
						}); ";
			
			//Add New JS Button
			$isi .= "			
						$('#add_crud_'+no_grid).click(function() {
							//alert('".$url_base.$url."/processForm');
							//return false;
							
							$.ajax({
								'url' : '".$url_base."privilege/employee/processForm',
								'data' : 'proc=add&group=".$group_id."&modul=".$module_id."',
								'success' : function(data) {									
									";
			if(isset($this->slider_page) && $this->slider_page) {
				$isi .= " //cycleClear_$module_id();
									cycleAdd_$module_id(data); ";
			} else {
				$isi .= " $('#tab_'+no_grid).html(data); ";
			}
			$isi .="
								}
							});
						}); ";
			
			//Edit JS Button
			$isi .= "			
						$('#edit_crud_'+no_grid).click(function() {
							var id = jQuery('#grid_'+no_grid).jqGrid('getGridParam','selrow'); 	
							if (id) { 								
								$.ajax({
									'url'  : '".$url_base.$url."/processForm',
									'data' : 'id='+id+'&proc=edit&group=".$group_id."&modul=".$module_id."',
									'success' : function(data) {
										";
			if(isset($this->slider_page) && $this->slider_page) {
				$isi .= " //cycleClear_$module_id();
									cycleAdd_$module_id(data); ";
			} else {
				$isi .= " $('#tab_'+no_grid).html(data); ";
			}
			$isi .="
									}
								});
							} else { 
								alert_box('Please select row');
								return false;
							}
						}); ";
			
			//Delete JS Button
			$isi .= "				
						$('#delete_crud_'+no_grid).click(function() {
							var id = jQuery('#grid_'+no_grid).jqGrid('getGridParam','selrow'); 	
							
							if (id) {
								var txt_conf = 'These items will be deleted. Are you sure?';
								var url 	 = '".$url_base."myform_save/delete';
								var data	 = 'id='+id+'&proc=delete&pk_tbl='+pk_tbl+'&pk_id='+pk_id+'&pk_db='+pk_db+'&group=".$group_id."&modul=".$module_id."';
								var num_grid = no_grid;
								confirm_delete_box(txt_conf, url, data, num_grid);
								
								/*var jwb = confirm('Anda yakin ingin menghapus data ?');
								if (jwb == 1) {
									$.ajax({
										'url'  : '".$url_base."myform_save/delete',
										'data' : 'id='+id+'&proc=delete&pk_tbl='+pk_tbl+'&pk_id='+pk_id+'&pk_db='+pk_db+'&group=".$group_id."&modul=".$module_id."',
										'success' : function(data) {
											if (data > 0) {
												jQuery('#grid_'+no_grid).trigger('reloadGrid');
											} else {
												alert('Data gagal dihapus');
												return false;
											}
										}
									});
								}*/
								
							} else {
								alert_box('Please select row');
								return false;
							}
						});";
			
			//Search JS Button
			$isi .= "
						$('#search_crud_'+no_grid).click(function() {
							var srcText = $('#searchgrid_'+no_grid).val();
							$('#grid_'+no_grid).trigger('reloadGrid');
						});	
						
						$('#searchgrid_'+no_grid).keypress(function(e){ 
						    var code = e.which; 
						    if(code==13)e.preventDefault();
						    if(code==32||code==13||code==188||code==186){
						    	var srcText = $(this).val();
								$('#grid_'+no_grid).trigger('reloadGrid');
						    }
						});	";
			
			
			//Search JS Advanced 
			if ($adv_search){
				$isi .="
							$( '#search_adv_box_'+no_grid).dialog({
								autoOpen: false,
								modal: true,
								resizable:false,
								buttons: {
					                'Search': function() {
					                    alert('searching..');
					                },
					                Cancel: function() {
					                    $( this ).dialog( 'close' );
					                }
					            }
							});
							
							$('#search_adv_crud_'+no_grid).click(function() {
								$( '#search_adv_box_'+no_grid ).dialog( 'open' );
							});	";
				
				for($i=0; $i < sizeof($param); $i++){
					if($param[$i]['adv_src']){						
						if($param[$i]['type'] == 'date'){
							$label_name = $param[$i]['name'];
							$idBox1 = "dt_adv_box_1_".$label_name;
							$idBox2 = "dt_adv_box_2_".$label_name;
							 
							$isi .= "$('#".$idBox1."').datepicker({ dateFormat: 'dd-mm-yy', maxDate: \"0d\" });";
							$isi .= "$('#".$idBox2."').datepicker({ dateFormat: 'dd-mm-yy', maxDate: \"0d\" });";
						} 
					}
				}
				
			}
			//End Init Javascript
			$isi .= "});	</script>";
			$isi .= "</tr></table>";
		} else {
			$isi = "Sorry you have no access right";
		}
		
		return $isi;
	}
	
	function drawForGridDtlx($param = array(), $property, $GroupAndModul) {
		
		$paramx = array();
		foreach($param as $para) {			
			if ($para['showOnGrid'] == 1) {	
				$paramx[] = $para;
			}
		}
		
		$url_base  = base_url();
		
		//set grup and modul
		$group_id 	= $GroupAndModul['group_id'];
		$module_id 	= $GroupAndModul['module_id'];		
		
		//set properti
		$url 		= $property['url'];
		$pk_tbl     = $property['pk_tbl'];
		$pk_id		= $property['pk_id'];
		$pk_db      = isset($property['pk_db']) ? $property['pk_db'] : FALSE;
		$sort_by	= $property['sort_by'];
		$caption	= $property['caption'];
		$view		= $property['view'];		
		$adv_search = isset($property['adv_search']) ? $property['adv_search'] : FALSE;
		$this->slider_page = (isset($property['slider_page']) && !empty($property['slider_page']) ) ? $property['slider_page'] : FALSE;
		
		//privilege/setup_applications/drawList
		$sess_auth 	= new Zend_Session_Namespace('auth');
		$no_grid 	= $sess_auth->gModul;
		$pager_name = $no_grid.'_'.$prt_id;

		//getAcl
		$acl = $this->_ci->myacl->getMyAcl($sess_auth->gComId, $sess_auth->gAccess, $sess_auth->gApps, $GroupAndModul);		
				
		$aData = array(
			'set_columns'  => $paramx,
			'div_name'     => 'grid_'.$no_grid,
			'source'       => $url.'/drawGrid',//.$param_for_grid_data,
			'sort_name'    => $sort_by,
			'pager'		   => 'pager_'.$no_grid,
			'add_url'      => 'index.php/'.$url.'/create',
			'edit_url'     => 'index.php/'.$url.'/update',
			'delete_url'   => 'index.php/'.$url.'/delete',
			'caption'      => $caption,
			'primary_key'  => $pk_id,
			'grid_height'  => 250,
			'pager_name'   => $pager_name
		);
		
		//echo $acl;
		if ($acl != 0) {			
			$data['appGrid']  = "<table id='grid_".$no_grid."'></table>";
			$data['appGrid'] .= "<div id='pager_".$no_grid."'></div>";
			$data['appGrid'] .= buildGrid($aData);
			
			$data['appGrid'] .= "<table cellpadding='3' cellspacing='0' border='0'>";
			$data['appGrid'] .= "<tr>";
			
			$butt_view = "<td><button name='view_crud_".$no_grid."' id='view_crud_".$no_grid."'>View</button></td>";
			$butt_add  = "<td><button name='add_crud_".$no_grid."' id='add_crud_".$no_grid."'>Add</button></td>";
			$butt_edt  = "<td><button name='edit_crud_".$no_grid."' id='edit_crud_".$no_grid."'>Edit</button></td>";
			$butt_del  = "<td><button name='delete_crud_".$no_grid."' id='delete_crud_".$no_grid."'>Delete</button></td>
						<td><span style='height:20px; border:solid 1px #CCC;'></span></td>
						"; 
			
			switch($acl) {									
				case 1 :
					$data['appGrid'] .= $butt_edt;
					break;
				case 2 :
					$data['appGrid'] .= $butt_del;
					break;
				case 3 :
					$data['appGrid'] .= $butt_edt.$butt_del;
					break;
				case 4 :
					$data['appGrid'] .= $butt_view;
					break;	
				case 5 :
					$data['appGrid'] .= $butt_view.$butt_edt;
					break;	
				case 6 :
					$data['appGrid'] .= $butt_view.$butt_del;
					break;
				case 7 :
					$data['appGrid'] .= $butt_view.$butt_edt.$butt_del;
					break;
				case 8 :
					$data['appGrid'] .= $butt_add;
					break;
				case 9 :
					$data['appGrid'] .= $butt_add.$butt_edt;
					break;
				case 10 :
					$data['appGrid'] .= $butt_add.$butt_del;
					break;
				case 11 :
					$data['appGrid'] .= $butt_add.$butt_edt.$butt_del;
					break;
				case 12 :
					$data['appGrid'] .= $butt_view.$butt_add;
					break;
				case 13 :
					$data['appGrid'] .= $butt_view.$butt_add.$butt_edt;
					break;
				case 14 :
					$data['appGrid'] .= $butt_view.$butt_add.$butt_del;
					break;
				case 15 :
					$data['appGrid'] .= $butt_view.$butt_add.$butt_edt.$butt_del;
					break;
				default :
					
					
			}
			
			//searching		
				$data['appGrid'] .= "<td><input type='text' name='searchgrid_".$no_grid."' id='searchgrid_".$no_grid."' value='' placeholder='search...' class='fieldTextBox' /></td>";
				$data['appGrid'] .= "<td><button name='search_crud_".$no_grid."' id='search_crud_".$no_grid."'>Search</button></td>";
				
			//advanced searching
			if ($adv_search){
				$data['appGrid'] .= "<td><span style='height:20px; border:solid 1px #CCC;'></span></td>";
				$data['appGrid'] .= "<td><button name='search_adv_crud_".$no_grid."' id='search_adv_crud_".$no_grid."'>Advanced Search</button></td>";
			}
			//button
			
			$data['appGrid'] .= "</tr></table>";
			
			//box advanced search
			if ($adv_search){
				$data['appGrid'] .= "<div id='search_adv_box_".$no_grid."'  title='Search...'>";				
					for($i=0; $i < sizeof($param); $i++){
						if($param[$i]['adv_src']){
							$data['appGrid'] .= $param[$i]['label'].":<br />";
							if($param[$i]['type'] == 'date'){
								$data['appGrid'] .= "From <input type='text' name='dt_adv_box_1_". $param[$i]['name']."'  id='dt_adv_box_1_". $param[$i]['name']."' class='fieldTextBox' readonly='readonly'>";
								$data['appGrid'] .= "To <input type='text' name='dt_adv_box_2_". $param[$i]['name']."'  id='dt_adv_box_2_". $param[$i]['name']."' class='fieldTextBox' readonly='readonly'>";
							}else{
								$data['appGrid'] .= "<input type='text' name='adv_box_". $param[$i]['label']."'  id='adv_box_". $param[$i]['label']."' class='fieldTextBox'>";
							}
						}
					}				
				$data['appGrid'] .= "</div>";
			}
			
			//Init Javascript
			$data['appGrid'] .= "<script language='text/javascript'>";
			
			//Init variable javascript
			$data['appGrid'] .= "var ret = '';  ";
			
			$data['appGrid'] .= "$(document).ready(function() { 
									var no_grid = '".$no_grid."';
									var pk_tbl  = '".$pk_tbl."';
									var pk_id   = '".$pk_id."';
									var pk_db   = '".$pk_db."';";
	
									
									
			$data['appGrid'] .= " 	$( '#view_crud_".$no_grid."' ).button({icons: { primary: 'ui-icon-document'} })
									$( '#add_crud_".$no_grid."' ).button({icons: { primary: 'ui-icon-plus'} })
									$( '#edit_crud_".$no_grid."' ).button({icons: { primary: 'ui-icon-pencil'} })
									$( '#delete_crud_".$no_grid."' ).button({icons: { primary: 'ui-icon-trash'} })
									$( '#search_crud_".$no_grid."' ).button({icons: { primary: 'ui-icon-search'}, text: false })
									$( '#search_adv_crud_".$no_grid."' ).button({icons: { primary: 'ui-icon-search'} })
								";
			
			//View JS Button
			$data['appGrid'] .= "			
						$('#view_crud_'+no_grid).click(function() {
							var id = jQuery('#grid_'+no_grid).jqGrid('getGridParam','selrow'); 	
							if (id) { 								
								$.ajax({
									'url'  : '".$url_base.$url."/processForm',
									'data' : 'id='+id+'&proc=view&group=".$group_id."&modul=".$module_id."',
									'success' : function(data) {
										";
			if(isset($this->slider_page) && $this->slider_page) {
				$data['appGrid'].= " cycleClear_$module_id();
									cycleAdd_$module_id(data); ";
			} else {
				$data['appGrid'].= " $('#tab_'+no_grid).html(data); ";
			}
			$data['appGrid'] .="
									}
								});
							} else { 
								alert_box('Please select row');
								return false;
							}
						}); ";
			
			//Add New JS Button
			$data['appGrid'] .= "			
						$('#add_crud_'+no_grid).click(function() {
							$.ajax({
								'url' : '".$url_base.$url."/processForm',
								'data' : 'proc=add&group=".$group_id."&modul=".$module_id."',
								'success' : function(data) {									
									";
			if(isset($this->slider_page) && $this->slider_page) {
				$data['appGrid'].= " cycleClear_$module_id();
									cycleAdd_$module_id(data); ";
			} else {
				$data['appGrid'].= " $('#tab_'+no_grid).html(data); ";
			}
			$data['appGrid'] .="
								}
							});
						}); ";
			
			//Edit JS Button
			$data['appGrid'] .= "			
						$('#edit_crud_'+no_grid).click(function() {
							var id = jQuery('#grid_'+no_grid).jqGrid('getGridParam','selrow'); 	
							if (id) { 								
								$.ajax({
									'url'  : '".$url_base.$url."/processForm',
									'data' : 'id='+id+'&proc=edit&group=".$group_id."&modul=".$module_id."',
									'success' : function(data) {
										";
			if(isset($this->slider_page) && $this->slider_page) {
				$data['appGrid'].= " cycleClear_$module_id();
									cycleAdd_$module_id(data); ";
			} else {
				$data['appGrid'].= " $('#tab_'+no_grid).html(data); ";
			}
			$data['appGrid'] .="
									}
								});
							} else { 
								alert_box('Please select row');
								return false;
							}
						}); ";
			
			//Delete JS Button
			$data['appGrid'] .= "				
						$('#delete_crud_'+no_grid).click(function() {
							var id = jQuery('#grid_'+no_grid).jqGrid('getGridParam','selrow'); 	
							
							if (id) {
								var txt_conf = 'These items will be deleted. Are you sure?';
								var url 	 = '".$url_base."myform_save/delete';
								var data	 = 'id='+id+'&proc=delete&pk_tbl='+pk_tbl+'&pk_id='+pk_id+'&pk_db='+pk_db+'&group=".$group_id."&modul=".$module_id."';
								var num_grid = no_grid;
								confirm_delete_box(txt_conf, url, data, num_grid);
								
								/*var jwb = confirm('Anda yakin ingin menghapus data ?');
								if (jwb == 1) {
									$.ajax({
										'url'  : '".$url_base."myform_save/delete',
										'data' : 'id='+id+'&proc=delete&pk_tbl='+pk_tbl+'&pk_id='+pk_id+'&pk_db='+pk_db+'&group=".$group_id."&modul=".$module_id."',
										'success' : function(data) {
											if (data > 0) {
												jQuery('#grid_'+no_grid).trigger('reloadGrid');
											} else {
												alert('Data gagal dihapus');
												return false;
											}
										}
									});
								}*/
								
							} else {
								alert_box('Please select row');
								return false;
							}
						});";
			
			//Search JS Button
			$data['appGrid'] .= "
						$('#search_crud_'+no_grid).click(function() {
							var srcText = $('#searchgrid_'+no_grid).val();
							$('#grid_'+no_grid).trigger('reloadGrid');
						});	
						
						$('#searchgrid_'+no_grid).keypress(function(e){ 
						    var code = e.which; 
						    if(code==13)e.preventDefault();
						    if(code==32||code==13||code==188||code==186){
						    	var srcText = $(this).val();
								$('#grid_'+no_grid).trigger('reloadGrid');
						    }
						});	";
			
			
			//Search JS Advanced 
			if ($adv_search){
				$data['appGrid'] .="
							$( '#search_adv_box_'+no_grid).dialog({
								autoOpen: false,
								modal: true,
								resizable:false,
								buttons: {
					                'Search': function() {
					                    alert('searching..');
					                },
					                Cancel: function() {
					                    $( this ).dialog( 'close' );
					                }
					            }
							});
							
							$('#search_adv_crud_'+no_grid).click(function() {
								$( '#search_adv_box_'+no_grid ).dialog( 'open' );
							});	";
				
				for($i=0; $i < sizeof($param); $i++){
					if($param[$i]['adv_src']){						
						if($param[$i]['type'] == 'date'){
							$label_name = $param[$i]['name'];
							$idBox1 = "dt_adv_box_1_".$label_name;
							$idBox2 = "dt_adv_box_2_".$label_name;
							 
							$data['appGrid'] .= "$('#".$idBox1."').datepicker({ dateFormat: 'dd-mm-yy', maxDate: \"0d\" });";
							$data['appGrid'] .= "$('#".$idBox2."').datepicker({ dateFormat: 'dd-mm-yy', maxDate: \"0d\" });";
						} 
					}
				}
				
			}
			//End Init Javascript
			$data['appGrid'] .= "});	</script>";
			
		} else {
			$data['appGrid'] = "Sorry you have no access right";
		}
		//$data['appGrid'] = "</div>";
		if( $this->slider_page ) {
			$data['id'] = $sess_auth->gModul;
			$this->_ci->load->view($this->slider_page, $data);
		} else {
			$this->_ci->load->view($view, $data);
		}
	}
	
	function getColumnsForGrid($data) {
		$columns = array();
		foreach($data as $dat) {
			if ($dat['showOnGrid'] == 1) {
				$columns[] = $dat['name'];
			}
		}
		return $columns;
	}
}
?>