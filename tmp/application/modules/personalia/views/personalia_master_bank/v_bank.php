<div>
<?php 
	echo $appGrid;
?>
</div>
<script type="text/javascript">
	$(document).ready(function() {		
		$('#btn_save_1').click(function() {
			var groups = '';
			var apps = '';
			var id = '';
			var app_id = '';
			var employee_cNip = '';
			$(':input[type=radio]:checked').each(function() {
				id = $(this).attr('id');	
				app_id = ($('input[name='+id+']:checked').attr('id')).split('_');						
				groups += $('input[name='+id+']:checked').val()+',';	
				apps += app_id[2]+',';			
			});

			groups = groups.substring(0, groups.length - 1);
			apps = apps.substring(0, apps.length - 1);
			employee_cNip = $('#employee_cNip').val();

			if ( apps.length > 0 ) {
				var jwb = confirm( 'Anda yakin ingin menyimpan ?' );
				if (jwb == 1) {
					$.post('<?php echo base_url();?>privilege/employee/save_employee', {employee_cNip:employee_cNip, apps:apps, groups:groups}, function(data) {
						if ( data > 0 ) {
							information_box( 'Data berhasil disimpan' );
						}
					});
				}
			}
		});
		
	});
</script>