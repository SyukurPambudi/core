<?php
	//$menus = Modules::run('menu');
	//print_r($menus);
?>
<div>
	<div class="box_navigator">
		<div class="main_menu">
			<span class="home_icon"> <a href="homepage.html" ><img src="<?php echo $_theme ?>assets/images/home_w.png" title="Home" /></a> </span>
			<span class="box_logout"> <a href="<?php base_url() ?>login/logout" ><img class="logout_icon" src="<?php echo $_theme ?>assets/images/logout.png" title="Logout System" /></a> </span>
			<span class="navigator">
				<ul id="nav" class="dropdown dropdown-horizontal">
					<?php
						foreach($menus as $menu) {
							$jsClass = count($menu['sub_menu']) > 0 ? 'master_link' : 'menu_link';
							$url = count($menu['sub_menu']) > 0 ? base_url().'menu/'.$menu['url'] : base_url().$menu['url'];
						?>
						<li class="nav_menu">
							<a ref="<?php echo $menu['url'] ?>" href="<?php echo $url ?>" class="<?php echo $jsClass; ?>"><?php echo $menu['label'] ?></a>
						</li>
					<?php
						}
					?>				
				</ul>
			</span>
			<div class="user_image">
				<a href="#" ><img src="<?php echo $_theme ?>assets/images/370042002952511s083.png" title="User Profile" style="width: 40px;" />&nbsp;</a>
				<span class="notif">
					<div id="message_plc" class="report_messageFB">
						9
					</div> <a href="#" title="notification"><img src="<?php echo $_theme ?>assets/images/messages-icon.png" /> </a> </span>

				<div class="notification-list-wrapper" id="notifikasi_plc" style=" ">
					<ul class="notification-list-menu">
						<li class="notification-list-menu-item" id="unread-menu-item">
							Unread
						</li>
						<li class="notification-list-menu-item" id="all-menu-item">
							All
						</li><li id="close_notif" class="close-notification-list"></li>
					</ul>
					<ul class="notification-list" data-type="unread">
						<li class="notification-list-item">
							<div class="ttw-notification" id="notification1357886202777-760281">
								<span class="message">Sample Notification</span><span class="close"></span>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<!--
			<ul id="projects"  class="ttw-notification-menu">
			<li class="notification-menu-item first-item"><a href="index.html#">Projects</a></li>
			</ul>
			<div class="report_message "> 5 Messages</div> -->
			<div class="clear"></div>
		</div>
	</div>
</div>