<script type="text/javascript">
$(document).ready(function() {
	//kalo pake: live('click',function(e){}) , suka aneh ..
	$("<?php echo $trigger;?>").click(function(e) {
		e.preventDefault();

		var form = $("<?php echo $form;?>");
		var url = "<?php echo base_url().$url?>";
	
		$.ajax( {
	      type: "POST",
	      url: url,
	      data: form.serialize(),
	      success: function( response ) {
	        alert(response);
	      }
	    });
	});
});
</script>