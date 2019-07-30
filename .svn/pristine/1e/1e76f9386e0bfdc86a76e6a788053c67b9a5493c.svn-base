<?php
// connect to the database
include('connect-db.php');
?>
<!-- BREAK -->
<!-- BREAK -->
<!DOCTYPE html>
<html>
<head>
	<title>	Artikel </title>
			
		<meta name="keyword" 				   content="Thromecon, " />
	<meta property="og:url"                content="" />
	<meta property="og:type"               content="article" />
	<meta property="og:title"              content="" />
	<meta property="og:description"        content="" />
	<meta property="og:image"              content="../assets/c2pw/assets/files/smsc/website/artikel/13/5ac79c4d40562b2ca49c1ae48888e2fc.jpg" />
	<link type="image/ico" rel="shortcut icon" href="../assets/c2pw/assets/images/logo_thromecon.ico">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="" />
	<link rel="stylesheet" href="../assets/c2pw/assetbaru/css/style-thromecon.css" type="text/css" media="screen" />
    
    <link rel="stylesheet" href="../assets/c2pw/assetbaru/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="../assets/c2pw/assetbaru/css/font-awesome.css" type="text/css">
	<link rel="stylesheet" href="../assets/c2pw/assetbaru/css/style-thromecon.css" type="text/css">
	<link rel="stylesheet" href="../assets/c2pw/assets/css/chartist.min.css">
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
		.social-google {
  background-color: #da573b;
  border-color: #be5238;
}
.social-google:hover{
  background-color: #be5238;
  border-color: #9b4631;
}

.social-twitter {
  background-color: #1daee3;
  border-color: #3997ba;
}
.social-twitter:hover {
  background-color: #3997ba;
  border-color: #347b95;
}

.social-facebook {
  background-color: #4c699e;
  border-color: #47618d;
}
.social-facebook:hover {
  background-color: #47618d;
  border-color: #3c5173;
}

.social-linkedin {
  background-color: #4875B4;
  border-color: #466b99;
}
.social-linkedin:hover {
  background-color: #466b99;
  border-color: #3b5a7c;
}
	</style>
    <section id="page-content" class="no-padding-top">
		<div class="container">
			<div class="content">
				<div class="article" style="padding-left:25px;padding-right:25px;">
					<div class="row">
						<div class="col-md-8 col-xs-12">
							<div class="isi-article">
								<?php
								 $id = $_GET['id'];
								 if ($result = $mysqli->query("SELECT * FROM artikel where iArtikelid ='$id'")) {
									// display records if there are records to display
										if ($result->num_rows > 0)
										{						
											while ($row = $result->fetch_object())
											{
												$date = $row->created_at;
												$format = date('d-m-Y | H:i:s', strtotime($date ));
												echo '<p class="overlay no-padding-top">'.$format.' - oleh :'.$row->vEditor.'</p>
														<h2 class="judul-article">'.$row->vJudul.'</h2>';							
													if (!$row->vImages == '') {
											    		echo '
															<img class="" src="../'. $row->vImages . '">		
														';
													}
											    	else {
											    		echo '
															<img src="../assets/c2pw/assets/images/no-image-thromecon.jpg" class="">		
														';
													}				
												echo '	
													<div class="teks-article">
														'.$row->vLengkap.'
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
								
                                <div class="clearfix"></div>
								<div class="teks-article">
									
									<div class="article-footer">
										<p class="article-copyright">( © 2016 | Customer Health Care - PT. Novell Pharmaceutical Labs. )</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-xs-12">
							<div class="sidebar-article">
								<div class="text-center head-sidebar-article">
									<h4>Artikel & News</h4>
								</div>
                                <?php
											 $id = $_GET['id'];
											 $idgroup = $_GET['cGroup2'];
											 if ($result = $mysqli->query("SELECT * FROM artikel where eType='ARTIKEL' And ldeleted ='0' And cGroup2='$idgroup'   ORDER BY created_at DESC limit 5 ")) {
												// display records if there are records to display
													if ($result->num_rows > 0)
													{						
														while ($row = $result->fetch_object())
														{
															echo '
															<div class="sidebar-article-item">
									<div class="media">
										<div class="media-left">
											                                                
										
																	
															';							
																if (!$row->vImages == '') {
														    		echo '<a href="/artikel-6/Pembekuan-Darah-3">
                                                    <img class="media-object" src="../'. $row->vImages . '" width="100px">		
                                                </a>
                                            										</div>';
																}
														    	else {
														    		echo '<a href="/artikel-6/Pembekuan-Darah-3">
                                                    <img class="media-object" src="../assets/c2pw/assets/images/no-image-thromecon.jpg" width="100px">		
                                                </a>
                                            										</div>';
																}				
															echo '	
															<div class="media-body">
											<a href="/artikel-6-Pembekuan-Darah-3">'.$row->vJudul.'</a>
										</div>
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
                                
                                								
                                								<a href="http://www.thromecon.co.id/artikel" class="btn btn-block flat" style="color:#444;"><b>Selengkapnya &raquo;</b></a>
							</div>
						</div>
					</div>
					<div>
						<h3>Bagikan: </h3>
						<div id="share">
						<a href="javascript: void(0)" onclick="popup_sosmed('http://www.facebook.com/sharer.php?u=http://www.thromecon.co.id/artikel/11/Artikel-04')" ><i id="social-fb" class="fa fa-facebook-square fa-3x social"></i></a>
						<a href="javascript: void(0)" onclick="popup_sosmed('https://twitter.com/share')"><i id="social-tw" class="fa fa-twitter-square fa-3x social"></i></a>
						<a href="javascript: void(0)" onclick="popup_sosmed('https://plus.google.com/share?url=http://www.thromecon.co.id/artikel/11/Artikel-04')"><i id="social-gp" class="fa fa-google-plus-square fa-3x social"></i></a>
					    </div>
					</div>	
				</div>
								<script type="text/javascript">
				var el = document.getElementById("menuArtikel");
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