<?php
/* jqgrid Helper
 */
function buildGrid($aData) {
	$CI = &get_instance();
	$CI->load->library('Zend', 'Zend/Session/Namespace');
	$sess_auth 	= new Zend_Session_Namespace('auth');
	
	$CI -> load -> library('jqgrid_lib');
	$jqGrid = $CI -> jqgrid_lib;
	$CI -> load -> library('acl', array('userID' => $sess_auth->gNip));
	$acl = $CI -> acl;


	if (isset($aData['button_view'])) {
		$jqGrid -> setButtonView($aData['button_view']);
	} else {
		$jqGrid -> setButtonView('1');
	}

	if (isset($aData['button_view_url'])) {
		$jqGrid -> setButtonViewUrl($aData['button_view_url']);
	} else {
		$jqGrid -> setButtonViewUrl('view');
	}

	if (isset($aData['set_columns'])) {
		$CI = &get_instance();
		$CI -> load -> library('grid');
		$grid = $CI -> grid;
		$group_id 	= $grid->getGroupID();
		$module_id 	= $grid->getModulID();
		$company_id = $grid->getCompanyID();		
		
		$id_PT = isset($company_id) ? $company_id : false;
		
		$GroupAndModul = array("group_id" => $group_id , "module_id" => $module_id, "company_id" => $company_id);
		
		//$parm1 = $CI -> uri -> segment(1);
		if ($acl -> hasPermission($GroupAndModul, 'delete')) {
			$delete = array('label' => 'del', 'name' => 'delete', 'title' => TRUE, 'sortable' => FALSE, 'width' => '19', 'size' => '10', 'align' => 'center','type' => '', 'search' => false, 'frozen'=>FALSE);
			array_unshift($aData['set_columns'], $delete);
			//array_push($aData['set_columns'], $delete);
		}
		
		if ($acl -> hasPermission($GroupAndModul, 'update')) {
			$edit = array('label' => 'edit', 'name' => 'edit', 'title' => TRUE, 'sortable' => FALSE, 'width' => '23', 'size' => '10', 'align' => 'center','type' => '', 'search' => false, 'frozen'=>FALSE);
			array_unshift($aData['set_columns'], $edit);
			//array_push($aData['set_columns'], $edit);
		}
		
		if ($acl -> hasPermission($GroupAndModul, 'view')) {
			$view = array('label' => 'view', 'name' => 'view', 'title' => TRUE, 'sortable' => FALSE, 'width' => '27', 'size' => '10', 'align' => 'center','type' => '', 'search' => false, 'frozen'=>FALSE);
			array_unshift($aData['set_columns'], $view);
			//array_push($aData['set_columns'], $view);
		}
		
		//}
		/*echo '<pre>';
		print_r($aData['set_columns']);
		echo '</pre>';*/
		$aProperty = array();
		foreach ($aData['set_columns'] as $sProperty) {
			$aProperty[] = array($sProperty['label'] => array('frozen'=>$sProperty['frozen'],'name' => $sProperty['name'], 'sortable' => $sProperty['sortable'] , 'title' => $sProperty['title'], 'index' => $sProperty['name'], 'width' => $sProperty['width'], 'align' => $sProperty['align'], 'editable' => false, 'search' => $sProperty['search'], 'type' => $sProperty['type'], 'editoptions' => array('readonly' => 'true',
			//'size'=> $sProperty['size']
			)));
		}
		foreach($aData['search'] as $s) {
			$aProperty['search_field'][] = $s['fields'];
		}		
		$jqGrid -> setColumns($aProperty);
	}

	if (isset($aData['custom'])) {
		if (isset($aData['custom']['button'])) {
			$jqGrid -> setCustomButtons(array($aData['custom']['button']));
		}
		if (isset($aData['custom']['function'])) {
			$jqGrid -> setCustomFunctions(array($aData['custom']['function']));
		}
	}

	if (isset($aData['div_name'])) {
		$jqGrid -> setDivName($aData['div_name']);
	} else {
		$divName = $CI -> uri -> segment(1);
		$jqGrid -> setDivName('grid_' . $divName);
	}

	if (isset($aData['pager_name'])) {
		$jqGrid -> setPagerName($aData['pager_name']);
	} else {
		$divName = $CI -> uri -> segment(1);
		$jqGrid -> setPagerName('pager_' . $divName);
	}

	if (isset($aData['source']))
		$jqGrid -> setSourceUrl(base_url() . $aData['source']);

	if (isset($aData['sort_name']))
		$jqGrid -> setSortName($aData['sort_name']);

	if (isset($aData['sort_order']))
		$jqGrid -> setSortOrder($aData['sort_order']);

	if (isset($aData['add_url']))
		$jqGrid -> setAddUrl(base_url() . $aData['add_url']);

	if (isset($aData['delete_url']))
		$jqGrid -> setDeleteUrl(base_url() . $aData['delete_url']);

	if (isset($aData['edit_url']))
		$jqGrid -> setEditUrl(base_url() . $aData['edit_url']);

	if (isset($aData['caption']))
		$jqGrid -> setCaption($aData['caption']);

	if (isset($aData['primary_key']))
		$jqGrid -> setPrimaryKey($aData['primary_key']);

	if (isset($aData['grid_height']))
		$jqGrid -> setGridHeight($aData['grid_height']);

	if (isset($aData['subgrid']))
		$jqGrid -> setSubGrid($aData['subgrid']);

	if (isset($aData['subgrid_url']))
		$jqGrid -> setSubGridUrl($aData['subgrid_url']);

	if (isset($aData['dbl_click'])) {
		$jqGrid -> setDblClick($aData['dbl_click']);
	} else {
		$jqGrid -> setDblClick('view');
	}

	if (isset($aData['dbl_click_id'])) {
		$jqGrid -> setDblClickId($aData['dbl_click_id']);
	} else {
		$jqGrid -> setDblClickId('');
	}

	if (isset($aData['subgrid_columnnames']))
		$jqGrid -> setSubGridColumnNames($aData['subgrid_columnnames']);

	if (isset($aData['subgrid_columnwidth']))
		$jqGrid -> setSubGridColumnWidth($aData['subgrid_columnwidth']);
	
	//Tambah multi select
	if (isset($aData['multi_select'])) {
		$aData['multi_select'] = $aData['multi_select'] == false ? 0 : 1;
		$jqGrid -> setMultiSelect($aData['multi_select']);
	} else {
		$jqGrid -> setMultiSelect(0);
	}

	return $jqGrid -> buildGrid();
}

