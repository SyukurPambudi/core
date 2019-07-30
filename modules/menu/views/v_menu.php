
<div id="wrap-app">		
	<?php		
		if ($arrmenu[0]['menu'] != 'no_access') {
			foreach($arrmenu as $key=>$arrdata) {
				$menu 		= $arrdata['menu'];
				$appid 		= $menu['idApp'];
				$appnames 	= $menu['appName'];
				$ptId 		= $menu['comId'];
				$nip 		= $menu['nip'];
				$group		= $menu['idGroup'];
	?>
				<span class="tester" id="<?php echo $appid;?>"><h3><?php echo $appnames;?></h3></span>	
				<div id="target_<?php echo $appid;?>">
					<div id="treenya">
						<!-- menu treenya disini -->
					</div>
					
					<input type="hidden" id="nip_<?php echo $appid;?>" value="<?php echo $nip;?>" /> 
					<input type="hidden" id="pt_<?php echo $appid;?>" value="<?php echo $ptId;?>" />
					<input type="hidden" id="group_<?php echo $appid;?>" value="<?php echo $group;?>"/>
				
				</div> 
				 
	<?php 
			}
		} else {			
	?>
	<span class="tester" id="0"><h3>You don't have any privilege(s)</h3></span>	
	<?php 
		}
	?> 
	
</div>