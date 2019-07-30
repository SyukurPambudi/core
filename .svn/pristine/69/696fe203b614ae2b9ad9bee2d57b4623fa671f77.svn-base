var required_message = 'Field Required!';
var comfirm_message = 'Anda Yakin?';
function TotalCalculation(txtJumOld, txtForOld, txtInc, txtJumNew, txtForNew) {
    if (txtInc.value > 0) { 
        txtJumNew.value = parseInt(txtJumOld.value) + (parseInt(txtJumOld.value.replace(/,/g,'')) * parseInt(txtInc.value.replace(/,/g,'')) / 100);
        txtForNew.value = parseInt(txtForOld.value) + (parseInt(txtForOld.value.replace(/,/g,'')) * parseInt(txtInc.value.replace(/,/g,'')) / 100);
    } else {
        txtJumNew.value = 0;
        txtForNew.value = 0;
    }
}

function browse_upb(pdId, title) {
	load_popup(base_url+'browse_upb/index?pdid='+pdId,'','',title);
}

function browse(url, title) {
	load_popup(url,'','',title);
}

function browse2(url, title, div) {
	load_popup2(url,'','',title, div);
}

function browse_with_no_close(url, title) { 
	load_popup_with_no_close(url,'','',title);
}

function browse_tab(url, title, div_id) {
	load_popup_tab(url,'','',title, div_id);
}

function browse_multi(url, title, dis) { 
	var i = $('.pur_item_btn').index(dis);
	load_popup_multi(url,'','',title,i);
}
function browse_multi1(url, title, dis, param) {
	var i = $('.pur_item_btn').index(dis);	
	load_popup_multi(url+'&'+param,'','',title,i);
}


function browse_multiple(url, title, dis, classes) {
	var i = $('.'+classes).index(dis);
	load_popup_multi(url,'','',title,i);
}

function load_popup_multi(page,div,act,title,ix){
	if(div === undefined || div == '') {
		div = '#alert_dialog_form';
	}
	if(title === undefined || title == '') {
		title = '';
	}
	if(act === undefined || act == '') {
		act = function(){$('#alert_dialog_form').dialog('close')};
	}
    //var image_load = "<div class='ajax_loading'><img src='"+loader+"' /></div>";
    $.ajax({
        url: page,
        type: 'get',
        data: 'index='+ix,
        beforeSend: function(){
            //$(div).html(image_load);
            //$('#loading_lock').css({'display':'block'});
        },
        success: function(response) {
        	if($(div).length == 0) {
        		$('#buat_content').html('<div title="'+title+'" id="alert_dialog_form" style="width: 880px;">' + response + '</div>');
        		$('#alert_dialog_form').dialog({
		        	modal: true,
		        	minWidth: 900,
		        	//zIndex: 999999,
		        	minHeight: 250,
		        	buttons: {
		        		Close: function(){
		        			 $(this).dialog('close');
		        			 //act();
		        		}
		        	},
		        	/*open: function() {
		        		$('#search').focus();
				    	$(this).parents('.ui-dialog-buttonpane button:eq(0)').focus(); 
				    },
				    close: function() {
				    	$('#alert_dialog_form').html('');
				    	$('#alert_dialog_form').remove(); 
				    },*/				    				       	
		        });
        	}
        	else {
        		$(div).html(response);
        		$(div).dialog({
		        	modal: true,
		        	minWidth: 900,
		        	//zIndex: 999999,
		        	minHeight: 250,
		        	buttons: {
		        		Close: function(){
		        			 $(this).dialog('close');
		        			 //act();		        			         			 
		        		}
		        	},
		        	/*open: function() {
		        		$('#search').focus();
				    	$(this).parents('.ui-dialog-buttonpane button:eq(0)').focus(); 
				    },
				    close: function() {
				    	$('#alert_dialog_form').html('');
				    	$('#alert_dialog_form').remove() 
				    },*/				    
		        });		       
        	}      
        	 $('#alert_dialog_form').bind('dialogclose', function(event) {
				act();
		    });      
        },
        statusCode: {
		    404: function() {
		      $(div).html('ERROR 404<br />Page Not Found! :p<br /><br /><img src='+image_404+' >');
			}
		},
        dataType:'html'  		
    });
    return false;
}

function select_upb(){
    //e.preventDefault();
    var s = $('#grid_browse_upb').jqGrid('getGridParam','selarrrow');
    console.log(s);
    if(s=='')
	{
		custom_alert('Please choose row(s) to be select(s).');	
	}
	else
	{
		custom_confirm('Select ?',
	        function(){
				return $.ajax({
				type: 'POST',
				url: href+'/delete',
				data: 'id='+s+'&oper=dellall',
				async: false,
				success: function(data) {
							if(data.error) {
								custom_alert('Deleted Failed!');
							}else {
								custom_alert('Delete Data Success!!');
								$('#grid_browse_upb').trigger('reloadGrid');
							}
						}
						
				}).responseText
	        }
	    )
	}
}
function load_pop() {
	custom_alert('test')
}

function submitform(formid, atrue, afalse) {
	if(atrue === undefined) {
		atrue = function () {
			custom_alert('Success');
		}
	}
	if(afalse === undefined) {
		afalse = function () {
			custom_alert('Failure');
		}
	}
	custom_confirm(comfirm_message,function(){
		$.ajax({
			url: $('#'+formid).attr('action'),
			type: $('#'+formid).attr('method'),
			data: $('#'+formid).serialize(),
			success: function(data) {
				var o = $.parseJSON(data);				
				if(o.status == true) {
					atrue();
				}
				else {
					afalse();
				}				
			}
		})
	})
}

function load_popup_mbr(page,div,act,title){
	if(div === undefined || div == '') {
		div = '#alert_dialog_form';
	}
	if(title === undefined || title == '') {
		title = '';
	}
	if(act === undefined || act == '') {
		act = function(){$('#alert_dialog_form').dialog('close')};
	}
    //var image_load = "<div class='ajax_loading'><img src='"+loader+"' /></div>";
    $.ajax({
        url: page,
        beforeSend: function(){
            //$(div).html(image_load);
            //$('#loading_lock').css({'display':'block'});
        },
        success: function(response) {
        	if($(div).length == 0) {
        		$('#buat_content').html('<div title="'+title+'" id="alert_dialog_form" style="width: 880px;">' + response + '</div>');
        		$('#alert_dialog_form').dialog({
		        	modal: true,
		        	minWidth: 900,
		        	//zIndex: 999999,
		        	minHeight: 250,
		        	buttons: {
		        		/*'Select Checked UPB': function() {
		        			select_upb();
		        		},*/
		        		Close: function(){
		        			 $(this).dialog('close');
		        			 //act();
		        		},		        		
		        	},
		        	/*open: function() {
		        		$('#search').focus();
				    	$(this).parents('.ui-dialog-buttonpane button:eq(0)').focus(); 
				    },
				    close: function() {
				    	$('#alert_dialog_form').html('');
				    	$('#alert_dialog_form').remove(); 
				    },*/				    				       	
		        });
        	}
        	else {
        		$(div).html(response);
        		$(div).dialog({
		        	modal: true,
		        	minWidth: 900,
		        	//zIndex: 999999,
		        	minHeight: 250,
		        	buttons: {
		        		/*'Select Checked UPB': function() {
		        			select_upb();
		        		},*/		        		
		        		Close: function(){
		        			 $(this).dialog('close');
		        			 //act();		        			         			 
		        		}
		        	},
		        	/*open: function() {
		        		$('#search').focus();
				    	$(this).parents('.ui-dialog-buttonpane button:eq(0)').focus(); 
				    },
				    close: function() {
				    	$('#alert_dialog_form').html('');
				    	$('#alert_dialog_form').remove() 
				    },*/				    
		        });		       
        	}      
        	 $('#alert_dialog_form').bind('dialogclose', function(event) {
				act();
		    });      
        },
        statusCode: {
		    404: function() {
		      $(div).html('ERROR 404<br />Page Not Found! :p<br /><br /><img src='+image_404+' >');
			}
		},
        dataType:'html'  		
    });
    return false;
}

function load_popup_tab(page,div,act,title, id_div){
	if(div === undefined || div == '') {
		div = '#'+id_div;
	}
	if(title === undefined || title == '') {
		title = '';
	}
	if(act === undefined || act == '') {
		act = function(){$('#'+id_div).dialog('close')};
	}
    //var image_load = "<div class='ajax_loading'><img src='"+loader+"' /></div>";
    $.ajax({
        url: page,
        beforeSend: function(){
            //$(div).html(image_load);
            //$('#loading_lock').css({'display':'block'});
        },
        success: function(response) {   
                //alert($(div).length);
        	if($(div).length == 0) {
                    //alert("1 : "+id_div);
                    $('#'+id_div).html('<div title="'+title+'" id="'+id_div+'" style="width: 880px;">' + response + '</div>');                        
                    //$('#'+id_div).html('<div title="'+title+'" id="'+id_div+'" style="width: 880px;">div</div>');                        
        	} else {
                    //alert("2 : "+id_div);
                    $(div).html(response);
                    //$(div).html(div);
        	} 
        },
        statusCode: {
		    404: function() {
		      $(div).html('ERROR 404<br />Page Not Found! :p<br /><br /><img src='+image_404+' >');
			}
		},
        dataType:'html'  		
    });
    return false;
}

