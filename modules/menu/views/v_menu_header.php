<?php
if($_SERVER["HTTP_HOST"] == 'www.npl-net.com' ||$_SERVER["HTTP_HOST"] == 'npl-net.com'||$_SERVER["HTTP_HOST"] == '10.1.49.16' ){
	$imodul=3803;
	$group_id=172;
}else if ($_SERVER["HTTP_HOST"] == 'dev.npl-net.com'){
	$imodul=3895;
	$group_id=157;
}else {
	$imodul=3895;
	$group_id=157;
}
?>
<div id="topLeft" class="pullLeft"></div>
<div id="topRight" class="pullRight" onmouseover="myLayout.allowOverflow('north')" onmouseout="myLayout.resetOverflow(this)">
	<ul id="top_navigate" >
		<li>
			<span class="file_message_erp ui-button-text ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" id="erp_<?php echo $imodul ?>" module="<?php echo $imodul ?>" rel="schedulercheck/inbox_erp_core?company_id=3&modul_id=<?php echo $imodul ?>&group_id=<?php echo $group_id ?>" style="cursor:pointer;" group="<?php echo $group_id ?>"><span class="ui-button-icon-primary ui-icon ui-icon-mail-closed"></span><span class="ui-button-text">	Message (<span class="new_count_message_<?php echo $gNIP ?>" id="new_count_message_header_<?php echo $gNIP ?>" <?php if($count_inbox_erp>=1){ ?> style="color:red;" <?php } ?>><?php echo $count_inbox_erp ?></span>)</span></span>
		</li>
		<li>
			<button id="open-select-company" title="<?php echo $this->lang->line('menu_chg_company');?>"><?php echo $open_company;?>&nbsp;</button> 
			<?php		
				if ($arrMenuComp[0]['menuComp'] != 'empty') {
			?>
			<div id="dialog-select-company" class="ui-helper-hidden">
				<form id="changeCompForm" action="home" method="post" target="_blank">
					<select name="select-company" id="select-company" class="text ui-widget-content ui-corner-all selectMenuComp" style="cursor:pointer; ">
						<option value="0">&nbsp;-</option>
						<?php 
							foreach($arrMenuComp as $key=>$arrdata) {
								$menuComp 	= $arrdata['menuComp'];
								$ptId 		= $menuComp['idPT'];
								$exp 		= explode(".", $menuComp['vNamaPT']);
								$nameComp	= $exp[0].'. '.ucwords(strtolower($exp[1]));		
						?>
							<option value="<?php echo $ptId; ?>"><?php echo $nameComp; ?></option>
						<?php
							}
						?>
					</select>
				</form>
			</div>
			<?php 	
				}
			?>
		</li>
		<li>
			<a href="<?php echo base_url()?>login/signout" name="btnLogout" id="btnLogout" title="<?php echo $this->lang->line('menu_logout');?>">
				<?php echo $this->lang->line('menu_logout');?>
			</a>
		</li>
		<li>
			<a href="#" id="btn_other_opt"><?php echo $this->lang->line('menu_setting');?></a>
			<ul class="ui-widget ui-widget-content ui-corner-bottom">
				<li class="list_other_opt">
					<a href="#!" class="file" id="0" group="0" rel="menu/change/profile0" title="<?php echo $this->lang->line('menu_my_profile');?>">
						<?php echo $this->lang->line('menu_my_profile');?>
					</a>
				</li>
				<li class="list_other_opt">
					<a href="#!" class="file" id="0" group="0" rel="menu/change/password" title="<?php echo $this->lang->line('menu_chg_password');?>">
						<?php echo $this->lang->line('menu_chg_password');?>
					</a>
				</li>
				<li class="list_other_opt">
					<a href="#!" id="chg_lang">
						<?php echo $this->lang->line('menu_chg_lang');?>
					</a>
					<div id="dialog-select-language" class="ui-helper-hidden">
						<select name="select-language" id="select-language" class="text ui-widget-content ui-corner-all selectMenuComp" style="cursor:pointer; width:125px; ">
							<option value="0">&nbsp;-</option>
							<option value="english">English</option>
							<option value="indonesia">Indonesia</option>
						</select>
					</div>
				</li>
			</ul>
		</li>
	</ul>
