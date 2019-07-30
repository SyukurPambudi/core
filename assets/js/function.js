$(document).ready(function() {
	$('#fix-content').live ('click',function() {
		$(this).toggleClass('tusuk_kambing');
		$('.content_form2').toggleClass('persen_margin');
		$('#sidebar_menu').toggleClass('notactive');
		if($('#sidebar_menu').hasClass('notactive')) {
			$('#sidebar_menu').fadeIn();
			
			/*var tab_width = $('#content_tabs').width();
			twidth = tab_width - 12; 
			$('#gbox_grid_privilege_module').css('width', twidth);
			$('#gview_grid_privilege_module').css('width', twidth);
			$('#grid_privilege_module_toppager').css('width', twidth);
			$('#ui-jqgrid-hdiv').css('width', twidth);
			$('#ui-jqgrid-bdiv').css('width', twidth);
			$('#pager_privilege_module').css('width', twidth);*/
			//$('.fitscreen').css('width','100%');
			//$('.dataTables_scrollHeadInner').css('width','100%');
		}
		else {
			$('#sidebar_menu').fadeOut();
			
			/*var tab_width = $('#content_tabs').width();
			twidth = tab_width - 12; 
			$('#gbox_grid_privilege_module').css('width', twidth);
			$('#gview_grid_privilege_module').css('width', twidth);
			$('#grid_privilege_module_toppager').css('width', twidth);
			$('#ui-jqgrid-hdiv').css('width', twidth);
			$('#ui-jqgrid-bdiv').css('width', twidth);
			$('#pager_privilege_module').css('width', twidth);*/
			//$('.fitscreen').css('width','100%');
			//$('.dataTables_scrollHeadInner').css('width','100%');
		}
	})
	$('.scroll-pane').jScrollPane();
	$('#message_plc').live ('click',function(){
		$('#notifikasi_plc').slideToggle();
	})
	$('#close_notif').live ('click',function(){
		$('#notifikasi_plc').slideUp();
	})
	$('.tambah').live ('click',function(){
		$('.content-add').fadeToggle();
	})
	$('.top-icon-colaps').live ('click',function(){
		$('.top-split').fadeToggle();
		$('.persen_margin-header-awal').toggleClass('persen_margin-header-colaps');
	})
	$('.top-head-content').live ('click',function(){
		if($(this).hasClass('search_keluar')) {
			$(this).removeClass('search_keluar');
			$('.form_head').siblings().removeClass('ui-icon-carat-1-e');
			$('.form_head').siblings().addClass('ui-icon-carat-1-s');
		}
		else {			
			$(this).addClass('search_keluar');
			$('.form_head').siblings().removeClass('ui-icon-carat-1-s');
			$('.form_head').siblings().addClass('ui-icon-carat-1-e');
		}		
		$('.content-table').slideToggle();
	})
	$( "#tabs" ).tabs();
	$( ".datepicker" ).livequery(function(){
		$(this).datepicker({
			showOn: "button",
			buttonImage: "http://10.1.49.8/erp/assets/images/calendar.gif",
			buttonImageOnly: true,
			dateFormat: 'dd-mm-yy',
			changeMonth: true,
			changeYear: true
		});
	})
	$('.icon-search').livequery(function(){
		$(this).button({
			icons: {
				primary : "ui-icon-search"
			}
		});
	})
	$('.icon-save').livequery(function(){
		$(this).button({
			icons: {
				primary : "ui-icon-disk"
			}
		});
	});
	$('.icon-cancel').livequery(function(){
		$(this).button({
			icons: {
				primary : "ui-icon-arrowreturnthick-1-w"
			}
		});
	});
	$('.icon-clear').livequery(function(){
		$(this).button({
			icons: {
				primary : "ui-icon-trash"
			}
		});
	});
	$('.icon-print').livequery(function(){
		$(this).button({
			icons: {
				primary : "ui-icon-print"
			}
		});
	});
	$('.icon-add').livequery(function(){
		$(this).button({
			icons: {
				primary : "ui-icon-document"
			}
		});
	});
	$('.icon-tambah').livequery(function(){
		$(this).button({
			icons: {
				primary : "ui-icon-plus"
			}
		});
	});
	
	$('.icon-edit').livequery(function(){
		$(this).button({
			icons: {
				primary : "ui-icon-pencil",
				text: false
			}
		});
	});
	
	$('.ui-icon-tag').livequery(function(){
		$(this).button({
			icons: {
				primary : "ui-icon-tag"
			}
		});
	});
	$('.ui-icon-circle-zoomin').livequery(function(){
		$(this).button({
			icons: {
				primary : "ui-icon-circle-zoomin"
			}
		});
	});
	
	/*var oTable = $('#example').dataTable( {
		"sScrollX": "260",
		"sScrollY": "260",
		"sScrollXInner": "200%",
		"bScrollCollapse": true,
		"sScrollWrapper": 'fix_datatable',
		"bJQueryUI": true
	} );
	new FixedColumns( oTable, {
		"iLeftColumns": 3,
		"iLeftWidth": 350
	} );
	tableToGrid("#mytable");*/
})
