<?php
// connect to the database
include('connect-db.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title> Homepage Nutrafor White Beauty | www.nutraforwhitebeauty.co.id
</title>
			
	<meta name="keywords" 				   content="Nutrafor White Beauty">	
<meta property="og:url"                content="" />
<meta property="og:type"               content="article" />
<meta property="og:title"              content="Homepage Nutrafor White Beauty | www.nutraforwhitebeauty.co.id" />
<meta property="og:description"        content="" />
<meta property="og:image"              content="" />
	<link type="image/ico" rel="shortcut icon" href="../assets/c2pw/assets/images/nwb/logo_thromecon.ico">
	<!-- CSRF Token -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="" />
	    
    <link rel="stylesheet" href="../assets/c2pw/assetbaru/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="../assets/c2pw/assetbaru/css/font-awesome.css" type="text/css">
	<link rel="stylesheet" href="../assets/c2pw/assetbaru/css/style-nwb.css" type="text/css">
	
</head>
<body>

<div id="wrapper">	
	<!-- HEADER & NAV -->
	<header>
		<div class="container">
			<div id="header-top">
				<div id="logo">
					<a href="/"><img src="../assets/c2pw/assets/images/nwb/logo_nwb.png" class="logo" width=""></a>
				</div>
				<div id="login" class="pull-right">
					<ul>
												<li><a href="#menulogin" id="loginbutton" data-toggle="modal"><i class="fa fa-unlock-alt" style="color: #748C87"></i> Login</a></li>
						<li><a href="/register"><i class="fa fa-sign-in" style="color: #748C87"></i> Register</a></li>
											</ul>
					<a href="/"><img src="../assets/c2pw/assets/images/nwb/follow_on_facebook.png" class="" width="180"></a>
				</div>
				<div id="menulogin" class="modal fade">
					<div class="modal-dialog" style="width: 300px;">
						<div class="modal-content flat">
							<div class="modal-body">
								<div class="leftFtr" id="menulogin">
								<div class="bgSign">
									<form method="post" action="/login" enctype="multipart/form-data">
										<input type="hidden" name="_token" value="LlQguba5jSBofaEtovcpAkdkiKV460NjwvE8Jdk6"> 
										<div class="form-group">
											<strong>Silahkan masukan <br /> Email & Password Anda ! </strong>
										</div>
										<div class="form-group">
											<input name="email" type="email" placeholder="Email Anda" />
										</div>
										<div class="form-group">
											<input name="password" type="password" placeholder="Password Anda" />
										</div>
										<div class="form-group">
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
						</div>
					</div>
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
					<a class="navbar-brand" href="/"><img src="../assets/c2pw/assets/images/nwb/logo_nwb.png" class="logo" width=""></a>
				</div>
				<div id="navbar" class="navbar-collapse collapse navbar-thromecon">
					<ul class="nav navbar-nav">
						<li>
                            <a id="menuHome"  href="#">Beranda</a>
                        </li>
                        <li>
                            <a id="menuProduk" href="#">Produk Kami</a>
                        </li>
                        <li>
                            <a id="menuArtikel" href="#">Tips Kesehatan</a>
                        </li>
                        <li>
                            <a id="menuOutlet" href="#">Beli dimana ?</a>
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

	<!-- PAGE CONTENT -->
    <section id="page-content" class="no-padding-top">
		<div class="container">
			<div class="content">
				<img src="../assets/c2pw/assets/images/nwb/bg_testi.png" alt="" title="" width="100%" />
				<div class="head-page text-center">
					<h1>Testimonial</h1>
				</div>
				
				<div class="clear"></div>
				
				<div class="testimoni">
					<div class="row">
						
						<?php
						$num_rec_per_page=6;
								//mysql_connect('10.1.49.8','nplnet','nplnet01');
								mysql_connect('localhost','root','');
								mysql_select_db('smsc');
								if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
								$start_from = ($page-1) * $num_rec_per_page; 
						 // $id = $_GET['id'];
						 if ($result = $mysqli->query("SELECT * FROM smsc.testimoni where ePublish='PUBLISH' And cGroup2='G00040' ORDER BY tCreated DESC LIMIT $start_from, $num_rec_per_page ")) {
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
										echo '<div class="col-md-4">
												<div class="testi-item">
													<div class="testi-head" style="border-bottom:1px dotted #ccc; margin-bottom:10px; padding-bottom:5px;">
														<div class="row">
															<div class="col-xs-3">';
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
																    		<img src="'.$path.'" class="img-circle img-testimoni">
															
																			</div>
																				<div class="col-xs-9 no-padding-l" style="text-align:right;">
																					<h4 class="no-padding-all"><strong>'.$row2->vName.'</strong></h4>
																					<h4 class="no-padding-all"><small>'.$format.'</small></h4>
																				</div>';
																		}
															    	else {
															    		echo '	
																				<img src="../assets/c2pw/assets/images/user.png" class="img-circle img-testimoni">
															
																			</div>
																				<div class="col-xs-9 no-padding-l" style="text-align:right;">
																					<h4 class="no-padding-all"><strong>'.$row2->vName.'</strong></h4>
																					<h4 class="no-padding-all"><small>'.$format.'</small></h4>
																				</div>';
																}
															}
																 	
															}				
															
														 }
													     
														 if (!$row->ifoto == '') {
														 	    echo '
														 	    		</div>
																			</div>
																			<div class="testi-body">
																				<a href="#'.$row->iMemberid.'" data-toggle="modal"> <!-- modal id 6 -->
																					<img src="../'.$row->ifoto.'" class="img-testimoni-item">
																				</a>
																				<div style="height:100px;">'.$string.'</div>
																			</div>
																			<!-- Testi Modal -->
																			<div id="'.$row->iMemberid.'" class="modal fade" style="display: none;"> <!-- modal id 6 -->
																				<div class="modal-dialog">
																					<div class="modal-content flat">
																						<div class="modal-header">
																							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																							<div class="row">
																								
																							</div>
																						</div>
																						<div class="modal-body">
																							<img src="../'.$row->ifoto.'" style="margin-bottom:10px;" width="100%">
																								'.$string.'
											
																						</div>
																					</div>
																				</div>
																			</div>
														 	    ';
															}
												    	else {
												    		echo '
												    		</div>
																			</div>
																			<div class="testi-body">
																				<a href="#'.$row->iMemberid.'" data-toggle="modal"> <!-- modal id 6 -->
																					<img src="../assets/c2pw/assets/images/no-image-nwb.jpg" class="img-testimoni-item">
																				</a>
																				<div style="height:100px;">'.$string.'</div>
																			</div>
																			<!-- Testi Modal -->
																			<div id="'.$row->iMemberid.'" class="modal fade" style="display: none;"> <!-- modal id 6 -->
																				<div class="modal-dialog">
																					<div class="modal-content flat">
																						<div class="modal-header">
																							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																							<div class="row">
																								
																							</div>
																						</div>
																						<div class="modal-body">
																							<img src="../assets/c2pw/assets/images/no-image-nwb.jpg" style="margin-bottom:10px;" width="100%">
																								'.$string.'
											
																						</div>
																					</div>
																				</div>
																			</div>';
														}					
											echo '	
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
				<script type="text/javascript">
					var el = document.getElementById("menuTestimoni");
					el.classList.add("active");
				</script>
			</div>
		</div>
	</section>

    
    <div class="footer">
        <p>Copyright &copy; 2017  | All rights reserved</p>
    </div>
    
    <script type="text/javascript" src="../assets/c2pw/assetbaru/js/jquery-2.2.0.min.js"></script>
	<script type="text/javascript" src="../assets/c2pw/assetbaru/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../assets/c2pw/assetbaru/js/thromecon.js"></script>
	<script>
		function check_availability(){
			  var username = $('#email').val(); 
			  $.ajax({
			  	beforeSend: function(){	
						$('#loading').html('<img src="../assets/c2pw/assets/images/camera-loader.gif" alt="loading" />'); 
					},	
				  type:'GET',
				  url:'/checkemail/'+username,
				  data:'_token = LlQguba5jSBofaEtovcpAkdkiKV460NjwvE8Jdk6',
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


