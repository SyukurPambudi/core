<?php
// connect to the database
include('connect-db.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		
		<title> Homepage Thromecon | www.thromecon.co.id
</title>
			
		<meta name="keywords" 				   			 content="Thromecon">	
<meta property="og:url"                content="" />
<meta property="og:type"               content="Produk" />
<meta property="og:title"              content="Homepage Thromecon | www.thromecon.co.id" />
<meta property="og:description"        content="" />
<meta property="og:image"              content="" />
	    
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">	
		<link type="image/ico" rel="shortcut icon" href="../assets/c2pw/assets/images/logo_thromecon.ico">
		<!-- CSRF Token -->
		<meta name="csrf-token" content="" />
		<link rel="stylesheet" href="../assets/c2pw/assets/css/style-thromecon.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="../assets/c2pw/assets/css/styleT.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="../assets/c2pw/assets/css/themes/default/default.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="../assets/c2pw/assets/css/nivo-slider.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="../assets/c2pw/assets/css/sosmed.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="../assets/c2pw/assets/css/font-awesome.min.css">
		<link rel="stylesheet" href="../assets/c2pw/assets/css/chartist.min.css">
	</head>
    <body>
	  <!-- HEADER -->
		<div id="boxtophed">
			<div id="topHed"></div>
			<div id="header">
				<div class="divLogo">
					<a href="/"> <img src="../assets/c2pw/assets/images/logo_thromecon.png" class="logo" /> </a>
				</div> 	
				<div class="boxSearch">
										<a href="#menulogin" id="loginbutton"><i class="fa fa-unlock-alt" style="color: #748C87"></i> Login</a>
					<a href="/register"><i class="fa fa-sign-in" style="color: #748C87"></i> Register</a>
									</div>	
				<div class="clear"></div>
				<!-- MENU -->
				<div id="boxMenu" class="boxHead">		
					<!-- <img class="scrollToTop" src="../assets/c2pw/assets/images/logo_thromecon.png" width="115"/>	-->	
					
					<div id="nav-wrap" class="divMenu">								
	<ul id="nav">
		<li>
			<a id="menuHome"  href="#">Beranda</a>
		</li>
		<li>
			<a id="menuProduk" href="#">Produk</a>
		</li>
		<li>
			<a id="menuArtikel" href="#">Artikel</a>
		</li>
		<li>
			<a id="menuOutlet" href="#">Beli dimana ?</a>
		</li>
		<li>
			<a id="menuEvent" href="#">Event</a>
		</li>
		<li>
			<a id="menuPromo" href="#">Promo</a>
		</li>
		<li>
			<a id="menuTestimoni" href="#">Testimoni</a>
		</li>
		<li>
			<a id="menuKeluhan" href="#">Hubungi Kami</a>
		</li>
	</ul>					
</div>	
					<div class="clear"></div>	
				</div>						
				<div class="clear"></div>				
			</div>
		</div>	
		<div class="clear"></div>
        <div>
  <div> <!-- SLIDESHOW -->
        <div class="divSLV">
      <div class="boxSLides">
       <?php
					 $id = $_GET['id'];
					 $cGroup2 = $_GET['cGroup2'];
					 if ($result = $mysqli->query("SELECT * FROM manufacturing.product_brand where cGroup2 ='$cGroup2' ")) {
						// display records if there are records to display
							if ($result->num_rows > 0)
							{						
								while ($row = $result->fetch_object())
								{				
									echo '	
										<img src="../'. $row->vImages . '" alt="" title="" width="100%" />';
								}
							
							}
							else
							{
								echo "No results to display!";
							}
						}
							else
							{
							echo "Error: " . $mysqli->error;
						}
					?>
      </div>
      <div class="clear"></div>
    </div>
    <!-- CONTENT -->
    <div id="contentDiv">
      <div class="fullContent pagesDetcontent">
        <div class="clear"></div>
        <?php
							 $id = $_GET['id'];
							 $cGroup2 = $_GET['cGroup2'];
							 if ($result = $mysqli->query("SELECT * FROM manufacturing.product_brand where cGroup2 ='$cGroup2' ")) {
								// display records if there are records to display
									if ($result->num_rows > 0)
									{						
										while ($row = $result->fetch_object())
										{
											echo '<a href="'. $row->vLinkBeli . '" target="_blank">
											<img src="../'. $row->vImageBeli . '" alt="" title="" width="100%" /></a>';					
											echo ' '. $row->vLengkap . ' ';
										}
									
									}
									else
									{
										echo "No results to display!";
									}
								}
									else
									{
									echo "Error: " . $mysqli->error;
								}
							?>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>
    </div>
</div>
<script type="text/javascript" src="../assets/c2pw/assets/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript">
$( document ).ready(function() {
  $('#menuProduk').addClass('activNav');
});
</script>
			
	</body>
</html>
<div id="contentDiv">
		<div id="boxLog">
			<div class="bgSignBotom">				
				<div class="leftFtr">
					<h2>Sign Up / Sign In</h2>
						<p>Daftarkan email anda dan dapatkan info-info terbaru dari THROMECON, atau kirim kritik dan saran kamu tentang THROMECON</p>
				</div>
				<div class="leftFtr" id="menulogin">
					<div class="bgSign">
						<form method="post" action="/login" enctype="multipart/form-data">
							<input type="hidden" name="_token" value="mWE3xqRtCl5AI3cKbri64pzFLgXaig9KP3oD8aM6"> 
							<div class="formInpt">
								<input name="email" type="email" placeholder="Email Anda" />
							</div>
							<div class="formInpt">
								<input name="password" type="password" placeholder="Password Anda" />
							</div>
							<div class="boxBTN23">
								<input type="submit" value="Masuk" class="btnCari" /> 
							</div>
							<div>
								Belum punya akun, <a href="/register" style="color: #cc0000;">Registrasi disini!</a>
							</div>
							<div>
								Lupa Password, <a href="/lupapassword" style="color: #cc0000;">Klik disini!</a>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<style>
	.visitor {
		font-family: Arial;
		color: #ffffff;
		background: #3498db;
		padding: 10px 20px 10px 20px;
		text-decoration: none;
	  }
	  
	  .visitor:hover {
		background: #3cb0fd;
		text-decoration: none;
	  }
</style>
<div class="visitor" style="width: 20%; float:left">
	Today Visitor: 2
 </div>
 <div class="visitor" style="width: 20%; float:right">
	Total Visitor: 11
 </div>
		</div>
		<div class="clear"></div>
		
		<link rel="stylesheet" href="../assets/c2pw/assets/css/font-awesome.min.css">
		<script>
		function check_availability(){
			  var username = $('#email').val(); 
			  $.ajax({
				  type:'GET',
				  url:'/checkemail/'+username,
				  data:'_token = mWE3xqRtCl5AI3cKbri64pzFLgXaig9KP3oD8aM6',
				  success:function(data){
					  if(data.msg=="true"){
						  $("#loading").html("Email Sudah Terdaftar");
						  $('input[type="submit"]').attr('disabled','disabled');
					  }else{
						  $("#loading").html("");
						  $('input[type="submit"]').removeAttr('disabled');
					  }
				  }
			  });
		  }
		  
		function check_password(){
			  var password = $('#password').val(); 
			  var password2 = $('#password2').val();
			  if(password!=password2){
						  $("#passcek").html("Password Tidak Sama");
						  $('input[type="submit"]').attr('disabled','disabled');
			  }else{
						  $("#passcek").html("");
						  $('input[type="submit"]').removeAttr('disabled');
			  }
		 }
		  
		  function check_password2(){
				var password = $('#password').val(); 
				var password2 = $('#password2').val();
				if(password!=password2){
							$("#passcek").html("Password Tidak Sama");
				}else{
							$("#passcek").html("");
				}
		 }
		  
		  document.addEventListener("DOMContentLoaded", function() {
		  var elements = document.getElementsByTagName("INPUT");
		  for (var i = 0; i < elements.length; i++) {
			  elements[i].oninvalid = function(e) {
				  e.target.setCustomValidity("");
				  if (!e.target.validity.valid) {
					  $("#blank").html("*Semua Field Wajib Diisi");
				  }
			  };
			  elements[i].oninput = function(e) {
				  e.target.setCustomValidity("");
			  };
		  }
	  })
	  </script>
		<script type="text/javascript">
		$(function(){
		  var $elems = $('.animateblock');
		  var winheight = $(window).height();
		  var fullheight = $(document).height();
		  
		  $(window).scroll(function(){
		    animate_elems();
		  });
		  
		  function animate_elems() {
		    wintop = $(window).scrollTop(); // calculate distance from top of window
		 
		    // loop through each item to check when it animates
		    $elems.each(function(){
		      $elm = $(this);
		      
		      if($elm.hasClass('animated')) { return true; } // if already animated skip to the next item
		      
		      topcoords = $elm.offset().top; // element's distance from top of page in pixels
		      
		      if(wintop > (topcoords - (winheight*.55))) {
		        // animate when top of the window is 3/4 above the element
		        $elm.addClass('animated');
		      }
		    });
		  } // end animate_elems()
		});
		</script>
	    <script type="text/javascript" src="../assets/c2pw/assets/js/jquery.easing.1.3.js"></script>
		<!-- the jScrollPane script -->
		<script type="text/javascript" src="../assets/c2pw/assets/js/jquery.mousewheel.js"></script>
		<script type="text/javascript" src="../assets/c2pw/assets/js/jquery.contentcarousel.js"></script>
		<script type="text/javascript">
			$('#ca-container').contentcarousel();
		</script>
		<script type="text/javascript" src="../assets/c2pw/assets/js/jquery-1.7.1.min.js"></script>		
		<script type="text/javascript" src="../assets/c2pw/assets/js/datepicker/bootstrap-datepicker.js"></script>
	    <script>		 
			//Date picker
		    $('.datepicker').datepicker({
		      autoclose: true
		    });		  
		</script>
		<script type="text/javascript" src="../assets/c2pw/assets/js/jquery.nivo.slider.js"></script>
		<script type="text/javascript">
	    $(window).load(function() {
	        $('#slider').nivoSlider();
	    });
	    </script>
		<script src="../assets/c2pw/assets/js/functionC2fit.js"></script>
		
		<!-- Scripts -->
	    <script type="text/javascript">
		$(function(){
			$("#overlay, .resizable").hide();  
		    $('#flogin').validate({
		        rules: {
		            nama: "required",
		            username: {
		                  required: true,
		                  email: true,
		              },
		            
		            password: {
		                required: true,
		                minlength: 6,
		                maxlength: 40,
		              },
		            password2: {
		                required: true,
		                equalTo: "#password"
		            },  
		        },
		        messages: {
		              username: {
			                required: "Email wajib diisi",
			                email: "Mohon isi email dengan benar"
			            },
		              password: {
		                required: "Password wajib disini",
		                minlength: "Password minimal 6 karakter"
		              },
		              password2: {
		                required: "Mohon masukkan kembali password anda",
		                equalTo: "Password tidak sama"
		              },
		          }
		    });
		    
		    
		    $("#ftesti").validate(
            {
                ignore: [],
                debug: false,
                rules: { 

                    iKomentar:{
                         required: function() 
                        {
                         CKEDITOR.instances.iKomentar.updateElement();
                        },

                         minlength:10
                    }
                },
                messages:
                    {

                    iKomentar:{
                        required:"Silahkan masukan testimoni anda",
                        minlength:"Minimal 10 karakter"


                    }
                }
            });
		    
		});
		
		
		</script>
		<script type="text/javascript" src="../assets/c2pw/assets/js/texteditor/ckeditor/ckeditor.js"></script>
		<script>
	     	CKEDITOR.replace( 'iKomentar',
				{
					toolbar :
					[
						{ name: 'basicstyles', items : [ 'Bold','Italic', ] },
						{ name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] },
						
						{ name: 'font', items : [ 'Font','TextColor'] }		
																	
					]
					
					
				});
	     </script>
	     <script>
			CKEDITOR.replace( 'alamat',
				{
					toolbar :
					[	
																	
					]
					
					
				});
	     </script>
<script src="../assets/c2pw/assets/js/jquery.validate.min.js"></script>
<script type="text/javascript">
	function popup_sosmed(url) 
	{
		 var width  = 600;
		 var height = 350;
		 var left   = (screen.width  - width)/2;
		 var top    = (screen.height - height)/2;
		 var params = 'width='+width+', height='+height;
		 params += ', top='+top+', left='+left;
		 params += ', directories=no';
		 params += ', location=no';
		 params += ', menubar=no';
		 params += ', resizable=no';
		 params += ', scrollbars=no';
		 params += ', status=no';
		 params += ', toolbar=no';
		 newwin=window.open(url,'windowname5', params);
		 if (window.focus) {newwin.focus()}
		 return false;
	}
</script>
