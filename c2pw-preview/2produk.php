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
	<title>	Produk C2Fit | www.c2fit.co.id
</title>
	<meta name="keywords" 				   content="C2Fit, Artikel, sehat | Fit Sepanjang Hari">	
<meta property="og:url"                content="" />
<meta property="og:type"               content="article" />
<meta property="og:title"              content="Homepage C2Fit | www.c2fit.co.id" />
<meta property="og:description"        content="C2Fit Multivitamin | Fit Sepanjang Hari" />
<meta property="og:image"              content="../assets/c2pw/assets/images/c2fit/logo_c2fit.png" />
	<meta name="csrf-token" content="" />

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">	
	<link type="image/ico" rel="shortcut icon" href="../assets/c2pw/assets/images/c2fit/logo_c2fit.png">
	<!-- CSRF Token -->
		<link rel="stylesheet" href="../assets/c2pw/assets/css/style-c2fit.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="../assets/c2pw/assets/css/styleT.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="../assets/c2pw/assets/css/themes/default/default.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="../assets/c2pw/assets/css/nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="../assets/c2pw/assets/css/sosmed.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="../assets/c2pw/assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="../assets/c2pw/assets/js/datepicker/datepicker3.css" type="text/css" media="screen" />
</head>
<body>	
	<!-- HEADER -->
	<div id="topHed"></div>
	<div id="header">
		<div class="divLogo">
			<a href="http://c2fit.co.id">
				<img src="../assets/c2pw/assets/images/c2fit/logo_c2fit.png" class="logo" />
			</a>
		</div> 	
		<div class="boxSearch">
						<a href="#login"><i class="fa fa-unlock-alt" style="color: #748C87"></i> Login</a>
			<a href="/register"><i class="fa fa-sign-in" style="color: #748C87"></i> Register</a>
					</div>
		<div id="boxMenu" class="boxHead">		
			<img class="scrollToTop" src="../assets/c2pw/assets/images/c2fit/logo_c2fit.png" width="115"/>		
			<div id="nav-wrap" class="divMenu">								
				<ul id="nav">
					<li>
						<a id="menuHome"  href="/">
							Beranda
						</a>
					</li>
					<li>
						<a id="menuProduk" href="#">
							Produk
						</a>
					</li>
					<li>
						<a id="menuArtikel" href="#">
							Artikel
						</a>
					</li>
					<li>
						<a id="menuBeli" href="#">
							Beli dimana ?
						</a>
					</li>
					<li>
						<a id="menuEvent" href="#">
							Event
						</a>
					</li>
					<li>
						<a id="menuPromo" href="#">
							Promo
						</a>
					</li>
								<li>
						<a id="menuTestimoni" href="#">
							Testimoni
						</a>
					</li>
								<li>
						<a id="menuKeluhan" href="#">
							Keluhan & Pertanyaan
						</a>
					</li>
				</ul>					
			</div>			
			<div class="clear"></div>
		</div>
		<div class="clear"></div>			
	</div>
	<div class="clear"></div>
<!-- MENU -->
<div><!-- SLIDESHOW VIDEO -->
	<div id="pageCT">
		<!-- CONTENT -->
    <div id="contentDiv">
      <div class="fullContent pagesDetcontent">
        <div class="clear"></div>
		<div class="boxCT">
						<div align="center" class="boxc2ft">
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
			<div>
				<div>
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
				</div>				
				<div><br />
					<div class="component" align="center">
							<a href="javascript: void(0)" onclick="popup_sosmed('http://www.facebook.com/sharer.php?u=http://www.c2fit.co.id/produk')"  class="icon icon-slide facebook">facebook</a>
							<a href="javascript: void(0)" onclick="popup_sosmed('https://twitter.com/share')" class="icon icon-slide twitter">twitter</a>
							<a href="javascript: void(0)" onclick="popup_sosmed('https://plus.google.com/share?url=http://www.c2fit.co.id/produk')" class="icon icon-slide googleplus">google+</a>
					</div>
				</div>	 						
			</div>
				
		</div>		
      </div>
      <div class="clear"></div>
    </div>
  </div>
