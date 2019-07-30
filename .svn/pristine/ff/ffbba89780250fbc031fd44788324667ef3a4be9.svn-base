<?php 
$id=isset($id)?$id:'';
$appGrid=isset($appGrid)?$appGrid:'';
?>
<ul id="iconsSlide_<?php echo $id;?>" class="iconsSlide ui-widget ui-helper-clearfix ui-helper-hidden">
	<li class="ui-state-default ui-corner-all" id="cycleNext_<?php echo $id;?>">
		<span  class="ui-icon ui-icon-circle-triangle-e" ></span>
	</li>
	<li class="ui-state-default ui-corner-all" id="cyclePrev_<?php echo $id;?>">
		<span  class="ui-icon ui-icon-circle-triangle-w"></span>
	</li>
</ul>

<div style="position:relative;">
	<div id ="app_<?php echo $id;?>" style="height:500px;width:900px!important;">
		<div class="cycle appGrid"><?php echo isset($appGrid)?$appGrid:"";?></div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	//create obj element slider
	$cycle_obj_<?php echo $id;?> = $('#app_<?php echo $id;?>');

	//create default first slider
	cycleNew_<?php echo $id?>(0); //generate slider

	$('#iconsSlide_<?php echo $id;?> li').hover(
		function() { $('#iconsSlide_<?php echo $id;?> li').addClass('ui-state-hover'); },
		function() { $('#iconsSlide_<?php echo $id;?> li').removeClass('ui-state-hover'); }
	);
});
function cycleClear_<?php echo $id?>() {
	//clear slider, back to default
	if ($cycle_obj_<?php echo $id;?> && ($cycle_obj_<?php echo $id;?>.children().length > 1)) {
		$cycle_obj_<?php echo $id;?>.cycle('destroy');
		$cycle_obj_<?php echo $id;?>.find('div.cycle').not('.appGrid').remove();
	}
}
function cycleNew_<?php echo $id?>( currSlide ) {
	//build slider
	$cycle_obj_<?php echo $id;?>.cycle({
		fx:     'scrollLeft', 
	    speed:  'fast', 
	    timeout: 0, 
	    next:   '#cycleNext_<?php echo $id;?>', 
	    prev:   '#cyclePrev_<?php echo $id;?>',
	    slideExpr:'div.cycle',
	    startingSlide: currSlide,
	    //before:onBefore,
	    after:onAfter_<?php echo $id;?>,
	});

	//check if only 1 slide, not show button prev/next
	if ( $cycle_obj_<?php echo $id;?> && ($cycle_obj_<?php echo $id;?>.children().length == 1)) {
		$('#app_<?php echo $id;?>').find('div.cycle').first().css('left','0px').show();
		//$('#cycleNext_<?php echo $id;?>').hide();
		//$('#cyclePrev_<?php echo $id;?>').hide();
	} else if( $cycle_obj_<?php echo $id;?> && ($cycle_obj_<?php echo $id;?>.children().length > 1)) {
		//$('#cycleNext_<?php echo $id;?>').show();
		//$('#cyclePrev_<?php echo $id;?>').show();
	}
}
function cycleAdd_<?php echo $id?>( html ) {
	//add slide to slider, and get content html
	if( html != undefined ) {
		$cycle_obj_<?php echo $id;?>.cycle('destroy'); //delete slider
		$cycle_obj_<?php echo $id;?>.append('<div class="cycle">'+html+'</div>');
		var count_div = $cycle_obj_<?php echo $id;?>.find("div.cycle").length-1;
		cycleNew_<?php echo $id?>(count_div);//generate ulang slider
	}
}
function cycleClose_<?php echo $id?>(obj) {
	//close current slider
	$cycle_obj_<?php echo $id;?>.cycle('destroy');
	obj.closest('div.cycle').remove();
	var count_div = $("div.cycle").length-1;
	cycleNew_<?php echo $id?>(count_div);
}
function cycleNext_<?php echo $id?>() { //trigger button next function
	$("#cycleNext_<?php echo $id;?>").trigger('click');
}
function cyclePrev_<?php echo $id?>() { //trigger button prev function
	$("#cyclePrev_<?php echo $id;?>").trigger('click');
}
function onAfter_<?php echo $id?>(curr, next, opts, fwd) {
	//draw ulang height container
	var $ht = $(this).height();
	var $wt = $(this).width();
	$(this).parent().height($ht).width($wt); 

	//check slide if end / start of slide
	var index = opts.currSlide;
	$('#iconsSlide_<?php echo $id;?>').show();
	$('#cyclePrev_<?php echo $id;?>')[index == 0 ? 'hide' : 'show']();
    $('#cycleNext_<?php echo $id;?>')[index == opts.slideCount - 1 ? 'hide' : 'show']();
	
}
</script>
