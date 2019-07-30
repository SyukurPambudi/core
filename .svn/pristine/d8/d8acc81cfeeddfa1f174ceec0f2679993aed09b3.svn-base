<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php echo 'PLC' ?></title>    
        <?php echo $_meta_css; ?>
       
		<script src="<?php echo $_theme ?>assets/js/jquery-1.8.1.min.js" type="text/javascript"></script>
		<script src="<?php echo $_theme ?>assets/js/jquery-ui-1.10.0.custom.min.js" type="text/javascript"></script>
		<!-- JQGrid -->
		<script src="<?php echo $_theme ?>assets/js/i18n/grid.locale-en.js" type="text/javascript"></script>
		<script src="<?php echo $_theme ?>assets/js/jquery.jqGrid.min.js" type="text/javascript"></script>
		<!-- Livequery -->
		<script type="text/javascript" src="<?php echo $_theme ?>assets/js/jquery.livequery.min.js"></script>
		<script type="text/javascript">
			var base_url = '<?php echo base_url() ?>';
			var base_theme = '<?php echo $_theme ?>';
			var loading_image = '<?php echo $_theme ?>assets/img/ajax_loader.gif';
			document.documentElement.className += 'js';
		</script>

		
		


		<style type="text/css">
			.jspVerticalBar {
				left: 0;
			}
			.scroll-pane {
				height: 425px;
				overflow: auto;
			}
			.js, .js body {overflow:hidden}
			.js body > * {visibility:hidden}
			.js #loading_layer {visibility:visible;display:block !important;position:absolute;top:0;left:0;width:100%;height:100%;background:#fff;z-index:10000}
			.js #loading_layer img {position:fixed;top:50%;left:50%;margin:-5px 0 0 -32px}
			.js .tab-pane {display:block !important}
			.js .hide {display: inherit}
			
		</style>
    </head>
    <body>
		<div id="loading_layer" style="display:none"><img src="<?php echo $_theme; ?>assets/images/ajax-loader2.gif" alt="" /></div>		
			<?php echo $_header; ?>			
			<?php echo $_menu; ?>			
		<div id="page_body">
			<div class="page_content">
				<div >
					<div class="fixed breadcrumb_box">						
					    <ul class="breadcrumb">
						    <li><a href="#">Home</a> <span class="divider">/</span></li>
						    <li><a href="#">Library</a> <span class="divider">/</span></li>
						    <li class="active">All - Task List</li>
						    <div id="loading_hide">
						    	<!--<img src="<?php echo $_theme; ?>assets/images/00_AJAX_loading_circle.gif" />-->
						    </div>
					    </ul>
					</div>
					<div class="set fixed" >
						<div class="title">
							<div id="fix-content" class="tusuk_sate" title="hidden sidebar"  ></div>
						</div>
					</div>
					<div class="clear"></div>
				</div>	
				<div>
					<div>
						<div class="content horizontal notactive" id="sidebar_menu">
							<?php echo $_sidebar; ?>
						</div>
						<div  class="content_form2" >
							<div id="wrap-content">
								<?php
									//if($_content) {
										echo $_content;
									/*}
									else {*/									
								?>
								<div id="content_tabs">
									<ul>
										<li><a href="#home">Home</a> <span class="ui-icon ui-icon-close">Remove Tab</span></li>
									</ul>
									<div id="home">
										
									</div>
								</div>
								<?php //} ?>
							</div>
							<?php //echo $_content; ?>
						</div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>		
		<?php echo $_footer; ?>
		<div id="buat_dialog"></div>
		<div id='buat_content'></div>
		<div id='buat_content_popup'></div>
		<?php echo $_meta_js; ?>
		<script>
			$(document).ready(function() {
				setTimeout('$("html").removeClass("js")',500);		
			});
		</script>
	</body>
</html>