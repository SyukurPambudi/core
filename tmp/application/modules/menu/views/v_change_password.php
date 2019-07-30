<table width="100%" cellspacing="0" cellpadding="3" border="0">
	<tbody>
		<tr>
			<td class="ui-widget ui-widget-header ui-corner-top padding-7" colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td class="ui-state ui-state-default ui-corner-bottom">
				<table width="100%" cellspacing="0" cellpadding="3" border="0" id="tb_chg_password">
					<tbody>
						<tr>
							<td class="field" valign="top" width="20%">
								Old Password
							</td>
							<td class="field_right" valign="top"  >
								<input type="password" name="old_password" id="old_password" class="fieldTextBox" value="" />
							</td>
						</tr>
						<tr>
							<td class="field" valign="top" width="20%">
								New Password
							</td>
							<td class="field_right" valign="top"  >
								<input type="password" name="new_password" id="new_password" class="fieldTextBox" value=""/>
							</td>
						</tr>
						<tr>
							<td class="field" valign="top" width="20%">
								Repeat Password
							</td>
							<td class="field_right" valign="top"  >
								<input type="password" name="rpt_password" id="rpt_password" class="fieldTextBox" value=""/>
							</td>
						</tr> 
						<tr>
							<td class="field" valign="top" colspan="2">
								<p class="validateTips padding-4"></p>
							</td> 
						</tr> 
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>
<br />
<table>
	<tbody>
		<tr>
			<td align="center" colspan="2">
				<button id="submit_chg_password" name="submit_chg_password">Save</button>					
			</td>
		</tr>
	</tbody>
</table>

<script language="text/javascript">
	var baseUrl = '<?php echo site_url();?>';
	
	$(document).ready(function() {
		tips = $( ".validateTips" );

		$("#submit_chg_password").button({icons: { primary: 'ui-icon-disk'} });
		
		$("#submit_chg_password").click(function(){
			var old_pass = $("#old_password"),
			    new_pass = $("#new_password"),
				rpt_pass = $("#rpt_password");

			var bValid = true;
			    bValid = bValid && checkLength( new_pass, "password", 3, 16 );
			    bValid = bValid && checkRegexp( new_pass, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
				bValid = bValid && checkMatch(new_pass, rpt_pass)
				
				if(bValid){
					doChange(old_pass.val(), new_pass.val());	
				} 
		}); 
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
	
	function checkRegexp( o, regexp, n ) {
		if ( !( regexp.test( o.val() ) ) ) {
			o.addClass( "ui-state-error" );
			updateTips( n );
			return false;
		} else {
			return true;
		}
	}
	
	function checkMatch(n, r){
		if( n.val() != r.val() ){
			r.addClass( "ui-state-error" );
			updateTips( "Password didn't match." );
			return false;
		}else{
			return true;
		}
	}

	function updateTips( t ) {
		tips.text( t ).addClass( "ui-state-highlight" );
		setTimeout(function() { tips.removeClass( "ui-state-highlight", 1500 );	}, 500 );
	}

	function doChange(old_pass, new_pass){
		var params	= 'old_pass='+old_pass;
			params	+= '&new_pass='+new_pass;
		$.ajax({
			type: 'POST', 
			url: baseUrl+'menu/change_password/action', 
			data: params, 
			async: false,
			dataType: 'json', 
			success: function(data) {
				var result = data.responseText.return;
				var txt    = data.responseText.text;
				if (result == 1){
					alert_box(txt);
					$("#old_password").val('').removeClass( "ui-state-error" );
			    	$("#new_password").val('').removeClass( "ui-state-error" );
				 	$("#rpt_password").val('').removeClass( "ui-state-error" );
				}else{
					updateTips(txt);
					$("#old_password").addClass( "ui-state-error" );
				}
			}
		});
	}

</script>