function buildGridData($aData) {
	$CI = &get_instance();
	/*$CI -> load -> library('acl', array('userID' => $CI -> session -> userdata('userID')));
	$acl = $CI -> acl;*/
	$CI -> load -> library('jqgrid_lib');
	$jqGrid = $CI -> jqgrid_lib;
	
	$CI->load->library('Zend', 'Zend/Session/Namespace');
	$sess_auth 	= new Zend_Session_Namespace('auth');
	
	$CI -> load -> library('acl', array('userID' => $sess_auth->gNip));
	$acl = $CI -> acl;
	$rs = new stdClass();

	$isSearch = $CI -> input -> get('_search');
	$searchField = $CI -> input -> get('searchField');
	$searchString = $CI -> input -> get('searchString');
	$searchOperator = $CI -> input -> get('searchOper');
	$page = $CI -> input -> get('page');
	//$page = $_GET['page'];
	// get the requested page
	$limit = $CI -> input -> get('rows');
	//$limit = $_GET['rows'];
	// get how many rows we want to have into the grid
	$sidx = $CI -> input -> get('sidx');
	if(array_key_exists($sidx, $aData['relations'])) {
		$sidx = $aData['relations'][$sidx]['join_table'].'.'.$aData['relations'][$sidx]['view_as'];
	}
	else {
		//$sidx = $aData['table'].'.'.$sidx;
		$sidx = $sidx;
	}
	// get index row - i.e. user click to sort
	$sord = $CI -> input -> get('sord');
	// get the direction

	if ($isSearch)
		$whereParam = buildWhereClauseForSearch($searchField, $searchString, $searchOperator);
	else
		$whereParam = NULL;

	$whr = array();
	//print_r($aData['search']);
	foreach ($aData['search'] as $ks => $vs) {
		//echo $vs['fields'].' ';
		//$vs['fields'] = str_replace('.', '_____', $vs['fields']);
		if($vs['type'] == 'date') {
			if ($CI -> input -> get($vs['fields']) != 'undefined') {
				$whr[$vs['fields']] = array('type'=>$vs['type'],'field'=>$vs['fields'], 'value' => $CI -> input -> get($vs['fields']));			
				//$whr[$vs['fields']] = array('type'=>$vs['type'],'field'=>$vs['fields'], 'value' => $vs['fields']);
			} else {
				$whr[$vs['fields']] = array('type'=>$vs['type'],'field'=>$vs['fields'], 'value' => '');
			}	
		} else
		if($vs['type'] == 'datetime' || $vs['type'] == 'timestamp') {
			if ($CI -> input -> get($vs['fields'].'_start') != 'undefined' && $CI -> input -> get($vs['fields'].'_end') != 'undefined') {
				$whr[$vs['fields']] = array('type'=>$vs['type'],'field'=>$vs['fields'],'start'=>$vs['fields'].'_start', 'value_start' => $CI -> input -> get($vs['fields'].'_start'),'end'=>$vs['fields'].'_end', 'value_end' => $CI -> input -> get($vs['fields'].'_end'));
				//$whr[] = array('type'=>'date','name'=>$vs['fields'],'field'=>$vs['fields'].'_start', 'value' => $CI -> input -> get($vs['fields'].'_start'));
				//$whr[] = array('type'=>'date','name'=>$vs['fields'],'field'=>$vs['fields'].'_end', 'value' => $CI -> input -> get($vs['fields'].'_end'));
				//$whr[][$vs['fields'].'_start'] = $CI -> input -> get($vs['fields'].'_start');
				//$whr[][$vs['fields'].'_end'] = $CI -> input -> get($vs['fields'].'_end');
			}
			else {
				$whr[$vs['fields']] = array('type'=>$vs['type'],'field'=>$vs['fields'],'start'=>$vs['fields'].'_start', 'value_start' =>'0000-00-00','end'=>$vs['fields'].'_end', 'value_end' => '0000-00-00');
				//$whr[] = array('type'=>'date','name'=>$vs['fields'],'field'=>$vs['fields'].'_start', 'value' => '');
				//$whr[] = array('type'=>'date','name'=>$vs['fields'],'field'=>$vs['fields'].'_end', 'value' => '');
			}			
		}
		elseif($vs['type'] == 'between') {
			if ($CI -> input -> get($vs['fields'].'_start') != 'undefined' && $CI -> input -> get($vs['fields'].'_end') != 'undefined') {
				$whr[$vs['fields']] = array('type'=>$vs['type'],'field'=>$vs['fields'],'start'=>$vs['fields'].'_start', 'value_start' => $CI -> input -> get($vs['fields'].'_start'),'end'=>$vs['fields'].'_end', 'value_end' => $CI -> input -> get($vs['fields'].'_end'));
			}
			else {
				$whr[$vs['fields']] = array('type'=>$vs['type'],'field'=>$vs['fields'],'start'=>$vs['fields'].'_start', 'value_start' =>'','end'=>$vs['fields'].'_end', 'value_end' => '');			
			}
		}
		else {
			$vs['fields'] = str_replace('.', '__', $vs['fields']);
			if ($CI -> input -> get($vs['fields']) != 'undefined') {
				$whr[$vs['fields']] = array('type'=>$vs['type'],'field'=>$vs['fields'], 'value' => $CI -> input -> get($vs['fields']));			
				//$whr[$vs['fields']] = array('type'=>$vs['type'],'field'=>$vs['fields'], 'value' => $vs['fields']);
			} else {
				$whr[$vs['fields']] = array('type'=>$vs['type'],'field'=>$vs['fields'], 'value' => '');
			}
		}		
	}

	//print_r($whr);
	
	$cont = $aData['cont'];
	require_once $cont;
	$con = new $aData['the_url'];
	
	if (isset($aData['method']) && isset($aData['library'])) {

		$CI -> load -> library($aData['library']);
		$paramArr['table'] = $aData['table'];
		//$paramArr['functions'] = $aData['functions'];
		$paramArr['functions_search'] = $aData['functions_search'];
		$paramArr['con'] = $con;
		$paramArr['relations'] = $aData['relations'];
		$paramArr['join_table'] = $aData['join_table'];
		$paramArr['queries'] = $aData['queries'];
		$paramArr['pk'] = $aData['pkid'];
		$paramArr['list'] = $aData['columns_list'];
		$paramArr['sortField'] = $sidx;
		$paramArr['sortOrder'] = $sord;
		$paramArr['groupField'] = $aData['group_by'];
		$paramArr['searchFields'] = $whr;
		$paramArr['searchOperand'] = $aData['searchOperand'];
		$paramArr['vsql'] = $aData['vsql'];
		$paramArr['vsqlCond'] = $aData['vsqlCond'];
		$paramArr['vsqlOrder'] = $aData['vsqlOrder'];
		$paramArr['whereParam'] = $whereParam;
		$paramArr['reload'] = TRUE;
		if (isset($aData['parmid'])) {
			$aDataList = $CI -> $aData['library'] -> $aData['method']($paramArr, $aData['parmid']);
		} else {
			$aDataList = $CI -> $aData['library'] -> $aData['method']($paramArr);

			//$count = count($aDataList);
			$count = $CI -> $aData['library'] -> count_json($paramArr);
			if ($count > 0)
				$total_pages = ceil($count / $limit);
			else
				$total_pages = 0;

			if ($page > $total_pages)
				$page = $total_pages;
			$start = $limit * $page - $limit;

			if ($start > 0 && $limit > 0) {
				$paramArr['start'] = $start;
				$paramArr['limit'] = $limit;
			}
		}
		
		$paramArr['table'] = $aData['table'];
		$paramArr['relations'] = $aData['relations'];
		$paramArr['join_table'] = $aData['join_table'];
		$paramArr['queries'] = $aData['queries'];
		$paramArr['pk'] = $aData['pkid'];
		$paramArr['sortField'] = $sidx;
		$paramArr['sortOrder'] = $sord;
		$paramArr['whereParam'] = $whereParam;
		$paramArr['reload'] = TRUE;
		if (isset($aData['parmid'])) {
			$aDataList = $CI -> $aData['library'] > $aData['method']($paramArr, $aData['parmid']);
		} else {
			$aDataList = $CI -> $aData['library'] -> $aData['method']($paramArr);
		}

		//print_r($aData['columns']);

		$i = 0;
		if (isset($aData['columns'])) {
			/*$parm1 = $CI->uri->segment(1);
			 if($acl->hasPermission($parm1,'update')) {
			 //$edit=array('label'=>'Ubah','name'=>'edit','width'=>'45','size'=>'10');
			 //array_push( $aData['columns'], 'edit' );
			 }
			 if($acl->hasPermission($parm1,'delete')) {
			 //$delete=array('label'=>'Hapus','name'=>'delete','width'=>'45','size'=>'10');
			 //array_push( $aData['columns'], 'delete' );
			 }*/
			//print_r($aData['columns']);
			if (is_array($aDataList)) {
				if (isset($aData['button_view'])) {
					$jqGrid -> setButtonView($aData['button_view']);
				} else {
					$jqGrid -> setButtonView('1');
				}

				if (isset($aData['button_view_url'])) {
					$jqGrid -> setButtonViewUrl($aData['button_view_url']);
				} else {
					$jqGrid -> setButtonViewUrl('view');
				}				
				//print_r($con);
				//print_r($aDataList);
				foreach ($aDataList as $row) {
					$columnData = array();
					$funcs = $aData['functions'];
					$changeField = $aData['change_fields'];					 
					//print_r($aData['change_fields']);
					foreach ($aData['columns'] as $kData => $sData) {
						$kData = str_replace('.', '__', $kData);
						$sData = str_replace('.', '__', $sData);
						if(isset($changeField[$kData])) {
							$new_value = '';
							foreach($changeField[$kData]['value'] as $ck => $cv) {
								if($row -> $sData == $ck) {
									$new_value = $cv;
									$paramArr['sortField'] = $cv;
								}
								else {
									if($new_value == '') {
										$new_value = $row -> $sData;
									}									
								}
							}
							//array_push($columnData, $new_value);
							array_push($columnData, $new_value);
						}
						else {
							if (isset($funcs[$kData]['box'])) {
								$fu = $funcs[$kData]['box'];
							} else {
								$fu = '';
							}
							
							if (method_exists($con, $fu)) {
								$isinya = isset($row->$sData) ? $row->$sData : '';
								//$new_value = $con->$fu($row->$sData, $row -> $aData['pkid'], $sData, $row);
								$new_value = $con->$fu($isinya, $row -> $aData['pkid'], $sData, $row);
								array_push($columnData, $new_value);								
							} else {
								$ada = strpos($sData, '/');
								if ($ada === false) {
									$isi = isset($row -> $sData) ? $row -> $sData : '';
									//array_push($columnData, $row -> $sData);
									array_push($columnData, $isi);
								} else {
									$ps = explode('/', $sData);
									if ($ps[0] == '' || $ps[0] == NULL) {
										array_push($columnData, $row -> $ps[1]);
									} else {
										array_push($columnData, $row -> $ps[0]);
									}
								}
							}
						}
					}
					$CI -> load -> library('grid');
					$grid = $CI -> grid;
					$group_id 	= $grid->getGroupID();
					$module_id 	= $grid->getModulID();
					$company_id = $grid->getCompanyID();
                                                                                
					$foreign_key = empty($aData["foreign_key"]) ? 0 : $aData["foreign_key"];
					//echo 'fkey : '.$foreign_key;
					//echo $group_id.' = '.$module_id.' = '.$company_id.' = '.$foreign_key;
					//print_r($aData);
					//exit;
					
					$id_PT = isset($company_id) ? $company_id : false;
					
					$nu = explode('_', $aData['the_url']);
					$nurl = implode('/', $nu);
					$urlpage = _url_module(uri_string());
					$urlpages = explode('/', $urlpage);
					
					$viewUrl = $jqGrid -> getButtonViewUrl();
					$action=array();
					$action['view'] = '<a href="javascript:;" onClick="javascript:edit_btn(\''.base_url().'processor/'.$urlpages[0].'/'.$nurl.'?action=view&id='.$row->$aData["pkid"].'&foreign_key='.$foreign_key.'&company_id='.$grid->getCompanyID().'&group_id='.$grid->getGroupID().'&modul_id='.$grid->getModulID().'\',\''.$aData['the_url'].'\')"><center><span class="ui-icon ui-icon-lightbulb"></span></center></a>';
					$action['edit'] = '<a href="javascript:;" onClick="javascript:edit_btn(\''.base_url().'processor/'.$urlpages[0].'/'.$nurl.'?action=update&id='.$row->$aData["pkid"].'&foreign_key='.$foreign_key.'&company_id='.$grid->getCompanyID().'&group_id='.$grid->getGroupID().'&modul_id='.$grid->getModulID().'\',\''.$aData['the_url'].'\')"><center><span class="ui-icon ui-icon-pencil"></span></center></a>';
					$action['delete'] = '<a href="javascript:;" onClick="javascript:del_btn(\''.base_url().'processor/'.$urlpages[0].'/'.$nurl.'?action=delete&id='.$row->$aData["pkid"].'&foreign_key='.$foreign_key.'&company_id='.$grid->getCompanyID().'&group_id='.$grid->getGroupID().'&modul_id='.$grid->getModulID().'\',\''.$aData['the_url'].'\')"><center><span class="ui-icon ui-icon-trash"></span></center></a>';
					
					if (method_exists($con, 'listBox_action')) {
						$action = $con->listBox_action($row, $action);
						$GroupAndModul = array("group_id" => $group_id , "module_id" => $module_id, "company_id" => $company_id);
						if (!isset($aData['parmid'])) {
							$parm1 = $CI -> uri -> segment(1);
							
							if($acl->hasPermission($GroupAndModul,'delete')) {
								$delete = isset($action['delete']) ? $action['delete'] : '';
								//array_push($columnData, $delete);
								array_unshift($columnData, $delete);
							}
							
							if($acl->hasPermission($GroupAndModul,'update')) {
								$edit = isset($action['edit']) ? $action['edit'] : '';
								//array_push($columnData, $edit);
								array_unshift($columnData, $edit);
							}
							
							if ($acl -> hasPermission($GroupAndModul, 'view')) {
								$view = isset($action['view']) ? $action['view'] : '';
								//array_push($columnData, $view);
								array_unshift($columnData, $view);
							}
						}
					}
					else {					
						$GroupAndModul = array("group_id" => $group_id , "module_id" => $module_id, "company_id" => $company_id);
						if (!isset($aData['parmid'])) {
							$parm1 = $CI -> uri -> segment(1);
							
							if($acl->hasPermission($GroupAndModul,'delete')) {
								$delete = $action['delete'];
								//array_push($columnData, $delete);
								array_unshift($columnData, $delete);
							}
							
							if($acl->hasPermission($GroupAndModul,'update')) {
								$edit = $action['edit'];
								//array_push($columnData, $edit);
								array_unshift($columnData, $edit);
							}
							
							if ($acl -> hasPermission($GroupAndModul, 'view')) {
								$view = $action['view'];
								//array_push($columnData, $view);
								array_unshift($columnData, $view);
							}
							
							//}
							
							//else {
							
							//}
							//}
						}
					}
					$no = $i + 1;
					if (isset($aData['parmid'])) {
						array_unshift($columnData, '<center>' . $no . '</center>');
					}
					$rs -> rows[$i]['id'] = $row -> $aData['pkid'];
					$rs -> rows[$i]['cell'] = $columnData;
					//print_r($columnData);
					$i++;
				}
			} else {
				$columnData = '';
			}
		}

		if (!isset($columnData)) {
			$columnData = '';
		}
		if (isset($aData['parmid'])) {
			$rs -> cols = $columnData;
		} else {
			$rs -> cols = $columnData;
			$rs -> page = $page;
			$rs -> total = $total_pages;
			$rs -> records = $count;
		}
		echo json_encode($rs);
	}
}

