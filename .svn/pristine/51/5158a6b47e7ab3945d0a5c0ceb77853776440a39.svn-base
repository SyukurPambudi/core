<?php
/* jqgrid lib
 */
class jqgrid_lib{
	private $divName;
	private $pagerName;
	private $sourceUrl;
    private $colNames;
    private $colModels;
	private $searchFields;
    private $sortName;
	private $sortOrder;
    private $caption;
    private $gridHeight;
    private $addUrl;
    private $editUrl;
    private $deleteUrl;
    private $customButtons;
    private $customFunctions;
    private $subGrid;
	private $subGridUrl;
	private $subGridColumnNames;
	private $subGridColumnWidth;
	private $dblClick;
	private $dblClickId;
	private $buttonView;
	private $buttonViewUrl;
	private $url;
	protected $_ci;
	
	protected $_insertPrivilege;
	protected $_updatePrivilege;
	protected $_deletePrivilege;
	
	//start multi select
	private $multiSelect;
	//end multi select
	
	function __construct() {
        $this->_ci=&get_instance();
		$this->_ci->load->library('acl');
		$parm1 = $this->_ci->uri->segment(1);
		$this->_ci->acl->hasPermission($parm1,'create') ? $this->setInsertPrivilege(1) : $this->setInsertPrivilege(0);
		$this->_ci->acl->hasPermission($parm1,'delete') ? $this->setDeletePrivilege(1) : $this->setDeletePrivilege(0);
		$this->_ci->acl->hasPermission($parm1,'update') ? $this->setUpdatePrivilege(1) : $this->setUpdatePrivilege(0);
    }

    public function setColumns($columns) {
    	//echo '<pre>';print_r($columns);echo '</pre>';
		$tmpColNames = array();		
		$tmpColModels = '';
		$tmpSearch = array();
                
                //print_r($columns);

		foreach ($columns as $columnNames => $columnOptions) {
			//echo $columnNames.' ';
			if($columnNames !== 'search_field') {
				foreach ($columnOptions as $columnName => $columnOption) {
                                        //$columnOption['autowrap'] = 'cellattr: function (rowId, tv, rawObject, cm, rdata) {return \'style="white-space: normal;"\'}'; 
					$tmpColNames[] = $columnName;
					$tmpColModels .= json_encode($columnOption).",";
					if($columnOption['search'] == 1) {
						if($columnOption['type'] == 'date' || $columnOption['type'] == 'datetime'|| $columnOption['type'] == 'timestamp') {
							$tmpSearch[] = $columnOption['name'].'_start';
							$tmpSearch[] = $columnOption['name'].'_end';
						}
						elseif($columnOption['type'] == 'between') {
							$tmpSearch[] = $columnOption['name'].'_start';
							$tmpSearch[] = $columnOption['name'].'_end';
						}
						else {
							$tmpSearch[] = $columnOption['name'];
						}					
					}				
				}
			}
		}
                //print_r($tmpColModels);
		$this->colNames = json_encode($tmpColNames);
		$this->colModels = '['.$tmpColModels.']';
		$this->searchFields = $tmpSearch;
		//print_r($columns['search_field']);
		if (array_key_exists('search_field', $columns)) {
			foreach($columns['search_field'] as $se) {
				if(!in_array($se, $this->searchFields)) {
					$this->searchFields[] = $se;
				}
			}
		}
		//print_r($this->searchFields);
		//print_r($tmpColModels);
	}
	
	public function setMultiSelect($multiSelect) {
		$this->multiSelect = $multiSelect;
	}

	public function setDivName($divName) {
		$this->divName = $divName;
	}
	
	public function setPagerName($pagerName) {
		$this->pagerName = $pagerName;
	}

	public function setSourceUrl($url) {
		$this->sourceUrl = $url;
	}

	public function setSortName($sortName) {
		$this->sortName = $sortName;
	}
	
	public function setSortOrder($sortOrder) {
		$this->sortOrder = $sortOrder;
	}

	public function setCaption($caption) {
		$this->caption = $caption;
	}

