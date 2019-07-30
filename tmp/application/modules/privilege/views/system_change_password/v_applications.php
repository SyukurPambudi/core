<?php 
$form_id = isset($form_id)?$form_id:'xxx';
$tab_id = 'xxx';
if($form_id!='xxx') {
	$arr_form = explode('_',$form_id);
	$id = $arr_form[1];
	
	$tab_id = 'tab_'.$id;
}
?>
<div>
<?php 
	echo $appGrid;
?>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		
		$('#<?php echo $form_id;?> button[name=btn_save]').click(function() {
			var form = $('#<?php echo $form_id;?>').serializeObject();

			$.ajax({
			    type: "POST",
			    url: "<?php echo base_url();?>/privilege/system_change_password/savePassword",
			    data : { form_data:form },
			    //data :{ gridData: gridData, gridTblData:gridTblData, formData: formData },
			    //data : { },
			    dataType:"json",
			    //contentType: "application/json",
			    //success: function(response, textStatus, xhr) {
			    success: function(data) {    
				   if(data.error) {
					   var txt = 'Error:'+data.message;
					   information_box(txt);
				   } else {
					   var txt = 'Success:'+data.message;
					   information_box(txt);
				   }
			    }
			});
		});
		$('#<?php echo $form_id;?> button[name=btn_cancel]').click(function() {
			var modul   = $('#employee_module').val();
			var group   = $('#employee_group').val();
			var company = $('#employee_company').val();
			$.ajax({
				'type' : 'GET',
				'data': { modul_id:modul, group_id:group, company_id:company, parent_id: 0, urut: 0 },						
				'url' : '<?php echo base_url();?>privilege/system_change_password/output',
				'success' : function(data) {
					$('#<?php echo $tab_id;?>').html(data);
				}
			});
		});
	});

</script>