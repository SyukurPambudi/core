<?php
$ci =& get_instance();
?>
<style type="text/css">
	.error_text {
		background: #FFBBBB;
		border: solid 1px #FF0000; 
	}
	.error_text:focus {
		background: #FFCCCC;
		border: solid 1px #FF0000; 
	}	
	#page {
		width: 480px;
		padding: 20px 40px 20px 40px;
		margin: 40px auto 40px auto;
		border: 1px solid #e1e1e1;
	}


	#toTop_<?php echo $url;?> {
		display: block;
		position: fixed;
		top: 96%;
		right: 79%;
		color:#FFFFFF;
		padding: 10px;
		border: 1px solid #A1CCEE;
		background: #F21A1A;

	}
</style>
<script type='text/javascript'>
$("#toTop_<?php echo $url;?>").click(function(event){
	event.preventDefault();
	goScrollTo('<?php echo $url;?>');
});
</script>
<div class="boxContent" style='overflow:auto;'>
	<div class="box_dropdown">
		<div class="top_head title" id="">
			<span class="head_tabs"><?php echo $ci->lang->line('form_view').str_replace('\\', '', $title); ?></span>
		</div>
		<div class="content">
			<div class="box_content_form">
				<div class="full_colums">
					<form class="form_horizontal_plc" method="post" action="<?php echo $form_action ?>" id="form_update_<?php echo $url ?>">
						<?php
						echo '<input type="hidden" id="'.$url.'_'.$pk.'" value="'.$id.'" name="'.$pk.'">';
							//print_r($theFields);
							//exit;
							foreach($theFields as $f) {
								if($f['type'] == 'hidden') {
									echo '<input type="hidden" id="'.$url.'_'.$f['field'].'" value="'.$f['value'].'" name="'.$f['field'].'">';
								}
								else {
									if($f['required'] == TRUE) {
										$reqClass = 'required';
										$reqSimbol = '<span class="required_bintang">*</span>';
									}
									else {
										$reqClass = '';
										$reqSimbol = '';
									}
									
									echo '<div class="rows_group" style="overflow:auto;">';
									echo '<label for="'.$url.'_'.$f['field'].'" class="rows_label">'.$f['label'].' '.$reqSimbol.'</label>';
									echo '<div class="rows_input">';
									switch ($f['type']) {
										case 'text':
											echo $f['value'];
											break;
										case 'combobox':
											echo $f['source'][$f['value']];
											//echo form_dropdown($f['field'], $f['source'],$f['value'],' class="'.$reqClass.' combobox" id ="'.$url.'_'.$f['field'].'"');
											break;
										case 'date':
											echo $f['value'];
											break;
										case 'datetime':
											echo $f['value'];
											break;
										case 'free':
											if($f['source'] == '') {
												echo '<input type="text" id="'.$url.'_'.$f['field'].'" value="'.$f['value'].'" name="'.$f['field'].'" class="input_rows1">';
											}
											else {
												echo $f['source'];
											}
											break;
										case 'int' :
											echo $f['value'];
											break;
										case 'float,' :
											echo $f['value'];
											break;
										default:
											if(substr($f['type'], 0, 4) == 'enum') {
												$val = substr($f['type'], 4);
												$new_val = str_replace("'", "", explode(",", $val));
												$dd = array();
												foreach($new_val as $k => $v) {
													$dd[$v] = $v;
												}
												//echo form_dropdown($f['field'], $dd,$f['value'],' class="'.$reqClass.' combobox" id ="'.$url.'_'.$f['field'].'"');
												echo $dd[$f['value']];
											}
											else {
												echo $f['value'];
											}
											break;
									}
									echo '</div>';
									echo '</div>';	
								}							
								
							}
						?>						
					</form>
					<!-- <em><span class="required">*</span> Fields Required</em>  -->
				</div>
				<div class="clear"></div>
				<div class="control-group-btn">
					<div class="left1-control-group-btn">
						<!--<span class="ui-button-text icon-print">Print</span>
						<span>
							<input type="radio" name="group2" value="Water">
							Screen</span>
						<span>
							<input type="radio" name="group2" value="Beer">
							Printer</span>-->
					</div>
					<div class="left-control-group-btn">
						<?php
							
							if(is_array($buttons)) {
								foreach($buttons as $k => $v) { 
									if ($k != 'goTop') {
										echo $v;
									}
								}
							}
						?>
						<!--<button onclick="javascript:update_btn('<?php echo $url ?>', '<?php echo base_url().$url ?>', this)" class="ui-button-text icon-save" id="<?php echo $button_update_id ?>">Update</button>
						<button onclick="javascript:update_btn_back('<?php echo $url ?>', '<?php echo base_url().$url ?>', this)" class="ui-button-text icon-save" id="<?php echo $button_update_back_id ?>">Update &amp; Back to list</button>
						<button onclick="javascript:cancel_btn('<?php echo $url ?>', '<?php echo base_url().$url ?>')" class="ui-button-text icon-cancel" id="<?php echo $button_cancel_id ?>">Cancel</button>-->
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>
<a id="toTop_<?php echo $url;?>" href="#" style='text-decoration:none;'>Hide Detail</a>