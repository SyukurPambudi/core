<script type="text/javascript">
	var myLayout;		
	$(document).ready(function(){
		$('.btn').button();			
		myLayout =  $('body').layout({
			 north: {
					spacing_open:1
				,	minSize: 30
				,	togglerLength_open:0
				,	togglerLength_closed:-1
				,	resizable:false
				,	slidable:false 
				,	paneClass:"northPanel"
			},west:{
					spacing_open:5
				,	spacing_closed:12
				,	fxName:"slide"
			    ,   fxSpeed:"fast"
			}
		});
		$("#btnLogout").button({
			icons: { primary: "ui-icon-extlink"} 
		});
		$("#btn_other_opt").button({
			text: false,
			icons: {
				primary: "ui-icon-wrench"
			}
		}).hover(
				function(){
					$(this).removeClass("ui-corner-all");
					$(this).addClass("ui-corner-top");
				},
				function(){
					$(this).addClass("ui-corner-all");
				}
			);

		$(".list_other_opt").hover(
			function(){
				$("#btn_other_opt").addClass("ui-state-hover");
				$("#btn_other_opt").removeClass("ui-corner-all");
				$("#btn_other_opt").addClass("ui-corner-top");
				$(this).addClass("ui-state-hover");
				$(this).css("border","none");
			}, 
			function(){
				$("#btn_other_opt").removeClass("ui-state-hover");
				$("#btn_other_opt").addClass("ui-corner-all");
				$(this).removeClass("ui-state-hover");
			}
		);
	});
</script>
	<?php
		echo isset($include) ? $include : "";
	?>
	
<div class="ui-layout-north" id="northPanel" > 
	<?php			
		$menuHeader = isset($menuHeader) ? $menuHeader : ""; echo $menuHeader;	
	?> 
</div>

<div class="ui-layout-west" id="westPanel">
	<?php
		$menu = isset($menu) ? $menu : ""; echo $menu;
	?>
</div>

<div class="ui-layout-center" id="centerPanel">
	<?php
		$content = isset($content) ? $content : ""; echo $content;
	?>
</div>