</div>
<!-- NAVIGATION -->
<div class="clboxs">
	<div class="boxCT">												
		<div>
			<div class="boxNavi" style="">
				<img class="imgNav" src="../assets/c2pw/assets/images/img_artikelberita.png" />
				<div class="boxNaviCont">
					<h2>Article & Berita</h2>
					<div>
						Dapatkan berita & artikel yang berguna dan bermanfaat bagi kegiatan kita sehari-hari.
					</div>
					<div>
						<a href="#">
							Explore more &raquo;
						</a>
					</div>
				</div>
			</div>
			<div class="boxNavi" style="">
				<img class="imgNav" src="../assets/c2pw/assets/images/img_event.png" />
				<div class="boxNaviCont">
					<h2>Event</h2>
					<div>
						Cari tahu dimana ada event-event seru yang diadakan oleh Tim C2FIT dikotamu.
					</div>
					<div>
						<a href="#">
							Explore more &raquo;
						</a>
					</div>
				</div>
			</div>
			<div class="boxNavi" style="">
				<img class="imgNav" src="../assets/c2pw/assets/images/img_testimoni.png" />
				<div class="boxNaviCont">
					<h2>Testimoni</h2>
					<div>
						Lihat dan Share pengalamanmu tentang pengalaman kegiatan sehari-harimu selama menkonsumsi C2FIT.
					</div>
					<div>
						<a href="#">
							Explore more &raquo;
						</a>
					</div>
				</div>
			</div>
			<div class="boxNavi" style="">
				<img class="imgNav" src="../assets/c2pw/assets/images/img_quiz.png" />
				<div class="boxNaviCont">
					<h2>Quiz Interaktif</h2>
					<div>
						Dapatkan hadiah-hadia keren dan menarik dari C2FIT. Pantau terus laman web kami.
					</div>
					<div>
						<a href="#">
							Explore more &raquo;
						</a>
					</div>
				</div>
			</div>
		</div>	
		
	</div>
	<div class="clear"></div>
</div><script type="text/javascript" src="../assets/c2pw/assets/images/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript">
$( document ).ready(function() {
  $('#menuArtikel').addClass('activNav');
});
</script>
		
		

<div class="visitor" style="width: 200px; margin: 0 auto; background-color: orange; color: #fff; padding: 10px; margin-bottom: 15px; text-align: center;">
	Today Visitor : 1 - 
	Total Visitor : 5
 </div>
 <div class="clear"></div>
