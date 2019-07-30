<?php
// connect to the database
include('connect-db.php');
// server info

?>
<!-- BREAK -->

<!-- BREAK -->

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		
		<title>	Testimoni Thromecon | www.thromecon.co.id
</title>
			
			<meta name="keywords" 				   content="Thromecon">	
	<meta property="og:url"                content="" />
	<meta property="og:type"               content="Testimoni" />
	<meta property="og:title"              content="Testimoni Thromecon | www.thromecon.co.id" />
	<meta property="og:description"        content="" />
	<meta property="og:image"              content="../assets/c2pw/assets/images/logo_thromecon.ico" />
	    
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
								<a id="menuHome"  href="/">Beranda</a>
							</li>
							<li>
								<a id="menuProduk" href="/produk">Produk</a>
							</li>
							<li>
								<a id="menuArtikel" href="/artikel">Artikel</a>
							</li>
							<li>
								<a id="menuOutlet" href="/outlet">Beli dimana ?</a>
							</li>
							<li>
								<a id="menuEvent" href="/event">Event</a>
							</li>
							<li>
								<a id="menuPromo" href="/promo">Promo</a>
							</li>
							<li>
								<a id="menuTestimoni" href="/testimoni">Testimoni</a>
							</li>
							<li>
								<a id="menuKeluhan" href="/kontak">Hubungi Kami</a>
							</li>
						</ul>					
					</div>			
					<div class="clear"></div>	
				</div>						
				<div class="clear"></div>				
			</div>
		</div>	
		<div class="clear"></div>
        <link href="../assets/c2pw/assets/css/modale.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="../assets/c2pw/assets/js/chartist.min.js"></script>
<script type="text/javascript" src="../assets/c2pw/assets/js/chartist-plugin-legend.js"></script>
<style>
  .ct-series-b .ct-slice-pie {
  /* fill of the pie slieces */
  fill: hsl(192, 100%, 50%);
  /* give your pie slices some outline or separate them visually by using the background color here */
  stroke: white;
  /* outline width */
  stroke-width: 4px;
}
	
