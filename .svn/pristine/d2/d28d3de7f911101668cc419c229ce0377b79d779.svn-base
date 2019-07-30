		<script type="text/javascript" src="<?php echo $_theme ?>assets/js/jquery.livequery.min.js"></script>
		<script src="<?php echo $_theme; ?>assets/js/jquery-ui-1.10.0.custom.min.js" type="text/javascript"></script>
        <script src="<?php echo $_theme; ?>assets/lib/validation/jquery.validate.min.js"></script>
        <script src="<?php echo $_theme ?>assets/js/combobox.js"></script>
		<script src="<?php echo $_theme; ?>assets/js/func.js"></script>
        <script>
            $(document).ready(function(){
				form_wrapper = $('.login_box');
				function boxHeight() {
					form_wrapper.animate({ marginTop : ( - ( form_wrapper.height() / 2) - 24) },400);	
				};
				form_wrapper.css({ marginTop : ( - ( form_wrapper.height() / 2) - 24) });         				
				$('#login_form input#username').live('keypress',function(e){
					if(e.which == 13) {
						$('#btn_login').trigger('click')
					}
				})
				$('#login_form input#password').live('keypress',function(e){
					if(e.which == 13) {
						$('#btn_login').trigger('click')
					}
				})
				$('#btn_login').live('click',function(){
					var btn = $("#login_form button").html();
					var thisbtn = $(this);
					return $.ajax({
						url: $('#login_form').attr('action'),
						type: 'POST',
						data: $('#login_form').serialize(),
						beforeSend: function(){
							$("#login_form input").attr('disabled',true);
							thisbtn.attr('disabled',true);
							$("#login_form button").attr('disabled',true);
							$("#btn_login button").attr('disabled',true);
							$("#login_form button").html('<img src="<?php echo $_theme; ?>assets/img/ajax-loader.gif" align="absmiddle" /> Please Wait');
						},
						success: function(resp){
							$("#login_form input").attr('disabled',false);
							thisbtn.attr('disabled',false);
							$("#login_form button").attr('disabled',false);
							$("#btn_login button").attr('disabled',false);
							$("#login_form button").html(btn);
							
							var o = $.parseJSON(resp);
							if(o.status == true) {
								custom_alert_login('<p class="error">'+o.message+'</p>','Success!','info');
								window.location=base_url;
							}
							else {
								custom_alert_login_fade('<p class="error">'+o.message+'</p>','Error!','error');
								$('#login_form input#login_username').focus();
							}							
						} 
					}).responseText;
					return false;
				});
				$('#username').focus();
            });
        </script>