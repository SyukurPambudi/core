<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.cycle.js"></script>
<div id ="app_<?php echo isset($id)?$id:"";?>" style="height:500px;">
<div class="appGrid"><?php echo isset($appGrid)?$appGrid:"";?></div>
<div class="appForm"></div> <!-- pake ngajax -->
</div>
<div id="cycleBtn_<?php echo isset($id)?$id:"";?>" style="float:left;clear:both;display:none;">&nbsp;</div>
<script type="text/javascript">
$(document).ready(function() {
	$('#app_<?php echo isset($id)?$id:"";?>').cycle({
		fx:     'fade', 
	    speed:  'fast', 
	    timeout: 0, 
	    next:   '#cycleBtn_<?php echo isset($id)?$id:"";?>', 
	});
	
});
function cycleBack_<?php echo isset($id)?$id:"";?>() {
	$("#cycleBtn_<?php echo isset($id)?$id:"";?>").trigger('click');
}
</script>