function load_popup_with_no_close(page,div,act,title){
	if(div === undefined || div == '') {
		div = '#alert_dialog_form';
	}
	if(title === undefined || title == '') {
		title = '';
	}
	if(act === undefined || act == '') {
		act = function(){$('#alert_dialog_form').dialog('close')};
	}
    //var image_load = "<div class='ajax_loading'><img src='"+loader+"' /></div>";
    $.ajax({
        url: page,
        beforeSend: function(){
            //$(div).html(image_load);
            //$('#loading_lock').css({'display':'block'});
        },
        success: function(response) {
        	if($(div).length == 0) {
        		$('#buat_content').html('<div title="'+title+'" id="alert_dialog_form" style="width: 880px;">' + response + '</div>');
        		$('#alert_dialog_form').dialog({
		        	modal: true,
		        	minWidth: 900,
		        	//zIndex: 999999,
		        	minHeight: 0,
		        	create: function() {
		                $(this).css("maxHeight", 650);        
		            },				    				       	
		        });
        	}
        	else {
        		$(div).html(response);
        		$(div).dialog({
		        	modal: true,
		        	minWidth: 900,
		        	//zIndex: 999999,
		        	minHeight: 0,
		        	create: function() {
		                $(this).css("maxHeight", 500);        
		            },				    
		        });		       
        	}      
        	 $('#alert_dialog_form').bind('dialogclose', function(event) {
				act();
		    });      
        },
        statusCode: {
		    404: function() {
		      $(div).html('ERROR 404<br />Page Not Found! :p<br /><br /><img src='+image_404+' >');
			}
		},
        dataType:'html'  		
    });
    return false;
}
function load_popup_hold(page,div,act,title){
	alert("aaaaaaaaa");
}
function load_popup(page,div,act,title){
	
	//alert("AAAA");
	if(div === undefined || div == '') {
		div = '#alert_dialog_form';
	}
	if(title === undefined || title == '') {
		title = '';
	}
	if(act === undefined || act == '') {
		act = function(){$('#alert_dialog_form').dialog('close')};
	}
    //var image_load = "<div class='ajax_loading'><img src='"+loader+"' /></div>";
    $.ajax({
        url: page,
        beforeSend: function(){
            //$(div).html(image_load);
            //$('#loading_lock').css({'display':'block'});
        },
        success: function(response) {
        	if($(div).length == 0) {
        		$('#buat_content').html('<div title="'+title+'" id="alert_dialog_form" style="width: 880px;">' + response + '</div>');
        		$('#alert_dialog_form').dialog({
        			resizable:false,
        			title:title,
		        	modal: true,
		        	minWidth: 900,
		        	//zIndex: 999999,
		        	minHeight: 0,
		        	create: function() {
		                $(this).css("maxHeight", 500);        
		            },
		        	//height: 450,
		        	buttons: {
		        		Close: function(){
		        			 $(this).dialog('close');
		        			 //act();
		        		}
		        	},
		        	/*open: function() {
		        		$('#search').focus();
				    	$(this).parents('.ui-dialog-buttonpane button:eq(0)').focus(); 
				    },
				    close: function() {
				    	$('#alert_dialog_form').html('');
				    	$('#alert_dialog_form').remove(); 
				    },*/				    				       	
		        });
        	}
        	else {
        		$(div).html(response);
        		$(div).dialog({
		        	modal: true,
		        	minWidth: 900,
		        	title:title,
		        	//zIndex: 999999,
		        	minHeight: 0,
		        	create: function() {
		                $(this).css("maxHeight", 500);        
		            },
		        	buttons: {
		        		Close: function(){
		        			 $(this).dialog('close');
		        			 //act();		        			         			 
		        		}
		        	},
		        	/*open: function() {
		        		$('#search').focus();
				    	$(this).parents('.ui-dialog-buttonpane button:eq(0)').focus(); 
				    },
				    close: function() {
				    	$('#alert_dialog_form').html('');
				    	$('#alert_dialog_form').remove() 
				    },*/				    
		        });		       
        	}      
        	 $('#alert_dialog_form').bind('dialogclose', function(event) {
				act();
		    });      
        },
        statusCode: {
		    404: function() {
		      $(div).html('ERROR 404<br />Page Not Found! :p<br /><br /><img src='+image_404+' >');
			}
		},
        dataType:'html'  		
    });
    return false;
}

function load(page,div){
    var image_load = "<div class='ajax_loading'><img src='"+loading_image+"' /></div>";
    $.ajax({
        //url: site+'/'+page,
        url: page,
        beforeSend: function(){
            $(div).html(image_load);
        },
        success: function(response){
            $(div).html(response);
        },
        statusCode: {
		    404: function() {
		      //$(div).html('ERROR 404<br />Page Not Found! :p<br /><br /><img src='+image_404+' >');
		      $(div).html('ERROR 404<br />Page Not Found!');
			}
		},
        dataType:'html'  		
    });
    return false;
}

function add_row(table_id) {
	//alert(table_id);
	var row = $('table#'+table_id+' tbody tr:last').clone();
	$("span."+table_id+"_num:first").text('1');
	var n = $("span."+table_id+"_num:last").text();
	var no = parseInt(n);
	var c = no + 1;
	//datepicker on clone active
	row.find('input.tanggal').attr("id", "").removeClass('hasDatepicker').removeData('datepicker').unbind().datepicker({changeMonth:true,
										changeYear:true,
										dateFormat:"yy-mm-dd" });

	$('table#'+table_id+' tbody tr:last').after(row);
	$('table#'+table_id+' tbody tr:last input').val("");
	$('table#'+table_id+' tbody tr:last div').text("");
	$('table#' + table_id + ' tbody tr:last textarea').val("");
	$("span."+table_id+"_num:last").text(c);
}

function del_row(dis, conname) {
	if($('.'+conname).length > 1) {
		custom_confirm('Delete Selected Record?', function(){
			$(dis).parent().parent().parent().remove();
		})
	}
	else {
		custom_alert('Tidak bisa');
	}
}

function del_row1(dis, conname) {
	//if($('.'+conname).length > 1) {
		custom_confirm('Delete Selected Record?', function(){
			$(dis).parent().parent().parent().remove();
		})
	//}
	//else {
	//	custom_alert('Tidak bisa');
	//}
}

function reload_grid(grid) {	
	$("#"+grid).trigger("reloadGrid");
	//send_inbox_erp(base_url+'processor/plcexport/daftar/upd/export?action=send_inbox_erp&id='+o.last_id+'&foreign_key='+o.foreign_id+'&company_id='+o.company_id+'&group_id='+o.group_id+'&modul_id='+o.modul_id,grid);
}




function reset_grid(divGrid,grid) {
	var input = $("div#"+divGrid).find('input');
	$.each(input, function(i, v) {
		$(v).val('');
	});
	var select = $("div#"+divGrid).find('select');
	$.each(select, function(i, v) {
		$(v).prop('selectedIndex',0);
	});
	
	$("#"+grid).trigger("reloadGrid");
}
/*function add_btn(url, grid) {
	$('div#form_'+grid).html('');
	$.get(url, function(data){
		//$('div#grid_wraper_'+grid).hide();
		//$('div#form_'+grid).show();		
		$('div#form_'+grid).html(data);
		//$('div#grid_wraper_'+grid).html(data);
		//$('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
	})
}*/

function edit_btn(url, grid) {
//alert(grid);
	//alert(url);
	//$('div#form_'+grid).html('');
		//$('#grid_'+grid).trigger('reloadGrid');
	//	$('#grid_upb_input_sample_originator').trigger('reloadGrid');
		$.get(url, function(data){
			$('div#form_'+grid).html(data);
		})
}

function add_btn(url, grid) {
	
	$('div#form_'+grid).html('');
	$.get(url, function(data){
		$('div#form_'+grid).html(data);
	})
}

function del_btn(url, grid) {
	//alert(url+'\n'+grid);
	custom_confirm('Delete Selected Record?', function(){
		$.get(url, function(data) {
			if (data > 0) {
				$("#grid_"+grid).trigger("reloadGrid");		
			} else {
				alert('Delete Failed!');
				return false;
			}
		});			
	});	
}

function cancel_btn(grid, url) {
	//$('div#form_'+grid).hide();
	//$('div#grid_wraper_'+grid).show();
	//$("#grid_"+grid).trigger("reloadGrid");
	$.get(url, function(data){
		$('div#grid_wraper_'+grid).html(data);
		//$('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
	})
}

function save_btn_back(grid, url, dis) {
	var req = $('#form_create_'+grid+' input.required, #form_create_'+grid+' select.required, #form_create_'+grid+' textarea.required');
	var conf=0;
	var alert_message = '';
	$.each(req, function(i,v){
		$(this).removeClass('error_text');
		if($(this).val() == '') {
			var id = $(this).attr('id');
			var label = $("label[for='"+id+"']").text();
			label = label.replace('*','');
			alert_message += '<br /><b>'+label+'</b> '+required_message;			
			$(this).addClass('error_text');			
			conf++;
		}		
	})
	if(conf > 0) {
		//$('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
		//_custom_alert(alert_message,'Error!','info',grid, 1, 5000);
		showMessage(alert_message);
	}
	else {
		custom_confirm(comfirm_message,function(){
			$.ajax({
				url: $('#form_create_'+grid).attr('action'),
				type: 'post',
				data: $('#form_create_'+grid).serialize(),
				success: function(data) {
					var o = $.parseJSON(data);
					var info = 'Error';
					var header = 'Error';
					if(o.status == true) {
						info = 'info';
						header = 'Info';
						$.get(url, function(data){							
							$('div#grid_wraper_'+grid).html(data);
						})						
						
					}
					$("#grid_"+grid).trigger("reloadGrid");	
					_custom_alert(o.message,header,info,grid, 1, 20000);
				}
			})
		})
	}	
}