</div>
<script type="text/javascript">
	$('.file_message_erp').click(function(){
		 var id = $(this).attr('module');
		 var href = base_url+'processor/'+$(this).attr('rel');
		 var title = 'tes';
	   	addTab_message_erp(id, href, title);
	});
	$(".ui-tabs-close").live( "click", function() {
		var tabs = $( "#tabsContent" ).tabs();
      	var panelId = $( this ).closest( "li" ).remove().attr( "aria-controls" );
      	var prev = $( "#" + panelId ).prev().attr('id');
      	$( "#" + panelId ).remove();
      	tabs.tabs( "refresh" );
     	tabs.tabs("option", "active", prev);
    }); 
	function addTab_message_erp(tabCounter, href, title) {
		var tabs = $( "#tabsContent" ).tabs();
		var countmessage =$("#new_count_message_header_<?php echo $gNIP ?>").html();
		/*var label = "<span>Message (<span class='new_count_message_<?php echo $gNIP ?>'>" +countmessage+ "</span>)<span>",*/
		var socket11 = io.connect( 'http://10.1.49.8:19391');
		$.ajax({
			url: base_url+'processor/schedulercheck/inbox/erp?action=getJSONCountbyNIP',
			success:function(data){
				var o = $.parseJSON(data);
				socket11.emit("update_count_erp_message", { 
				    new_count_erp: o.count,
				    nip_erp:"<?php echo $gNIP; ?>"
				});
			}
		});
		/* Refresh*/
		var label = "<span>Inbox ERP<span>",
		tabTemplate = "<li><a href='#{href}'>#{label}</a> <span class='ui-tabs-close ui-icon ui-icon-close' title='Close Tab' role='presentation'> </span></li>",
        id = "tab_" + tabCounter,
        li = $( tabTemplate.replace( /#\{href\}/g, "#" + id ).replace( /#\{label\}/g, label ) ),
        tabContentHtml = "Tab " + tabCounter + " content.";
        var idxtab = getIndexForId('tabsContent', id);
 		if(idxtab != -1){
			var tab = $( "#tabsContent" ).find(".ui-tabs-nav li:eq(" + idxtab + ")").remove();
			var datatab=$( "div#tab_<?php echo $imodul ?>").remove();
			tabs.tabs("refresh");
			tabs.find( ".ui-tabs-nav" ).append( li );
	      	tabs.append( "<div id='" + id + "'></div>" );
	      	var indexTab = tabs.index($('#'+id));
	      	$.ajax({
		        url: href,
		        success: function(response){
		            tabContentHtml = response;
		            $("div#"+id).html(response);
					tabs.tabs( "refresh" );
	      			tabs.tabs("option", "active", indexTab);

		        },
		        statusCode: {
				    404: function() {
				      	tabContentHtml = 'ERROR 404<br />Page Not Found!';
				      	$("div#"+id).html(tabContentHtml);
						tabs.tabs( "refresh" );
	      				tabs.tabs("option", "active", indexTab);
					}
				},
		        dataType:'html'  		
		    });
		}
		else {
	      	tabs.find( ".ui-tabs-nav" ).append( li );
	      	tabs.append( "<div id='" + id + "'></div>" );
	      	var indexTab = tabs.index($('#'+id));
	      	$.ajax({
		        url: href,
		        success: function(response){
		            tabContentHtml = response;
		            $("div#"+id).html(response);
					tabs.tabs( "refresh" );
	      			tabs.tabs("option", "active", indexTab);

		        },
		        statusCode: {
				    404: function() {
				      	tabContentHtml = 'ERROR 404<br />Page Not Found!';
				      	$("div#"+id).html(tabContentHtml);
						tabs.tabs( "refresh" );
	      				tabs.tabs("option", "active", indexTab);
					}
				},
		        dataType:'html'  		
		    });
      	}
		/*var idxtab = getIndexForId('tabsContent', id);	
		var tabs = $( "#tabsContent" ).tabs();	
		var itab ='tab_'+id;
		tabTemplate = "<li><a href='#{href}'>#{label}</a> <span class='ui-icon ui-icon-close'>Remove Tab</span></li>";
		if(idxtab != -1){
			tabs.tabs("option", "active", idxtab);
		}
		else {
		    
			var label = title,
			li = $( tabTemplate.replace( /#\{href\}/g, "#" + itab ).replace( /#\{label\}/g, label ) );		
			tabs.find( ".ui-tabs-nav" ).append( li );
			
			$.ajax({
		        url: href,
		        success: function(response){
		            tabContentHtml = response;
		            
		            $("div#"+id).html(response);
					tabs.tabs( "refresh" );
		        },
		        statusCode: {
				    404: function() {
				      	tabContentHtml = 'ERROR 404<br />Page Not Found!';
				      	$("div#"+id).html(tabContentHtml);
						tabs.tabs( "refresh" );
					}
				},
		        dataType:'html'  		
		    });	    
		    $("div#"+id).html('dsadsad');
		    var indexTab = tabs.index($('#'+id));
		    alert(indexTab);
			tabs.tabs("option", "active", indexTab);
			tabs.tabs( "refresh" );

			    
		}*/
	}
</script>