<div id="boxLog">
	<div class="bgSignBotom" id="login">
		<div class="btm">	
			<div class="RightFtr">
				<div class="bgSign">
					<h2>Sign Up / Sign In</h2>
					<div>
						<!-- <form action="../assets/submitlogin" class="form_horizontal" method="post" id="flogin"> -->
						<form method="post" action="/login" enctype="multipart/form-data">
	      					<input type="hidden" name="_token" value="5usy59YrJVEZY1QrntAURTsdrGpXdZrth0rt3mSC"> 
							<p>
								Daftarkan email anda dan dapatkan info-info terbaru dari C2FIT, atau kirim kritik dan saran kamu tentang C2FIT
							</p>
							<div class="formInpt">
								<input type="email" name="email" id="email" placeholder="Masukan Email Anda" class="input_rows1"  />
							</div>
							<div class="formInpt">
								<input type="password" name="password" id="password" placeholder="Masukan Password Anda" class="input_rows1"  /> 
							</div>
							<!--
							<div class="formInpt">
								<textarea name="isi" placeholder="Komentar dan Saran" class="textE100"></textarea>
							</div> -->
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
						<!-- </form> -->
					</div>
										
				</div>
			</div>
			<div class="leftFtr">
				<?php
					 $id = $_GET['id'];
					 if ($result = $mysqli->query("SELECT * FROM artikel where iArtikelid ='2'")) {
						// display records if there are records to display
							if ($result->num_rows > 0)
							{						
								while ($row = $result->fetch_object())
								{
									echo '<div class="divAreaPhoto">
												<img src="../'. $row->vImageFooter.'" width="100%" />
											</div>	';
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
		</div>
		<div class="clear"></div>
	</div>
</div>
<!-- FOOTER -->
<div id="boxFtr">
	<div class="wrapWidth">
		<div class="">
			Customer Service : (021) 5355 888, C2Fit tersedia di Apotek dan Toko Obat Terkemuka, juga tersedia di :						
		</div><br /><br />
		<?php
		 $idgroup = $_GET['cGroup2'];
		 if ($result = $mysqli->query("SELECT * FROM eoutlet where cGroup2 ='$idgroup'")) {
			// display records if there are records to display
				if ($result->num_rows > 0)
				{						
					while ($row = $result->fetch_object())
					{
						echo '<a href="'. $row->link_url.'" title="kimia farma" target="_blank"><img class="imgOutlet" height="30" src="../'. $row->vImages.'"></a>';
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
        	
		<!--<img class="imgApotkFotr" src="../assets/c2pw/assets/images/c2fit/apotek.png"/> -->
	</div>
	
</div>

<link rel="stylesheet" href="../assets/c2pw/assets/css/font-awesome.min.css">

<script type="text/javascript" src="../assets/c2pw/assets/js/jquery-1.6.2.min.js"></script>
	
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

  	$('#btnsubmit').click(function(){
    	$('#fregister').submit();  
  	});

  $('#fregister').validate({
        rules: {
            nama: "required",
            email: {
                  required: true,
                  email: true,
                  remote: {		   
	                  	beforeSend: function(){	
							$('#loading').html('<img src="../assets/c2pw/assets/images/camera-loader.gif" alt="loading" />'); 
						},	 
						complete:function() {
					           $("#loading").remove();
					     },
						url: "../assets/checkemail",
                        type: "get",
                        data: {email: $("input[email='email']").val(), _token: $('input[name=_token]').val()},
                        dataFilter: function (data) {
                            var json = JSON.parse(data);
                            if (json.msg == "true") {
                                return "\"" + "<style>#loading {display:none;}</style><p>Mohon maaf email yang anda masukan sudah pernah mendaftar, <br /> jika anda lupa password silahkan <br /> <a href=\'../assets/lupa\'>klik disini</a></p>" + "\"";
                           		
                            } else {
                                return 'true';
                                //return "\"" + "<style>#loading {display:none;}</style>sip" + "\"";
                            }                                    
                        }
                        					            		                              
                    }
              },
            telp: "required",
            kota: "required",
            namabayi: "required",
		    dBaby: "required",
            tgllahir: "required",
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
              nama: "Nama wajib diisi",
              email: {
	                required: "Email wajib diisi",
	                email: "Mohon isi email dengan benar",
	                remote: "Mohon maaf email sudah pernah mendaftar, jika anda lupa password. silahkan klik disni"
	            },
              telp: "No. Telp wajib diisi",
              tgllahir: "Tanggal Lahir wajib diisi",
              namabayi: "Nama anak anda wajib diisi",
		      dBaby: "Tanggal lahir anak anda wajib diisi",
              kota: "Kota wajib diisi",
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
    // $('#lengkap').wysihtml5();
    
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
<script type="text/javascript" src="../assets/assetbaru/js/thromecon.js"></script>
	<script>
		function check_availability(){
			  var username = $('#email').val(); 
			  $.ajax({
			  	 beforeSend: function(){	
						$('#loading').html('<img src="../assets/c2pw/assets/images/camera-loader.gif" alt="loading" />'); 
					},	
				  type:'GET',
				  url:'/checkemail/'+username,
				  data:'_token = 5usy59YrJVEZY1QrntAURTsdrGpXdZrth0rt3mSC',
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
</body>
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
</html>

