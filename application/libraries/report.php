<?php

//require_once("http://10.1.49.8:8080/JavaBridge/java/Java.inc");
require_once("Java.inc");

class report {

	var $url;
	var $user;
	var $pass;
	var $config;
	var $host;
	var $db;
	var $dbset;
	
    public function __construct() {	  		
		$this->_ci =& get_instance();
		$this->dbset = $this->_ci->load->database('hrd', true);
		
        $this->host = $this->dbset->hostname;
        $this->db = $this->dbset->database;;   
		$this->url = 'jdbc:mysql://'.$this->host.'/'.$this->db;
		$this->user = $this->dbset->username;
		$this->pass= $this->dbset->password;
	     
    }

	public function showReport($path, $reportAsal, $reportTujuan, $params='', $type=1) {
		//load jasper
		$objJcm = new Java("net.sf.jasperreports.engine.JasperCompileManager");
		$objReportAsal = $objJcm->compileReport($path.$reportAsal);
		
		//database connection
		$objDriver = new Java("java.lang.Class");
		$objDriver->forName("com.mysql.jdbc.Driver");
		$objDManager = new Java("java.sql.DriverManager");
		$objDBConnect = $objDManager->getConnection($this->url, $this->user, $this->pass);
		$objFManager = new Java("net.sf.jasperreports.engine.JasperFillManager");
		$objPrint = $objFManager->fillReport($objReportAsal, $params, $objDBConnect);
		if ($type == 1) {
			$objJEManager = new Java("net.sf.jasperreports.engine.JasperExportManager");
			$objJEMHasil = $objJEManager->exportReportToPdfFile($objPrint, $path.$reportTujuan);

			//if($Preview == 'yes')
				$this->previewReport($path, $reportTujuan);
		} else if ($type == 2) {
			$xlsExporter = new Java("net.sf.jasperreports.engine.export.JRXlsExporter");
			$xlsExporterParam = new Java("net.sf.jasperreports.engine.JRExporterParameter");
			$xlsApiExporterParam = new Java("net.sf.jasperreports.engine.export.JExcelApiExporterParameter");
			$xlsExporter->setParameter($xlsExporterParam->JASPER_PRINT, $objPrint);
			$xlsExporter->setParameter($xlsExporterParam->OUTPUT_FILE_NAME, $path.$reportTujuan);
			//$xlsExporter->setParameter($xlsExporterParam->IS_AUTO_DETECT_CELL_TYPE, true);
			//IS_AUTO_DETECT_CELL_TYPE
			//IS_FONT_SIZE_FIX_ENABLED
			//IS_REMOVE_EMPTY_SPACE_BETWEEN_COLUMNS
			//IS_REMOVE_EMPTY_SPACE_BETWEEN_ROWS
			//IS_IGNORE_CELL_BORDER
			//IS_IGNORE_GRAPHICS
			//IS_COLLAPSE_ROW_SPAN
			$xlsExporter->setParameter($xlsApiExporterParam->IS_DETECT_CELL_TYPE, true);
			$xlsExporter->setParameter($xlsApiExporterParam->IS_FONT_SIZE_FIX_ENABLED, true);
			$xlsExporter->setParameter($xlsApiExporterParam->IS_REMOVE_EMPTY_SPACE_BETWEEN_COLUMNS, true);
			$xlsExporter->setParameter($xlsApiExporterParam->IS_REMOVE_EMPTY_SPACE_BETWEEN_ROWS, true);
			//$xlsExporter->setParameter($xlsApiExporterParam->IS_IGNORE_CELL_BORDER, true);
			//$xlsExporter->setParameter($xlsApiExporterParam->IS_IGNORE_GRAPHICS, true);
			//$xlsExporter->setParameter($xlsApiExporterParam->IS_COLLAPSE_ROW_SPAN, true);
			$xlsExporter->exportReport();	
			//if($Preview == 'yes')
				$this->previewReport($path, $reportTujuan);			
			
		} else if ($type == 3) {
			$htmlExporter = new Java("net.sf.jasperreports.engine.export.JRHtmlExporter");
			$htmlExporterHtml = new Java("net.sf.jasperreports.engine.export.JRHtmlExporterParameter");
			$htmlExporterParam = new Java("net.sf.jasperreports.engine.JRExporterParameter");
			
			$folder = array();
			$folder = explode(".", $reportAsal);	

			$htmlExporter->setParameter($htmlExporterHtml->IS_USING_IMAGES_TO_ALIGN, false); 	
			$htmlExporter->setParameter($htmlExporterHtml->IMAGES_URI, "localhost/erp/modules/misell/laporan/".$folder[0].".html_files/");
			//$htmlExporter->setParameter($htmlExporterHtml->IMAGES_URI,$folder[0].".html_files/");
	
	  		$htmlExporter->setParameter($htmlExporterParam->JASPER_PRINT, $objPrint);
	  		$htmlExporter->setParameter($htmlExporterParam->OUTPUT_FILE_NAME, $path.$reportTujuan);
	  		$htmlExporter->exportReport();
			
			$this->previewReport($path, $reportTujuan);
		} else if ($type == 4) {
			$jview = new Java("net.sf.jasperreports.view.JasperViewer");
			$jview->viewReport($objPrint, false);
		}else if ($type == 5) {
			$jprint = new Java("net.sf.jasperreports.engine.JasperPrintManager");			
			$jprint->printReport($objPrint,true);
		} else if ($type == 6) {
			$xlsExporter = new Java("net.sf.jasperreports.engine.export.JRTextExporter");			
			$xlsExporterText = new Java("net.sf.jasperreports.engine.export.JRTextExporterParameter");
			$xlsExporterParam = new Java("net.sf.jasperreports.engine.JRExporterParameter");
			
			$xlsExporter->setParameter($xlsExporterText->PAGE_WIDTH, 80);
			$xlsExporter->setParameter($xlsExporterText->PAGE_HEIGHT, 40);
			$xlsExporter->setParameter($xlsExporterParam->JASPER_PRINT, $objPrint);
			$xlsExporter->setParameter($xlsExporterParam->OUTPUT_FILE_NAME, $path.$reportTujuan);
			$xlsExporter->exportReport();
			
			$this->previewReport($path, $reportTujuan);
		}
	}

