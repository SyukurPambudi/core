<?php 
$url = $editurl = isset($url)?$url:'';
$grid_name = isset($grid_name)?$grid_name:'';
$pager_name = isset($pager_name)?$pager_name:'';
$colNames = isset($columns['colNames'])?$columns['colNames']:'';
$colModels = isset($columns['colModels'])?$columns['colModels']:'';
$grid_sel = (!empty($grid_name))?'#'.$grid_name:'';
$pager_sel = (!empty($pager_name))?'#'.$pager_name:'';
$caption = isset($caption)?$caption:'';

$form_name = isset($form_name)?$form_name:'';
$form_sel = (!empty($form_name))?'#'.$form_name.' form':'';
$form_content = isset($form_content)?$form_content:'';

$submit_url = isset($submit_url)?$submit_url:'';
?>
<fieldset>
	<div id="<?php echo $form_name;?>"><?php echo $form_content;?></div>
	<table id="<?php echo $grid_name;?>"></table>
	<div id="<?php echo $pager_name;?>"></div>
	<div><button onclick="getRowData()">Submit</button></div>
</fieldset>
<script type="text/javascript">
$(document).ready(function() {
	grid = $("<?php echo $grid_sel;?>");
	grid.jqGrid({ 
		url:'<?php echo $url;?>', 
		datatype: 'json',  
		colNames:<?php echo $colNames;?>,
		colModel:<?php echo $colModels;?>, 
		rowNum:10, 
		rowTotal: 50, 
		rowList:[10,20,30], 
		pager: '<?php echo $pager_sel;?>', 
		gridview:true,
		rownumbers:true,
		loadonce: true, 
		autoencode:true,
        ignoreCase:true,
		viewrecords: true, 
		//sortorder: "desc", 
		editurl: '<?php echo $editurl;?>', // this is dummy existing url 
		caption:'<?php echo $caption;?>' 
	}); 
	grid.jqGrid('navGrid','<?php echo $pager_sel;?>',
			{ add:true,edit:true,del:true,
		      // editfunc:function(id){},
		      // addfunc:function(id){},
		      // delfunc:function(id){},
	  		},
			{ //edit dialog
	           beforeShowForm: function(form) {
		           dialogCenter(form,'editmod');
	           },
	           onInitializeForm: function(form) {
	        	   //$("#vAppName",form).datepicker();  
	           }
		    },
		    { //add dialog
				beforeShowForm: function(form) {
		           dialogCenter(form,'editmod');
	            },
	            onInitializeForm: function(form) {
	        	   //$(\'#vAppName\',form).datepicker();  
	            }
			},
			{ //delete dialog
				beforeShowForm: function(form) {
		           dialogCenter(form,'delmod');
	            },
	            onInitializeForm: function(form) {
	            }
			},
			{ //search dialog
				beforeShowSearch: function(form) {
					dialogCenter(form,'searchmodfbox_');
				},
				onInitializeSearch: function(form) {
					
				}
			},
			{ //view dialog
			}
	);
});
function dialogCenter(form,dialog) {
    var dlgDiv = $("#" + dialog + grid[0].id);

    var parentDiv = dlgDiv.parent();
    var dlgWidth = dlgDiv.width();
    var parentWidth = parentDiv.width();
    var dlgHeight = dlgDiv.height();
    var parentHeight = parentDiv.height();
   
    $(dlgDiv[0]).css({top:'50%',left:'50%',margin:'-'+(dlgHeight / 2)+'px 0 0 -'+(dlgWidth / 2)+'px'});
}
function getRowData() {
	var gridData = $("<?php echo $grid_sel;?>").getRowData();
	//alert(JSON.stringify(gridData));
	//return false;
	////var postData = JSON.stringify(gridData);
	////postData = setProperties( postData );
	//postData = JSON.stringify(postData[0].value);
	////postData = postData[0].value;
	////postData = gridData;
	//var formData = JSON.stringify($("#test_form").serializeObject());
	var formData = $("<?php echo $form_sel;?>").serializeObject();
	//alert(formData);
	//alert(postData);
	//return false;
	//alert( JSON.stringify( formData ) );
	//return false;
	//alert(formData);
	//return false;
	//formData = JSON.stringify(formData);
	//alert(formData);
	//return false;
	//var parseData = JSON.parse(gridData);
	//alert(postData);
	//return false;
	//echo $ajax_getRowData;
	//alert(postData+' '+selRow);
	//alert(postData);
	$.ajax({
	    type: "POST",
	    url: "<?php echo $submit_url;?>",
	    data :{ gridData: gridData, formData: formData },
	    //data : { },
	    //dataType:"json",
	    //contentType: "application/json",
	    //success: function(response, textStatus, xhr) {
	    success: function(data) {    
	        alert( data );
	    }
	});
}
</script>