function save_btn(grid, url, dis) {
	
	var req = $('#form_create_'+grid+' input.required, #form_create_'+grid+' select.required, #form_create_'+grid+' textarea.required');
	var conf=0;
	var alert_message = '';
	$.each(req, function(i,v){
		$(this).removeClass('error_text');
		if($(this).val() == '') {
			var id = $(this).attr('id');
			var label = $("label[for='"+id+"']").text();
			label = label.replace('*','');
			//alert_message += '<br /><b>'+label+'</b> '+required_message;			
			alert_message +='<b>Field '+label+' Required!</b> <br/>';			
			$(this).addClass('error_text');			
			conf++;
		}		
	})
	if(conf > 0) {
		//$('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
		//_custom_alert(alert_message,'Error!','info',grid, 1, 5000);
		showMessage(alert_message);
	}
	else {
	//alert($('#form_create_'+grid).attr('action'));
	custom_confirm(comfirm_message,function(){			
			$.ajax({
				url: $('#form_create_'+grid).attr('action'),
				type: 'post',
				data: $('#form_create_'+grid).serialize(),
				success: function(data) {
					var o = $.parseJSON(data);
					var info = 'Error';
					var last_id = o.last_id;
					var foreign_id = o.foreign_id;
					var header = 'Error';
					if(o.status == true) {
						info = 'info';
						header = 'Info';					
						_custom_alert(o.message,header,info, grid, 1, 20000);
						$.get(url+'&action=update&id='+last_id+'&foreign_key='+foreign_id, function(data) {
	                            $('div#form_'+grid).html(data);
	                    });
						
					}else{
						_custom_alert(o.message,header,info, grid, 1, 20000);
					}
					$('#grid_'+grid).trigger('reloadGrid');
					
				}
			})
		})
	}		
}

function save_btn_upload(grid, url, dis) {
	
	var req = $('#form_create_'+grid+' input.required, #form_create_'+grid+' select.required, #form_create_'+grid+' textarea.required');
	var conf=0;
	var alert_message = '';
	$.each(req, function(i,v){
		$(this).removeClass('error_text');
		if($(this).val() == '') {
			var id = $(this).attr('id');
			var label = $("label[for='"+id+"']").text();
			label = label.replace('*','');
			// alert_message += '<br /><b>'+label+'</b> '+required_message;			
			alert_message +='Field '+label+' Required! ';			
			$(this).addClass('error_text');			
			conf++;
		}		
	})
	if(conf > 0) {
		//$('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
		// _custom_alert(alert_message,'Error!','info',grid, 1, 5000);
		alert('Error! '+alert_message);
	}
	else {
	//alert($('#form_create_'+grid).attr('action'));
	custom_confirm(comfirm_message,function(){
		$('#form_create_'+grid).iframePostForm ({
			post : function (){
				//$('#uploading').modal();
			},		
			complete : function (result){
				console.log(result);
				var o = $.parseJSON(result);
				console.log(o);
				var info = 'Error';
				var header = 'Error';
				var last_id = o.last_id;
				var foreign_id = o.foreign_id;
				if(o.status == true) {
					//$('#form_create_'+grid)[0].reset();
					$.get(url+'&action=update&id='+last_id+'&foreign_key='+foreign_id, function(data) {
                        $('div#form_'+grid).html(data);
                        //$('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
					});
					info = 'info';
					header = 'Info';
				}
				$('#grid_'+grid).trigger('reloadGrid');
				 _custom_alert(o.message,header,info,grid, 1, 20000);											
				//alert(o.message);											
			}
		});
		
		$('#form_create_'+grid).submit();	
			/*$.ajax({
				url: $('#form_create_'+grid).attr('action'),
				type: 'post',
				data: $('#form_create_'+grid).serialize(),
				success: function(data) {
					var o = $.parseJSON(data);
					var info = 'Error';
					var header = 'Error';
					if(o.status == true) {
						$('#form_create_'+grid)[0].reset();
						info = 'info';
						header = 'Info';
					}
					_custom_alert(o.message,header,info, grid, 1, 20000);
				}
			})*/
		})
	}		
}

function save_btn_back_upload(grid, url, dis) {
	
	var req = $('#form_create_'+grid+' input.required, #form_create_'+grid+' select.required, #form_create_'+grid+' textarea.required');
	var conf=0;
	var alert_message = '';
	$.each(req, function(i,v){
		$(this).removeClass('error_text');
		if($(this).val() == '') {
			var id = $(this).attr('id');
			var label = $("label[for='"+id+"']").text();
			label = label.replace('*','');
			alert_message += '<br /><b>'+label+'</b> '+required_message;			
			$(this).addClass('error_text');			
			conf++;
		}		
	})
	if(conf > 0) {
		//$('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
		_custom_alert(alert_message,'Error!','info',grid, 1, 5000);
	}
	else {
	//alert($('#form_create_'+grid).attr('action'));
	custom_confirm(comfirm_message,function(){
			$('#form_create_'+grid).iframePostForm ({
				post : function (){
					//$('#uploading').modal();
				},		
				complete : function (result){
					console.log(result);
					var o = $.parseJSON(result);
					console.log(o);
					var info = 'Error';
					var header = 'Error';
					if(o.status == true) {
						$.get(url, function(data){
							$('div#grid_wraper_'+grid).html(data);
							//$('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
						})						
						info = 'info';
						header = 'Info';
					}
					_custom_alert(o.message,header,info,grid, 1, 20000);											
				}
			});
			
			$('#form_create_'+grid).submit();		
			/*$.ajax({
				url: $('#form_create_'+grid).attr('action'),
				type: 'post',
				data: $('#form_create_'+grid).serialize(),
				success: function(data) {
					var o = $.parseJSON(data);
					var info = 'Error';
					var header = 'Error';
					if(o.status == true) {
						$('#form_create_'+grid)[0].reset();
						info = 'info';
						header = 'Info';
					}
					_custom_alert(o.message,header,info, grid, 1, 20000);
				}
			})*/
		})
	}		
}

function save_confirm(grid, url, dis, status, action, company, group, modul) {
	custom_confirm(comfirm_message,function(){
		$.ajax({
			url: url+'?action='+action+'&company_id='+company+'&group_id='+group+'&modul_id='+modul,
			type: 'post',
			data: $('#form_'+status+'_'+grid).serialize(),
			success: function(data) {	
				
				var o = $.parseJSON(data);
				var info = 'Error';
				var header = 'Error';	
				var last_id = o.last_id;
				
				if(o.status == true) {
					info = 'info';
					header = 'Info';
					
					reload_grid('grid_'+grid);
					$.get(url+'?action=update&id='+last_id+'&company_id='+company+'&group_id='+group+'&modul_id='+modul, function(data) {
						//$('div#grid_wraper_'+grid).html(data);
						$('div#form_'+grid).html(data);
						//$('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
						
					});
				}				
				_custom_alert(o.message,header,info, grid, 1, 20000);
			}
		})
	})	
}

function save_draft_btn(grid, url, dis) {
	var req = $('#form_create_'+grid+' input.required, #form_create_'+grid+' select.required, #form_create_'+grid+' textarea.required');
	var conf=0;
	var alert_message = '';
	$.each(req, function(i,v){
		$(this).removeClass('error_text');
		if($(this).val() == '') {
			var id = $(this).attr('id');
			var label = $("label[for='"+id+"']").text();
			label = label.replace('*','');
			alert_message += '<br /><b>'+label+'</b> '+required_message;			
			$(this).addClass('error_text');			
			conf++;
		}		
	})
	if(conf > 0) {
		//$('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
		_custom_alert(alert_message,'Error!','info',grid, 1, 5000);
	}
	else {
		custom_confirm(comfirm_message,function(){
			var data_post = $('#form_create_'+grid).serializeArray();
			data_post.push({ name: "draft", value: true });
			$.ajax({
				url: $('#form_create_'+grid).attr('action'),
				type: 'post',
				data: data_post,
				success: function(data) {
					var o = $.parseJSON(data);
					var info = 'Error';
					var header = 'Error';
					if(o.status == true) {
						$('#form_create_'+grid)[0].reset();
						info = 'info';
						header = 'Info';
					}
					_custom_alert(o.message,header,info, grid, 1, 20000);
				}
			})
		})
	}		
}

function save_btn_back(grid, url, dis) {
	var req = $('#form_create_'+grid+' input.required, #form_create_'+grid+' select.required, #form_create_'+grid+' textarea.required');
	var conf=0;
	var alert_message = '';
	$.each(req, function(i,v){
		$(this).removeClass('error_text');
		if($(this).val() == '') {
			var id = $(this).attr('id');
			var label = $("label[for='"+id+"']").text();
			label = label.replace('*','');
			alert_message += '<br /><b>'+label+'</b> '+required_message;			
			$(this).addClass('error_text');			
			conf++;
		}		
	})
	if(conf > 0) {
		//$('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
		_custom_alert(alert_message,'Error!','info',grid, 1, 5000);
	}
	else {
		custom_confirm(comfirm_message,function(){
			$.ajax({
				url: $('#form_create_'+grid).attr('action'),
				type: 'post',
				data: $('#form_create_'+grid).serialize(),
				success: function(data) {
					var o = $.parseJSON(data);
					var info = 'Error';
					var header = 'Error';
					if(o.status == true) {
						$.get(url, function(data){
							$('div#grid_wraper_'+grid).html(data);
							//$('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
						})						
						info = 'info';
						header = 'Info';
					}
					_custom_alert(o.message,header,info,grid, 1, 20000);
				}
			})
		})
	}	
}

