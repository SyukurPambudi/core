	<script type="text/javascript">
		$(document).ready(function(){
			var username = $( "#username" ),
				password = $( "#password" ),
				company  = $( "#company" ),
				allFields = $( [] ).add( username ).add( password );
				tips = $( ".validateTips" );
				baseUrl = '<?php echo site_url();?>'
				
			$( "#loginBox" ).dialog({
				title:'Welcome',
				autoOpen: true,
				width: 350,
				modal: true,
				draggable: true,
				resizable: false,
				closeText: "hide" ,
				dialogClass: "noClose",
				position: { my: "top-80%", at: "center", of: window  },
				buttons: {
					"Sign In": function() {
						var bValid = true;
						allFields.removeClass( "ui-state-error" );
						bValid = bValid && checkLength( username, "username", 1, 7 );
						bValid = bValid && checkLength( password, "password", 3, 16 );
						bValid = bValid && checkRegexp( username, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
						bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
						if ( bValid ) {
							var uName = $( "#username" ).val();
							var uPass = $( "#password" ).val();
							var uComp = $( "#company" ).val();
							
							doLogin(uName, uPass, uComp);
						}
					},
					Reset: function() {
						resetForm('#formLogin');
					}
				},
				close: function() {
					allFields.val( "" ).removeClass( "ui-state-error" );
				}
			});
			
			//getCompany();
			$('#username').keyup(function(){
				$(this).val(String($(this).val()).toUpperCase());
			});
			//focusCursor();
		});
		
		function checkLength( o, n, min, max ) {
			if ( o.val().length > max || o.val().length < min ) {
				o.addClass( "ui-state-error" );
				updateTips( "Length of " + n + " must be between " +
					min + " and " + max + "." );
				return false;
			} else {
				return true;
			}
		}
		
		function updateTips( t ) {
			tips
				.text( t )
				.addClass( "ui-state-highlight" );
			setTimeout(function() {
				tips.removeClass( "ui-state-highlight", 1500 );
			}, 500 );
		}
		
		function checkRegexp( o, regexp, n ) {
			if ( !( regexp.test( o.val() ) ) ) {
				o.addClass( "ui-state-error" );
				updateTips( n );
				return false;
			} else {
				return true;
			}
		}
		
		function resetForm(form) { 
			$(form).each(function(){ this.reset(); });
		}
		
		function getCompany() {
			$.ajax({ 
				type: 'GET', 
				url: baseUrl+'login/getComp', 
				data: '', 
				async: false, 
				dataType: 'json', 
				success: function(data) {
					var listComp = ''
					$.each(data.comp, function(i, item) {
						if (item.value == 3){
							listComp += '<option value="'+item.value+'" selected="selected">'+item.name+'</option>';
						}else{
							listComp += '<option value="'+item.value+'" >'+item.name+'</option>';
						}
					});
					$("#company").html(listComp);
				}
			});
		}
		
		function doLogin(uName, uPass, uComp){
			var params	= 'username='+uName;
				params	+= '&password='+uPass;
				params	+= '&company='+uComp; 
				
			if(uName.length > 0 && uPass.length > 0 && uComp.length > 0 ) {
				$.ajax({
					type: 'POST', 
					url: baseUrl+'login/signin', 
					data:$("#formLogin").serialize(), 
					async: false,
					dataType: 'json', 
					success: function(data) {
						if (data.stat == 1){
							$("#loginBox").dialog('destroy');
						}else{
							updateTips(data.message);
						} 
					}
				});
			} else {
				alert('error');
			}
		}

		function focusCursor() {
		   if (formLogin.username.value!='') formLogin.userpassword.focus();
		   else formLogin.username.focus();
		}

		 
	</script>
	
	<div id="loginBox">
		<p class="validateTips"></p>
		<form id="formLogin">
			<fieldset>
				<label for="name">Name</label>
				<input type="text" name="username" id="username" class="text ui-widget-content ui-corner-all" />
				<label for="password">Password</label>
				<input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" />
				<label for="company">Company</label>
				<select name="company" id="company" class="text ui-widget-content ui-corner-all" style="cursor:pointer;"><?php echo $getCompany;?></select>
				<input type="hidden" name="flag" value="hore"/>
			</fieldset>
		</form>
	</div>
	