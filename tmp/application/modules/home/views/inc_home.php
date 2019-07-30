
<script type="text/javascript">	
	$(document).ready(function(){
		var tabTemplate = "<li><a href='#{href}'>#{label}</a> <span class='ui-icon ui-icon-close'>Remove Tab</span></li>";		
		var maintab =jQuery('#tabsContent','#centerPanel').tabs({
	        add: function(e, ui) {
	            $(ui.tab).parents('li:first')
	                .append('<span class="ui-tabs-close ui-icon ui-icon-close" title="Close Tab"> </span>')
	                .find('span.ui-tabs-close')
	                .click(function() {
	                    maintab.tabs('remove', $('li', maintab).index($(this).parents('li:first')[0]));
	                });
	            maintab.tabs('select', '#' + ui.panel.id);
	        },
	        activate: function(e, ui) {
		        var tabHref = $(ui.newTab).find('a').attr('href');				
				
		        if(tabHref.length > 0) {
		        	tabHref = tabHref.split('_');
		        	var tabId = tabHref[1];
		        	var url = "<?php echo base_url()?>infomodule";
		        	$.post(url,{moduleId:tabId},function(data){
						$("#topLeft").html( data );
			        });
		        }
			}
	    });

	    $(".file").live("click", function() {
		    <?php
			   $get_URL		= explode('/', $_SERVER['REQUEST_URI']);
			   $id_PT		= $get_URL[sizeOf($get_URL) - 1];
		    ?>
	    	var labelTab 	= $(this).html();
    	 	var idModul		= $(this).attr('id');
    	 	var groupPrivi	= $(this).attr('group');
	    	var idTab	 	= "#tab_"+$(this).attr('id');
	    	var pathModul	= '<?php echo base_url()?>processor/'+$(this).attr('rel');
	    	var idPT		= <?php echo $id_PT;?>;
			if($(idTab).html() != null ) {
				maintab.tabs('select', idTab);
			} else {
				maintab.tabs('add', idTab, labelTab);	
				$(idTab, "#tabsContent").html('<span class="loaderMini">&nbsp;</span>');
				<?php 
				$ajax_call =$this->load->library('MyAjaxCall');
				echo $ajax_call->ajax_request( 
					array(
						'url'=>'pathModul',
						'type'=>'\'GET\'',
						'data'=>'{company_id: idPT, modul_id:idModul, group_id: groupPrivi}',
						'success'=>'function(data){ $(idTab,"#tabsContent").html(data); }',
					)
				);
				?>
			}
	   	});
	});
</script>
