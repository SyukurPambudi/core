<div>
<?php 
	echo $appGrid;
?>
</div>
<script language="text/javascript">
	$(document).ready(function() {
		$('.btn').button();
		$('#btn_cancel').click(function() {			
			alert('Hore');
		});
	});

	function proses_simpan() {
		var iID_GroupApp   = $('#privi_group_pt_app_iID_GroupApp').val();
		var iCompanyId     = $('#privi_group_pt_app_iCompanyId option:selected').val();
		var idprivi_apps   = $('#privi_group_pt_app_idprivi_apps').val();
		var idprivi_group  = $('#privi_group_pt_app_idprivi_group').val();
		var vNamaGroup     = $('#privi_group_pt_app_vNamaGroup').val();
		var txtDesc        = $('#privi_group_pt_app_txtDesc').val();
		var st_updt        = $('#privi_group_pt_app_st_update').val();
		var module_id      = $('#privi_group_pt_app_module').val();	

		if (st_updt == 'add') {
			idprivi_group = getLastGroupId(iCompanyId, idprivi_apps);
			$('#idprivi_group').attr('value', idprivi_group);
		}
		
		$.post('<?php echo base_url();?>privilege/setup_groups/save', 
			{iID_GroupApp:iID_GroupApp,iCompanyId:iCompanyId,idprivi_apps:idprivi_apps,idprivi_group:idprivi_group,vNamaGroup:vNamaGroup,txtDesc:txtDesc,st_updt:st_updt},  function(data) {
			
			var data1 = data.split('|');
			if (data1[0] > 0) {
				information_box('Data saved successfully');
				$('#privi_group_pt_app_iID_GroupApp').attr('value', data1[1]);
			
				//
				jQuery('#grid_'+module_id).trigger('reloadGrid');
			}
		}); 
	}

	function getLastGroupId(iCompanyId, idprivi_apps) {
		return $.ajax({
			type: 'GET', 
			'url'  : '<?php echo base_url();?>privilege/setup_groups/getLastGroupId',
			'data' : 'iCompanyId='+iCompanyId+'&idprivi_apps='+idprivi_apps,
			async:false
		}).responseText
	}
</script>