	public function setGridHeight($height) {
		$this->gridHeight = $height;
	}

	public function setPrimaryKey($primaryKey) {
		$this->primaryKey = $primaryKey;
	}

	public function setAddUrl($url) {
		$this->addUrl = $url;
	}

	public function setEditUrl($url) {
		$this->editUrl = $url;
	}

	public function setDeleteUrl($url) {
		$this->deleteUrl = $url;
	}

	public function setCustomButtons($buttons) {
		$this->customButtons = $buttons;
	}

	public function setCustomFunctions($customFunctions) {
		$this->customFunctions = $customFunctions;
	}

	public function setSubGrid($isSubGrid = FALSE) {
		$this->subGrid = $isSubGrid;
	}

	public function setSubGridUrl($subGridUrl) {
		$this->subGridUrl = $subGridUrl;
	}

	public function setSubGridColumnNames($columnNames) {
		$this->subGridColumnNames = $columnNames;
	}

	public function setSubGridColumnWidth($columnWidth) {
		$this->subGridColumnWidth = $columnWidth;
	}
	
	public function setButtonView($v) {
		$this->buttonView = $v;
	}
	
	public function getButtonView() {
		return $this->buttonView;
	}
	
	public function setButtonViewUrl($v) {
		$this->buttonViewUrl = $v;
	}
	
	public function getButtonViewUrl() {
		return $this->buttonViewUrl;
	}
	
	public function setDblClick($v) {
		$this->dblClick = $v;
	}
	public function setDblClickId($v = FALSE) {
		$this->dblClickId = $v;
	}
	
	public function setUpdatePrivilege($v) {
		$this->_updatePrivilege=$v;
	}
	public function setDeletePrivilege($v) {
		$this->_deletePrivilege=$v;	
	}
	public function setInsertPrivilege($v) {
		$this->_insertPrivilege=$v; 
	}
	public function getUpdatePrivilege() {
		return $this->_updatePrivilege;
	}
	public function getDeletePrivilege() {
		return $this->_deletePrivilege;
	}
	public function getInsertPrivilege() {
		return $this->_insertPrivilege;
	}

