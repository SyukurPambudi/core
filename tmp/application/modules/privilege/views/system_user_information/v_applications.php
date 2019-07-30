<div>
<?php 
	echo $appGrid;
?>
</div>
<script type="text/javascript">
	$(document).ready(function() {		
		var nip = '';
		var nama = '';
		var pass1 = '';
		var pass2 = '';
		var email = '';
		var stUpdate = '';
		$('#btn_save').click(function() {
			//alert($("#privi_password_vPassword1").val());
			nip   = $("#employee_cNIP").val();
			nama  = $("#employee_vName").val();
			pass1 = $("#employee_vPassword1").val();
			pass2 = $("#employee_vPassword2").val();
			email = $("#employee_vEmail").val();
			stUpdate = $("#employee_st_update").val();
			group_id = $("#employee_group").val();
			modul_id = $("#employee_module").val();
			company_id = $("#employee_company").val();
			
			if (nip == '') {
				alert_box('Lengkapi kolom NIP');
				$('#employee_cNIP').select();
				
				return false;
			}
			
			if (nama == '') {
				alert_box('Lengkapi kolom Nama');
				$('#employee_vName').select();
				
				return false;
			}
			
			if (stUpdate == 'add') {
				if (pass1 == '') {
					alert_box('Lengkapi kolom Password');
					$('#employee_vPassword1').select();
					
					return false;
				}
				
				if (pass2 == '') {
					alert_box('Lengkapi kolom Confirm Password');
					$('#employee_vPassword2').select();
					
					return false;
				}
				
				if (pass1 != pass2) {
					alert_box('Password tidak cocok. Ulangi');
					$('#employee_vPassword2').select();
					
					return false;
				}
			} else {
				if (pass1 != pass2) {
					alert_box('Password tidak cocok. Ulangi');
					$('#employee_vPassword2').select();
					
					return false;
				}
			}
			
			if (email == '') {
				alert_box('Lengkapi kolom Email');
				$('#employee_vEmail').select();
				
				return false;
			}
			
			if (!isValidEmailAddress(email)) {
				alert_box('Email tidak valid');
				$('#employee_vEmail').select();
				
				return false;
			}
			
			var parameter = $('form').serializeObject();
			$.get("<?php echo base_url();?>privilege/system_user_information/save_information",{ parameter:parameter }, function(data) {  
			   var data1 = data.split('|');
			   if (data1[0] > 0) {
					alert_box("Data berhasil disimpan");
					$('#employee_st_update').attr('value', 'edit');
					$('#employee_id_process').attr('value', 'edit');
					
					$.ajax({
						'url' : '<?php echo base_url();?>privilege/system_user_information/processForm',
						'data' : 'id='+data1[1]+'&proc=edit&group_id='+group_id+'&modul_id='+modul_id+'&company_id='+company_id,
						'success' : function(data) {
							$('#tab_382').html(data);
						}
					});
			   } else {
					alert_box("Data Gagal disimpan");
					return false;
			   }
			});
		});
		
		$('#btn_cancel').click(function() {
			group_id = $("#employee_group").val();
			modul_id = $("#employee_module").val();
			company_id = $("#employee_company").val();
			
			$.ajax({
				'type' : 'GET',
				'data': 'company_id='+company_id+'&modul_id='+modul_id+'&group_id='+group_id+'&company_id'+company_id,						
				'url' : '<?php echo base_url();?>privilege/system_user_information/output',
				'success' : function(data) {
							$('#tab_382').html(data);
				}
			});
		});
		
		//tab_382
	});
</script>