<script language="javascript">
$(document).ready(function() {
	$("#add_crud").click(function(){ 
		//var gr = jQuery("#editgrid").jqGrid('getGridParam','selrow');
		$.ajax({
		 	 url: "<?php echo base_url(); ?>/privilege/setup_applications/drawForm",
	 		success: function(data) {
		 	    $('#app').html(data);
		 	  }
		})	
	});

	$("#edit_crud").click(function(){ 
		//var gr = jQuery("#grid_1").jqGrid('getGridParam','selrow');
		//alert(gr);
		//if( gr != null ) jQuery("#grid_1").jqGrid('editGridRow',gr,{height:280,reloadAfterSubmit:false}); else alert("Please Select Row");
	});

	$("#back").click(function() {
		$.ajax({
		 	 url: "<?php echo base_url(); ?>/privilege/setup_applications",
	 		success: function(data) {
		 	    $('#app').html(data);
		 	  }
		})	
	});
});
</script>