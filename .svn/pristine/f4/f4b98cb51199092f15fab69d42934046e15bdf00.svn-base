<div id="tabsContent" class="jqgtabs">
	<ul>
		<li><a href="#tabs-1">Home</a></li> 
	</ul>
	<div id="tabs-1" style="font-size:12px;" class="sum_tabs">
		<?php 
			$clock = date('H : i');
			$exp   = explode(":",$clock);
			$time  = $exp[0]; 
			$greeting = '';
			
			if($time >='00' && $time < '10'){
				$greeting = $this->lang->line('tab_home_morning');
			} elseif( $time >= '10' && $time < '15'){
				$greeting = $this->lang->line('tab_home_noon');
			}elseif($time >= '15' && $time < '19'){
				$greeting = $this->lang->line('tab_home_afternoon');
			}elseif($time >= '19' && $time < '23'){
				$greeting = $this->lang->line('tab_home_night');
			}
			$exp_name = explode(" ", $NameUser);
			$nick_name= $exp_name[0];
		 	//echo $greeting.', '.$nick_name;
                        $isi  = "<div id='home'>";
                        $isi .= "<div id='greetings' style='width:30%;border:0px solid;'>";
                        $isi .= "<pre>";
                        $isi .= "Welcome, ".$NameUser." [ ".$NIPUser." ] <br/><br/>";
                        $isi .= $ComName."<br/>";
                        $isi .= $DivName."<br/>";
                        $isi .= $DeptName."<br/>";
                        $isi .= "</pre>";
                        $isi .= "</div>";
                        
                        //$isi .= "<div id='listtc' style='width:30%;border:1px solid;margin-top:3px;'>";
                        //$isi .= "List Tobe Confirmed";
                        //$isi .= "</div>";
                                
                        $isi .= "</div>";
                        echo $isi;
			
			$vContent = '';
			$sql = "SELECT vContent FROM hrd.eb_sysparam WHERE cVariable='LINKTEXT'";
			$query 	= $this->db->query($sql);
			if ($query->num_rows() > 0){
				$row 	= $query->row_array();
				$vContent 		= $row['vContent'];
			}
		?>
	
	<br /><br />
	
	<div id="placeholder" style="width:600px;height:300px; ">
		<span 
			style='position: absolute;
				bottom: 0;
				padding: 10px;
				color: #3c763d;
background-color: #dff0d8;
border-color: #d6e9c6;
padding: 15px;
margin-bottom: 20px;
border: 1px solid transparent;
border-radius: 4px;
				
				'
				
		><a style="text-decoration: none;" href='http://www.npl-net.com/bulletin/' target='_blank'><?php echo $vContent; ?></a></span>
	</div>
	<!-- script language="javascript" type="text/javascript" src="<?php echo base_url()?>assets/js/chart/jquery.flot.js"></script> 
	<script language="javascript" type="text/javascript" src="<?php echo base_url()?>assets/js/chart/jquery.flot.tooltip.min.js"></script> -->
	<script type="text/javascript">					
		/*$(function () {
			var placeholder = $("#placeholder");
		    var data = [];
		    var options = {
		       series:{  lines	: { show: true, lineWidth: 3  },
		        		 points	: { show: true },
		        		 xaxis	: { tickDecimals: 0, tickSize: 2  },
		        		 color  : '#FED22F'
		       },
		       grid:  { hoverable: true },
		       legend: { show: true },
		       tooltip: true,
		       tooltipOpts: {
		         content: "Tahun: %x, Growth: %y"
		       }
		    };

		    $.plot(placeholder, data, options);
		    var alreadyFetched = {};
		    function onDataReceived(series) {
				if (!alreadyFetched[series.label]) {
		             alreadyFetched[series.label] = true;
		             data.push(series);
		        }
		        $.plot(placeholder, data, options);
		   	}
		   	
			var dataNya = {
					    	"label": "Europe (EU27)",
					    	"data": [[1999, 3.0], [2000, 3.9], [2001, 2.0], [2002, 1.2], [2003, 1.3], [2004, 2.5], [2005, 2.0], [2006, 3.1], [2007, 2.9], [2008, 0.9]]
						  }
	        onDataReceived(dataNya)
		   
		});*/
	</script>	
	</div>
	
	</div>