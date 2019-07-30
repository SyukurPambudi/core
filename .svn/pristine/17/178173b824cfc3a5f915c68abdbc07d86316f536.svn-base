<?php
	$Photo        = (isset($Photo) && !empty($Photo)) ? base_url().$Photo :  base_url().'assets/images/download.jpeg';
	$WaitIco      =  base_url().'assets/images/e-load.gif';
	$NIP          = (isset($Photo)) ?  $NIP : "";
	$Nama         = (isset($Photo)) ?  $Nama : "";
	$Divisi       = (isset($Photo)) ?  $Divisi : "";
	$Departemen   = (isset($Photo)) ?  $Departemen : "";
	$Posisi       = (isset($Photo)) ?  $Posisi : "";
	$Perusahaan   = (isset($Photo)) ?  $Perusahaan : "";
	$Area_Kerja   = (isset($Photo)) ?  $Area_Kerja : "";
	$EmailKantor  = (isset($Photo)) ?  $EmailKantor : "-";
	$HandPhone    = (isset($Photo)) ?  $HandPhone : "-";
	$PerSonalMail = (isset($Photo)) ?  $PerSonalMail : "-";
?>
<style>
	.PaytAll{
		border: px solid #ddddee; text-align: center;  border-collapse: collapse; margin-left: 0px; width: 100%;
	}
	.PaytAll thead tr{
		text-align: center; background: #31698a; color:#e3e3e3; border-collapse: collapse;
	}
	.PaytAll thead tr th{
		border: 1px solid #dddddd;border-collapse: collapse; text-align: center;;
	}
	.PaytAll tbody tr td{
		border: 0px solid #dddddd;
		background-color:"#f0f8ff"; 	text-align: justify-all;
	}
	.PaytAll tbody tr td{
		border: 0px solid #dddddd;
		background-color:"#fcfdf2"; 	text-align: justify-all;
	}
	.PaytAll tfoot tr td{
		border: 1px solid #dddddd;
		background-color:#f5f5f5;
	}
	.field{
		font-weight: bold;
		text-align: left;
	}
	.main_profile_data{
		font-weight: bold;
		text-align: left;
		background:#faebd7;
	}
</style>

<div class="box_cbox"  style=" overflow: auto; width:-moz-fit-content; height:-moz-fit-content;">
	<table width="100%" cellspacing="0" cellpadding="3" class = "PaytAll">
		<thead>
			<tr>
				<th  colspan="2" style="width:40%;">
						&nbsp;
				</th>
				<th  style="width:30%;" colspan="2">
						<strong> USER PROFILE </strong>
				</th>

				<th  style="width:30%;text-align: right;">
					<button id="btn_edit_user_profile"   class="custom_btn" name="btn_edit_user_profile">Edit</button>
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="2" rowspan="10" >
					<div style="width:300px; height:330px;"> <img src="<?php echo $Photo;?>" width="100%" height="100%" /></div>
				</td>
				<td class="field" valign="top"><div class="field_0">NIP </div> </td>
				<td colspan="3" class="field" valign="top"> <?php echo trim($NIP);?> <input type="hidden" name="cNIP" value="<?php echo trim($NIP);?>">   </td>
			</tr>
			<tr>
				<td class="field" valign="top">Nama</td>
				<td colspan="3" class="field" valign="top">  	<p><?php echo trim($Nama);?> </p>  </td>
			</tr>
			<tr>
				<td class="field" valign="top">Perusahaan</td>
				<td colspan="3" class="field" valign="top">  	<p><?php echo trim($Perusahaan);?> </p> </td>
			</tr>
			<tr>
				<td class="field" valign="top">Divisi</td>
				<td colspan="3" class="field" valign="top">  <p>	<?php echo trim($Divisi);?>  </p></td>
			</tr>
			<tr>
				<td class="field" valign="top">Departemen</td>
				<td colspan="3" class="field" valign="top"> <p> 	<?php echo trim($Departemen);?>  </p></td>
			</tr>
			<tr>
				<td class="field" valign="top">Posisi</td>
				<td colspan="3" class="field" valign="top">  <p>	<?php echo trim($Posisi);?>  </p></td>
			</tr>
			<tr>
				<td class="field" valign="top">Area Kerja</td>
				<td colspan="3" class="field" valign="top">  	<?php echo trim($Area_Kerja);?>  </td>
			</tr>
			<tr>
				<td class="field" valign="top">Email Kantor</td>
				<td colspan="3" class="field" valign="top">
					<span class="main_profile_deft"> <?php echo trim($EmailKantor);?> </span>
					<input type="text" name="main_profile_Email" id="main_profile_Email" value="<?php echo trim($EmailKantor);?>" class = "main_profile_data" maxlength="50" size = "50">
				</td>
			</tr>
			<tr>
				<td class="field" valign="top">Email Pribadi</td>
				<td colspan="3" class="field" valign="top">
					<span class="main_profile_deft"> <?php echo trim($PerSonalMail);?> </span>

					<input type="text" name="main_profile_Email" id="main_profile_PersEmail" value="<?php echo trim($PerSonalMail);?>" class = "main_profile_data"  maxlength="50" size = "50">
				</td>
			</tr>
			<tr>
				<td class="field" valign="top">No. HP</td>
				<td colspan="3" class="field" valign="top">
					<span class="main_profile_deft"> <?php echo "+".trim($HandPhone0).trim($HandPhone);?> </span>
					<input type="text" name="main_profile_Hp0" id="main_profile_Hp0" value="<?php echo trim($HandPhone0);?>" class = "main_profile_data"  size ="2"  style ="background: e6e6fa" placeholder = "62">
					<input type="text" name="main_profile_Hp" id="main_profile_Hp" value="<?php echo trim($HandPhone);?>" class = "main_profile_data"  maxlength="12" size = "18">

				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>

				<td style="text-align: right;" colspan="5">
					<button id="btn_cancel_user_profile" class="custom_btn" name="btn_cancel_user_profile">Cancel</button>
					<button id="btn_save_user_profile"   class="custom_btn" name="btn_save_user_profile">Save</button>
					<div style="width:50px; height:50px;float: right;" id ="user_profile_WaitIco"> <img src="<?php echo $WaitIco;?>" width="100%" height="100%" /></div>
				</td>
			</tr>
			<tr>

				<td style="text-align: right;" colspan="5">
								<p class="validateTips padding-4"></p>
				</td>
			</tr>
		</tfoot>
	</table>

