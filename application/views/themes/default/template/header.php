<header id="top_header">
	<div class="logo">
		<img src="<?php echo $_theme ?>assets/images/logo.png" />
	</div>
	<div class="box_welcome">
		<span class="box_user"> <span> USER ID &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <span class="user">&nbsp; <?php //echo $this->session->userdata('nip') ?> - <?php //echo $this->session->userdata('name') ?></span> </span>
			<br>
			<span> LAST LOGIN : <span class="user">&nbsp; <?php //echo date('l, d M Y | H:i:s', strtotime($this->session->userdata('last_login'))) ?></span> </span> </span>
	</div>
</header>