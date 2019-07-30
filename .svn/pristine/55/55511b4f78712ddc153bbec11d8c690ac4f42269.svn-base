<div>
<?php 
	echo $appGrid;
?>
</div>
<script language="text/javascript">
	

	$(document).ready(function() {
		$('#btn_save').click(function() {
			var idprivi_modules  = $('#privi_modules_idprivi_modules').val();
			var vCodeModule  	 = $('#privi_modules_vCodeModule').val();
			var vNameModule  	 = $('#privi_modules_vNameModule').val();
			var vPathModule  	 = $('#privi_modules_vPathModule').val();
			var txtDesc     	 = $('#privi_modules_txtDesc').val();
			var idprivi_apps	 = $('#privi_modules_idprivi_apps').val();
			var iParent     	 = $('#privi_modules_iParent option:selected').val();
			var group       	 = $('#privi_modules_group').val();
			var module      	 = $('#privi_modules_module').val();
			var company     	 = $('#privi_modules_company').val();
			var st_updt    	 	 = $('#privi_modules_st_update').val()

			//return false;
			if (vCodeModule == '') {
				alert('Lengkapi isian Kode Module');
				$('#privi_modules_vCodeModule').focus();
				
				return false;
			}
			
			if (vNameModule == '') {
				alert('Lengkapi isian nama module');
				$('#privi_modules_vNameModule').focus();
				
				return false;
			}

			if (vPathModule == '') {
				alert('Lengkapi isian path module');
				$('#privi_modules_vPathModule').focus();
				
				return false;
			}

			if (iParent == '-') iParent = 0;
			if (st_updt == 'add') {			
				var code_modules = checkDuplicate(idprivi_apps, code_modules);
				if (code_modules > 0) {
					alert('Kode Module telah terdaftar. Periksa kembali isian anda');
					$('#privi_modules_vCodeModule').focus();
				
					return false;
				}

				var name_modules = checkDuplicate(idprivi_apps, name_modules);
				if (name_modules > 0) {
					alert('Nama Module telah terdaftar. Periksa kembali isian anda');
					$('#privi_modules_vNameModule').focus();
				
					return false;
				}
			}

			//console.log(vCodeModule);
			//return false;
		
			$.post('<?php echo base_url();?>privilege/privilege_setup_modules/save', 
				{idprivi_modules:idprivi_modules, iParent:iParent, idprivi_apps:idprivi_apps,vCodeModule:vCodeModule,vNameModule:vNameModule,vPathModule:vPathModule, txtDesc:txtDesc, st_updt:st_updt},  function(data) {
			
				var data1 = data.split('|');
				if (data1[0] > 0) {
					information_box('Data Berhasil disimpan');
					$('#privi_modules_idprivi_modules').attr('value', data1[1]);
			
					//
					oTable.fnDraw();
					$("#update_modules").dialog('close');
				}
			});			
		});

		$('#btn_cancel').click(function() {
			var modul     = $('#privi_modules_module').val();
			var group     = $('#privi_modules_group').val();
			var company   = $('#privi_modules_company').val();
			var parent_id = $('#privi_modules_idprivi_apps').val();

			$.ajax({
						'type' : 'GET',
						'data': { modul_id:modul, group_id:group, company_id:company, parent_id: parent_id, urut: 0 },						
						'url' : '<?php echo base_url();?>privilege/privilege_setup_modules/output',
						'success' : function(data) {
									$('#tab_1210').html(data);
						}
					});
		});
	});
</script>
<!-- <div id="update_modules">

</div>
 -->