	public function previewReport($path, $namaLaporan) {
		$file_path = $path.$namaLaporan;
		
		//echo $file_path;

		if ($fp = fopen ($file_path, "r")) {
		$file_info = pathinfo($file_path);
		$file_name = $file_info["basename"];
		$file_size = filesize($file_path);
		$file_extension = strtolower($file_info["extension"]);	
		
		//echo $file_extension;
		//die;	

		if($file_extension != 'pdf' && $file_extension != 'xls' && $file_extension != 'html') {
			
			die('LOGGED! bad extension : '.$file_extension.''.strlen($file_extension));
		}

		ob_start();
		if ($file_extension == 'pdf') {
			header('Content-type: application/pdf');
		} else if ($file_extension == 'xls') {
			header('Content-type: application/ms-excel');
		} else if ($file_extension == 'html') {
			header('Content-type: text/html');  
			header('charset: UTF-8');
		} else if ($file_extension == 'txt') {
			header("Content-Type:text/plain");
		}
		
		header('Content-Disposition: attachment; filename="'.$file_name.'"');
		header("Content-length: $file_size");
		ob_end_flush();

		while(!feof($fp)) {
			$file_buffer = fread($fp, 2048);
			echo $file_buffer;
		}

		fclose($fp);
		unlink($file_path);
		exit;		
		} else {
		die('LOGGED! bad file '.$file_path);
		}	
	}

	public function compileReport($path, $reportAsal, $reportTujuan, $params='') {


		//load jasper
		$objJcm = new Java("net.sf.jasperreports.engine.JasperCompileManager");
		$objReportAsal = $objJcm->compileReport($path.$reportAsal);


		//database connection
		$objDriver = new Java("java.lang.Class");
		$objDriver->forName("com.mysql.jdbc.Driver");
		$objDManager = new Java("java.sql.DriverManager");
		$objDBConnect = $objDManager->getConnection($this->url, $this->user, $this->pass);

		$objFManager = new Java("net.sf.jasperreports.engine.JasperFillManager");
		$objPrint = $objFManager->fillReport($objReportAsal, $params, $objDBConnect);

		$objJEManager = new Java("net.sf.jasperreports.engine.JasperExportManager");
		$objJEMHasil = $objJEManager->exportReportToPdfFile($objPrint, $path.$reportTujuan);

		//$this->previewReport($path, $reportTujuan);


	}

	public function compileReportToWord($path, $reportAsal, $reportTujuan, $params='') {
		//load jasper
		$objJcm = new Java("net.sf.jasperreports.engine.JasperCompileManager");
		$objReportAsal = $objJcm->compileReport($path.$reportAsal);


		//database connection
		$objDriver = new Java("java.lang.Class");
		$objDriver->forName("com.mysql.jdbc.Driver");
		$objDManager = new Java("java.sql.DriverManager");
		$objDBConnect = $objDManager->getConnection($this->url, $this->user, $this->pass);

		$objFManager = new Java("net.sf.jasperreports.engine.JasperFillManager");
		$objPrint = $objFManager->fillReport($objReportAsal, $params, $objDBConnect);

		$xlsExporter = new Java("net.sf.jasperreports.engine.export.ooxml.JRDocxExporter");
		$xlsExporterParam = new Java("net.sf.jasperreports.engine.JRExporterParameter");
		
		$xlsExporter->setParameter($xlsExporterParam->JASPER_PRINT, $objPrint);
		$xlsExporter->setParameter($xlsExporterParam->OUTPUT_FILE_NAME, $path.$reportTujuan);
		$xlsExporter->exportReport();
	} 

	public function compileSubReport($path, $reportAsal, $params='') {

		//load jasper
		$objJcm = new Java("net.sf.jasperreports.engine.JasperCompileManager");
		$objReportAsal = $objJcm->compileReport($path.$reportAsal);	

		//database connection
		$objDriver = new Java("java.lang.Class");
		$objDriver->forName("com.mysql.jdbc.Driver");
		$objDManager = new Java("java.sql.DriverManager");
		$objDBConnect = $objDManager->getConnection($this->url, $this->user, $this->pass);

		$objFManager = new Java("net.sf.jasperreports.engine.JasperFillManager");
		$objPrint = $objFManager->fillReport($objReportAsal, $params, $objDBConnect);	

	} 
	
	public function previewIntReport($path,$reportAsal,$params='') {
	
	}
}


?>