</div>


<script language="text/javascript">
	var baseUrl = '<?php echo site_url();?>';

	$(document).ready(function() {
		tips = $( ".validateTips" ); $(".main_profile_data").hide();
				$("#btn_cancel_user_profile").closest("tr").hide();
				$("#user_profile_WaitIco").hide();

		$("#btn_cancel_user_profile").click(function(){
				$(this).closest("tr").hide(300);
				$(".main_profile_data").hide(300);
				$(".main_profile_deft").show(300);
				$("#btn_edit_user_profile").show(300);
		});

		$("#btn_edit_user_profile").click(function(){
				$("#btn_cancel_user_profile").closest("tr").show(300);
				$(".main_profile_data").show(300);
				$(".main_profile_deft").hide(300);
				$(this).hide(300);
		});

		$("#main_profile_Hp").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: Ctrl+C
            (e.keyCode == 67 && e.ctrlKey === true) ||
             // Allow: Ctrl+X
            (e.keyCode == 88 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

		$("#btn_edit_user_profile").button({icons: { primary: 'ui-icon-pencil', label: "Edit Profile", showLabel: false} });
		$("#btn_save_user_profile").button({icons: { primary: 'ui-icon-disk'} });
		$("#btn_cancel_user_profile").button({icons: { primary: 'ui-icon-cancel'} });

		$("#btn_save_user_profile").click(function(){
			 		vEmail = $("#main_profile_Email"),
			    vPersoEmail = $("#main_profile_PersEmail");
			    vPhoneNumber = $("#main_profile_Hp0").val() + $("#main_profile_Hp").val();

			 bValid = true;
			    bValid = bValid && validateEmail( vEmail, "Format Email Salah" );///^([0-9a-zA-Z])+$/Password field
			    bValid = bValid && validateEmail( vPersoEmail, "Format Email Salah" );///^([0-9a-zA-Z])+$/Password field

				if(bValid){
					doUpdateProfile(vEmail.val(), vPersoEmail.val(), vPhoneNumber);
				}

		});


		$("#submit_chg_password").click(function(){
			var old_pass = $("#old_password"),
			    new_pass = $("#new_password"),
				rpt_pass = $("#rpt_password");

			var bValid = true;
			    bValid = bValid && checkLength( new_pass, "password", 3, 16 );
			    //bValid = bValid && checkRegexp( new_pass, /^([0-9a-zA-Z~!@#$%^&*_+=`-])+$/, "Password field not allowed" );///^([0-9a-zA-Z])+$/Password field only allow : a-z 0-9
				bValid = bValid && checkMatch(new_pass, rpt_pass)

				if(bValid){
					doChange(old_pass.val(), new_pass.val());
				}
		});
	});

	function doUpdateProfile(email,PersoEmail,Hp){
		$.ajax({
			type: 'POST',
			url: baseUrl+'menu/change_profile0/action',
			//data: params,
                        data: {email:email,PersoEmail:PersoEmail,Hp:Hp},
			async: false,
			beforeSend: function () {
               		$("#user_profile_WaitIco").show();
            	},

			dataType: 'json',
			success: function(data) {
				var result = data.responseText.return;
				var txt    = data.responseText.text;
					$("#user_profile_WaitIco").hide(250);
				if (result == 1){
					alert_box(txt);
					$(".main_profile_data").removeClass( "ui-state-error" );
					$(".main_profile_deft").each(function(){
						meh = $(this).text();
						victim = $(this).siblings(".main_profile_data").val();
						$(this).text(victim);
					});
					myPhone = $("#main_profile_Hp0").val() + $("#main_profile_Hp").val();
					$("#main_profile_Hp0").siblings(".main_profile_deft").text(myPhone);
					$("#btn_cancel_user_profile").click();
				}else{
					updateTips(txt);
					$(".main_profile_data").removeClass( "ui-state-error" );
				}
			}
		}).always(function () {
				$("#user_profile_WaitIco").hide();
    });
	}


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
		//var params	= 'old_pass='+old_pass;
		//	params	+= '&new_pass='+new_pass;
		$.ajax({
			type: 'POST',
			url: baseUrl+'menu/change_password/action',
			//data: params,
                        data: {old_pass:old_pass,new_pass:new_pass},
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

	function validateEmail(email, n){
		var emailReg = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
			mail = email.val();
			var valid = true;
			if( mail != "") valid = emailReg.test( mail );

			if(!valid) {
				email.addClass( "ui-state-error" );
				updateTips( n );
			    return false;
			} else {
				return true;
			}
		}


</script>