	public function buildGrid() {
		$buildDivName = $this->divName;
		$buildPagerName = $this->pagerName;
		$buildSourceUrl = $this->sourceUrl;
		$buildColNames = $this->colNames;
		$buildColModels = $this->colModels;
		$buildSortName = $this->sortName;
		$buildSortOrder = $this->sortOrder;
		$buildEditUrl = $this->editUrl;
		$buildAddUrl = $this->addUrl;
		$buildDeleteUrl = $this->deleteUrl;
		$buildCaption = $this->caption;
		$buildGridHeight = $this->gridHeight;
		$buildPrimaryKey = $this->primaryKey;
		$buildCustomButtons = $this->customButtons;
		$buildSubGrid = $this->subGrid;
		$buttonView = $this->buttonView;
		$buttonViewUrl = $this->buttonViewUrl;
		$dblClick = $this->dblClick;
		$dblClickId = $this->dblClickId;
		$buildSubGridUrl = $this->subGridUrl;
		$buildSubGridColumnNames = $this->subGridColumnNames;
		$buildSubGridColumnWidth = $this->subGridColumnWidth;
		
		$multiSelect = $this->multiSelect;

		//$this->url=$this->_ci->uri->segment(1);
		//print_r($this->searchFields);
		$sGrid = "postData: {";
		if(is_array($this->searchFields)) {
			foreach($this->searchFields as $kf => $vf) {
				$vfs = str_replace('.', '__', $vf);
				$sGrid .= "'".$vfs."': function() { return $('#search_".$buildDivName."_".$vfs."').val(); },";
			}
		}
		$sGrid .= "},";
		//echo $sGrid;
		//echo 'test :'.$buildDivName;
		$grid = "<script type='text/javascript'>";
		//return $buildSubGrid;
		if($buildSubGrid){
			$subGridModel = array(array('name'=>$buildSubGridColumnNames,'width'=>$buildSubGridColumnWidth));
			$subGridModel = json_encode($subGridModel);
			//$grid .= "$('#grid').jqGrid({
			$grid .= "$('#$buildDivName').jqGrid({
					url:'$buildSourceUrl',
					".$sGrid."
					/*postData: {
					    search_key: function() { return $('#search').val(); },
					},*/
					datatype: 'json',
					colNames:$buildColNames,
					colModel:$buildColModels,
					rowNum:10,
					rowList:[10,20,30,50,100],
					pager: '#$buildPagerName',
					//toppager:true,
					autowidth: true,
					//cloneToTop:true,
					sortname: '$buildSortName',
					viewrecords: true,
					//height: 'auto',
					sortorder: '$buildSortOrder',
					rownumbers: true,
					height: '100%',
					//cmTemplate: { title: false },
					shrinkToFit: true,
					multiselect: $multiSelect,
						subGrid : true, 
						subGridUrl : '$buildSubGridUrl',
						subGridModel : $subGridModel,
					caption:'$buildCaption',";					
				if($dblClickId) {
					$grid .= "ondblClickRow: function(rowid) {
				      var v = $('#$buildDivName').getRowData(rowid);
				      load('$buildDivName/$dblClick/$dblClickId/'+rowid,'#masterform-konten');
			      }";
				}
				else {
					$grid .= "ondblClickRow: function(rowid) {
				      var v = $('#$buildDivName').getRowData(rowid);
				      load('$buildDivName/$dblClick/'+rowid,'#masterform-konten');
			      }";
				}					
			$grid .= "});";
			$grid .= "$('#$buildDivName').jqGrid('setFrozenColumns');";
		}
		else {
			//$grid .= "$('#grid').jqGrid({
			$grid .= "$('#$buildDivName').jqGrid({
					url:'$buildSourceUrl',
					".$sGrid."
					/*postData: {
					    search_key: function() { return $('#search._$buildDivName').val(); },
					},*/
					datatype: 'json',
					colNames:$buildColNames,
					colModel:$buildColModels,
					rowNum:10,
					rowList:[10,20,30,50,100],
					pager: '#$buildPagerName',
					//toppager:true,
					autowidth: true,
					shrinkToFit: false,
					//cloneToTop:true,
					sortname: '$buildSortName',
					viewrecords: true,
					sortorder: '$buildSortOrder',
					rownumbers:true,
					height: '100%',
					//scroll:1,
					multiselect: $multiSelect,
					caption:'$buildCaption',";
				if($dblClickId) {
					$grid .= "ondblClickRow: function(rowid) {
				      var v = $('#$buildDivName').getRowData(rowid);
				      load('$buildDivName/$dblClick/$dblClickId/'+rowid,'#masterform-konten');
			      }";
				}
				else {
					$grid .= "ondblClickRow: function(rowid) {
				      var v = $('#$buildDivName').getRowData(rowid);
				      load('$buildDivName/$dblClick/'+rowid,'#masterform-konten');
			      }";
				}
			$grid .= "});";
			$grid .= "$('#$buildDivName').jqGrid('setFrozenColumns');";
		}

		$grid .= "$('#$buildDivName').jqGrid('gridResize',{minWidth:300,maxWidth:1305,minHeight:80, maxHeight:370});";
		
		/*$grid .= "$('#grid_search').filterGrid('grid',{
				    gridModel:true,
				    gridNames:true,   
				    formtype:'vertical',				    
				    gridToolbar: true,
				    //enableSearch: true,
				    //enableClear: true,
				    formclass: 'form-search-grid',
				    tableclass: 'table-search-grid',
				    buttonclass: 'button-search-grid',
				    searchButton: 'Cari',
				    clearButton: 'Batalkan',
				    autosearch: false 
				  });";*/

		//NavBar
		$grid .= "$('#$buildDivName').jqGrid('navGrid','#$buildPagerName',
					//{search:false,edit:false,add:false,del:false,cloneToTop:true}, //options
					{search:false,edit:false,add:false,del:false,cloneToTop:false}, //options
					{} // search options
					)";
      if( !empty( $buildCustomButtons ) ){
         foreach($buildCustomButtons as $customButton) {
               $customButton = ".navButtonAdd('#grid_toppager_left',".$customButton.")";
               $grid .= $customButton;
            }
      }

		/*$grid .= ".navButtonAdd('#grid_toppager_left',
					{ caption:'', buttonicon:'ui-icon-trash', onClickButton:jqGridDelete ,title: 'Delete selected row', position: 'first', cursor: 'pointer'})
					.navButtonAdd('#grid_toppager_left',
					{ caption:'', buttonicon:'ui-icon-pencil', onClickButton:jqGridEdit,title: 'Edit selected row', position: 'first', cursor: 'pointer'})
					.navButtonAdd('#grid_toppager_left',
					{ caption:'', buttonicon:'ui-icon-plus', onClickButton:jqGridAdd,title: 'Add new record', position: 'first', cursor: 'pointer'});";*/

		$grid .= "
		function jqGridAdd() {
			location.href='$buildAddUrl';
		}

		function jqGridEdit() {
			var grid = $('#$buildDivName');
			var sel_id = grid.jqGrid('getGridParam', 'selrow');
			var myCellData = grid.jqGrid('getCell', sel_id, '$buildPrimaryKey');
			if(!myCellData) {
				alert('No selected row');
			} else {
				//alert(myCellData);

            location.href='$buildEditUrl' + myCellData;
			}
		}

		function jqGridDelete() {
			var grid = $('#$buildDivName');
			var sel_id = grid.jqGrid('getGridParam', 'selrow');
			var recid = grid.jqGrid('getCell', sel_id, '$buildPrimaryKey');
			if(!recid) {
				alert('No selected row');
			} else {
				var ans = confirm('Delete selected record?');
				if(ans) {
					var data = {};
					data.recid = recid;
					$.post('$buildDeleteUrl',data);
					$('#$buildDivName').trigger('reloadGrid');
				}
			}
		}

		";

		if( !empty( $this->customFunctions ) ){
         foreach($this->customFunctions as $customFunction) {
            $grid .= $customFunction;
         }
      }

		//Set Grid Height
		//$grid .= "$('#$buildDivName').setGridHeight($buildGridHeight,true);";
		//$grid .= "$('.ui-jqgrid-titlebar-close','#gview_grid').remove();";
		$parm1 = $this->_ci->uri->segment(1);
		//$grid .= "$('<div align=\"right\"><input type=\"text\" id=\"search\" class=\"master-search\" placeholder=\"Search Keyword\"  size=\"55\" /><button type=\"button\" id=\"startSearch\">Search</button></div>').prependTo(\"#pagewrap\");";
		$disp = $buildDivName=='grid2' ? 'display: none;' : ''; 
    	//$grid .= "$('<div align=\"right\" id=\"div_search\" class=\"_".$buildDivName."\" style=\"margin-bottom: 10px; $disp\"><input type=\"text\" id=\"search\" class=\"master-search _".$buildDivName."\" trigger=\"".$buildDivName."\" placeholder=\"Search Keyword\"  size=\"55\" /></div>').prependTo(\"#masterform-konten\");";
		//$grid .= "$('<div align=\"right\"><div id=\"master-search-box\" class=\"_".$buildDivName."\" style=\"margin-bottom: 10px; $disp\"><input type=\"text\" id=\"search\" class=\"master-search _".$buildDivName."\" trigger=\"".$buildDivName."\" placeholder=\"Search Keyword\"  size=\"46\" /><img id=\"button_search\" class=\"button-search\" src=\"".base_url()."images/Search-icon.png\" width=\"18\" height=\"18\"></div></div>').prependTo(\"#masterform-konten\");";
		$grid .= "$('<div align=\"right\"><div id=\"master-search-box\" class=\"_".$buildDivName."\" style=\"margin-bottom: 10px; $disp\"><input type=\"text\" id=\"search\" class=\"master-search _".$buildDivName."\" trigger=\"".$buildDivName."\" placeholder=\"Search Keyword\"  size=\"46\" />search</div></div>').prependTo(\"#masterform-konten\");";
		if($buildDivName!='grid2') {
			if($this->_ci->acl->hasPermission($parm1,'create')) {
				if($this->_ci->acl->hasPermission($parm1,'delete')) {
					//$grid .= "$('<div id=\"button_add\" class=\"addlink\"><a href=\"".$parm1."/create\">Tambah Baru</a></div>').appendTo(\"#content\");";
					//$grid .= "$('<div id=\"button_delete\" class=\"delalllink\"><a href=\"".$parm1."/delall\" class=\"dellall\">Hapus Data yg Terpilih</a></div>').appendTo(\"#content\");";
					//$grid .= "$('<button type=\"button\" ref=\"$this->url\" class=\"dellall\">Delete Selected(s)</button></div>').appendTo(\"#masterform-konten\");";
					//$grid .= "$('<div id=\"masterform-konten-isi\"><div align=\"right\"><a href=\"javascript:void(0);\" title=\"Entry New File\" class=\"addlink\" onClick=\"javascript:load(\'".base_url().$parm1."/create\',\'#masterform-konten\');\"><img src=\"".base_url()."images/new_doc.png\" width=\"28\" height=\"28\"></a><a href=\"javascript:void();\" title=\"Delete\" ref=\"".$this->url."\" class=\"dellall\"><img src=\"".base_url()."images/document_delete.png\" width=\"28\" height=\"28\"></a></div></div>').appendTo(\"#masterform-konten\");";
					$grid .= "$('<div id=\"masterform-konten-isi\"><div align=\"right\"><a title=\"Add New Record\" class=\"edit_link\" href=\"".base_url().$parm1."/create\"><img src=\"".base_url()."images/new_doc.png\" width=\"28\" height=\"28\"></a><a href=\"javascript:void();\" title=\"Delete\" ref=\"".$buildDivName."\" class=\"dellall\"><img src=\"".base_url()."images/document_delete.png\" width=\"28\" height=\"28\"></a></div></div>').appendTo(\"#masterform-konten\");";
				}
				else {
					//$grid .= "$('<div id=\"button_add\" class=\"addlink\"><a href=\"".$parm1."/create\">Tambah Baru</a></div>').appendTo(\"#content\");";
					//$grid .= "$('<div id=\"masterform-konten-isi\"><div align=\"right\"><a href=\"javascript:void(0);\" title=\"Entry New File\" class=\"addlink\" onClick=\"javascript:load(\'".base_url().$parm1."/create\',\'#masterform-konten\');\"><img src=\"".base_url()."images/new_doc.png\" width=\"28\" height=\"28\"></a></div></div>').appendTo(\"#masterform-konten\");";
					$grid .= "$('<div id=\"masterform-konten-isi\"><div align=\"right\"><a title=\"Add New Record\" class=\"edit_link\" href=\"".base_url().$parm1."/create\"><img src=\"".base_url()."images/new_doc.png\" width=\"28\" height=\"28\"></a></div></div>').appendTo(\"#masterform-konten\");";
				}
			}
			elseif($this->_ci->acl->hasPermission($parm1,'delete')) {
				//$grid .= "$('<div id=\"button_delete\" class=\"delalllink\"><a href=\"".$parm1."/delall\" class=\"dellall\">Hapus Data yg Terpilih</a></div>').appendTo(\"#content\");";
				//$grid .= "$('<button type=\"button\" ref=\"$this->url\" class=\"dellall\">Delete Selected(s)</button>').appendTo(\"#masterform-konten\");";
				$grid .= "$('<div id=\"masterform-konten-isi\"><div align=\"right\"><a href=\"javascript:void();\" title=\"Delete Record\" ref=\"".$buildDivName."\" class=\"dellall\"><img src=\"".base_url()."images/document_delete.png\" width=\"28\" height=\"28\"></a></div></div>').appendTo(\"#masterform-konten\");";
			}
		}
		
		$grid .= "</script>";
		return $grid;
	}
}
