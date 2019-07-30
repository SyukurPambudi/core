<div>
<?php 
	echo $appGrid;
?>
</div>
<script language="text/javascript">
	$(document).ready(function() {
		$('.btn').button();
		$('#btn_cancel_0').live('click', function() {					
			$("#update_groups").dialog('close');
		});

		$('#btn_save').click(function() {
			var iID_GroupApp   = $('#privi_group_pt_app_iID_GroupApp').val();
			var iCompanyId     = $('#privi_group_pt_app_iCompanyId option:selected').val();
			var idprivi_apps   = $('#privi_group_pt_app_idprivi_apps').val();
			var idprivi_group  = $('#privi_group_pt_app_idprivi_group').val();
			var vNamaGroup     = $('#privi_group_pt_app_vNamaGroup').val();
			var txtDesc        = $('#privi_group_pt_app_txtDesc').val();
			var st_updt        = $('#privi_group_pt_app_st_update').val();
			var module_id      = $('#privi_group_pt_app_module').val();
			var group_id       = $('#privi_group_pt_app_group').val();
			var company_id     = $('#privi_group_pt_app_company').val();

			//console.log(iCompanyId);
			if (iCompanyId == '-') {
				alert('Company is mandatory');
				$('#privi_group_pt_app_iCompanyId').focus();

				return false;
			}

			if (st_updt == 'add') {
				idprivi_group = getLastGroupId(iCompanyId, idprivi_apps);
				$('#privi_group_pt_app_idprivi_group').attr('value', idprivi_group);
			
				if (vNamaGroup == '') {
					alert('Group Name is mandatory');
					$('#privi_group_pt_app_vNamaGroup').focus();

					return false;
				} else {
					var nama_group = checkDuplicate(iCompanyId, idprivi_apps);
					if (nama_group == vNamaGroup) {
						alert('Group Name is registered. Please check your form');
						$('#privi_group_pt_app_vNamaGroup').focus();
				
						return false;
					}
				}
			}

			if (vNamaGroup == '') {
				alert('Group Name is mandatory');
				$('#privi_group_pt_app_vNamaGroup').focus();

				return false;
			}
	
			var checkbox_var = '';
			var checkbox_val = '';
			var checkbox_var_arr = {};
			var jwb = confirm('Anda yakin ?');
			if (jwb == 1) {
				var parameter = $('form').serializeObject();
				$(':input[type=checkbox]').each(function() {
					var id = $(this).attr('id');
					if ($('#'+id).is(':checked')) {
						checkbox_var_arr[id] = 	$('#'+id).val();				
					} else {
						checkbox_var_arr[id] = 	0;
					}
				});

				//console.log(checkbox_var_arr.length);
				//console.log(parameter);
				//console.log(checkbox_var_arr);
				//return false;
				$.post('<?php echo base_url();?>privilege/privilege_setup_groups_dtl/save', {checkbox_var:checkbox_var_arr,parameter:parameter}, function(data) {					
					var data1 = data.split('|');
					if (data1[0] > 0) {						
						alert_box('Data saved successfully');	

						$('#privi_group_pt_app_iID_GroupApp').attr('value', data1[1]);	
						$('#privi_group_pt_app_st_update').attr('value', 'edit');
						$('#privi_group_pt_app_id_process').attr('value', 'edit');	
	
						$.ajax({
							'url' : '<?php echo base_url();?>privilege/privilege_setup_groups_dtl/processForm',
							'data' : 'id='+data1[1]+'&proc=edit&group_id='+group_id+'&modul_id='+module_id+'&company_id='+company_id+'&parent_id='+idprivi_apps,
							'success' : function(data) {
									oTable.fnDraw();
									$('#error').hide();
							}
						});
					}			
				});
			}			
		});

		$('#btn_cancel').click(function() {
			var modul = $('#privi_group_pt_app_module').val();
			var group = $('#privi_group_pt_app_group').val();
			var company = $('#privi_group_pt_app_company').val();
			var parent_id = $('#privi_group_pt_app_idprivi_apps').val();

			$.ajax({
						'type' : 'GET',
						'data': { modul_id:modul, group_id:group, company_id:company, parent_id: parent_id, urut: 0 },						
						'url' : '<?php echo base_url();?>privilege/privilege_setup_groups_dtl/output',
						'success' : function(data) {
									$('#tab_1230').html(data);
						}
					});
		});
	});

	function getLastGroupId(iCompanyId, idprivi_apps) {
		return $.ajax({
			type: 'GET', 
			'url'  : '<?php echo base_url();?>privilege/privilege_setup_groups_dtl/getLastGroupId',
			'data' : 'iCompanyId='+iCompanyId+'&idprivi_apps='+idprivi_apps,
			async:false
		}).responseText
	}
	
	function checkDuplicate(iCompanyId, idprivi_apps) {
		return $.ajax({
			type: 'GET', 
			'url'  : '<?php echo base_url();?>privilege/privilege_setup_groups_dtl/checkDuplicate',
			'data' : 'iCompanyId='+iCompanyId+'&idprivi_apps='+idprivi_apps,
			async:false
		}).responseText
	}
	
	function deleteRecord(id) {
		return $.ajax({
			type: 'GET', 
			'url'  : '<?php echo base_url();?>privilege/privilege_setup_groups_dtl/deleteRecord',
			'data' : 'id='+id,
			async:false
		}).responseText
	}
</script>
<div id="update_groups">

</div>
<!-- <div id="modules">
	<table>
		<thead>
			<tr>				
				<th>Nama Module</th>
				<th>Read</th>
				<th>Create</th>
				<th>Update</th>
				<th>Delete</th>
			</tr>
		</thead>		
	</table>
	<script type="text/javascript">
		$(document).ready(function() {

		});
	</script>
</div>
 -->