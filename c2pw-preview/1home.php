<?php
// connect to the database
include('connect-db.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title> Homepage Thromecon | www.thromecon.co.id
</title>
			
	<meta name="keywords" 				   content="Thromecon">	
<meta property="og:url"                content="" />
<meta property="og:type"               content="article" />
<meta property="og:title"              content="Homepage Thromecon | www.thromecon.co.id" />
<meta property="og:description"        content="" />
<meta property="og:image"              content="" />
	<link type="image/ico" rel="shortcut icon" href="../assets/c2pw/assets/images/logo_thromecon.ico">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="" />
	<link rel="stylesheet" href="../assets/c2pw/assetbaru/css/style-thromecon.css" type="text/css" media="screen" />
    
    <link rel="stylesheet" href="../assets/c2pw/assetbaru/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="../assets/c2pw/assetbaru/css/font-awesome.css" type="text/css">
	<link rel="stylesheet" href="../assets/c2pw/assetbaru/css/style-thromecon.css" type="text/css">
	<link rel="stylesheet" href="../assets/c2pw/assets/css/chartist.min.css">
	<link rel="stylesheet" href="../assets/c2pw/assets/css/themes/default/default.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="../assets/c2pw/assets/css/nivo-slider.css" type="text/css" media="screen" />
</head>
<body>

<div id="wrapper">
	
	<!-- HEADER & NAV -->
	<header>
		<div class="container">
			<div id="header-top">
				<div id="logo">
					<a href="#"><img src="../assets/c2pw/assets/images/logo_thromecon.png" class="logo" width="270px"></a>
				</div>
				<div id="login" class="pull-right">
					<ul>
												<li><a href="#menulogin" id="loginbutton"><i class="fa fa-unlock-alt" style="color: #748C87"></i> Login</a></li>
						<li><a href="/register"><i class="fa fa-sign-in" style="color: #748C87"></i> Register</a></li>
											</ul>
				</div>
			</div>
		</div>
	</header>
	<div id="wrapper-nav" class="">
		<div class="container">
			<nav class="navbar navbar-default nav-thromecon flat">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed flat" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#"><img src="../assets/c2pw/assets/images/logo_thromecon.png" class="logo" width="150px"></a>
				</div>
				<div id="navbar" class="navbar-collapse collapse navbar-thromecon">
					<ul class="nav navbar-nav">
						<li>
                            <a id="menuHome"  href="/">Beranda</a>
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
			</nav>
		</div>
	</div>
    <style>
	#modal {
    position: fixed;
    font-family: Arial, Helvetica, sans-serif;
    top: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.8);
    z-index: 99999;
    height: 100%;
    width: 100%;
}
.modalconent {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #fff;
    width: 50%;
    padding: 20px;
	border: 1px solid #888;
}
/*button[type=submit]{
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 8px 16px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
}*/
.affix-top,.affix{
  position: static;
}

/*#sidebar {
  background-color:#eee;
}*/

/*#sidebar li.active {
    border:0 #ddd solid;
    border-right-width:4px;
}*/

