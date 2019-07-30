<div id="topLeft" class="pullLeft"></div>

<div id="topRight" class="pullRight" onmouseover="myLayout.allowOverflow('north')" onmouseout="myLayout.resetOverflow(this)">
	<ul id="top_navigate" >
		<li>
			<button id="open-select-company" title="<?php echo $this->lang->line('menu_chg_company');?>"><?php echo $open_company;?>&nbsp;</button> 
			<?php		
				if ($arrMenuComp[0]['menuComp'] != 'empty') {
			?>
			<div id="dialog-select-company" class="ui-helper-hidden">
				<form id="changeCompForm" action="home" method="post" target="_blank">
					<select name="select-company" id="select-company" class="text ui-widget-content ui-corner-all selectMenuComp" style="cursor:pointer; ">
						<option value="0">&nbsp;-</option>
						<?php 
							foreach($arrMenuComp as $key=>$arrdata) {
								$menuComp 	= $arrdata['menuComp'];
								$ptId 		= $menuComp['idPT'];
								$exp 		= explode(".", $menuComp['vNamaPT']);
								$nameComp	= $exp[0].'. '.ucwords(strtolower($exp[1]));		
						?>
							<option value="<?php echo $ptId; ?>"><?php echo $nameComp; ?></option>
						<?php
							}
						?>
					</select>
				</form>
			</div>
			<?php 	
				}
			?>
		</li>
		<li>
			<a href="<?php echo base_url()?>login/signout" name="btnLogout" id="btnLogout" title="<?php echo $this->lang->line('menu_logout');?>">
				<?php echo $this->lang->line('menu_logout');?>
			</a>
		</li>
		<li>
			<a href="#" id="btn_other_opt"><?php echo $this->lang->line('menu_setting');?></a>
			<ul class="ui-widget ui-widget-content ui-corner-bottom">
				<li class="list_other_opt">
					<a href="#!" class="file" id="0" group="0" rel="menu/change/password" title="<?php echo $this->lang->line('menu_my_profile');?>">
						<?php echo $this->lang->line('menu_my_profile');?>
					</a>
				</li>
				<li class="list_other_opt">
					<a href="#!" class="file" id="0" group="0" rel="menu/change/password" title="<?php echo $this->lang->line('menu_chg_password');?>">
						<?php echo $this->lang->line('menu_chg_password');?>
					</a>
				</li>
				<li class="list_other_opt">
					<a href="#!" id="chg_lang">
						<?php echo $this->lang->line('menu_chg_lang');?>
					</a>
					<div id="dialog-select-language" class="ui-helper-hidden">
						<select name="select-language" id="select-language" class="text ui-widget-content ui-corner-all selectMenuComp" style="cursor:pointer; width:125px; ">
							<option value="0">&nbsp;-</option>
							<option value="english">English</option>
							<option value="indonesia">Indonesia</option>
						</select>
					</div>
				</li>
			</ul>
		</li>
	</ul>
</div>
