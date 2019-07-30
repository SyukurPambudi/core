<?php
	$ur = explode('/', $the_url);
	if(count($ur) > 1) {
		$the_url = $ur[0].'_'.$ur[1];
	}
	else {
		$the_url = $ur[0];
	}
	$the_url = $ur[0];
?>
<div id="_alert-area_<?php echo $the_url ?>"></div>
<div id="grid_wraper_<?php echo $the_url ?>">
	<div id="grid_search_<?php echo $the_url ?>">
		<div class="full_colums">
			<div class="top_form_head">									
				<span class="form_head top-head-content"> <img class="img_search " src="<?php echo $_theme ?>assets/images/Search-icon.png" /> 
				<?php echo str_replace('\\', '', $sarch_caption); ?>  </span>
				<span class="top-icon ui-icon ui-icon-carat-1-s"></span>
			</div> 
			<div class="clear"></div>
			<div class="content-table">
				<div class="left_colums2">
					<div class="form_horizontal_plc">
				<?php
					if(is_array($search) && count($search)) {
						//echo '<pre>';print_r($search);echo '</pre>';
						$jcs = count($search);
						$lc = ceil($jcs/2);
						$rc = $jcs - $lc;
						//echo $jcs.' '.$lc.' '.$rc;
						$cn = 0;					
						foreach($search as $s) {
							if($cn == $lc) {
								echo '</div></div><div class="right_colums2"><div class="form_horizontal_plc">';
							}
							//echo '<div class="form_horizontal_plc">';
								echo '<div class="rows_group" style="overflow:auto;">';
								if($s['ftype'] == 'datetime' || $s['ftype'] == 'date') {
									echo '<label class="rows_label" for="'.$s['id'].'">'.$s['label'].'</label>';
									echo '<div class="rows_input select_rows">';
										echo ' Between <input class="input_tgl datepicker" type="text" id="'.$s['source']['start']['id'].'" name="'.$s['source']['start']['id'].'"> and ';									
										echo '<input class="input_tgl datepicker" type="text" id="'.$s['source']['end']['id'].'" name="'.$s['source']['end']['id'].'">';
									echo '</div>';							
								}
								elseif($s['ftype'] == 'replace') {
									echo '<label class="rows_label" for="'.$s['id'].'">'.$s['label'].'</label>';
									echo '<div class="rows_input select_rows">';
										echo $s['source'];
									echo '</div>';
								}
								elseif($s['ftype'] == 'combobox') {
									echo '<label class="rows_label" for="'.$s['id'].'">'.$s['label'].'</label>';
									echo '<div class="rows_input select_rows">';
										echo form_dropdown($s['name'],$s['source'], '', 'id = "'.$s['id'].'" class="combobox"');
									echo '</div>';
								}
								else {
									if(substr($s['ftype'], 0, 4) == 'enum') {
										$val = substr($s['ftype'], 4);
										$new_val = str_replace("'", "", explode(",", $val));
										$dd = array(''=>'--Select--');
										foreach($new_val as $k => $v) {
											$dd[$v] = $v;
										}
										echo '<label class="rows_label" for="'.$s['id'].'">'.$s['label'].'</label>';
										echo '<div class="rows_input">';
											echo form_dropdown($s['name'],$dd, '', 'id = "'.$s['id'].'" class="combobox"');
										echo '</div>';
									}
									else {
										echo '<label class="rows_label" for="'.$s['id'].'">'.$s['label'].'</label>';
										echo '<div class="rows_input">';
											echo form_input($s);
										echo '</div>';
									}																		
								}
								echo '</div>';
							//echo '</div>';
							$cn++;			
						}
					}
				?>
					</div>
				</div>			
				<div class="clear"></div>
				<div class="control-group-btn">
					<div class="left-control-group-btn">
						<?php
							echo form_button('btn_search_'.$the_url,'Search','onClick ="javascript:reload_grid(\'grid_'.$the_url.'\');", class="icon-search" ,id = btn_search_'.$the_url);
							echo form_button('btn_search_reset_'.$the_url,'Reset Search','onClick ="javascript:reset_grid(\'grid_search_'.$the_url.'\',\'grid_'.$the_url.'\');", class="icon-clear" ,id = btn_search_reset_'.$the_url);
						?>									
					</div>
					
				</div>
			</div>								
		</div>
	</div>
	<div class="clear"></div>
	<div class="grid-list">
		<div style="width: 850px;">
			<table id="grid_<?php echo $the_url ?>"></table>
			<div id="pager_<?php echo $the_url ?>"></div>
			<?php echo $grid; ?>
			<div class="tambah">
				<?php
					foreach($button as $b) {
						$btnClass = $b['class'] == 'addBtn' ? 'icon-add' : 'icon-clear';
						$jsFunc = $b['class'] == 'addBtn' ? 'edit_btn' : 'del_btn';
						echo '<button type="button" name="'.$b['name'].'" id="'.$b['id'].'" class="'.$btnClass.'" onClick="javascript:'.$jsFunc.'(\''.$b['url'].'\',\''.$the_url.'\')">'.$b['label'].'</button>';
					}
				?>	
			</div>
		</div>
	</div>
</div>
<div id="form_<?php echo $the_url ?>"></div>
<!--Rendered in <?php echo $this->benchmark->elapsed_time();?> Seconds<br />
Memory used <?php echo $this->benchmark->memory_usage();?>-->