function update_btn(grid, url, dis) {
	var req = $('#form_update_'+grid+' input.required, #form_update_'+grid+' select.required, #form_update_'+grid+' textarea.required');
	var conf=0;
	var alert_message = '';
	$.each(req, function(i,v){
		$(this).removeClass('error_text');
		if($(this).val() == '') {
			var id = $(this).attr('id');
			var label = $("label[for='"+id+"']").text();
			label = label.replace('*','');
			// alert_message += '<br /><b>'+label+'</b> '+required_message;			
			alert_message +='<b>Field '+label+' Required!</b> <br/>';			
			$(this).addClass('error_text');			
			conf++;
		}		
	})
	if(conf > 0) {
		//$('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
		//_custom_alert(alert_message,'Error!','info',grid, 1, 5000);		
		showMessage(alert_message);
	}
	else {
		custom_confirm(comfirm_message,function(){			
			$.ajax({
				url: $('#form_update_'+grid).attr('action'),
				type: 'post',
				data: $('#form_update_'+grid).serialize(),
				success: function(data) {
					var o = $.parseJSON(data);
					var info = 'Error';
					var header = 'Error';
					var last_id = o.last_id;
					var foreign_id = o.foreign_id;
					if(o.status == true) {
						//$('#form_update_'+grid)[0].reset();
						info = 'info';
						header = 'Info';
						_custom_alert(o.message,header,info, grid, 1, 20000);						
						$.get(url+'&action=update&id='+last_id+'&foreign_key='+foreign_id, function(data) {
	                        $('div#form_'+grid).html(data);
	                        //$('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
						});
						$('#grid_'+grid).trigger('reloadGrid');
					}else{
						_custom_alert(o.message,header,info, grid, 1, 20000);
					}
					//alert(' '+o.message);
					//$('#grid_'+grid).trigger('reloadGrid');
				}
			})
		})
	}		
}

function showMessage(txt) {
	$( "#dialog-alert" ).html(txt);
	$( "#dialog-alert" ).dialog({
		title: "Perhatian",
		modal: true,
		buttons: {
			Ok: function() {
				$( this ).dialog( "close" );
			}
		}
	});	
}

function update_btn_upload(grid, url, dis) {
	var req = $('#form_update_'+grid+' input.required, #form_update_'+grid+' select.required, #form_update_'+grid+' textarea.required');
	var conf=0;
	var alert_message = '';
	$.each(req, function(i,v){
		$(this).removeClass('error_text');
		if($(this).val() == '') {
			var id = $(this).attr('id');
			var label = $("label[for='"+id+"']").text();
			label = label.replace('*','');
			alert_message +='Field '+label+' Required! ';			
			// alert_message += '<br /><b>'+label+'</b> '+required_message;			
			$(this).addClass('error_text');			
			conf++;
		}		
	})
	if(conf > 0) {
		//$('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
		alert('Error! '+alert_message);
		// _custom_alert(alert_message,'Error!','info',grid, 1, 5000);
	}
	else {
		custom_confirm(comfirm_message,function(){
			$('#form_update_'+grid).iframePostForm ({
				post : function (){
					//$('#uploading').modal();
				},		
				complete : function (result){
					console.log(result);
					var o = $.parseJSON(result);
					console.log(o);
					var info = 'Info';
					var header = 'Info';
					var last_id = o.last_id;
					var foreign_id = o.foreign_id;
					if(o.status == true) {
						//$('#form_update_'+grid)[0].reset();
						$('#grid_'+grid).trigger('reloadGrid');
						$.get(url+'&action=update&id='+last_id+'&foreign_key=0'+foreign_id, function(data) {
	                        $('div#form_'+grid).html(data);
	                        //$('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
						});
						
						info = 'info';
						header = 'Info';
					}
					$('#grid_'+grid).trigger('reloadGrid');
					_custom_alert(o.message,header,info,grid, 1, 20000);											
					//alert(o.message);											
				}
			});			
			$('#form_update_'+grid).submit();				
			
		})
	}		
}

function update_draft_btn(grid, url, dis) {
	var req = $('#form_update_'+grid+' input.required, #form_update_'+grid+' select.required, #form_update_'+grid+' textarea.required');
	var conf=0;
	var alert_message = '';
	$.each(req, function(i,v){
		$(this).removeClass('error_text');
		if($(this).val() == '') {
			var id = $(this).attr('id');
			var label = $("label[for='"+id+"']").text();
			label = label.replace('*','');
			alert_message += '<br /><b>'+label+'</b> '+required_message;			
			$(this).addClass('error_text');			
			conf++;
		}		
	})
	if(conf > 0) {
		//$('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
		_custom_alert(alert_message,'Error!','info',grid, 1, 5000);
	}
	else {
		custom_confirm(comfirm_message,function(){
			var data_post = $('#form_update_'+grid).serializeArray();
			data_post.push({ name: "draft", value: true });
			$.ajax({
				url: $('#form_update_'+grid).attr('action'),
				type: 'post',
				data: data_post,
				success: function(data) {
					var o = $.parseJSON(data);
					var info = 'Error';
					var header = 'Error';
					if(o.status == true) {
						//$('#form_update_'+grid)[0].reset();
						info = 'info';
						header = 'Info';
					}
					_custom_alert(o.message,header,info, grid, 1, 20000);
				}
			})
		})
	}		
}

function update_btn_back(grid, url, dis) {
	var req = $('#form_update_'+grid+' input.required, #form_update_'+grid+' select.required, #form_update_'+grid+' textarea.required');
	var conf=0;
	var alert_message = '';
	$.each(req, function(i,v){
		$(this).removeClass('error_text');
		if($(this).val() == '') {
			var id = $(this).attr('id');
			var label = $("label[for='"+id+"']").text();
			label = label.replace('*','');
			alert_message += '<br /><b>'+label+'</b> '+required_message;			
			$(this).addClass('error_text');			
			conf++;
		}		
	})
	if(conf > 0) {
		//$('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
		_custom_alert(alert_message,'Error!','info',grid, 1, 5000);
	}
	else {
		custom_confirm(comfirm_message,function(){
			$.ajax({
				url: $('#form_update_'+grid).attr('action'),
				type: 'post',
				data: $('#form_update_'+grid).serialize(),
				success: function(data) {
					var o = $.parseJSON(data);
					var info = 'Error';
					var header = 'Error';
					if(o.status == true) {
						$.get(url, function(data){
							$('div#grid_wraper_'+grid).html(data);
							//$('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
						})
						info = 'info';
						header = 'Info';
					}
					_custom_alert(o.message,header,info, grid, 1, 20000);
				}
			})
		})
	}	
}

function update_btn_back_upload(grid, url, dis) {
	var req = $('#form_update_'+grid+' input.required, #form_update_'+grid+' select.required, #form_update_'+grid+' textarea.required');
	var conf=0;
	var alert_message = '';
	$.each(req, function(i,v){
		$(this).removeClass('error_text');
		if($(this).val() == '') {
			var id = $(this).attr('id');
			var label = $("label[for='"+id+"']").text();
			label = label.replace('*','');
			alert_message += '<br /><b>'+label+'</b> '+required_message;			
			$(this).addClass('error_text');			
			conf++;
		}		
	})
	if(conf > 0) {
		//$('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
		_custom_alert(alert_message,'Error!','info',grid, 1, 5000);
	}
	else {
		custom_confirm(comfirm_message,function(){
			$('#form_update_'+grid).iframePostForm ({
				post : function (){
					//$('#uploading').modal();
				},		
				complete : function (result){
					console.log(result);
					var o = $.parseJSON(result);
					console.log(o);
					var info = 'Error';
					var header = 'Error';
					if(o.status == true) {
						$.get(url, function(data){
							$('div#grid_wraper_'+grid).html(data);
							//$('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
						})
						info = 'info';
						header = 'Info';
					}
					_custom_alert(o.message,header,info,grid, 1, 20000);											
				}
			});			
			$('#form_update_'+grid).submit();				
		})
	}	
}

/*function getStatusByActivity(dis) {	
	var ix = $('.effected_proses').index(dis);
	//console.log(ix);
	var $id = $(dis).val();
	var image_load = "<div class='ajax_loading'><img src='"+loading_image+"' /></div>";
	$.ajax({
		url: base_url+'master_bisnis_proses_sub/get_action',
		type: 'post',
		data: 'sub_id='+$id,
		beforeSend: function(){
            $('span.effected_action').eq(ix).html(image_load);
        },
        success : function(resp) {
        	var o = $.parseJSON(resp);
        	if(o.status == true) {
        		$('span.effected_action').eq(ix).html(o.source);
        	}
        	else {
        		$('span.effected_action').eq(ix).html('Error');
        	}
        }
	});
}*/

function load_sub_menu(page,div){
    var image_load = "<div class='ajax_loading'><img src='"+loading_image+"' /></div>";
    $.ajax({
        //url: site+'/'+page,
        url: page,
        beforeSend: function(){
            $('#sub_menu_body').html(image_load);
        },
        success: function(response){
        	var o = $.parseJSON(response);        	
        	if(o.status == true) {
        		var html = '<ul class="main_menu_left">';
        		$.each(o.resp, function(i, item) {
				    html += '<li><a class="menu_link" ref="'+o.resp[i].url+'" href="'+base_url+o.resp[i].url+'">'+o.resp[i].label+'</a></li>';
				});
				html += '</ul">';
				$('#sub_menu_head').html(o.menu);
				$('#sub_menu_body').html(html);
        	}
        	else {
        		alert('error!');
        	}            
        },
        statusCode: {
		    404: function() {
		      //$(div).html('ERROR 404<br />Page Not Found! :p<br /><br /><img src='+image_404+' >');
		      $(div).html('ERROR 404<br />Page Not Found!');
			}
		},
        dataType:'html'  		
    });
    return false;
}

function getIndexForId( tabsDivId, searchedId ) {
	var index = -1;
    var i = 0, els = $("#" + tabsDivId).find("a");
    var l = els.length, e;
    while ( i < l && index == -1 ) {
        e = els[i];
        if ( "#" + searchedId == $(e).attr('href') ) {
            index = i;
        }
        i++;
    };
    return index;
}