</style>
<div id="contentDiv">
	<div class="fullContent pagesDetcontent">
		<div class="clear"></div>
		
				
		<p style="text-align:center;">Perlukah Pertolongan Pertama Bila Anda Mengalami Memar?</p>
		<div class="ct-chart"></div>
		<script>
		  var data = {
			series: [3, 0]
		  };
		  
		  var sum = function(a, b) { return a + b };
		  
		  new Chartist.Pie('.ct-chart', data, {
			labelInterpolationFnc: function(value) {
			  return Math.round(value / data.series.reduce(sum) * 100) + '%';
			}
		  });
		</script>
			<p style="font-size: 12px;line-height: 24px;font-weight: normal;color: #848484;padding: 0;margin: 0;text-align:center;">
				<b>Perlu:</b> <span style="width: 15px; height: 15px; margin:auto; display: inline-block; border: 1px solid gray; vertical-align: middle; border-radius: 2px; background: hsl(192, 100%, 50%); "></span>
				<b>Tidak Perlu:</b> <span style="width: 15px; height: 15px; margin:auto; display: inline-block; border: 1px solid gray; vertical-align: middle; border-radius: 2px; background: #d70206; "></span>
			</p>
		<div class="boxCT">
		<style>
			.alert {
        padding: 20px;
        background-color: red; /* Red */
        color: white;
        margin-bottom: 15px;
      }
			
			.sukses {
				padding: 20px;
        background-color: green; /* Red */
        color: white;
        margin-bottom: 15px;
      }
			
			.closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
      }
                                              
			.closebtn:hover {
				color: black;
			}
		</style>
			<div>
				<div class="headEvent" align="center">
					<h1>Testimonial</h1>
				</div>
				<div class="clear"></div>
				<div class="isicontprod">
					<div>
						<?php
						$num_rec_per_page=6;
								mysql_connect('10.1.49.8','nplnet','nplnet01');
								mysql_select_db('smsc');
								if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
								$start_from = ($page-1) * $num_rec_per_page; 
						 //$id = $_GET['id'];
						 if ($result = $mysqli->query("SELECT * FROM smsc.testimoni where ePublish='PUBLISH'  LIMIT $start_from, $num_rec_per_page ")) {
							// display records if there are records to display
								if ($result->num_rows > 0)
								{						
									while ($row = $result->fetch_object())
									{
										$date = $row->tCreated;
										$format = date('d-m-Y | H:i:s', strtotime($date ));
										$string = substr($row->iKomentar,0,160).'...';
										$idmember = $row->iMemberid;
										$icret = $row->iCreatemember;
										
										echo '<div class="box_listArtkelFull">';
										 if ($result2 = $mysqli->query("SELECT * FROM smsc.mscustomer where tCreated='$icret' ")) {
										 	//print_r($result2);exit;
										 	if ($result2->num_rows > 0)
											{						
												while ($row2 = $result2->fetch_object())
												{
													//print_r($row2);exit;
													$path ='../files/smsc/frontend/member/'.$row2->vProfileImage.'';
													//print_r($path);exit;
													if (!$row2->vProfileImage == '') {
												    		echo '
												    		<a href="#">
																<!-- <div class="userTestii" style="background-image:url("../'.$row2->vProfileImage.'")"></div>	-->
																<img src="'.$path.'" class="userTestii">	
																<div class="NameTesti">
																	<div>
																		'.$row2->vName.'
																	</div>
																	<div class="datePost">
																		'.$format.'
																	</div>
																</div>
															</a>';
														}
											    	else {
											    		echo '
											    		<a href="#">
																<img src="../assets/c2pw/assets/images/user.png" class="userTestii">	
																<div class="NameTesti">
																	<div>
																		'.$row2->vName.'
																	</div>
																	<div class="datePost">
																		'.$format.'
																	</div>
																</div>
															</a>';
												}
											}
												 	
											}				
											
										 }							
											
										echo '<div class="kotak_art" style="">
												<div class="uiScaledImageContainer hoperMenu">';
										if (!$row->ifoto == '') {
									    		echo '<a href="#">
														<img src="../'.$row->ifoto.'" class="imgListArtklFullEvent">		
													</a>';
											}
								    	else {
								    		echo '<a href="#">
												<img src="../assets/c2pw/assets/images/no-image-thromecon.jpg" class="imgListArtklFullEvent">		
											</a>';
										}	
										echo '</div><div class="clear"></div>	
									<div class="boxlistIsiTesti">
										<div class="isi_artikellist">  
											'.$string.'
										</div>									
									</div><div class="clear"></div>';		
									    echo '</div>';
										echo '</div>';
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
						<!-- <div class="bxpagin" align="center">
							<?php 
							    
								$sql = "SELECT * FROM smsc.testimoni where ePublish='PUBLISH'"; 
								$rs_result = mysql_query($sql); //run the query
								$total_records = mysql_num_rows($rs_result);  //count number of records
								$total_pages = ceil($total_records / $num_rec_per_page); 
								
								echo "<a href='testimoni.php?page=1'>".'|<'."</a> "; // Goto 1st page  
								
								for ($i=1; $i<=$total_pages; $i++) { 
								            echo "<a href='testimoni.php?page=".$i."'>".$i."</a> "; 
								}; 
								echo "<a href='testimoni.php?page=$total_pages'>".'>|'."</a> "; // Goto last page
								?>
						</div> -->
					</div>
				</div>
				<div class="clear"></div> 
				<div class="clear"></div>
				<div class="bgSign">
										<h2 style="padding-top: 20px; font-size: 30px;">Untuk memberikan testimoni anda harus login terlebih dahulu</h2>
					<!--<div>
						<div class="boxBTN23">
							<br><a href="#login" target="_blank"class="linkArtFull">Login disini !</a>
						</div>
					</div>-->
									</div>
				<div><br/>
						<div class="component" align="center">
							<a href="javascript: void(0)" onclick="popup_sosmed('http://www.facebook.com/sharer.php?u=http://www.thromecon.co.id/testimoni')"  class="icon icon-slide facebook">facebook</a>
							<a href="javascript: void(0)" onclick="popup_sosmed('https://twitter.com/share')" class="icon icon-slide twitter">twitter</a>
							<a href="javascript: void(0)" onclick="popup_sosmed('https://plus.google.com/share?url=http://www.thromecon.co.id/testimoni')" class="icon icon-slide googleplus">google+</a>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="../assets/c2pw/assets/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript">
$( document ).ready(function() {
  $('#menuTestimoni').addClass('activNav');
});
function closeAlert() {
   $('div.alert').remove();
}
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
							<input type="hidden" name="_token" value="Onl4650JyDI1A7Fneg1PXgz5yNlDod9r9TJEymrV"> 
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
				  data:'_token = Onl4650JyDI1A7Fneg1PXgz5yNlDod9r9TJEymrV',
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
