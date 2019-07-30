<div id="tabsContent" class="jqgtabs">
	<ul>
		<li><a href="#tabs-1">Home</a></li> 
	</ul>
	<div id="tabs-1" style="font-size:12px;" class="sum_tabs">
		<?php 
			$clock = date('H : i');
			$exp   = explode(":",$clock);
			$time  = $exp[0]; 
			$greeting = '';
			
			if($time >='00' && $time < '10'){
				$greeting = $this->lang->line('tab_home_morning');
			} elseif( $time >= '10' && $time < '15'){
				$greeting = $this->lang->line('tab_home_noon');
			}elseif($time >= '15' && $time < '19'){
				$greeting = $this->lang->line('tab_home_afternoon');
			}elseif($time >= '19' && $time < '23'){
				$greeting = $this->lang->line('tab_home_night');
			}
			$exp_name = explode(" ", $NameUser);
			$nick_name= $exp_name[0];
		 	echo $greeting.', '.$nick_name;
		?>
	</div>
</div>