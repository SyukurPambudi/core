<?php
  function buildGrid( $aData ){
     $CI =& get_instance();
     $CI->load->library('jqgrid_lib');
     $CI->load->library('Zend', 'Zend/Session/Namespace');
     $sess_auth = new Zend_Session_Namespace('auth');
     
     $jqGrid = $CI->jqgrid_lib;
     if( isset( $aData['set_columns'] ) ){
        $aProperty = array();
        foreach( $aData['set_columns'] as $sProperty ){
           $aProperty[] = array(
                           $sProperty['label'] =>
                              array(
                                 'name'  => $sProperty['name'],
                                 'index' => $sProperty['name'],
                              	 'align' => isset($sProperty['align']) ? $sProperty['align'] : '', 
                                 'width' => $sProperty['width'],
                                 'editable'    => false,
                                 'editoptions' => array(
                                                   'readonly'=>'true',
                                                   'size'=> $sProperty['size']
                                                  )
                              )
           );
        }
        $jqGrid->setColumns( $aProperty );
     }

     if( isset( $aData['custom'] ) ){
        if( isset( $aData['custom']['button'] ) ){
           $jqGrid->setCustomButtons( array( $aData['custom']['button'] ) );
        }
        if( isset( $aData['custom']['function'] ) ){
           $jqGrid->setCustomFunctions( array( $aData['custom']['function'] ) );
        }
     }

     if( isset( $aData['div_name'] ) ){
        $jqGrid->setDivName( $aData['div_name'] );
     } else {
        $jqGrid->setDivName( 'grid_'.$sess_auth->gModul );
     }

     if( isset( $aData['source'] ) ) $jqGrid->setSourceUrl( base_url() . $aData['source'] );

     if( isset( $aData['sort_name'] ) ) $jqGrid->setSortName( $aData['sort_name'] );

     if( isset( $aData['add_url'] ) ) $jqGrid->setAddUrl( base_url() . $aData['add_url'] );

     if( isset( $aData['delete_url'] ) ) $jqGrid->setDeleteUrl( base_url() . $aData['delete_url'] );

     if( isset( $aData['edit_url'] ) ) $jqGrid->setEditUrl( base_url() . $aData['edit_url'] );

     if( isset( $aData['caption'] ) ) $jqGrid->setCaption( $aData['caption'] );

     if( isset( $aData['primary_key'] ) ) $jqGrid->setPrimaryKey( $aData['primary_key'] );

     if( isset( $aData['grid_height'] ) ) $jqGrid->setGridHeight( $aData['grid_height'] );

     if( isset( $aData['subgrid'] ) ) $jqGrid->setSubGrid($aData['subgrid']);

	 if( isset( $aData['subgrid_url'] ) ) $jqGrid->setSubGridUrl($aData['subgrid_url']);

	 if( isset( $aData['subgrid_columnnames'] ) ) $jqGrid->setSubGridColumnNames($aData['subgrid_columnnames']);

	 if( isset( $aData['subgrid_columnwidth'] ) ) $jqGrid->subGridColumnWidth($aData['subgrid_columnwidth']);
	 
	 /*Added*/
	 if( isset( $aData['dbl_click_row'] ) ) $jqGrid->setDblClickRow($aData['dbl_click_row']);
	 
     return $jqGrid->buildGrid();
  }

  function buildGridData( $aData ){
      $CI =& get_instance();
      $isSearch         = $CI->input->get('_search');
      $searchField      = $CI->input->get('searchField');
      //$searchString     = $CI->input->get('searchString');
      $searchString     = $CI->input->get('search_key');
      $searchOperator   = $CI->input->get('searchOper');
      
      $page    			= $CI->input->get('page'); // get the requested page
      $limit   			= $CI->input->get('rows'); // get how many rows we want to have into the grid
      $sidx    			= $CI->input->get('sidx'); // get index row - i.e. user click to sort
      $sord    			= $CI->input->get('sord'); // get the direction
      $parentId = (isset($aData['parentId']) ? $aData['parentId'] : 0); // get parentId;
        
      if($isSearch) $whereParam = buildWhereClauseForSearch($searchField,$searchString,$searchOperator);
      else $whereParam = NULL;
      
      if($searchString != 'undefined') {
	     	$searchParam = buildWhereCustomForm($searchString,$aData['columns']);
	  } else {
	      	$searchParam = '';
	  }
	  
      //$paramArr['whereParam'] 	= $whereParam; 
      $paramArr['searchParam'] 	= $searchParam;
      $paramArr['reload']     	= TRUE;
      
      $paramArr['parentId']     = $parentId;
      
      /*you can add aditional params in the where clause here:
      $paramArr['outletid']		= $CI->session->userdata(SELECTED_OUTLET);
	  $paramArr['invtypeId']	= $CI->session->userdata(SELECTED_INVENTORY_TYPE);
	  $paramArr['postingYear'] 	= getPostingYear();
	  */
      
      if( isset( $aData['method'] ) && isset( $aData['model'] ) ){
          
         $CI->load->model( $aData['model'] );
         $aDataList = $CI->$aData['model']->$aData['method']($paramArr);
         $count = count($aDataList);
         if( $count >0 ) $total_pages = ceil($count/$limit);
         else $total_pages = 0;

         if ($page > $total_pages) $page=$total_pages;
         $start = $limit*$page - $limit;

         $paramArr['start']      = $start;
         $paramArr['limit']      = $limit;
         $paramArr['sortField']  = $sidx;
         $paramArr['sortOrder']  = $sord;
         $paramArr['whereParam'] = $whereParam;         
         $paramArr['reload']     = TRUE;
         $paramArr['parentId']   = $parentId;
         $aDataList = $CI->$aData['model']->$aData['method']($paramArr);

         $i=0;
         if( isset( $aData['columns'] ) ){
            foreach ($aDataList as $row)
            {
               $columnData = array();
               foreach( $aData['columns'] as $sData ){
                  array_push( $columnData, $row->$sData );
               }
               $rs->rows[$i]['id']     = $row->$aData['pkid'];
               $rs->rows[$i]['cell']   = $columnData ;
               $i++;
            }
         }
         $rs->cols      = $columnData;
         $rs->page      = $page;
         $rs->total     = $total_pages;
         $rs->records   = $count;
         echo json_encode($rs);
      }
  }
	
	function buildWhereCustomForm($key, $column) {
		$search = '';
		$key = mysql_real_escape_string($key);
		$jum = count($column);
		for($i=0;$i<$jum;$i++) {
			if($i == 0) {
				$search = $column[$i]." LIKE '%".$key."%'";
			}
			else {
				$search .= ' OR '.$column[$i]." LIKE '%".$key."%'";
			}
		}
		return $search;
	}
  
    function buildWhereClauseForSearch($searchField,$searchString,$searchOperator) {
		$searchString = mysql_real_escape_string($searchString);
		$searchField = mysql_real_escape_string($searchField);
		$operator['eq'] = "$searchField='$searchString'"; //equal to
		$operator['ne'] = "$searchField<>'$searchString'"; //not equal to
		$operator['lt'] = "$searchField < $searchString"; //less than
		$operator['le'] = "$searchField <= $searchString "; //less than or equal to
		$operator['gt'] = "$searchField > $searchString"; //less than
		$operator['ge'] = "$searchField >= $searchString "; //less than or equal to
		$operator['bw'] = "$searchField like '$searchString%'"; //begins with
		$operator['bn'] = "$searchField not like '$searchString%'"; //not begins with
		$operator['in'] = "$searchField in ($searchString)"; //in
		$operator['ni'] = "$searchField not in ($searchString)"; //not in
		$operator['ew'] = "$searchField like '%$searchString'"; //ends with
		$operator['en'] = "$searchField not like '%$searchString%'"; //not ends with
		$operator['cn'] = "$searchField like '%$searchString%'"; //in
		$operator['nc'] = "$searchField not like '%$searchString%'"; //not in
		$operator['nu'] = "$searchField is null"; //is null
		$operator['nn'] = "$searchField is not null"; //is not null

		if(isset($operator[$searchOperator])) {
			return $operator[$searchOperator];
		} else {
			return null;
		}
	}
	
	function buildGridLocal( $aData ) {
		$CI =& get_instance();
		$myvar = new StdClass();
		
		$CI->load->library('jqgrid_lib');
		$jqGrid = $CI->jqgrid_lib;
		
		$CI->load->library('Zend', 'Zend/Session/Namespace');
		$sess_auth = new Zend_Session_Namespace('auth');
		
		$myvar->url = '';
		if( isset( $aData['url'] ) ) {
			$myvar->url = base_url().$aData['url'];
		}
		
		$myvar->grid_name = '';
		if( isset( $aData['grid_name'] ) ) {
			$myvar->grid_name = $aData['grid_name'].'_'.$sess_auth->gModul;
		}
		
		$myvar->pager_name = '';
		if( isset( $aData['pager_name'] ) ) {
			$myvar->pager_name = $aData['pager_name'].'_'.$sess_auth->gModul;
		}
		
		$myvar->columns = '';
		if( isset( $aData['set_columns'] ) ){
			$aProperty = array();
			foreach( $aData['set_columns'] as $sProperty ){
				$aProperty[] = array(
						$sProperty['label'] =>
						array(
								'name'  => $sProperty['name'],
								'index' => $sProperty['name'],
								'align' => isset($sProperty['align']) ? $sProperty['align'] : '',
								'width' => $sProperty['width'],
								'editable'    => true,
								/*
								'editoptions' => array(
										'readonly'=>'false',
										'size'=> $sProperty['size']
								)*/
						)
				);
			}
			$myvar->columns = $jqGrid->setColumns( $aProperty, TRUE );
		}
		
		$myvar->caption = '';
		if( isset( $aData['caption'] ) ) {
			$myvar->caption = $aData['caption'];
		}
		
		$myvar->view = '';
		if( isset( $aData['view'] ) ) {
			$myvar->view = $aData['view'];
		}
		$data['url'] = $myvar->url;
		$data['grid_name'] = $myvar->grid_name;
		$data['pager_name'] = $myvar->pager_name;
		$data['columns'] = $myvar->columns;
		$grid = $CI->load->view($myvar->view, $data, TRUE );
		return $grid;
		
	}
