<?php 
class MyGrid2 { 
	
	public $_ci;
	public $_dttblext;
	
	function __construct() {
		$this->_ci =& get_instance();		
		$this->_ci->load->library('datatables');
		$this->_ci->load->helper('url');
		//session
		$this->_ci->load->library('Zend', 'Zend/Session/Namespace');
		
		//acl
		$this->_ci->load->library('MyAcl');
	}
	
	public function drawGrid($property) {
	
		//print_r($property);
		
		/* Rule for parameter (variable $param):
		   'label'   => 'App ID', // for label
			'name'   => $this->f_columns[0], // for field name on table
			'width'  => 50, //width coloumn
			'size'   => 10,
			'adv_src'=> FALSE, //if true, advance search will   activated
			'type'	 => 'text' //type of field for searchin
		 */
		 
		//echo 'Group ID '.$_GET['group_id'];
		//echo 'Modul ID '.$_GET['modul_id'];
		//echo 'Company ID '.$_GET['company_id'];
		
		$paramx = array();
		$list_table_to_be_use = array();
		$list_table = array();
		$list_field = array();
		$list_relation = array();
		$list_relation1 = array();
		$list_where_condition = array();
		$list_FK   = array();//kalo ada, otomatis akan dimasukkan kondisi where FK = Headernya
		$field_PK  = '';
		
		
		foreach($property['data'] as $para) {						
			$paramx[] = $para;			
			
			//get table
			if (isset($para['PK'])) {	
				if (!in_array(
					(isset($para['prefix']) ? $para['prefix'] : $property['pk_db']).'.'.
					(isset($para['table']) ? $para['table'] : $property['pk_tbl']), $list_table)) 
					
					$list_table[] = (isset($para['prefix']) ? $para['prefix'] : $property['pk_db']).'.'.(isset($para['table']) ? $para['table'] : $property['pk_tbl']);
					
					$label = str_replace('.', '', $para['label']);
					$label = str_replace('/', '', $label);
					$label = str_replace(' ', '_', $label);
				
					$field_PK = str_replace(' ', '_', $label);
			} else {
				if (!in_array(
				(isset($para['prefix']) ? $para['prefix'] : $property['pk_db']).'.'.
				(isset($para['table']) ? $para['table'] : $property['pk_tbl']), $list_table_to_be_use)) 
				$list_table_to_be_use[] = (isset($para['prefix']) ? $para['prefix'] : $property['pk_db']).'.'.
				(isset($para['table']) ? $para['table'] : $property['pk_tbl']);
			}
			
			//get relationship
			/* if (isset($para['relationTo'])) {
				if (!in_array($para['relationTo'], $list_relation)) {
					$list_relation[] = $para['relationTo'];
				}
			} */ 
			if (isset($para['relationTo'])) {
				$relation = explode('.', $para['relationTo']);
				if (sizeOf($relation) == 2) {
					if (!in_array($property['pk_db'].'.'.$relation[0].'.'.$relation[1], $list_relation)) {
						$list_relation[] = $property['pk_db'].'.'.$relation[0].'.'.$relation[1];
					}
				} else if (sizeOf($relation) == 3) {
					if (!in_array($para['relationTo'], $list_relation)) {
						$list_relation[] = $para['relationTo'];
					}
				} else {
					//echo 'Invalid Relationship
				}
			}
			
			//get relationfree
			if (isset($para['relationAt']) && $para['relationAt'] == TRUE) {
				
				$label = str_replace('.', '', $para['label']);
				$label = str_replace('/', '', $label);
				$label = str_replace(' ', '_', $label);
				
				if (!in_array($label, $list_relation1)) {
					$list_relation1[] = $label;
				}
			}
		}	
		
		//print_r($list_table);
		
		foreach($property['data'] as $para) {			
			foreach($list_table_to_be_use as $ltable) {			
				if ($ltable == (isset($para['prefix']) ? $para['prefix'] : $property['pk_db']).'.'.(isset($para['table']) ? $para['table'] : $property['pk_tbl'])) {
					if (!in_array($para['name'], $list_field)) {
						
						$label = str_replace('.', '', $para['label']);
						$label = str_replace('/', '', $label);
						$label = str_replace(' ', '_', $label);

						$list_field[] = (isset($para['prefix']) ? $para['prefix'] : $property['pk_db']).'.'.(isset($para['table']) ? $para['table'] : $property['pk_tbl']).'.'.$para['name'].' AS '.$label;
					}
				}				
			}
		}
		
		if (isset($property['where_condition'])) {
			$list_where_condition[] = $property['where_condition'];
		}
		
		
		$url_base  = base_url();
		
		//set grup and modul
		//$group_id 	= $property['group_and_modul']['group_id'];
		//$module_id 	= $property['group_and_modul']['module_id'];
		//$company_id = $property['group_and_modul']['company_id'];
		$group_id 	= $_GET['group_id'];
		$module_id 	= $_GET['modul_id'];
		$company_id = $_GET['company_id'];
		$parent_id  = (isset($property['group_and_modul']['parent_id']) ? $property['group_and_modul']['parent_id'] : 0);

		//set properti
		$url 		= $property['url'];
		$pk_tbl     = $property['pk_tbl'];
		$pk_id		= $property['pk_id'];
		$pk_db      = $property['pk_db'];
		$pk_prefix  = $property['pk_prefix'];
		$sort_by	= $property['sort_by'];
		$caption	= $property['caption'];
		$view		= $property['view'];
		$no_urut    = (isset($property['urut']) ? $property['urut'] : '');
		$button     = (isset($property['button']) ? $property['button'] : '') ;
		$is_detail  = (isset($property['detail']) ? $property['detail'] : '');
		$adv_search = isset($property['adv_search']) ? $property['adv_search'] : FALSE;
		$this->slider_page = (isset($property['slider_page']) && !empty($property['slider_page']) ) ? $property['slider_page'] : FALSE;
		
		//DM
		$custom_del = ( isset($property['custom_delete']) ?  $property['custom_delete'] : FALSE );
		if ($custom_del){
			$custom_confirm	= $property['custom_confirm'];
			$custom_function= $property['custom_function'];
		}
		
		//privilege/setup_applications/drawList
		$sess_auth 	= new Zend_Session_Namespace('auth');
		$no_grid 	= $module_id;//$sess_auth->gModul;

		$GroupAndModul = array("group_id" => $group_id , "module_id" => $module_id, "company_id" => $company_id);

		$id_PT = isset($company_id) ? $company_id : false;		
		//getAcl
		if (empty($id_PT)){
			$acl = $this->_ci->myacl->getMyAcl($sess_auth->gComId, $sess_auth->gAccess, $GroupAndModul);
		}else{
			$acl = $this->_ci->myacl->getMyAcl($id_PT, $sess_auth->gAccess, $GroupAndModul);
		}

		$aoColumns = '';
		$header   = '';
		$i = 0;
		foreach($paramx as $par) {	
			if ($par['showOnGrid'] == TRUE) $visible = 1;
			else $visible = 0;
			
			//echo $par['width'];
				
			$aoColumns .= "{'sClass':'".$par['name']."', 'sTitle':'".$par['label']."', 'sWidth':'".$par['width']."px', 'bVisible' : $visible, 'mData':$i},";
			$i++;
		}
		
		$aoColumns .= "{'sClass': 'action','sTitle': 'Action', 'bSortable': false, 'bSearchable': false, 'sWidth': '7%', 'mData': $i}";

		if ($acl != 0) {			
			if ($no_urut == '') {
				$tab_id = ' ';
			} else {
				$tab_id = 'id="tab_'.$no_grid.$no_urut.'"';
			}
			
			$data['appGrid'] = "<div {$tab_id} class='ui-jqgrid'>";
			$data['appGrid'] .= "<table id='grid_".$no_grid.$no_urut."' width='100%' border='0' cellpadding='0' cellspacing='0' class='display'>";
			$data['appGrid'] .= "<tbody><tr>
									<td colspan='4' class='dataTables_empty'>Loading data...</td>
								</tr></tbody>";
			$data['appGrid'] .= "</table>";			
			//button
			$data['appGrid'] .= "<table width='100%' cellpadding='2' cellspacing='0' border='0'>";
			$data['appGrid'] .= "<tr>";
				
			//echo 'Parent ID : '.$parent_id;
			$disabled_button = ' ';
			if (isset($property['detail'])) {
				if ($parent_id == '0' || $parent_id == '') $disabled_button = ' disabled';
				else $disabled_button = ' ';
			}
			
			//print_r($property);
			if (isset($property['reset_add_button']) && $property['reset_add_button'] === TRUE) {
				$butt_add = '<td></td>';
			} else {
				if ($button != '') {
					$butt_add  = "<td align='right'><input ".$disabled_button." class='btn ui-button ui-widget ui-state-default' type ='".$button[0]['type']."' name='".$button[0]['name']."' id='".$button[0]['id']."' value='".$button[0]['content']."' onclick='".$button[0]['onclick']."'/></td>";
				} else {
					$butt_add  = "<td align='right'><button ".$disabled_button." name='add_crud_".$no_grid.$no_urut."' id='add_crud_".$no_grid.$no_urut."'>Add New Record</button></td>";
				}
			}
 
			switch($acl) {
				case 1 :
					//$data['appGrid'] .= $butt_edt;
					break;
				case 2 :
					//$data['appGrid'] .= $butt_del;
					break;
				case 3 :
					//$data['appGrid'] .= $butt_edt.$butt_del;
					break;
				case 4 :
					//$data['appGrid'] .= $butt_view;
					break;
				case 5 :
					//$data['appGrid'] .= $butt_view.$butt_edt;
					break;
				case 6 :
					//$data['appGrid'] .= $butt_view.$butt_del;
					break;
				case 7 :
					//$data['appGrid'] .= $butt_view.$butt_edt.$butt_del;
					break;
				case 8 :
					$data['appGrid'] .= $butt_add;
					break;
				case 9 :
					$data['appGrid'] .= $butt_add;//.$butt_edt;
					break;
				case 10 :
					$data['appGrid'] .= $butt_add;//.$butt_del;
					break;
				case 11 :
					$data['appGrid'] .= $butt_add;//.$butt_edt.$butt_del;
					break;
				case 12 :
					//$data['appGrid'] .= $butt_view.$butt_add;
					$data['appGrid'] .= $butt_add;
					break;
				case 13 :
					//$data['appGrid'] .= $butt_view.$butt_add.$butt_edt;
					$data['appGrid'] .= $butt_add;
					break;
				case 14 :
					//$data['appGrid'] .= $butt_view.$butt_add.$butt_del;
					$data['appGrid'] .= $butt_add;
					break;
				case 15 :
					//$data['appGrid'] .= $butt_view.$butt_add.$butt_edt.$butt_del;
					$data['appGrid'] .= $butt_add;
					break;
				default :
			}
				
			//searching
			//$data['appGrid'] .= "<td><input type='text' name='searchgrid_".$no_grid.$no_urut."' id='searchgrid_".$no_grid.$no_urut."' value='' placeholder='search...' class='fieldTextBox' /></td>";
			//$data['appGrid'] .= "<td><button name='search_crud_".$no_grid.$no_urut."' id='search_crud_".$no_grid.$no_urut."'>Search</button></td>";
			
			//advanced searching
			//if ($adv_search){
			//	$data['appGrid'] .= "<td><span style='height:20px; border:solid 1px #CCC;'></span></td>";
			//	$data['appGrid'] .= "<td><button name='search_adv_crud_".$no_grid.$no_urut."' id='search_adv_crud_".$no_grid.$no_urut."'>Advanced Search</button></td>";
			//}
			//button
				
			$data['appGrid'] .= "</tr></table>";
			//button			
			$data['appGrid'] .= "</div>";
			
			
			//box advanced search
			if ($adv_search){
				$data['appGrid'] .= "<div id='search_adv_box_".$no_grid.$no_urut."'  title='Search...'>";				
					for($i=0; $i < sizeof($property['data']); $i++){
						if($property['data'][$i]['adv_src']){
							$data['appGrid'] .= $property['data'][$i]['label'].":<br />";
							if($property['data'][$i]['type'] == 'date'){
								$data['appGrid'] .= "From <input type='text' name='dt_adv_box_1_". $property['data'][$i]['name']."'  id='dt_adv_box_1_". $property['data'][$i]['name']."' class='fieldTextBox' readonly='readonly'>";
								$data['appGrid'] .= "To <input type='text' name='dt_adv_box_2_". $property['data'][$i]['name']."'  id='dt_adv_box_2_". $property['data'][$i]['name']."' class='fieldTextBox' readonly='readonly'>";
							}else{
								$data['appGrid'] .= "<input type='text' name='adv_box_". $property['data'][$i]['label']."'  id='adv_box_". $property['data'][$i]['label']."' class='fieldTextBox'>";
							}
						}
					}				
				$data['appGrid'] .= "</div>";
			}
			
			//Init Javascript
			$data['appGrid'] .= "<script type='text/javascript'>";
			
			//Init variable javascript
			$data['appGrid'] .= "	var ret = '';  
								 	var oTable = '';
									var no_grid 	= '';
									var pk_tbl  	= '';
									var pk_id   	= '';
									var pk_db   	= '';
									var pk_prefix   = '';
									var list_table 	= '';		
									var list_field 	= '';
									var list_relation 	 = '';
									var field_PK 		 = '';
									var group_and_module = '';
									var where_condition = '';
									var is_detail       = '';
									var list_relation1 = '';
								";
			
			//kita looping utk dijadikan parameter sebagai javascript
			$list_table_ = '';
			if (sizeOf($list_table) > 0) {
				foreach($list_table as $lTable) {
					$list_table_ .= $lTable.',';
				} 
				$list_table_ = substr($list_table_, 0, strlen($list_table_) - 1);
			}
			
			//echo "list Table : ".$list_table_;
			
			
			$list_field_ = '';
			if (sizeOf($list_field) > 0) {
				foreach($list_field as $lField) {
					$list_field_ .= $lField.',';
				} 
				$list_field_ = substr($list_field_, 0, strlen($list_field_) - 1);
			}	

			$list_relation_ = '';
			if (sizeOf($list_relation) > 0) {
				foreach($list_relation as $lRela) {
					$list_relation_ .= $lRela.',';
				} 
				$list_relation_ = substr($list_relation_, 0, strlen($list_relation_) - 1);
			}
			
			$list_relation1_ = '';
			if (sizeOf($list_relation1) > 0) {
				foreach($list_relation1 as $lRela) {
					$list_relation1_ .= $lRela.',';
				}
				$list_relation1_ = substr($list_relation1_, 0, strlen($list_relation1_) - 1);
			}
			
			$list_where_condition_ = '';
			if (sizeOf($list_where_condition) > 0) {
				foreach($list_where_condition as $lWC) {
					$list_where_condition_ .= $lWC.',';
				}
				$list_where_condition_ = substr($list_where_condition_, 0, strlen($list_where_condition_) - 1);
			}
			$data['appGrid'] .= "$(document).ready(function() { 
									no_grid 	= '".$no_grid."';
									pk_tbl  	= '".$pk_tbl."';
									pk_id   	= '".$pk_id."';
									pk_db   	= '".$pk_db."';
									pk_prefix   = '".$pk_prefix."';
									list_table 	= '".$list_table_."';		
									list_field 	= '".$list_field_."';
									list_relation 	 = '".$list_relation_."';
									field_PK 		 = '".$field_PK."';
									group_and_module = '".$group_id.",".$module_id."';
									where_condition = '".$list_where_condition_."';
									is_detail       = '".$is_detail."';
									no_urut     = '".$no_urut."';
									list_relation1 = '".$list_relation1_."';
									company_id	= '".$id_PT."';
								";
	
			$data['appGrid'] .= "	var aoColumns = [".$aoColumns."];
									
									oTable = $('#grid_".$no_grid.$no_urut."').dataTable({
										'sDom'			 : '<\"ui-helper-clearfix\"><\"headerTable\"f>rt<\"dataTables_footWrapper\"ipl>',
										'bJQueryUI'		 : true,
										'bSortClasses'	 : false,
										'bProcessing'	 : false,
										'bServerSide'	 : true,
										//'bRetrieve'	     : true,
										//'bDestroy'	     : true,
										'sPaginationType': 'full_numbers',
										'sAjaxSource'	 : '".$url_base."myform_save/getData',	
										'oLanguage'		 : {
										           			'sSearch': '<span>Search :</span>',
										           			'oPaginate': {
										           					'sPrevious': 'Prev'
										           				}
										  	       			},
										'fnServerParams' : function(aoData) {
											aoData.push(
												{'name':'list_table', 'value':list_table},
												{'name':'list_field', 'value':list_field},
												{'name':'list_relation', 'value':list_relation},
												{'name':'field_PK', 'value':field_PK},
												{'name':'list_where_condition', 'value':where_condition},
												{'name':'group_and_module','value':group_and_module},
												{'name':'is_detail','value':is_detail},
												{'name':'no_urut','value':no_urut},
												{'name':'list_relation1', 'value':list_relation1},
												{'name':'company_id', 'value':company_id});
											},
										'aoColumns'		 : aoColumns,
										'fnDrawCallback' : function(oSettings){
												$('#grid_".$no_grid.$no_urut." tbody tr').hover(
													function (){
														$(this).addClass('ui-state-hover');
													},
													function (){
														$(this).removeClass('ui-state-hover');
													}
												);
												
												$('#grid_".$no_grid.$no_urut." tbody tr td').click(function() {
													$('#grid_".$no_grid.$no_urut." tbody tr').removeClass('ui-state-highlight');
													$(this).parent('tr').addClass('ui-state-highlight');
												}); 
										}
									});	
									
									{$this->_dttblext}
									
									$(\".headerTable\").addClass(\"fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix\");
									$(\".dataTables_footWrapper\").addClass(\"fg-toolbar ui-toolbar ui-state-default ui-corner-bl ui-corner-br ui-helper-clearfix\");
									$('#grid_".$no_grid.$no_urut."_wrapper .headerTable').append(\"<span class='dataTables_title'>".$caption."</span>\");
								";						
									
			$data['appGrid'] .= " $( '#add_crud_".$no_grid.$no_urut."' ).button({icons: { primary: 'ui-icon-plus'} })
								  $( '#search_crud_".$no_grid.$no_urut."' ).button({icons: { primary: 'ui-icon-search'}, text: false })
								";
			
			
			//Add New JS Button
			$data['appGrid'] .= "			
						$('#add_crud_".$no_grid.$no_urut."').click(function() {
							$.ajax({
								'url' : '".$url_base.$url."/processForm',
								'data' : 'proc=add&id=0&company_id=".$id_PT."&group_id=".$group_id."&modul_id=".$module_id."&no_urut=".$no_urut."&parent_id=".$parent_id."',
								'success' : function(data) {	
										//alert(data);											
									";
			$data['appGrid'].= " $('#tab_".$no_grid.$no_urut."').html(data); ";
			$data['appGrid'] .="
								}
							});
						}); ";
						
			//End Init Javascript
			$data['appGrid'] .= "}); ";
			
			//View Record
			$data['appGrid'] .= "
					function viewRecord_$no_grid$no_urut(id, dtl, company_id) {
						if (id) { 								
							$.ajax({
								'url'  : '".$url_base.$url."/processForm',
								'data' : 'id='+id+'&proc=view&company_id=".$id_PT."&group_id=".$group_id."&modul_id=".$module_id."&no_urut=".$no_urut."&parent_id=".$parent_id."',
								'success' : function(data) {
												var no_grid = $no_grid$no_urut;
												$('#tab_'+no_grid).html(data);
											}
							});
						} else { 
							alert_box('Please select row');
							return false;
						}
					} ";
			
			//Edit Record
			$data['appGrid'] .= "
					function editRecord_$no_grid$no_urut(id, dtl, obj, company_id) {
						if (id) {							
							$.ajax({
								'url'  : '".$url_base.$url."/processForm',
								'data' : 'id='+id+'&proc=edit&company_id=".$id_PT."&group_id=".$group_id."&modul_id=".$module_id."&no_urut=".$no_urut."&parent_id=".$parent_id."',
								'success' : function(data) {
											 var no_grid = $no_grid$no_urut;
											 //alert(no_grid);
											 $('#tab_'+no_grid).html(data);
											}
							});
						} else { 
							alert_box('Please select row');
							return false;
						}
					} ";
			if (!$custom_del){
				//Delete Record
				$data['appGrid'] .= "		
						function deleteRecord_$no_grid$no_urut(id) {
							//alert('Delete Record : '+id);
							if (id) {
									var txt_conf = 'These items will be deleted. Are you sure?';
									var url 	 = '".$url_base."myform_save/delete';
									var data	 = 'id='+id+'&proc=delete&pk_tbl='+pk_tbl+'&pk_id='+pk_id+'&pk_db='+pk_db+'&pk_prefix='+pk_prefix+'&group_id=".$group_id."&modul_id=".$module_id."&company_id=".$company_id."';
									var num_grid = no_grid;
									confirm_delete_box(txt_conf, url, data, '');								
									
								} else {
									alert_box('Please select row');
									return false;
								}				
						} ";
			}else{
				$data['appGrid'] .= "
						function deleteRecord_$no_grid$no_urut(id) {
						 	if (id) {
								var txt_conf = '".$custom_confirm.". Are you sure?';
								var url 	 = '".$url_base.$url.'/'.$custom_function."';
								var data	 = 'id='+id+'&proc=delete&pk_tbl='+pk_tbl+'&pk_id='+pk_id+'&pk_db='+pk_db+'&pk_prefix='+pk_prefix+'&group=".$group_id."&modul=".$module_id."';
								var num_grid = no_grid;
								confirm_delete_box(txt_conf, url, data, ''); 
							} else {
								alert_box('Please select row');
								return false;
							}
						} ";
			}
			
			//End Script
			$data['appGrid'] .= "</script>";
			
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
	
	function drawGridDtl($no_grid, $urut, $data, $group_and_modul) {			
		$isi = "<div id='tab_".$no_grid.$urut."' style='z-index:1;overflow:auto;text-align:left;'>";
		$isi .= $data;
		$isi .= "</div>";

		return $isi;
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
	
	function setFilteringDelay($bool=false,$time=1000) {
		if($bool==true) {
			$this->_dttblext.= ' oTable.fnSetFilteringDelay('.$time.'); ';
		}
	}
}
?>