<div>
<?php 
	echo $appGrid;
?>
</div>
<script language="text/javascript">
	$(document).ready(function() {
		$('.btn').button();		

		$('#btn_cancel_0').click(function() {
			var modul     = $('#privi_authlist_module').val();
			var group     = $('#privi_authlist_group').val();
			var company   = $('#privi_authlist_company').val();
			var parent_id = $('#privi_authlist_cNIP').val();

			$.ajax({
						'type' : 'GET',
						'data': { modul_id:modul, group_id:group, company_id:company, parent_id: parent_id, urut: 0 },						
						'url' : '<?php echo base_url();?>privilege/privilege_setup_group_access/output',
						'success' : function(data) {
									$('#list_apps').parent().html('');
									$('#list_groups').parent().html('');
									$('#tab_1270').html(data);
						}
					});
		});

		$('#btn_save_0').click(function() {
			var cNip       = $('#privi_authlist_cNIP').val();
			var companyId  = $('#privi_authlist_iCompanyId option:selected').val();
			var aplikasiId = $('#privi_authlist_idprivi_apps').val();
			var groupId    = $('#privi_authlist_idprivi_group').val();
			var company    = $('#privi_authlist_company').val();
			var stUpdate   = $('#privi_authlist_st_update').val();

			if (companyId == '-') {
				alert('Kode Perusahaan wajib diisi');
				$('#privi_authlist_iCompanyId').focus();

				return false;
			}

			if (aplikasiId == '' || aplikasiId == '0') {
				alert('Kode Aplikasi wajib diisi');
				$('#privi_authlist_idprivi_apps').focus();

				return false;
			}

			if (groupId == '' || groupId == '0') {
				alert('Kode Group wajib diisi');
				$('#privi_authlist_idprivi_group').focus();

				return false;
			}

		
			if (stUpdate == 'add') {
				var isDupl = checkDuplicate(cNip, companyId, aplikasiId, groupId);
				if (isDupl > 0) {
					alert('Group Access telah terdaftar. Periksa kembali isian anda');
					return false;
				}	
			}		

			var jwb = confirm('Anda yakin ?');
			if (jwb == 1) {
				var parameter = $('form').serializeObject();
				$.post('<?php echo base_url();?>privilege/privilege_setup_group_access/save', {parameter:parameter}, function(data) {
					var data1 = data.split('|');
					if (data1[0] > 0) {
						alert_box('Data berhasil disimpan');
						$('#privi_authlist_iID_Authlist').attr('value', data1[1]);
						$('#privi_authlist_st_update').attr('value', 'edit');
						$('#privi_authlist_id_process').attr('value', 'edit');
					}
				});
			}
		});

		$('#bt_privi_authlist_idprivi_apps').live('click', function() {
			 $( "#list_apps" ).dialog({
				height: 'auto',
				width: 'auto',
				modal: true,
				title: 'Application',
			 });
		});

		$('#bt_privi_authlist_idprivi_group').live('click', function() {
			 $( "#list_groups" ).dialog({
				height: 'auto',
				width: 'auto',
				modal: true,
				title: 'Groups',
			 });
		});
		
	});
	
	function deleteRecord(id) {
		return $.ajax({
			type: 'GET', 
			'url'  : '<?php echo base_url();?>privilege/privilege_setup_group_access/deleteRecord',
			'data' : 'id='+id,
			async:false
		}).responseText
	}

	function checkDuplicate(cNip, companyId, aplikasiId, groupId) {
		return $.ajax({
			type: 'GET', 
			'url'  : '<?php echo base_url();?>privilege/privilege_setup_group_access/checkDuplicate',
			'data' : 'cNip='+cNip+'&companyId='+companyId+'&aplikasiId='+aplikasiId+'&groupId='+groupId,
			async:false
		}).responseText
	}
</script>