@media  screen and (min-width: 992px) {
  
  #sidebar .nav > .active > ul {
    display: block;
  }
  /* Widen the fixed sidebar */
  #sidebar.affix-top {
    position: static;
    /*margin-top:30px;*/
    /*width:234px;*/
  }
  
  #sidebar.affix,
  #sidebar.affix-bottom {
    /*width: 234px;*/
  }
  #sidebar.affix {
    position: fixed;
    top:50px;
  }
  #sidebar.affix-bottom {
    position: absolute;
  }
}
@media  screen and (min-width: 1200px) {
  #sidebar.affix-bottom,
  #sidebar.affix {
    width:360px;
  }
}
</style>
<div class="divSLV">				
		<div class="boxSLides">
			<div class="slider-wrapper theme-default">
				<div id="slider" class="nivoSlider">
					<?php
					 $id = $_GET['id'];
					 if ($result = $mysqli->query("SELECT * FROM eventimages where iArtikelid ='$id' And ldeleted = '0'")) {
						// display records if there are records to display
							if ($result->num_rows > 0)
							{						
								while ($row = $result->fetch_object())
								{
									echo '<a href="#"><img src="../' . $row->vImages . '" data-thumb="../' . $row->vImages . '" alt="" title="" width="100%" /></a>';
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
		</div>
		<div class="clear"></div>
	</div>
	<!-- PAGE CONTENT -->
<section id="page-content">
		<div class="container">
			<div class="content">
				<div class="row">
					<div class="col-md-8 col-sm-8 col-xs-12 pull-right">
						<main>
							<?php
							 $id = $_GET['id'];
							 if ($result = $mysqli->query("SELECT * FROM artikel where iArtikelid ='$id'")) {
								// display records if there are records to display
									if ($result->num_rows > 0)
									{						
										while ($row = $result->fetch_object())
										{
											echo "<img src='../" . $row->vImages . "' width='100%' /><br>";
											echo '<div class="bgVideo" style="margin-top:10px;">
													<iframe class="videoThromecon" width="100%" height="375" src="'. $row->vYoutube .'" frameborder="0" allowfullscreen></iframe>
												  </div>';
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
								
														
							<!-- artikel & tips -->
							<div class="home-article">
								<h1>Article & Tips</h1>
								<div class="row">
									<?php
										 function limit_words($string, $word_limit)
											{
											    $words = explode(" ",$string);
											    return implode(" ",array_splice($words,0,$word_limit));
											}
 
 
										 $id = $_GET['id'];
										 if ($result = $mysqli->query("SELECT * FROM artikel where eType ='ARTIKEL' And ldeleted = '0'  ORDER BY created_at DESC limit 1" )) {
											// display records if there are records to display
												if ($result->num_rows > 0)
												{						
													while ($row = $result->fetch_object())
													{
														
														
														echo '<div class="col-md-6 col-sm-6 col-xs-12">
																	<div class="article-item article-item-home">
																		<a href="/artikel/11/Artikel-04"><img src="../' . $row->vImages . '"></a>
																	</div>
																</div>
																<div class="col-md-4 col-sm-6 col-xs-12">
																	<div class="article-item article-item-home">
																	  <a href="/artikel/11/Artikel-04">'.$row->vJudul.'</a>
																		'.limit_words($row->vLengkap,20);'
																		
																	</div>
																</div>';
														
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
								<a href="/artikel" class="btn btn-default flat pull-right lihat">Lihat Artikel Lain &raquo;</a>
							</div>
							<div class="clearfix"></div>
								
							<div class="home-article">
								<h1>Promo</h1>
								<div class="row">
									<?php
									
										 $id = $_GET['id'];
										 if ($result = $mysqli->query("SELECT * FROM event where vKategori ='PROMO' And ldeleted = '0'  ORDER BY created_at DESC limit 1" )) {
											// display records if there are records to display
												if ($result->num_rows > 0)
												{						
													while ($row = $result->fetch_object())
													{
														echo '<div class="col-md-6 col-sm-6 col-xs-12">
																	<div class="article-item article-item-home">
																		<a href="/artikel/11/Artikel-04"><img src="../' . $row->vImageUtama . '"></a>
																	</div>
																</div>
																<div class="col-md-4 col-sm-6 col-xs-12">
																	<div class="article-item article-item-home">
																	  <a href="/artikel/11/Artikel-04">'.$row->vJudul.'</a>
																		'.limit_words($row->vLengkap,20);'
																	</div>
																</div>';
														
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
								<a href="/promo" class="btn btn-default flat pull-right lihat">Lihat Promo Lain &raquo;</a>
							</div>
							<div class="clearfix"></div>
								
							<!-- testimoni -->
							<div id="home-testimoni">	
								<div class="home-article">
									<h1>Testimoni</h1>
									<div class="row">
									<div class="col-md-4"> <!-- testi item 3 -->
										<?php
										 $id = $_GET['id'];
										 if ($result = $mysqli->query("SELECT * FROM testimoni a 
												INNER JOIN mscustomer b ON a.iMemberid = b.id
												where a.ePublish ='PUBLISH' ORDER BY a.tCreated DESC limit 1" )) {
											// display records if there are records to display
												if ($result->num_rows > 0)
												{						
													while ($row = $result->fetch_object())
													{
														echo '
															<div class="testi-head">
												<div class="row">
													<div class="col-xs-3">
														<img src="..//files/smsc/frontend/member/' . $row->vProfileImage . '" class="img-circle img-testimoni">
													</div>
													<div class="col-xs-9 no-padding-l" style="text-align:right;">
														<h4 class="no-padding-all"><strong>'.$row->vName.'</strong></h4>
														<h4 class="no-padding-all"><small>'.$row->tCreated.'</small></h4>
													</div>
												</div>
											</div>
											<div class="testi-body testi-body-home">
												<a href="#4" data-toggle="modal"> <!-- modal id 3 -->
													<img src="../' . $row->ifoto . '" width="100%" style="margin-bottom:10px;">
												</a>
													'.$row->iKomentar.'

												</div>
														';
														
														
														
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
									<a href="/testimoni" class="btn btn-default flat pull-right lihat">Lihat Testimoni Lain &raquo;</a>
								</div>
							</div>

						</main>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 pull-left fixedsticky">
						<aside id="sidebar">
							<div class="side-content-item">
								<div class="row">
									<div class="col-xs-4 col-md-3 no-padding-r">
										<img src="../assets/c2pw/assets/images/instagram.png" width="50px">
									</div>
									<div class="col-xs-8 col-md-9 no-padding-l">
										<h4 style="color:#fff;">JOIN OUR SOCIAL MEDIA</h4>
										<h4 class="no-padding-all"><small><a href="https://www.instagram.com/thromecongel/" target="_blank" style="color:#fff;">Click Here &raquo;</a></small></h4>
									</div>
								</div>
							</div>
							<div class="side-content-item">
								<h4>Ikuti Kuis & Menangkan Hadiahnya</h4>
								<a href="/promo">Click Here &raquo;</a>
							</div>
							<div class="side-content-item">
								<h4>Polling Konsumen</h4>
								<p>Perlukah Pertolongan Pertama Bila Anda Mengalami Memar ?</p>
								<form method="POST" action="/submitpolling">
										<input type="hidden" name="_token" value="DvDrcAuUU9lhPUcRcl7Uw1UCwbaSHfGgo3K0u9ZT">
									<input type="radio" name="polling" value="1"> PERLU<br>
									<input type="radio" name="polling" value="2"> TIDAK PERLU<br>
									<br>
									<button id="button" type="Submit" class="btn btn-login flat form-footer">Submit</button>
								</form>
							</div>
							<div class="side-content-item">
								<h4>Event Thromecon</h4>
								<a href="/event">Click Here &raquo;</a>
							</div>
							<div class="side-content-item side-content-item-last">
								<h4>Question & Answer</h4>
								<a href="/kontak">Click Here &raquo;</a>
							</div>
						</aside>
					</div>
				</div>
								<script type="text/javascript">
				window.onload = function () {
					 document.getElementById('button').onclick = function () {
					 document.getElementById('modal').style.display = "none"
					};
				};
					var el = document.getElementById("menuHome");
					el.classList.add("active");
				</script>
    <div class="footer">
        <div class="row">
            <div class="col-sm-5">
                <h2 class="no-padding-top" style="color:#006ab3;">Sign Up / Sign In</h2>
                <p>Daftarkan email anda dan dapatkan info-info terbaru dari THROMECON, atau kirim kritik dan saran kamu tentang THROMECON </p>
            </div>
            <div class="col-sm-7" id="menulogin">
                <form method="post" action="/login" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="DvDrcAuUU9lhPUcRcl7Uw1UCwbaSHfGgo3K0u9ZT"> 
                    <div class="input-group col-xs-9 form-footer">
                        <input type="text" placeholder="Email Anda" class="form-control flat" name="email">
                    </div>
                    <div class="input-group col-xs-9 form-footer">
                        <input type="password" placeholder="Password Anda" class="form-control flat" name="password">
                    </div>
                    <div>
						<input type="submit" value="Masuk" class="btn btn-login flat form-footer"/> 
					</div>
                    <p>Belum punya akun, <a href="/register">Registrasi disini!</a></p>
                    <p>Lupa password, <a href="#">Klik disini!</a></p>
                </form>
            </div>
        </div>
    </div>
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
</section>
</div>
    <script type="text/javascript" src="../assets/c2pw/assetbaru/js/jquery-2.2.0.min.js"></script>
	<script type="text/javascript" src="../assets/c2pw/assetbaru/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../assets/c2pw/assetbaru/js/thromecon.js"></script>
	<script>
		function check_availability(){
			  var username = $('#email').val(); 
			  $.ajax({
				  type:'GET',
				  url:'/checkemail/'+username,
				  data:'_token = DvDrcAuUU9lhPUcRcl7Uw1UCwbaSHfGgo3K0u9ZT',
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
	  <script type="text/javascript" src="../assets/c2pw/assets/js/jquery-1.7.1.min.js"></script>
	  <script type="text/javascript" src="../assets/c2pw/assets/js/jquery.nivo.slider.js"></script>
		<script type="text/javascript">
	    $(window).load(function() {
	        $('#slider').nivoSlider();
	    });
	    </script>
	  <script type="text/javascript" src="assets/js/texteditor/ckeditor/ckeditor.js"></script>
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
</body>
</html>