$(document).ready(function(){
	
	$(".moveUp,.moveDown").live('click', function(){
        var row = $(this).parents("tbody tr:first");
        if ($(this).is(".moveUp")) {
            row.insertBefore(row.prev());
        } else {
            row.insertAfter(row.next());
        }
    });
	
	$(".multiselect").livequery(function(){
		$(this).multiselect();
	});
	
	$(".chosen").livequery(function(){
		$(this).chosen({no_results_text: "No results matched"});
	});
	/*$(".combobox").livequery(function(){
		$(this).combobox();
	});*/
	var config = {
		source: base_url+'processor/plc/master/divisi?action=employee_list',					
		select: function(event, ui){
			var i = $('.vName_member_div').index(this);
			$('.vName_member_div_cNip').eq(i).val(ui.item.id);						
		},
		minLength: 2,
		autoFocus: true,
	};
	$(".vName_member_div").livequery(function(){
		$(this).autocomplete(config);
		var i = $('.vName_member_div').index(this);
		$(this).keypress(function(e){
			if(e.which != 13) {
				$('.vName_member_div_cNip').eq(i).val('');
			}			
		});
		$(this).blur(function(){
			if($('.vName_member_div_cNip').eq(i).val() == '') {
				$(this).val('');
			}			
		});
	})
	
	$('.effected_div_add').live('click', function() {
		var row = $('table#vName_member_div_table tbody tr:last').clone(true);
		
		$("span.numberlist:first").text('1');
		var n = $("span.numberlist:last").text();
		var no = parseInt(n);
		var c = no + 1;		
		$('table#vName_member_div_table tbody tr:last').after(row);
		//$("table#vName_member_div_table tbody tr:last td span.effected_action").text("Choose Effected Proses first");
		$("table#vName_member_div_table tbody tr:last input").val("");
		$("span.numberlist:last").text(c);
	})
	$('.effected_proses_del').live('click', function() {
		var dis = $(this);
		custom_confirm('Delete Selected Record?', function(){
			if($('table#vName_member_div_table tbody tr').length == 1) {
				custom_alert('Isi Minimal 1');
			}
			else {
				dis.parent().parent().remove();
			}
		})
	})
	
	$('.vName_member_div_add').live('click', function() {
		var level = $('.master_divisi_iLevel_span').html();
		var row = '<tr><td style="text-align: right"><span class="numberlist"></span></td><td style="text-align: center"><input class="vName_member_div_cNip" name="nip[]" type="hidden" ><input class="input_rows-table vName_member_div" style="width: 98%" name="name[]" type="text" ></td><td style="text-align: center">[ <a href="javascript:;" class="vName_member_div_del">Hapus</a> ]</td></tr>';		
		$("span.numberlist:first").text('1');
		var n = $("span.numberlist:last").text();
		var no = parseInt(n);
		var c = no + 1;		
		$('table#vName_member_div_table tbody tr:last').after(row);
		//$("table#vName_member_div_table tbody tr:last td span.effected_action").text("Choose Effected Proses first");
		$("table#vName_member_div_table tbody tr:last input").val("");
		$("span.numberlist:last").text(c);
		//$('.master_divisi_iLevel:last').prop('selectedIndex',0);
	})
	
	$('.vName_member_div_del').live('click', function() {
		var dis = $(this);
		custom_confirm('Delete Selected Record?', function(){
			if($('table#vName_member_div_table tbody tr').length == 1) {
				custom_alert('Isi Minimal 1');
			}
			else {
				dis.parent().parent().remove();
			}
		})
	})
	
	$('#master_bisnis_proses_sub_idplc_activity').live('change', function() {
		var $id = $(this).val();
		var image_load = "<div class='ajax_loading'><img src='"+loading_image+"' /></div>";
		$.ajax({
			url: base_url+'master_bisnis_proses_sub/get_action',
			type: 'post',
			data: 'sub_id='+$id,
			beforeSend: function(){
	            $('span.effected_action').html(image_load);
	        },
	        success : function(resp) {
	        	var o = $.parseJSON(resp);
	        	if(o.status == true) {
	        		$('span.effected_action').html(o.source);
	        	}
	        	else {
	        		$('span.effected_action').html('Error');
	        	}
	        }
		});
	})
	
	var required_message = 'Field is Required!';
	var confirm_message = 'Are You Sure ?';
	$('#btn_search').live('click',function() {
	    //$('#grid').trigger('reloadGrid');
	    var grid=$('#search').attr('trigger');
		$('#'+grid).trigger('reloadGrid');
	});
	$('#search').live('keypress',function(e) {
		var grid=$(this).attr('trigger');
		if(e.which == 13) {
			$('#'+grid).trigger('reloadGrid');
		}
	});
	$("#form_search").livequery(function(){
		$(this).submit(function(e) {
			return false;
		});
	});
	$('.chosen').livequery(function() {
		$(this).chosen({
			allow_single_deselect : true
		});
	});
	
	$('.tab').livequery(function(){
		$(this).tabs();
	})
	
	$('.icon-browse').livequery(function(){
		$(this).button({
			icons: {
				primary : "ui-icon-plus"
			}
		});
	});
	
	var tabTitle = $( "#tab_title" ),
	tabContent = $( "#tab_content" ),
	tabTemplate = "<li><a href='#{href}'>#{label}</a> <span class='ui-icon ui-icon-close'>Remove Tab</span></li>",
	tabCounter = 2;
	var tabs = $( "#content_tabs" ).tabs();
	
	function addTab(id, href, title) {
		var idxtab = getIndexForId('content_tabs', id);		
		if(idxtab != -1){
			tabs.tabs("option", "active", idxtab);
			//alert(id);
		}
		else {
			var image_load = "<div class='ajax_loading'><img src='"+loading_image+"' /></div>";
		    
			var label = title,
			li = $( tabTemplate.replace( /#\{href\}/g, "#" + id ).replace( /#\{label\}/g, label ) );			
			tabs.find( ".ui-tabs-nav" ).append( li );
			
			$.ajax({
		        url: href,
		        beforeSend: function(){
		            tabContentHtml = image_load;          
					tabs.append( "<div id='" + id + "'><p>" + tabContentHtml + "</p></div>" );
					tabs.tabs( "refresh" );				
		        },
		        success: function(response){
		            tabContentHtml = response;
		            
		            $("div#"+id).html(response);
					tabs.tabs( "refresh" );
		        },
		        statusCode: {
				    404: function() {
				      	//$(div).html('ERROR 404<br />Page Not Found! :p<br /><br /><img src='+image_404+' >');
				      	tabContentHtml = 'ERROR 404<br />Page Not Found!';
				      	$("div#"+id).html(tabContentHtml);
						tabs.tabs( "refresh" );
					}
				},
		        dataType:'html'  		
		    });	    
		    
		    var indexTab = tabs.index($('#'+id));
		    //alert(indexTab);
			tabs.tabs("option", "active", indexTab);
		}
	}
	// close icon: removing the tab on click
	$( "#content_tabs span.ui-icon-close" ).live( "click", function() {
		var panelId = $( this ).closest( "li" ).remove().attr( "aria-controls" );
		$( "#" + panelId ).remove();
		tabs.tabs( "refresh" );
	});
	
	$(".menu_link").live('click', function(e){
    	e.preventDefault();
    	var title=$(this).text();
    	var id=$(this).attr("ref");
        var href=$(this).attr("href");        
        addTab(id, href, title);
    });
    
    $('.master_link').live('click',function(e){
    	var image_load = "<div class='ajax_loading'><img src='"+loading_image+"' /></div>";
		e.preventDefault();
		var href = $(this).attr('href');
		return $.ajax({
			url : base_url+'cek_session',
			type : 'GET',
			data : 'randval='+Math.random(),
			cache : false,
			beforeSend: function() {
				//var image_load = "<div class='ajax_loading'><img src='"+loading_image+"' /></div>";
				//$('#content-wrapper').html(image_load);
			},
			success : function(res) {
				if(res == 0) {
					custom_alert('Your Session Has Expired, Please Re-Login!','','',
						function(){
							location.href = base_url;
						});
				}
				else {
					load_sub_menu(href,'#menubar');					
				}
			}
		}).responseText
	});
	
	/*$('.menu_link').live('click',function(e){
		e.preventDefault();
		var href = $(this).attr('href');
		return $.ajax({
			url : base_app+'cek_session',
			type : 'GET',
			data : 'randval='+Math.random(),
			cache : false,
			beforeSend: function() {
				//var image_load = "<div class='ajax_loading'><img src='"+loading_image+"' /></div>";
				//$('#content-wrapper').html(image_load);
			},
			success : function(res){
				if(res == 0) {
					custom_alert('Your Session Has Expired, Please Re-Login!','','',
						function(){
							location.href = base_app;
						});
				}
				else {
					//load_tab(href,'#content-wrapper');
					addTab()
				}
			}
		}).responseText
	});*/
	$('.edit_link').live('click',function(e){
		e.preventDefault();
		var href = $(this).attr('href');
		return $.ajax({
			url : base_app+'cek_session',
			type : 'GET',
			data : 'randval='+Math.random(),
			cache : false,
			beforeSend: function() {
				var image_load = "<div class='ajax_loading'><img src='"+loading_image+"' /></div>";
				$('#content-wrapper').html(image_load);
			},
			success : function(res){
				if(res == 0) {
					custom_alert('Your Session Has Expired, Please Re-Login!','','',
						function(){
							window.location.href = base_app;
						});
				}
				else {
					load(href,'#content-wrapper');
				}
			}
		}).responseText		
	});	
	
	/*$("select.combobox").livequery(function(){
		$(this).combobox();
	})*/
	
	$('#create_button').live('click',function(){
		req = $('#form1 input.required,select.required,textarea.required');
		var form_load = $(this).attr('load');
		var conf=0
		
		/*var datep = $('.datepicker');
		var dateold = $('.old');
		
		if(datep.eq(0).val() > datep.eq(1).val() && datep.eq(1).val()!='') {
			var n1 = datep.eq(0).attr('name');
			var n2 = datep.eq(1).attr('name');
			var l1 = $("label[for='"+n1+"']").text();
			var l2 = $("label[for='"+n2+"']").text();
			custom_alert(l1+' Can\'t be Greater than '+l2+'!','',datep.eq(1));
			conf++;
			return false;
		}
		if(datep.eq(0).val() <= dateold.eq(0).val() || datep.eq(0).val() <= dateold.eq(1).val()) {
			custom_alert('a New Date Must be Greater than the date of the old !','',datep.eq(0));
			conf++;
			return false;
		}
		if((datep.eq(0).val() <= dateold.eq(0).val() || datep.eq(0).val() <= dateold.eq(1).val() || datep.eq(1).val() <= dateold.eq(0).val() || datep.eq(1).val() <= dateold.eq(1).val()) && datep.eq(1).val()!='') {
			custom_alert('a New Date Must be Greater than the date of the old !','',datep.eq(0));
			conf++;
			return false;
		}*/
		$.each(req, function(i,v){
			var clasp = $(this).attr('name');
			if($(this).val() == '') {
				var name = $(this).attr('name');
				var label = $("label[for='"+name+"']").text();
				custom_alert('<b>'+label+'</b> '+required_message,'',$(this));
				conf++;
				return false;
			}
			for (i=0; i<9; i++){
				if($(this).val() == '0' && clasp == 'qty['+i+']') {
					var name = $(this).attr('name');
					var label = $("label[for='"+name+"']").text();
					custom_alert('<b>'+label+'</b> Field not zero (0)','',$(this));
					conf++;
					return false;
				}
			}
		})
		
		if(conf === 0) {
			custom_confirm(confirm_message,
		        function(){
		        	return $.ajax({
						type: 'POST',
						url: $('#form1').attr('action'),
						data: $('#form1').serialize(),
						async: false,
						success: function(data) {
							//load(base_app+form_load,'#content-wrapper');
							load(form_load,'#content-wrapper');							 
						}							
					}).responseText
		        }
		    )
		}
	});
	
	$('#create_button_module').live('click',function(){
		req = $('#form1 input.required,select.required,textarea.required');
		var form_load = $(this).attr('load');
		var conf=0
		
		/*var datep = $('.datepicker');
		var dateold = $('.old');
		
		if(datep.eq(0).val() > datep.eq(1).val() && datep.eq(1).val()!='') {
			var n1 = datep.eq(0).attr('name');
			var n2 = datep.eq(1).attr('name');
			var l1 = $("label[for='"+n1+"']").text();
			var l2 = $("label[for='"+n2+"']").text();
			custom_alert(l1+' Can\'t be Greater than '+l2+'!','',datep.eq(1));
			conf++;
			return false;
		}
		if(datep.eq(0).val() <= dateold.eq(0).val() || datep.eq(0).val() <= dateold.eq(1).val()) {
			custom_alert('a New Date Must be Greater than the date of the old !','',datep.eq(0));
			conf++;
			return false;
		}
		if((datep.eq(0).val() <= dateold.eq(0).val() || datep.eq(0).val() <= dateold.eq(1).val() || datep.eq(1).val() <= dateold.eq(0).val() || datep.eq(1).val() <= dateold.eq(1).val()) && datep.eq(1).val()!='') {
			custom_alert('a New Date Must be Greater than the date of the old !','',datep.eq(0));
			conf++;
			return false;
		}*/
		$.each(req, function(i,v){
			var clasp = $(this).attr('name');
			if($(this).val() == '') {
				var name = $(this).attr('name');
				var label = $("label[for='"+name+"']").text();
				custom_alert('<b>'+label+'</b> '+required_message,'',$(this));
				conf++;
				return false;
			}
			for (i=0; i<9; i++){
				if($(this).val() == '0' && clasp == 'qty['+i+']') {
					var name = $(this).attr('name');
					var label = $("label[for='"+name+"']").text();
					custom_alert('<b>'+label+'</b> Field not zero (0)','',$(this));
					conf++;
					return false;
				}
			}
		})
		
		var $permKey = $('.menu_permKey');
		$.each($permKey, function(i,el1){
			var current_val = $(el1).val();
			var current_ix = i;
	        if (current_val != "") {
	            $($permKey).each(function (i,el2) {
	                if ($(el2).val() == current_val && current_ix != i) {
	                    isDuplicate = true;
	                    conf++;
	                    custom_alert('Duplicate Value <strong>'+current_val+'</strong>','',$(this));
	                    return;
	                }
	            });
	        }
		})
		
		if(conf === 0) {
			custom_confirm(confirm_message,
		        function(){
		        	return $.ajax({
						type: 'POST',
						url: $('#form1').attr('action'),
						data: $('#form1').serialize(),
						async: false,
						success: function(data) {
							//load(base_app+form_load,'#content-wrapper');							 
							load(form_load,'#content-wrapper');
						}							
					}).responseText
		        }
		    )
		}
	});
	
	$('#create_button_user').live('click',function(){
		var thisbtn = $(this);
		var htmlbtn = thisbtn.html();
		req = $('#form1 input.required,select.required,textarea.required');
		var form_load = $(this).attr('load');
		var conf=0		
		
		$.each(req, function(i,v){
			var clasp = $(this).attr('name');
			if($(this).val() == '') {
				var name = $(this).attr('name');
				var label = $("label[for='"+name+"']").text();
				custom_alert('<b>'+label+'</b> '+required_message,'',$(this));
				conf++;
				return false;
			}
		});
		
		if($('#password').val() != $('#password2').val()) {
			custom_alert('Password Not Same!','',$('#password2'));
			conf++;
			return false;
		}
		
		if(conf === 0) {
			custom_confirm(confirm_message,
		        function(){
		        	return $.ajax({
						type: 'POST',
						url: $('#form1').attr('action'),
						data: $('#form1').serialize(),
						async: false,
						beforeSend: function() {
							$('#create_button_user').html('Please Wait..');
							$('#form1').find('button').attr('disabled',true);							
						},
						success: function(data) {
							if(data == '99') {
								custom_alert('Username Allready Registered','',$('#username'));
								$('#create_button_user').html(htmlbtn);
								$('#form1').find('button').attr('disabled',false);
							}
							else if(data == '1') {
								//load(base_app+form_load,'#content-wrapper');
								load(form_load,'#content-wrapper');
							}
							else {
								alert(data);
							}														 
						}							
					}).responseText
		        }
		    )
		}
	});
	
	$('.dellall').live('click',function(e){
	    e.preventDefault();
	    var href = $(this).attr('ref');
	    var s = $('#grid').jqGrid('getGridParam','selarrrow');
	    //alert(s);
	    if(s=='')
		{
			custom_alert('Please choose row(s) to be deleted.');	
		}
		else
		{
			custom_confirm('Delete Selected Record(s) ?',
		        function(){
					return $.ajax({
					type: 'POST',
					url: href+'/delete',
					data: 'id='+s+'&oper=dellall',
					async: false,
					success: function(data) {
								if(data.error) {
									custom_alert('Deleted Failed!');
								}else {
									custom_alert('Delete Data Success!!');
									$('#grid').trigger('reloadGrid');
								}
							}
							
					}).responseText
		        }
		    )
		}
	});
 	$("form.master_group").find("select#privilege_master_group_app_id").live("change", function(){
 		var thisval = $(this).val();
 		$.ajax({
			url: base_app+"master_group/privilege/",
			type: 'post',
			data: "app_id="+thisval,
			beforeSend: function(){
				var image_load = "<div class='ajax_loading'><img src='"+loading_image+"' /></div>";
				$('span#privilege_list').html(image_load);
			},
			success: function(res){
				$('span#privilege_list').html(res);
			},
		})
	});
	
	//Add  Menu
	$('#btn_add_menu').live('click', function(){
		var permKey = $('.menu_permKey');
		var permName = $('.menu_permName');
		
		var data = [];		
		$.each(permKey, function(i,v){
			data[v.value] = permName[i].value;	
		})
		
		var html = '<tr><td><input type="text" class="span12 menu_permKey required" name="permKey[]"></td><td><input type="text" class="span12 menu_permName required" name="permName[]"></td><td class="selectbox_parent"></td><td><input onKeyPress="return isNumberKey(event)" maxlength="2" style="text-align: right;" type="text" class="span12 menu_bobot" name="bobot[]"></td><td><select class="span12" name="status[]"><option value="0">Not Active</option><option selected value="1">Active</option></select></td><td><button type="button" class="btn btn-danger del_menu_row"><i class="icon-remove-sign icon-white"></i></button></td></tr>';
		$('#table_menu_list tbody tr:last').after(html);
		
		/*var data2 = {
		    'foo': 'bar',
		    'foo2': 'baz'
		}
		console.log(data2);*/
		var s = $('<select name="parent[]" class="span12 menu_parent"></select>');
		$('<option />', {value: '0', text: '-- Parent --'}).appendTo(s);		
		for(var val in data) {
		    $('<option />', {value: val, text: data[val]}).appendTo(s);
		}
		$('td.selectbox_parent:last').html(s);		
	});
	$('.del_menu_row').live('click', function(){
		var thisis = $(this);
		custom_confirm('Delete Selected Record(s) ?',
	        function(){
				thisis.parent().parent().remove();
	        }
	    )		
	})
	
	//Add  App
	$('#btn_add_app').live('click', function(){
		//var html = '<tr><td><input type="hidden" class="app_user_id" name="user_id[]"><input type="text" class="span12 app_username user_typeahead required" onChange="clear_user_typeahead(this)" name="username[]"></td><td><input type="text" class="span12 app_level required" name="level[]"></td><td><button type="button" class="btn btn-danger del_app_row"><i class="icon-remove-sign icon-white"></i></button></td></tr>';
		var html = '<tr><td><input type="hidden" class="app_user_id" name="user_id[]"><input type="text" class="span12 app_username user_typeahead required" onChange="clear_user_typeahead(this)" name="username[]"></td><td><button type="button" class="btn btn-danger del_app_row"><i class="icon-remove-sign icon-white"></i></button></td></tr>';
		$('#table_app_list tbody tr:last').after(html);		
	});
	$('.del_app_row').live('click', function(){
		var thisis = $(this);
		custom_confirm('Delete Selected Record(s) ?',
	        function(){
				thisis.parent().parent().remove();
	        }
	    )		
	})
})
function clear_user_typeahead(dis) {
	var i = $('.app_username').index(dis);
    //$(this).val('');
    $('.app_username').eq(i).val('');
    $('.app_user_id').eq(i).val('');
}
function custom_alert(prompt, title, focus, act){
    if (title === undefined || title === '') title = "Alert";
    if (focus === undefined) focus = "";
    if (act === undefined) act = "";
    if ($("#alert_dialog").length == 0){
        $("#buat_dialog").html('<div id="alert_dialog" title="' + title + '"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>' + prompt + '</div>');
        if(act == '') {
	        $("#alert_dialog").dialog({
	        	modal: true,
	        	buttons: {
	        		Ok: function(){
	        			 $(this).dialog('close');
	        			 $(focus).focus();        			 
	        		}
	        	},
	        	open: function() {
			    	$(this).parents('.ui-dialog-buttonpane button:eq(0)').focus(); 
			    },        	
	        });
       }
       else {
       		$("#alert_dialog").dialog({
	        	modal: true,
	        	buttons: {
	        		Ok: function(){
	        			 $(this).dialog('close');
	        			 act();        			 
	        		}
	        	},
	        	open: function() {
			    	$(this).parents('.ui-dialog-buttonpane button:eq(0)').focus(); 
			    },        	
	        });
	        $('#alert_dialog').bind('dialogclose', function(event) {
				act();
		    });
       }        
    }
    else {
    	if(act == '') {
	        $("#alert_dialog").html(prompt);
	        //$("#alert_dialog").dialog('open');
	        $("#alert_dialog").dialog({
	        	modal: true,
	        	zIndex: 9999999,
	        	buttons: {
	        		Ok: function(){
	        			 $(this).dialog('close');
	        			 $(focus).focus();        			 
	        		}
	        	},
	        	open: function() {
			    	$(this).parents('.ui-dialog-buttonpane button:eq(0)').focus(); 
			    },
			    close: function() {
			    	$(this).remove() 
			    },        	
	        });
        }
       	else {
       		$("#alert_dialog").html(prompt);
       		$("#alert_dialog").dialog({
	        	modal: true,
	        	zIndex: 9999999,
	        	buttons: {
	        		Ok: function(){
	        			 $(this).dialog('close');
	        			 //act();        			 
	        		}
	        	},
	        	open: function() {
			    	$(this).parents('.ui-dialog-buttonpane button:eq(0)').focus(); 
			    },
			    close: function() {
			    	$(this).remove() 
			    },        	
	        });
	        $('#alert_dialog').bind('dialogclose', function(event) {
				act();
		    });
       	}
    }
}
function custom_confirm(prompt, action, title){
    if (title === undefined) title = "Confirmation";
    if ($("#confirm_dialog").length == 0){
        //$("#content").append('<div id="confirm_dialog" title="' + title + '"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>' + prompt + '</div>');
        $("#buat_dialog").html('<div id="confirm_dialog" title="' + title + '"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>' + prompt + '</div>');
        $("#confirm_dialog").dialog({
        	modal: true,
        	zIndex: 9999999,
        	buttons: {
        		Yes: function(){
        			 $(this).dialog('close'); 
        			 action(); 
        		}, 
        		No: function(){
        			 $(this).dialog('close'); 
        		}
        	},
        	close: function() {
		    	$(this).remove() 
		    },
        });
    }
    else {
        $("#confirm_dialog").html(prompt);
        $("#confirm_dialog").dialog({
        	modal: true,
        	zIndex: 9999999,
        	buttons: {
        		Yes: function(){
        			 $(this).dialog('close'); 
        			 action(); 
        		}, 
        		No: function(){
        			 $(this).dialog('close'); 
        		}
        	},
        	close: function() {
		    	$(this).remove() 
		    },        	
        });        
        $("#confirm_dialog").dialog('open');
    }
}
function load(page,div){
    var image_load = "<div class='ajax_loading'><img src='"+loading_image+"' /></div>";
    $.ajax({
        //url: site+'/'+page,
        url: page,
        beforeSend: function(){
            $(div).html(image_load);
        },
        success: function(response){
            $(div).html(response);
        },
        statusCode: {
		    404: function() {
		      //$(div).html('ERROR 404<br />Page Not Found! :p<br /><br /><img src='+image_404+' >');
		      $(div).html('ERROR 404<br />Page Not Found!');
			}
		},
        dataType:'html'  		
    });
    return false;
}
function _custom_alert(message,header,type,grid,fade,fadetime) {
	if(type === undefined || type == '') {
		type = 'info';
	}
	if(header === undefined || header == '') {
		header = 'Alert';
	}
	if(fade === undefined || fade == '') {
		fade = 0;
	}
	if(fadetime === undefined || fade == '') {
		fadetime = 5000;
	}
	if(type == 'error') {
		var msg = '<div class="alert-message alert-login alert alert-block alert-'+type+' fade in"><div class="ui-widget"><div class="ui-state-error ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"><p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-alert"></span><strong>'+header+'</strong><br />'+message+'</p></div><div></div>';
	}
	else {
		var msg = '<div class="alert-message alert-login alert alert-block alert-'+type+' fade in"><div class="ui-widget"><div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"><p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span><strong>'+header+'</strong><br />'+message+'</p></div><div></div>';
	}
    //$("#alert-area-login").html('<div class="alert-message alert-login alert alert-block alert-'+type+' fade in"><h4 class="alert-heading">'+header+'</h4>'+message+'</div>');
    //$("#_alert-area_"+grid).html(msg);
    //$("#alert-area-login").html('<div class="alert-message alert-login alert alert-block alert-'+type+' fade in"><h4>'+header+'</h4>'+message+'</div>');
    //if(fade == 1) {
    //	$(".alert-message").delay(fadetime).fadeOut("slow", function () { $(this).remove(); });
    //}
	showMessage(msg);
}
function custom_alert_login(message,header,type) {
	if(type === undefined || type == '') {
		type = 'info';
	}
	if(header === undefined || header == '') {
		header = 'Warning';
	}
	//$('#alert-area-login').html('<div class="alert alert-login alert-block alert-'+type+'"><a class="close" data-dismiss="alert" href="#">&times;</a><h4 class="alert-heading">'+header+'</h4>'+message+'</div>')
	if(type == 'error') {
		var msg = '<div class="alert alert-block alert-'+type+'"><div class="ui-widget"><div class="ui-state-error ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"><p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-alert"></span>'+message+'</p></div><div></div>';
	}
	else {
		var msg = '<div class="alert alert-block alert-'+type+'"><div class="ui-widget"><div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"><p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>'+message+'</p></div><div></div>';
	}
	$('#alert-area-login').html(msg);
}
function custom_alert_login_fade(message,header,type) {
	if(type == 'error') {
		var msg = '<div class="alert-message alert-login alert alert-block alert-'+type+' fade in"><div class="ui-widget"><div class="ui-state-error ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"><p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-alert"></span><strong>'+header+'</strong><br />'+message+'</p></div><div></div>';
	}
	else {
		var msg = '<div class="alert-message alert-login alert alert-block alert-'+type+' fade in"><div class="ui-widget"><div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"><p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span><strong>'+header+'</strong><br />'+message+'</p></div><div></div>';
	}
    //$("#alert-area-login").html('<div class="alert-message alert-login alert alert-block alert-'+type+' fade in"><h4 class="alert-heading">'+header+'</h4>'+message+'</div>');
    $("#alert-area-login").html(msg);
    //$("#alert-area-login").html('<div class="alert-message alert-login alert alert-block alert-'+type+' fade in"><h4>'+header+'</h4>'+message+'</div>');
    $(".alert-message").delay(3000).fadeOut("slow", function () { $(this).remove(); });
}
function _toggleCheckBoxes(td){
	if(td){
		if(td.checked){
			td.checked = false;
		}else{
			td.checked = true;
		}
		var tr = td.parentNode;
		if(tr && tr.cells){
			var l = tr.cells.length - 1;
			var cbox = tr.cells[0].childNodes[1];
			if(cbox && cbox.value){
				if(td.checked){
					cbox.value = 15;
				}else{
					cbox.value = 0;
				}
			}
			var cbox1 = tr.cells[0].childNodes[2];
			if(cbox1 && cbox1.value){
				if(td.checked){
					cbox1.value = 15;
				}else{
					cbox1.value = 0;
				}
			}
			for(var i = 1 ; i <= l ; i++){
				var tmpTd = tr.cells[i];
				var checkbox = tmpTd.childNodes[0];
				if(checkbox){
					checkbox.checked = td.checked;
				}
			}
		}
	}
}
function isNumberKey(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
    	return false;
    return true;
}
function isFloatKey(event, dis) { 
	/*var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
    	return false;
    return true;*/    
    if (event.which != 46 && (event.which < 47 || event.which > 59)) {
        event.preventDefault();
        if ((event.which == 46) && ($(dis).indexOf('.') != -1)) {
            event.preventDefault();            
        }
    }
}
// function showFileSize() {
    // var input, iLimit, FSize;

    // // (Can't use `typeof FileReader === "function"` because apparently
    // // it comes back as "object" on some browsers. So just see if it's there
    // // at all.)
    // if (!window.FileReader) {
        // alert("The file API isn't supported on this browser yet.");
        // return;
    // }
		
	// $(".multifile").each(function(){
		// if($(this).val() !=''){
			// input = $(this).get();
			// iLimit = input.length;
			// //FSize=input.files.fileSize;
			// //alert('size file= '+FSize);
		// }
    // });
    // //input = $('.multifile').get();
    // // if (!input) {
        // // alert("Um, couldn't find the fileinput element.");
    // // }
    // // else if (!input.files) {
        // // alert("This browser doesn't seem to support the `files` property of file inputs.");
    // // }
    // // else if (!input.files[0]) {
        // // alert("Please select a file before clicking 'Load'");
    // // }
    // // else {
        // // file = input.files[0];
        // // alert("File " + file.name + " is " + file.size + " bytes in size");
    // // }
// }
// function AlertFilesize(){
    // if(window.ActiveXObject){
        // var fso = new ActiveXObject("Scripting.FileSystemObject");
        // $(".multifile").each(function(){
			// if($(this).val() !=''){
				// var filepath = $(this).value;
				// var thefile = fso.getFile(filepath);
				// var sizeinbytes = thefile.size;
				// alert('if='+sizeinbytes);
			// }
		// });
		
    // }
	// else{
         // $(".multifile").each(function(){
			// if($(this).val() !=''){
				// var sizeinbytes = $(this).files[0].size;
				// alert('else= '+sizeinbytes);
			// }
		// });
		
    // }
	// // var fSExt = new Array('Bytes', 'KB', 'MB', 'GB');
    // // fSize = sizeinbytes; i=0;while(fSize>900){fSize/=1024;i++;}

    // //alert((Math.round(fSize*100)/100)+' '+fSExt[i]);
// }
function isValidFileSize( fileId, sizeLimit ) {
    var input, file, iLimit, iObj, iInc, jumSize;

    // (Can't use `typeof FileReader === "function"` because apparently
    // it comes back as "object" on some browsers. So just see if it's there
    // at all.)
    if (!window.FileReader) {
        bodyAppend("p", "The file API isn't supported on this browser yet.");
        return 2;
    }

    //input = document.getElementById('fileinput');
	//input = $("input[type=file][id^='"+fileId+"']").get();
    input = $(fileId).get();
	iLimit = input.length;
	jumSize = 0;
	
	for(iInc = 0; iInc < iLimit; iInc++) {
		iObj = input[iInc];
		//alert('isinya='+iObj.files[0]);
		if(iObj.files[0] != undefined) {
			//alert(iObj.files[0].name);
			jumSize = jumSize + iObj.files[0].size;
		}
	}
	
	if(jumSize > sizeLimit) {
		return 0;
	} else {
		return 1;
	}
}



function toNumeric(numer) {
	return numer.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')
}

function removeComma(numer) {
	return numer.replace(/,/g , "");
}

function removeTitik(numer) {
	return numer.replace(/./g , "");
}

function goScrollTo(nama) {			
	$('#form_'+nama).html('');			
	//$(window).scrollTop($("#grid_wraper_"+nama).offset().top);
	//$('html, body').animate({scrollTop: $("div#grid_wraper_"+nama).offset().top},'slow');
}
function isValidAFileSize( fileId, sizeLimit ) {
    var input, file, iLimit, iObj, iInc, jumSize,xx,yy,zz;

    // (Can't use `typeof FileReader === "function"` because apparently
    // it comes back as "object" on some browsers. So just see if it's there
    // at all.)
    if (!window.FileReader) {
        bodyAppend("p", "The file API isn't supported on this browser yet.");
        return 2;
    }

    //input = document.getElementById('fileinput');
	//input = $("input[type=file][id^='"+fileId+"']").get();
    input = $(fileId).get();
	iLimit = input.length;
	jumSize = 0;
	xx=0;yy=0; zz=0;
	//alert('input '+input+' length '+iLimit);
	
	for(iInc = 0; iInc < iLimit; iInc++) {
		iObj = input[iInc];
		//alert('isinya='+iObj.files[0]);
		//kalo undefined berarti kosong, gak ada file yg diupload
		if((iObj.files == null)||(iObj.files[0] == undefined)|| (iObj.files[0] == null) ){
			yy=1;
		}
		else{
			//alert(iObj.files[0].name);
			jumSize = iObj.files[0].size;
			//alert('size= '+jumSize);
			if(jumSize > sizeLimit) {
				//alert('size= '+jumSize);
				//alert('size limit= '+sizeLimit);
				xx=2;
			}else {
				zz=1;
			}
		}
	}
	//alert('xx='+xx+' yy='+yy+' zz='+zz);
	if(xx==2){return 0;}
	else if((xx==0)&&(yy==1)){return 1;}
	else if((zz==0)&&(yy==1)){return 1;}
	else if((yy==1)&&(zz==1)){return 1;}
	else if((yy==0)&&(zz==1)){return 1;}
}

function load_popup2(page,div,act,title,divv) {
	if(div === undefined || div == '') {
		div = '#'+divv;
	}
	if(title === undefined || title == '') {
		title = '';
	}
	if(act === undefined || act == '') {
		act = function(){$('#'+divv).dialog('close')};
	}
    //var image_load = "<div class='ajax_loading'><img src='"+loader+"' /></div>";
    $.ajax({
        url: page,
        beforeSend: function(){
            //$(div).html(image_load);
            //$('#loading_lock').css({'display':'block'});
        },
        success: function(response) {
        	if($(div).length == 0) {
        		$('#buat_content').html('<div title="'+title+'" id="'+divv+'" style="width: 880px;">' + response + '</div>');
        		$('#buat_content').dialog({
		        	modal: true,
		        	minWidth: 900,
		        	//zIndex: 999999,
		        	minHeight: 0,
		        	create: function() {
		                $(this).css("maxHeight", 650);        
		            },				    				       	
		        });
        	}
        	else {
        		$(div).html(response);
        		$(div).dialog({
		        	modal: true,
		        	minWidth: 900,
		        	//zIndex: 999999,
		        	minHeight: 0,
		        	create: function() {
		                $(this).css("maxHeight", 500);        
		            },				
		          close : function(){
		          	act();
		          }    
		        });		       
        	}      
        	 $('#buat_content').bind('dialogclose', function(event) {
				act();
		    });      
        },
        statusCode: {
		    404: function() {
		      $(div).html('ERROR 404<br />Page Not Found! :p<br /><br /><img src='+image_404+' >');
			}
		},
        dataType:'html'  		
    });
    return false;
}

function hitSisaChar(nilai, idx) {
	var hasil = 160 - nilai;
	$('#'+idx).html(hasil);
}

function setup_tinymce() {
	var url = base_url+'processor/smsc/master/imagegallery_popup';
	tinymce.init({
		theme:"advanced",
		width : 870,
		selector: "textarea.html",
		"theme_advanced_toolbar_location":"top",
		"theme_advanced_toolbar_align":"left",
		"theme_advanced_path_location":"bottom",
		"theme_advanced_buttons1_add":"fontsizeselect,pagebreak",
		"theme_advanced_buttons2_add":"imagegallery",
		"cleanup":true,
		"setup":function(ed) {
			ed.addButton("imagegallery",{title:"Image Gallery",image:"/erp/assets/images/imagegallery.gif",
				onclick:function(){								
					browse(url+'?company_id=3&modul_id=2696&group_id=60','Image Gallery');
				}
			});
		}
	});
}

function setup_tinymceweb() {
	var url = base_url+'processor/smsc/master/imagegallery_popwebsite';
	tinymce.init({
		theme:"advanced",
		width : 870,
		selector: "textarea.html",
		"theme_advanced_toolbar_location":"top",
		"theme_advanced_toolbar_align":"left",
		"theme_advanced_path_location":"bottom",
		"theme_advanced_buttons1_add":"fontsizeselect,pagebreak",
		"theme_advanced_buttons2_add":"imagegallery",
		"cleanup":true,
		"setup":function(ed) {
			ed.addButton("imagegallery",{title:"Image Gallery",image:"/erp/assets/images/imagegallery.gif",
				onclick:function(){								
					browse(url+'?company_id=3&modul_id=2696&group_id=60','Image Gallery Website');
				}
			});
		}
	});
}

$(document).ready(function () {
    $("#form_create_upb_daftar").submit(function () {
        $("#button_save_draft_daftar_upb").attr("disabled", true);
        return true;
    });
});

$(document).ready(function () {
    $("#form_create_upb_daftar").submit(function () {
        $("#button_save_daftar_upb").attr("disabled", true);
        return true;
    });
});


/*xxx*/
function send_inbox_erp(url,grid){
	var socket = io.connect( 'http://10.1.49.8:19391' );
	$.ajax({
		url: url,
		type: 'post',
		data: 'grid='+grid,
		success: function(data) {
			var o = $.parseJSON(data);
			var info = 'Info';
			var header = 'Info';
			if(o.status == true){
				nilai=o.datacount;
				datadet=o.detailinbox;
				socket.emit('new_count_message', { 
			        new_count_message: nilai
			   	});
                socket.emit('show_pop_up',{
                	datadet_inbox: datadet
                });
                //remarkasSend();
			}else{


			}
		}
	});
}

function reload_grid_new(repo='',grid='') {	
	$("#"+grid).trigger("reloadGrid");
	//send_inbox_erp(base_url+'processor/plcexport/daftar/upd/export?action=send_inbox_erp',grid);
	varsa=repo+'/'+grid;
	send_inbox_erp(base_url+'processor/schedulercheck/inbox/erp?action=sendJSONCount',varsa);
}

/*function remarkasSend(){

	$.ajax({
		url: url,
		type: 'post',
		data: 'grid='+grid,
		success: function(data) {
			var o = $.parseJSON(data);
			var info = 'Info';
			var header = 'Info';
			if(o.status == true){
				nilai=o.datacount;
				socket.emit('new_count_message', { 
			        new_count_message: nilai
			   	});
                
			}else{

				
			}
		}
	});

}*/
/*xxx*/