function buildWhereClauseForSearch($searchField, $searchString, $searchOperator) {
	$searchString = mysql_real_escape_string($searchString);
	$searchField = mysql_real_escape_string($searchField);
	$operator['eq'] = "$searchField='$searchString'";
	//equal to
	$operator['ne'] = "$searchField<>'$searchString'";
	//not equal to
	$operator['lt'] = "$searchField < $searchString";
	//less than
	$operator['le'] = "$searchField <= $searchString ";
	//less than or equal to
	$operator['gt'] = "$searchField > $searchString";
	//less than
	$operator['ge'] = "$searchField >= $searchString ";
	//less than or equal to
	$operator['bw'] = "$searchField like '$searchString%'";
	//begins with
	$operator['bn'] = "$searchField not like '$searchString%'";
	//not begins with
	$operator['in'] = "$searchField in ($searchString)";
	//in
	$operator['ni'] = "$searchField not in ($searchString)";
	//not in
	$operator['ew'] = "$searchField like '%$searchString'";
	//ends with
	$operator['en'] = "$searchField not like '%$searchString%'";
	//not ends with
	$operator['cn'] = "$searchField like '%$searchString%'";
	//in
	$operator['nc'] = "$searchField not like '%$searchString%'";
	//not in
	$operator['nu'] = "$searchField is null";
	//is null
	$operator['nn'] = "$searchField is not null";
	//is not null

	if (isset($operator[$searchOperator])) {
		return $operator[$searchOperator];
	} else {
		return null;
	}
}

function buildWhereCustomForm($key, $column) {
	$search = '';
	$key = mysql_real_escape_string($key);
	$jum = count($column);
	for ($i = 0; $i < $jum; $i++) {
		if ($i == 0) {
			$search = $column[$i] . " LIKE '%" . $key . "%'";
		} else {
			$search .= ' OR ' . $column[$i] . " LIKE '%" . $key . "%'";
		}
	}
	return $search;
}
