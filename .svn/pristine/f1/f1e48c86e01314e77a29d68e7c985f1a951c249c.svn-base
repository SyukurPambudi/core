
function open_detail_sample(theclass, dis) {
	$('.input_sample_toggle').slideUp();
	var ix = $('.btn_input_sample_detail').index(dis);
	$('.input_sample_toggle').eq(ix).slideToggle();
}
//cek terima sample bahan baku
// $('.add').live('change', function() {
    // var total = 0;
    // var maks = 0;
	// //var ix = $('.add').index($(this));
    	// $(".add").each(function(){
			// if($(this).val() !=''){
				// total += parseFloat($(this).val());
			// }
    	// });
	// maks=parseFloat($('#bahan_baku_terima_sample_ijumlah').val());
	// sisa=maks-(total-parseFloat($(this).val()));
	// if(sisa<0){sisa=0;}
	// //alert(sisa);
	// if((total.toFixed(2)) > (maks.toFixed(2))){
		// $(this).val(sisa);
		// alert("Tidak boleh melebihi jumlah terima Purchasing !");
		// //$('#button_bahan_baku_terima_sample').attr('disabled',true);
	// }
	
	// //alert(maks.toFixed(2)+'-'+total.toFixed(2));
// })

// //cek penerimaan sample
// $('.detjum_pr').live('change', function() {
	// var total = 0;
    // var maks = 0;
	// var ix = $('.detjum_pr').index($(this));
	// maks=parseFloat($('.detjumlah').eq(ix).val());
	// total=parseFloat($(this).val());
	// if((total.toFixed(2)) > (maks.toFixed(2))){
		// alert("Tidak boleh melebihi jumlah permintaan !");
		// $(this).val(maks);
	// }
	
	// //alert($(this).val());	
// })

// //cek stabilita pilot nya basic formula length <=2
// //cek penerimaan sample
// $('.dua').live('change', function() {
	// var total = $(this).val();
	// if((total.length)>2){
		// alert('Tidak boleh lebih dari Dua Angka !');
		// $(this).val('0');
	// }
 // })


$('#btn_save_plc_input_sample_originator').live('click', function(){
	//alert($('#form_update_upb_input_sample_originator').attr('action'));
	custom_confirm('Anda Yakin?', function(){
		return $.ajax({
			url: $('#form_update_upb_input_sample_originator').attr('action'),
			type: $('#form_update_upb_input_sample_originator').attr('method'),
			data: $('#form_update_upb_input_sample_originator').serialize(),
			success : function(resp) {
	        	var o = $.parseJSON(resp);
				//alert('aaa'+o.status);
	        	if(o.status == true) {
					info = 'info';
					header = 'Info';
	        		_custom_alert(o.message,header,info,'#form_upb_input_sample_originator', 1, 20000);
	        		$('#grid_upb_input_sample_originator').trigger('reloadGrid');
						 $.get(base_url+'processor/plc/upb/input/sample/originator?action=update&id='+$('#iupb_id').val()+'&foreign_key=0&company_id='+$('#company_id').val()+'&group_id='+$('#group_id').val()+'&modul_id='+$('#modul_id').val(), function(data) {
							 $('div#form_upb_input_sample_originator').html(data);
	    				 })
					//edit_btn(base_url+'processor/plc/upb/input/sample/originator?action=update&id='+$('#iupb_id').val()+'&company_id='+$('#company_id').val()+'&group_id='+$('#group_id').val()+'&modul_id='+$('#modul_id').val()+'','#form_update_upb_input_sample_originator');
					//$('#grid_update_upb_input_sample_originator').trigger('reloadGrid');
	        	}
	        	else {
	        		info = 'info';
					header = 'Info';
					//_custom_alert('Error!',header,info,'#form_update_upb_input_sample_originator', 1, 20000);
					alert('Error! Isi Tanggal Pengirim dan Pengirim!');
	        	}        	
	        }
		}).responseText;
	})
})

//tambahan untuk PO Sample
$('#sample_po_sample_itype').live('change', function() {
	if($(this).val()==1){ //free
		$('#sample_po_sample_vpo_nomor').attr('disabled',true);
		$('#sample_po_sample_vpo_nomor').val('auto generate');
	}
	else{
		$('#sample_po_sample_vpo_nomor').val('');
		$('#sample_po_sample_vpo_nomor').removeAttr('disabled');
	}
})
