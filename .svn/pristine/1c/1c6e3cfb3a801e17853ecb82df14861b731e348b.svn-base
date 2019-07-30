<?php
/*@Developer - Mark Lenard M. Mirandilla
 *@Version 1.0
 *@Description jqgrid library for Codeigniter
 */
class jqgrid_lib {
	private $divName;
	private $sourceUrl;
    private $colNames;
    private $colModels;
    private $sortName;
    private $caption;
    private $gridHeight;
    private $addUrl;
    private $editUrl;
    private $deleteUrl;
    private $customButtons;
    private $customFunctions;
    private $subgrid;
	private $subGridUrl;
	private $subGridColumnNames;
	private $subGridColumnWidth;
	
	/*Added*/
	private $gridDblClickRow;
	private $pager_name;
	
	private $_ci;	
	
	public function __construct() {
		$this->_ci =& get_instance();
		
	}

    public function setColumns($columns,$return=false) {
		$tmpColNames = array();
		$tmpColModels = '';
		
		foreach ($columns as $columnNames => $columnOptions) {			
			foreach ($columnOptions as $columnName => $columnOption) {				
				$tmpColNames[] = $columnName;
				$tmpColModels .= json_encode($columnOption).",";
			}
		}

		$this->colNames = json_encode($tmpColNames);
		$this->colModels = '['.$tmpColModels.']';			
		
		if($return) {
			return array('colNames'=>$this->colNames,'colModels'=>$this->colModels);
		}
	}

	public function setDivName($divName) {
		$this->divName = $divName;
	}

	public function setSourceUrl($url) {
		$this->sourceUrl = $url;
	}

	public function setSortName($sortName) {
		$this->sortName = $sortName;
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
	
	/*Added*/
	public function setDblClickRow($isDblClickRow = FALSE){
		$this->gridDblClickRow = $isDblClickRow;
	}
	
	//Added
	public function setNamePager($pager_name) {
		$this->pager_name = $pager_name;
	}	

	public function buildGrid() {
		
		//session
		$this->_ci->load->library('Zend', 'Zend/Session/Namespace');
		$sess_auth 	= new Zend_Session_Namespace('auth');		
		
		$buildDivName 			 = $this->divName;
		$buildSourceUrl 		 = $this->sourceUrl;
		$buildColNames 			 = $this->colNames;
		$buildColModels 		 = $this->colModels;
		$buildSortName 			 = $this->sortName;
		$buildEditUrl 			 = $this->editUrl;
		$buildAddUrl 			 = $this->addUrl;
		$buildDeleteUrl 		 = $this->deleteUrl;
		$buildCaption 			 = $this->caption;
		$buildGridHeight 		 = $this->gridHeight;
		$buildPrimaryKey 		 = $this->primaryKey;
		$buildCustomButtons 	 = $this->customButtons;
		$buildSubGrid 			 = $this->subgrid;
		$buildSubGridUrl 		 = $this->subGridUrl;
		$buildSubGridColumnNames = $this->subGridColumnNames;
		$buildSubGridColumnWidth = $this->subGridColumnWidth;
		
		/*Added*/
		//search_key: function() { return $('#search".$buildDivName."').val(); },
		$buildDblClickRow		 = $this->gridDblClickRow;
		$pager_name              = $this->pager_name;
		
		$grid = "<script type='text/javascript'>";
		$grid .= "
				var pageWidth = $('#$buildDivName').parent().width() - 100;
				$('#$buildDivName').jqGrid({
					url:'$buildSourceUrl'
				,   postData: {
				    	search_key: function() { return $('#search".$buildDivName."').val(); },
					}
				,	datatype: 'json'
				,	colNames:$buildColNames
				,	colModel:$buildColModels
				,	rowNum:10
				,	rowList:[10,20,30]
				,	pager: '#pager_$pager_name'
				,	toppager:false
				,	cloneToTop:false
				,   autowidth:true
				,	sortname: '$buildSortName'
				,	viewrecords: true
				,	sortorder: 'asc'
				,	caption:'$buildCaption'";

		if($buildDblClickRow){
		$grid .=",	ondblClickRow: function(id){ 
				      alert(id);
				   	}
			";
		}
		$grid .= "});";

		//NavBar
		$grid .= "$('#$buildDivName').jqGrid('navGrid', '#pager_".$pager_name."',
					{search:false, edit:false, add:false, del:false, cloneToTop:false}, //options
					{} // search options
					)";
      if( !empty( $buildCustomButtons ) ){
         foreach($buildCustomButtons as $customButton) {
               $customButton = ".navButtonAdd('#grid_".$pager_name."_toppager_left',".$customButton.")";
               $grid .= $customButton;
            }
      }

		$grid .= ".navButtonAdd('#grid_".$pager_name."_toppager_left',
					{ caption:'', buttonicon:'ui-icon-trash', onClickButton:jqGridDelete ,title: 'Delete selected row', position: 'first', cursor: 'pointer'})
					.navButtonAdd('#grid_".$pager_name."_toppager_left',
					{ caption:'', buttonicon:'ui-icon-pencil', onClickButton:jqGridEdit,title: 'Edit selected row', position: 'first', cursor: 'pointer'})
					.navButtonAdd('#grid_".$pager_name."_toppager_left',
					{ caption:'', buttonicon:'ui-icon-plus', onClickButton:jqGridAdd,title: 'Add new record', position: 'first', cursor: 'pointer'});";

		$grid .= "
		function jqGridAdd() {
			location.href='$buildAddUrl?oper=add';
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
		$grid .= "$('#$buildDivName').setGridHeight($buildGridHeight,true);";
		$grid .= "$('.ui-jqgrid-titlebar-close','#gview_$buildDivName').remove();";
		$grid .= "</script>";
		return $grid;
	}
}
