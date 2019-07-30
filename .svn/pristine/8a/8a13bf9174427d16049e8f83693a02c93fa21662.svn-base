<div>
<?php 
	echo $appGrid;
?>
</div>
<script type="text/javascript">
	$(document).ready(function() {		
		$('#btn_save').click(function() {
			var parameter = $('#form_2331').serializeObject();
			 $.ajaxFileUpload({
				 url: '<?php echo base_url();?>privilege/authlist/save_employee',
				 secureuri: false,
				 fileElementId: 'privi_authlist_tAttachment',
				 dataType: 'json',
				 success: function (xml, status){
					
				 }
			  });
		});
	});
</script>
 