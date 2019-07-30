<link rel="stylesheet" href="<?php echo base_url()?>assets/js/treeview/jquery.treeview.css" />
<script src="<?php echo base_url()?>assets/js/treeview/jquery.treeview.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){			
	var rslt = '';
	var id 	 = 0;
	var pt   = 0;
	var user = '';
	var url  = '';
	var target = '';
		
	$("#wrap-app").accordion({
		collapsible: true,
		active:-99,
		heightStyle: "content",
		activate: function( event, ui ) {
			id 	  = $(ui.newHeader).attr('id');
		  	pt 	  = $('#pt_'+id).val();
		  	user  = $('#nip_'+id).val();
		  	group = $('#group_'+id).val();
		  	url   = '<?php echo base_url()?>menu/getMenuByApp';

		  	target = $(ui.newHeader).parent().find('#target_'+id);	
		  	tree = $(ui.newHeader).parent().find('#browser_'+id);		
		  	
			if (id != undefined) {	
				if( tree.length < 1 ) { 
					$(target).html('<span class="loaderMini">&nbsp;</span>');	
					rslt = getTree(pt, user, url, id, 0, group);
					setTimeout(function() {
						$(target).html(rslt);
					}, 100);
				}
			}
	  	},
	  	beforeActivate: function( event, ui ) {
	  		//var url = $(ui.newHeader).attr('id');
		  	//alert(url);
	  	},
	  	create: function( event, ui ) {
		  	id 	  = $(ui.header).attr('id');
		  	pt 	  = $('#pt_'+id).val();
		  	user  = $('#nip_'+id).val();
		  	group = $('#group_'+id).val();
		  	url   = '<?php echo base_url()?>menu/getMenuByApp';
		  	target = $(ui.header).parent().find('#target_'+id);
			tree = $(ui.header).parent().find('#browser_'+id);
			
		  	if( tree.length < 1 ) {
		  		$(target).html('<span class="loaderMini">&nbsp;</span>');
		  		rslt = getTree(pt, user, url, id, 0, group);
		  		setTimeout(function() {
			  		$(target).html(rslt);
		  		}, 100);
		  	}
	  	}
	});


	$("#open-select-company").button({ icons: { primary: "ui-icon-home"} }).click(function(){ $("#dialog-select-company").dialog("open"); });
	$( "#dialog-select-company" ).dialog({ autoOpen: false,	height: 100, modal: true, resizable: false });
	$("#select-company").change(function () {
		var idPT = $(this).val();
		if (idPT > 0) {
			window.open('<?php echo base_url()?>home/'+idPT, '_blank');
			$( "#dialog-select-company" ).dialog("close");
		}
	});

	$("#chg_lang").click(function(){ $("#dialog-select-language").dialog("open"); });
	$("#dialog-select-language").dialog({ autoOpen: false, height: 100, width: 100, modal: true, resizable: false });
	$("#select-language").change(function () { 
		var target = "<?php echo base_url()?>menu";
		var val	   = $(this).val();
		<?php 
			$ajax_call =$this->load->library('MyAjaxCall');
			echo $ajax_call->ajax_request( 
				array(
					'url' => 'target',
					'type'=>'\'POST\'',
					'data'=>'{lang: val}',
					'success'=>'function(data){ location.reload(); }',
				)
			);
		?>
	});
});
	
	function getTree(pt, user, url, iAppId, parentId, group) {		
		return $.ajax({
			type: 'POST', 
			url: url,
			data: 'iAppId='+iAppId+'&ptId='+pt+'&nip='+user+'&group='+group,
			async:false
		}).responseText
	}	 
</script>