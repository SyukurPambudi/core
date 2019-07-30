<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html class="home" lang="en"><!--<![endif]--> 
<head>
	<title>demo</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	
	<meta name="description" content="{mtDesc}">
	<meta name="author" content="{mtAuth}">
	<meta name="viewport" content="initial-scale=1.0, width=device-width, maximum-scale=1, user-scalable=no">
	<meta charset="utf-8">
	
	<link rel="icon" href="<?php echo base_url()?>assets/image/button-blue.png">
	<link rel="shortcut icon" href="assets/image/button-blue.png">
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()?>assets/themes/redmond/jquery-ui-1.9.2.custom.min.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()?>assets/themes/redmond/ui.layout.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()?>assets/themes/ui.jqgrid.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()?>assets/themes/ui.multiselect.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()?>assets/style.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()?>assets/datatable_ui.css" />
	
	<script src="<?php echo base_url()?>assets/js/jquery.1.7.2.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>assets/js/jquery.extra.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>assets/js/jquery-ui-1.9.2.custom.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>assets/js/jquery.layout-1.3.0.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>assets/js/jquery.cookie.js" type="text/javascript" ></script>
	<script src="<?php echo base_url()?>assets/js/jquery.dataTables.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>assets/js/datatables_api/fnSetFilteringDelay.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>assets/js/jquery-ui-timepicker-addon.js" type="text/javascript"></script>
	
	<script src="<?php echo base_url()?>assets/js/function.js" type="text/javascript"></script>
	<script type="text/javascript">
		
		function confirm_delete_box(txt_conf, url, data, no_grid){
			$( "#dialog-confirm-text" ).text(txt_conf);
			$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:140,
				modal: true,
				buttons: {
					Yes: function() {
						$.ajax({
							'url'  : url,
							'data' : data,
							'success' : function(data) {
								if (data > 0) {
									if (no_grid == '') {									
										oTable.fnDraw();
									} else {														
										$('#grid_'+no_grid).trigger('reloadGrid');
									}
								} else {
									alert_box('Data gagal dihapus');
									return false;
								}
							}
						});
						$( this ).dialog( "close" );
					},
					No: function() {
						$( this ).dialog( "close" );
					}
				}
			});
		}
	
		function information_box(txt_info){
			$( "#dialog-info-text" ).text(txt_info);
			$( "#dialog-info" ).dialog({
				resizable: false,
				height:140,
				modal: true,
				buttons: {
					OK: function() {
						$( this ).dialog( "close" );
					}
				}
			});
		}
		
		function alert_box(txt_alert){
			$( "#dialog-alert-text" ).text(txt_alert);
			$( "#dialog-alert" ).dialog({
				resizable: false,
				height:140,
				modal: true,
				buttons: {
					OK: function() {
						$( this ).dialog( "close" );
					}
				}
			});
		}
	</script>	
</head>
<body>
<div id="dialog-confirm" title="Confirmation" class="ui-helper-hidden">
	<p>
		<span class="ui-icon ui-icon-alert icon-box-alert" ></span>
		<span id="dialog-confirm-text"></span>
	</p>
</div>

<div id="dialog-alert" title="Alert" class="ui-helper-hidden">
	<p>
		<span class="ui-icon ui-icon-alert icon-box-alert"></span>
		<span id="dialog-alert-text"></span>
	</p>
</div>

<div id="dialog-info" title="Information" class="ui-helper-hidden">
	<p>
		<span class="ui-icon ui-icon-info icon-box-alert"></span>
		<span id="dialog-info-text"></span>
	</p>
</div>