<?php
/*
 * library form 2012, 
 * made in hongkong (madekong)
 */
class MyForm {
	
	protected $options;
	
	public $_ci;
	public $_form; // string nampung form html
	public $_formID; // form id untuk ajax request
	public $_formAjaxAction; // form submit ajax url-nya
	public $_btnSubmit; // string nampung button submit html
	public $javascript; // string nampung extra javascript source
 	
	private $no_grid;
	private $group_id;
	private $module_id;
	private $url_base;
	private $js_form_upload = false;
	
	private $company;
	/*
	 * bisa ditambahkan/modif2 lagi, monggo..
	 */
	
	public function __construct() {
		$this->_ci=&get_instance();
		$this->_ci->load->library('form_validation'); //belum terpakai
		$this->_ci->load->library('Zend', 'Zend/Session/Namespace');		
		$this->_ci->load->helper('form'); //http://ellislab.com/codeigniter/user-guide/helpers/form_helper.html
		$this->_ci->load->helper('url'); //belum terpakai
		$this->_ci->load->model('m_utilitas');
		
		$this->options = array(
			'url' 		=> base_url(), 	//url, for action form
			'view'	 	=> '', 			//view, for load 
			'proc'		=> '', 			//proc, for action process. Ex:edit, read etc.
			'draw_dtl'  => FALSE, 		//draw_dtl, for draw detail form
			'opt_dtl' 	=> FALSE, 		//opt_dtl, for draw option detail from detail form
			'pk_id'		=> '',			//pk_id, for init primary key form
			'db'		=> '',			//db, for init database
			'table'		=> '',			//table, for init table in database
			'button' 	=> '',			//button, for draw your custom button
			'param_id'	=> '',			//param_id, option for parameter id
			'parent_id'	=> '',			//parent_id, option for parent id
			'no_urut'	=> '',			//no_urut, option for number
			'return'	=> FALSE,		//return, for return
			'multipart'	=> FALSE,		//multipart, for multipart form type			
		);
		
		
	}
	
	public function drawSearching($param) {
		
		//print_r($param);
		switch($param['type']) {
			case 'file' :
				$options = array(
					'name'    => 'files[]',
					'id'      => $param['name'],
					'required' => $param['required'],
				);
				$field 	 = $this->setFileType($param['label'], $options, 'search');
		
				$this->js_form_upload = TRUE;
				break;
					
			case 'combobox' :
				$options = array(
					'name'       => $param['name'],
					'id'         => $param['name'],
					'selected'   => '-',
					'class'      => 'fieldTextBox',							
					'values'     => $param['values'],
					'relationAt' => isset($param['relationAt']) ? $param['relationAt'] : 0,
					'required'   => $param['required'],
				);
				
				$field = $this->setDropdown($param['label'], $options);
				break;
					
			case 'radio' :
				$options = array(
					'name'   => $param['name'],
					'id'	 => $param['name'],
					'value'  => 'accept',
					'required' => $param['required'],
				);
				$field = $this->setRadio($param['label'], $options);
				break;
					
			case 'hidden' :
				$field = $this->setHiddenText($param['name'], $param['value']);
				break;
		
			case 'date' :
				$options = array(
					'name'     => $param['name'],
					'id'       => $param['name'],
					'value'    => $param['value'],
					'maxlength'=> '100',
					'class'      => 'fieldTextBox',
					'size'     => $param['size'],
					'required' => $param['required'],
				);
				$field = $this->setDateBox($param['label'], $options);
				break;
		
			case 'datetime' :
				$options = array(
					'name'     => $param['name'],
					'id'       => $param['name'],
					'value'    => $param['value'],
					'maxlength'=> '100',
					'class'      => 'fieldTextBox',
					'size'     => $param['size'],
					'required' => $param['required'],
				);
				$field = $this->setDateTimeBox($param['label'], $options);
				break;
		
			case 'time' :
				$options = array(
					'name'     => $param['name'],
					'id'       => $param['name'],
					'value'    => $param['value'],
					'maxlength'=> '100',
					'class'      => 'fieldTextBox',
					'size'     => $param['size'],
					'required' => $param['required'],
				);
				break;
		
			case 'textbox' :
				$options = array(
					'name'     => $param['name'],
					'id'       => $param['name'],
					'value'    => $param['value'],
					'size'     => $param['size'],
					'class'      => 'fieldTextBox',
					'required' => $param['required'],
				);
				$field = $this->setTextBox($param['label'], $options);
				break;
					
			case 'password' :
				$options = array(
					'name'     => $param['name'],
					'id'       => $param['name'],
					'value'    => $param['value'],
					'size'     => $param['size'],
					'class'      => 'fieldTextBox',
					'required' => $param['required'],
				);
				$field = $this->setPasswordBox($param['label'], $options, (isset($param['info'])?$param['info']:''));
				break;
					
			case 'textarea' :
				if (!isset($param['rows'])) $param['rows'] = 0;
				if (!isset($param['cols'])) $param['cols'] = 0;
				$options = array(
					'name'   => $param['name'],
					'id'     => $param['name'],
					'value'  => $param['value'],
					'rows'   => $param['rows'],
					'cols'	 => $param['cols'],
					'class'      => 'fieldTextBox',
					'required' => $param['required'],
				);
				$field = $this->setTextArea($param['label'], $options);
				break;					
			case 'label' :
				$options = array(
					'name'   	=> $param['name'],
					'id'     	=> $param['name'],
					'value'  	=> $param['value'],
					'values' 	=> isset($param['values']) ? $param['values'] : $param['value'],
					'model'  	=> isset($param['model']) ? $par['model'] : "",
					'method' 	=> isset($param['method']) ? $par['method'] : "",
					'relationAt'=> isset($param['relationAt']) ? $par['relationAt'] : 0,
					'type'		=> $param['type'],
					'required' => $param['required'],
				);
				$field = $this->setLabel($param['label'], $options);
				break;
		
			case 'lookup' :
				$options = array(
					'name'   => $param['name'],
					'id'     => $param['name'],
					'value'  => $param['value'],
					'model'  	=> isset($param['model']) ? $param['model'] : "",
					'method' 	=> isset($param['method']) ? $param['method'] : "",
					'size'   => $param['size'],
					'class'      => 'fieldTextBox',
					'required' => $param['required'],
				);
				$field = $this->setLookup($param['label'], $options);
				break;
		
			case 'free' :
				$options = array(
				'object' => $param['object']
				);
				$field = $this->setFreeObject($options);
				break;
					
			default :
				$options = array(
					'name'     => $param['name'],
					'id'       => $param['name'],
					'value'    => $param['value'],
					'maxlength'=> '100',
					'size'     => $param['size'],
					'class'      => 'fieldTextBox',
					'required' => $param['required'],
				);
				$field = $this->setTextBox($param['label'], $options);
				break;
		}
		
		return $field;
	}

	
	public function drawForm($param, $property, $group_and_modul="") {
		
		$this->_ci->load->library('MyGrid2');
		
	 	$sess_auth 		= new Zend_Session_Namespace('auth');
		$this->no_grid 	= $sess_auth->gModul;
		$this->url_base = base_url();
		$required_field = array();
		$duplicated_field = array();
		$this->company	= $_GET['company_id'];//$group_and_modul['company_id'];
		
		$group_and_modul['group_id'] = $_GET['group_id'];
		$group_and_modul['modul_id'] = $_GET['modul_id'];
		$group_and_modul['company_id'] = $_GET['company_id'];

		$this->options = array_merge($this->options, $property);
		
		$url  	   = $this->options['url'];
		$view 	   = $this->options['view'];
		$proc 	   = $this->options['proc'];
		$drawDtl   = $this->options['draw_dtl'];
		$param_dtl = $this->options['opt_dtl'];
		$pk_id 	   = $this->options['pk_id'];
		$table     = $this->options['table'];
		$db        = $this->options['db'];
		$button    = $this->options['button'];
		$param_id  = $this->options['param_id'];
		$parent_id = $this->options['parent_id'];
		$multipart = $this->options['multipart'];
		
		$group_and_modul['parent_id'] = $parent_id;
		
		$drawField = '';
		$drawForm  = '';
		$field 	   = '';				
		$form_element_to_save = '';
		$form_type_to_save = '';
		
		foreach($param as $par) {
			//cek required field
			if($par['required']){
				//array_push($required_field, $par['name'] );
				array_push($required_field, $table.'_'.$par['name'] );
			}
			//cek required field
			
			//cek duplicated field
			if(!$par['duplicated']){
				//array_push($duplicated_field, $par['name'] );
				array_push($duplicated_field, $table.'_'.$par['name'] );
			}
			//cek duplicated field
				
			if ($par['name'] == $pk_id) {
				$id = $par['value'];
			} else {
				$id = 0;
			}
			
			$form_element_to_save .= '"'.$table.'_'.$par['name'].'",';	
			$form_type_to_save .= '"'.$table.'_'.$par['type'].'",';
			
			//klo dalam view mode, paksa jadi label.
			if ($proc == 'view' && $par['type'] != 'hidden' && $par['type'] != 'free' && $par['type'] != 'file') $par['type'] = 'label';
			
			switch($par['type']) {
				case 'file' :
					$options = array(
						'name'    => 'files[]',
						'id'      => $table."_".$par['name'],
						'style'   => $par['style'],
						'class'	  => $par['class'],
						'width'   => $par['width'],
						'required' => $par['required']
					);
					
					if ($par['readonly'] == 1 || $proc == 'view'){
						$dsbld = ',ui-state-disabled';
						$readonly = array('readonly' => 'readonly',  'class' => $dsbld );
					}else{
						$readonly = array();
					}
					
					$options = array_merge($options, $readonly);
					$field 	 = $this->setFileType($par['label'], $options, $proc);
						
					$this->js_form_upload = TRUE;					
					break;
					
				case 'combobox' :
					$options = array(
								'name'    => $table."_".$par['name'],
								'id'      => $table."_".$par['name'],
								'values'  => $par['values'],
								'style'   => $par['style'],
								'class'	  => $par['class'],
								'selected'=> $par['value'],
								'width'   => $par['width'],
								'relationAt' => isset($par['relationAt']) ? $par['relationAt'] : 0,
								'required' => $par['required']
							);
					if ($par['readonly'] == 1 || $proc == 'view'){
						$dsbld = ',ui-state-disabled';
						$readonly = array('readonly' => 'readonly',  'class' => $dsbld );
					}else{
						$readonly = array();
					}	
					
					$options = array_merge($options, $readonly);					
					$field = $this->setDropdown($par['label'], $options);
					break;
					
				case 'radio' :
					$options = array(
							    'name'   => $table."_".$par['name'],
							    'id'	 => $table."_".$par['name'],
							    'value'  => 'accept',
							    'style'  => $par['style'],
							    'checked'=> TRUE,	
							    'class'	 => $par['class'],
								'required' => $par['required']
						    );
				    if ($par['readonly'] == 1 || $proc == 'view'){
				    	$dsbld = ',ui-state-disabled';
				    	$readonly = array('readonly' => 'readonly',  'class' => $par["class"].$dsbld );
				    }else{
				    	$readonly = array();
				    }
				    $options = array_merge($options, $readonly);
					$field = $this->setRadio($par['label'], $options);
					break;
					
				case 'hidden' :										
						$field = $this->setHiddenText($table."_".$par['name'], $par['value']);
						break;
						
				case 'date' :
						$options = array(
								'name'     => $table."_".$par['name'],
								'id'       => $table."_".$par['name'],
								'value'    => $par['value'],
								'maxlength'=> '100',
								'size'     => $par['size'],
								'style'    => $par['style'],
								'class'	 => $par['class'],
								'required' => $par['required']
						);
						if ($par['readonly'] == 1 || $proc == 'view'){
							$dsbld = ',ui-state-disabled';
							$readonly = array('readonly' => 'readonly',  'class' => $par["class"].$dsbld );
						}else{
							$readonly = array();
						}
						$options = array_merge($options, $readonly);
						$field = $this->setDateBox($par['label'], $options);
						break;
						
				case 'datetime' :
						$options = array(
								'name'     => $table."_".$par['name'],
								'id'       => $table."_".$par['name'],
								'value'    => $par['value'],
								'maxlength'=> '100',
								'size'     => $par['size'],
								'style'    => $par['style'],
								'class'	 => $par['class'],
								'required' => $par['required']
						);
						if ($par['readonly'] == 1 || $proc == 'view'){
							$dsbld = ',ui-state-disabled';
							$readonly = array('readonly' => 'readonly',  'class' => $par["class"].$dsbld );
						}else{
							$readonly = array();
						}
						$options = array_merge($options, $readonly);
						$field = $this->setDateTimeBox($par['label'], $options);
						break;
						
				case 'time' :
						$options = array(
								'name'     => $table."_".$par['name'],
								'id'       => $table."_".$par['name'],
								'value'    => $par['value'],
								'maxlength'=> '100',
								'size'     => $par['size'],
								'style'    => $par['style'],
								'class'	 => $par['class'],
								'required' => $par['required']
						);
						if ($par['readonly'] == 1 || $proc == 'view'){
							$dsbld = ',ui-state-disabled';
							$readonly = array('readonly' => 'readonly',  'class' => $par["class"].$dsbld );
						}else{
							$readonly = array();
						}
						$options = array_merge($options, $readonly);
						$field = $this->setTimeBox($par['label'], $options);
						break;
						
				case 'textbox' :
					$options = array(
								  'name'     => $table."_".$par['name'],
					              'id'       => $table."_".$par['name'],
					              'value'    => $par['value'],
					              'maxlength'=> '100',
					              'size'     => $par['size'],
					              'style'    => $par['style'],
					              'class'	 => $par['class'],
								  'required' => $par['required']
							);
					if ($par['readonly'] == 1 || $proc == 'view'){
						$dsbld = ',ui-state-disabled';
						$readonly = array('readonly' => 'readonly',  'class' => $par["class"].$dsbld );
					}else{
						$readonly = array();
					}
					$options = array_merge($options, $readonly);
					$field = $this->setTextBox($par['label'], $options);
					break;	
					
				case 'password' :
						$options = array(
							'name'     => $table."_".$par['name'],
							'id'       => $table."_".$par['name'],
							'value'    => $par['value'],
							'maxlength'=> '100',
							'size'     => $par['size'],
							'style'    => $par['style'],
							'class'	 => $par['class'],
							'required' => $par['required']
						);
						if ($par['readonly'] == 1 || $proc == 'view'){
							$dsbld = ',ui-state-disabled';
							$readonly = array('readonly' => 'readonly',  'class' => $par["class"].$dsbld );
						}else{
							$readonly = array();
						}
						$options = array_merge($options, $readonly);
						$field = $this->setPasswordBox($par['label'], $options, (isset($par['info'])?$par['info']:''));
						break;
					
				case 'textarea' :
					if (!isset($par['rows'])) $par['rows'] = 0;
					if (!isset($par['cols'])) $par['cols'] = 0;
					$options = array(
								'name'   => $table."_".$par['name'],
								'id'     => $table."_".$par['name'],
								'value'  => $par['value'],
								'rows'   => $par['rows'],
								'cols'	 => $par['cols'],	
								'style'  => $par['style'],
								'class'	 => $par['class'],
								'required' => $par['required']
							);	
					if ($par['readonly'] == 1 || $proc == 'view'){
						$dsbld = ',ui-state-disabled';
						$readonly = array('readonly' => 'readonly',  'class' => $par["class"].$dsbld );
					}else{
						$readonly = array();
					}						
					$options = array_merge($options, $readonly);
					$field = $this->setTextArea($par['label'], $options);
					break;
					
				case 'label' :
						$options = array(
							'name'   	=> $table."_".$par['name'],
							'id'     	=> $table."_".$par['name'],
							'value'  	=> $par['value'],
							'values' 	=> isset($par['values']) ? $par['values'] : $par['value'],
							'style'  	=> $par['style'],
							'class'	 	=> $par['class'],
							'model'  	=> isset($par['model']) ? $par['model'] : "",
							'method' 	=> isset($par['method']) ? $par['method'] : "",
							'relationAt'=> isset($par['relationAt']) ? $par['relationAt'] : 0,
							'type'		=> $par['type'],
							'required' => $par['required']
						);
						
						if ($par['readonly'] == 1 || $proc == 'view'){
							$dsbld = ',ui-state-disabled';
							$readonly = array('readonly' => 'readonly',  'class' => $par["class"].$dsbld );
						}else{
							$readonly = array();
						}
						$options = array_merge($options, $readonly);
						$field = $this->setLabel($par['label'], $options);
						break;
						
				case 'lookup' :
						$options = array(
							'name'   => $table."_".$par['name'],
							'id'     => $table."_".$par['name'],
							'value'  => $par['value'],
							'style'  => $par['style'],
							'class'	 => $par['class'],
							'model'  	=> isset($par['model']) ? $par['model'] : "",
							'method' 	=> isset($par['method']) ? $par['method'] : "",
							'size'   => $par['size'],
							'required' => $par['required']
						);
						$field = $this->setLookup($par['label'], $options);
						break;
						
				case 'free' :
					$options = array(
							'object' => $par['object']
					);
					$field = $this->setFreeObject($options);
					break;
					
				default :
					$options = array(
								  'name'     => $table."_".$par['name'],
					              'id'       => $table."_".$par['name'],
					              'value'    => $par['value'],
					              'maxlength'=> '100',
					              'size'     => $par['size'],
					              'style'    => $par['style'],
					              'class'	 => $par['class'],
								  'required' => $par['required']
							);
					if ($par['readonly'] == 1 || $proc == 'view'){
						$dsbld = ',ui-state-disabled';
						$readonly = array('readonly' => 'readonly',  'class' => $par["class"].$dsbld );
					}else{
						$readonly = array();
					}
					$options = array_merge($options, $readonly);
					$field = $this->setTextBox($par['label'], $options);
					break;
			}			
			$drawField .= $field; 
		}
		switch($proc) {
			case 'add' :
				$header = "Add Record";
				break;
			case 'edit' :
				$header = "Edit Record #".$parent_id;
				break;
			case 'view' :
				$header = "View Record #".$parent_id;
				break;
			default :
				break;
		}
		
		$form_id   = 'form_'.$this->no_grid;
		$drawForm .= $this->openForm($url, array('name'=>$form_id, 'id'=>$form_id), $multipart);
		$drawForm .= '<table border="0" cellpadding="3" cellspacing="0" width="100%">';
		$drawForm .= '<tr><td id="error" colspan="3" align="center" style="display:none;">
							<span id="errorMessage"></span>
					  </td></tr>';
		$drawForm .= '<tr>';
			$drawForm .= '<td colspan="2" class="ui-widget ui-widget-header ui-corner-top padding-7">'.$header.'</td>';
		$drawForm .= '</tr>';
		
		$drawForm .= '<tr>';
			$drawForm .= '<td class="ui-state ui-state-default ui-corner-bottom">';
				$drawForm .= '<table cellpadding="3" cellspacing="0" width="100%" border="0">';
					$drawForm .= $drawField;
				$drawForm .= '</table>';
			$drawForm .= '</td>';
		$drawForm .= '</tr>';
		
		//$lastUpdate = $this->_ci->m_utilitas->getLastUpdated($db, $pk_id, $id, $table);
				
		$drawForm .= '<span>';
		$drawForm .= '<input type="hidden" class="para" name="'.$table.'_group" id="'.$table.'_group" value="'.$group_and_modul['group_id'].'"/>';		
		$drawForm .= '<input type="hidden" class="para" name="'.$table.'_module" id="'.$table.'_module" value="'.$group_and_modul['modul_id'].'"/>';
		$drawForm .= '<input type="hidden" class="para" name="'.$table.'_company" id="'.$table.'_company" value="'.$group_and_modul['company_id'].'"/>';
		//$drawForm .= '<input type="hidden" class="para" name="'.$table.'_lastUpdateAt" id="'.$table.'_lastUpdateAt" value="'.$lastUpdate['tUpdatedAt'].'"/>';
		//$drawForm .= '<input type="hidden" class="para" name="'.$table.'_lastUpdateBy" id="'.$table.'_lastUpdateBy" value="'.$lastUpdate['cUpdatedBy'].'"/>';
		$drawForm .= '<input type="hidden" class="para" name="'.$table.'_lastUpdateAt" id="'.$table.'_lastUpdateAt" value=""/>';
		$drawForm .= '<input type="hidden" class="para" name="'.$table.'_lastUpdateBy" id="'.$table.'_lastUpdateBy" value=""/>';
		$drawForm .= '<input type="hidden" class="para" name="'.$table.'_st_update" id="'.$table.'_st_update" value = "'.$proc.'"/>';
		$drawForm .= '<input type="hidden" class="para" name="'.$table.'_id_process" id="'.$table.'_id_process" value = "'.$proc.'"/>';
		$drawForm .= '</span>';
		$drawForm .= '</table>';
		
		//$drawForm .= '<br />';
		$dtl_ = array();
		if ($drawDtl === TRUE) {
			//print_r($group_and_modul);
			if (!isset($param_dtl[0]['reset'])) {	
				$drawForm  .= "<div align='center' id='tabs_detail_".$this->no_grid."' style='z-index:1;'>";
			
				$drawForm  .= "<ul>";
				for ($i=0; $i<sizeOf($param_dtl); $i++) {
					$drawForm  .= '<li><a href="#tab_'.$this->no_grid.$i.'">'.$param_dtl[$i]['title'].'</a></li>';
				}
				$drawForm .= "</ul>";
				
				$data_dtl = array();
				for ($i=0; $i<sizeOf($param_dtl); $i++) {
					$group_and_modul['no_urut'] = $i;
					$drawForm .= $this->_ci->mygrid2->drawGridDtl(
							$this->no_grid
							,$i
							,$param_dtl[$i]['isi']
							,$group_and_modul
					);
					
					//echo $param_dtl[$i]['isi'];
				}
				$drawForm .= "</div>";
			} else {
				$data_dtl = array();				
				for ($i=0; $i<sizeOf($param_dtl); $i++) {
					$group_and_modul['no_urut'] = $i;
					$drawForm .= $this->_ci->mygrid2->drawGridDtl(
							$this->no_grid
							,$i
							,$param_dtl[$i]['isi']
							,$group_and_modul
					);
				}
			}		
		}
		
		if ($par['required'] == 1) {
			$drawForm .= '<table><tr><td>*) Required fields</td></tr></table>';
		}
		
		//tombol di paling akhir halaman...
		$drawForm .= '<table width="100%">';
		$drawForm .= '<tr>';
		$drawForm .= '<td colspan="2" align="right">';	
		$drawForm .= '<div class="fileupload-buttonbar">';
		if ($proc == 'edit' || $proc == 'add')	{
			$prop_tbl = array (
						'pk_id'=>$pk_id,
						'id'=>$id,
						'table'=>$table,
						'db'=>$db
					);
			if (!isset($button) || $button == '') {
				$form_element_to_save = substr($form_element_to_save, 0, strlen($form_element_to_save) - 1);
				$form_type_to_save    = substr($form_type_to_save, 0, strlen($form_type_to_save) - 1);
				$drawForm .= $this->setSave("submit", "Save", $url, $required_field, $duplicated_field, $prop_tbl, $form_element_to_save, $form_type_to_save, $group_and_modul);
				$drawForm .= $this->setSaveBackToList("submit_back_to_list", "Save & Back To List", $url, $required_field, $duplicated_field, $prop_tbl, $form_element_to_save, $form_type_to_save, $group_and_modul);
				$drawForm .= $this->setCancel($url, $group_and_modul);
			} else {
				$drawForm .= '<div align="center">';
				foreach($button as $b) {
					$drawForm .= form_button($b);
				}
				$drawForm .= '</div>';
			}
		} else {
			if (!isset($button) || $button == '') {				
				$drawForm .= $this->setCancel($url, $group_and_modul);
			} else {
				foreach($button as $key=>$b) {
					if ( substr($b['id'], 0, 10) == 'btn_cancel' ) {
						$drawForm .= form_button($b);
					}
				}
			}
		}
		$drawForm .= '</div>';
		$drawForm .= '</td>';
		$drawForm .= '</tr>';
		$drawForm .= "</table>";
		
		//tombol di paling akhir halaman...
		$drawForm .= $this->_closeForm();
		
		$drawForm .= "<script language='text/javascript'>";
		$drawForm .= " $(document).ready(function() {
							$('.btn').button();
							var initGrids= [false, false];
							$('#tabs_detail_".$this->no_grid."').tabs();
						});
					 ";
		$drawForm .= "</script>";
		
		$data['appGrid'] = $drawForm;
		$data['form_id'] = $form_id;
		if($this->options['return']==FALSE) {
			$this->_ci->load->view($view, $data);
		} else {
			return $this->_ci->load->view($view, $data, TRUE);
		}
	}
	
	public function openForm( $action="", $formOptions="", $multipart=false) {// awal buat form
		if(is_array($formOptions) && count($formOptions)>0) {
	
			if( $multipart ) {
				$this->_form = form_open_multipart($action, $formOptions);
			} else {
				$this->_form = form_open($action, $formOptions);
			}
			//set id form
			if(isset($formOptions['id'])) {
				$this->_formID = $formOptions['id'];
			}
			//set ajax action form
			if(isset($action)) {
				$this->_formAjaxAction = $action;
			}
		}
		return $this->_form;
	}
	
	private function _closeForm() {// form close, draw button-button
	 	$this->_form = form_close(); 
		return $this->_form;
	}
	
	public function setCheckbox($label="",$options="") { // bikin checkbox
		if(is_array($options) && count($options)>0) {
			$this->_form.='<br/><label>';
			$this->_form.=form_checkbox( $options );
			$this->_form.='<span>'.$label.'</span>';
			$this->_form.='</label>';
		} else {
			$this->_form.='<br/><label><span>checkbox failed</span></label>';
		}
	}
	
	public function setRadio($label="",$options="") { //radio button model pertamax
		$this->_form  = '<tr>';
		$this->_form .= '<td valign="middle">'.$label.'</td>';
		$this->_form .= '<td valign="middle">:</td>';
		if(is_array($options) && count($options)>0) {
			$this->_form .='<td>';
			$this->_form .=form_radio( $options );
			$this->_form .='</td>';
		} else {
			$this->_form .='<br/><label><span>radiobox failed</span></label>';
		}
		$this->_form .= '</tr>';
		
		return $this->_form;
	}
	
	public function setDropDown($label="", $options="") { //drop down model pertamax
		if ($options['required'] == 1) $required = ' *';
		else $required = ' ';
		
		$this->_form  = '<tr>';
		$this->_form .= '<td valign="middle" width="30%" class="field">'.$label.$required.'</td>';
		if(is_array($options) && count($options)>0) {
	
			$data = array(''=>'---- Pilih -----');
		
			if (isset($options['relationAt']) && $options['relationAt'] == TRUE) {
				//print_r($options['values']);
				foreach($options['values'] as $key=>$val) {
					$data[$key] = $val;
				}
			} else {
				foreach($options['values'] as $opts) {
					
					$data[$opts['id']] = $opts['name'];
				}
			}
				
			$this->_form .='<td valign="top" class="field_right">';
			$this->_form .=form_dropdown( $options['name'], $data, $options['selected'], 'id="'.$options['name'].'" class="'.$options['class'].'"' );
			$this->_form .='</td>';
		} else {
			$this->_form .='<br/><label><span>dropdown failed</span></label>';
		}
		$this->_form .= '</tr>';
	
		return $this->_form;
	}
	
	public function setTextBox($label="",$options="") { //text box model pertamax
		if ($options['required'] == 1) $required = ' *';
		else $required = ' ';
		
		$this->_form  = '<tr>';
		$this->_form .= '<td width="30%" valign="middle" class="field">'.$label.$required.'</td>';
		
		if(is_array($options) && count($options)>0) {
			$this->_form .='<td width="61%" class="field_right">';
			$this->_form .=form_input( $options );
			$this->_form .='</td>';
		} else {
			$this->_form .='<br/><label><span>textbox failed</span></label>';
		}
		$this->_form .= '</tr>';
	
		return $this->_form;
	}
	
	public function setDateBox($label="",$options="") { //date box model pertamax
		if ($options['required'] == 1) $required = ' *';
		else $required = ' ';
		
		$this->_form  = '<tr>';
		$this->_form .= '<td width="30%" valign="middle" class="field">'.$label.$required.'</td>';
	
		if(is_array($options) && count($options)>0) {
			$this->_form .='<script type="text/javascript">
								$("#'.$options['id'].'").datepicker({
									changeYear: true,
									changeMonth: true,
									yearRange: "1900:2330",	
									dateFormat : "dd-mm-yy"	
								});
						    </script>
							';
			$this->_form .='<td width="61%" class="field_right">';
			$this->_form .=form_input( $options );
			$this->_form .='</td>';
		} else {
			$this->_form .='<br/><label><span>textbox failed</span></label>';
		}
		$this->_form .= '</tr>';
	
		return $this->_form;
	}
	
	public function setDateTimeBox($label="",$options="") { //date time box model pertamax
		if ($options['required'] == 1) $required = ' *';
		else $required = ' ';
		
		$this->_form  = '<tr>';
		$this->_form .= '<td width="30%" valign="middle" class="field">'.$label.$required.'</td>';
	
		if(is_array($options) && count($options)>0) {
			$this->_form .='<script type="text/javascript">
								$("#'.$options['id'].'").datetimepicker({
									changeYear: true,
									changeMonth: true,
									yearRange: "1900:2330", 
									dateFormat : "dd-mm-yy",
									showSecond: true,
									controlType: "select",
									timeFormat: "HH:mm:ss"
								});
						    </script>
							';
			$this->_form .='<td width="61%" class="field_right">';
			$this->_form .=form_input( $options );
			$this->_form .='</td>';
		} else {
			$this->_form .='<br/><label><span>textbox failed</span></label>';
		}
		$this->_form .= '</tr>';
	
		return $this->_form;
	}
	
	public function setTimeBox($label="",$options="") { //time box model pertamax
		if ($options['required'] == 1) $required = ' *';
		else $required = ' ';
		
		$this->_form  = '<tr>';
		$this->_form .= '<td width="30%" valign="middle" class="field">'.$label.$required.'</td>';
	
		if(is_array($options) && count($options)>0) {
			$this->_form .='<script type="text/javascript">
								$("#'.$options['id'].'").timepicker(
								{
									showSecond: true,
									controlType: "select",
									timeFormat: "HH:mm:ss"
								});
						    </script>
							';
			$this->_form .='<td width="61%" class="field_right">';
			$this->_form .=form_input( $options );
			$this->_form .='</td>';
		} else {
			$this->_form .='<br/><label><span>textbox failed</span></label>';
		}
		$this->_form .= '</tr>';
	
		return $this->_form;
	}
	
	public function setPasswordBox($label="",$options="",$info="") { //password box model pertamax
		if ($options['required'] == 1) $required = ' *';
		else $required = ' ';
		
		$this->_form  = '<tr>';
		$this->_form .= '<td width="30%" valign="middle" class="field">'.$label.$required.'</td>';
	
		if(is_array($options) && count($options)>0) {
			$this->_form .='<td width="61%" class="field_right">';
			$this->_form .=form_password( $options );
			$this->_form .='&nbsp;<span>'.$info.'</span>';
			$this->_form .='</td>';
		} else {
			$this->_form .='<br/><label><span>textbox failed</span></label>';
		}
		$this->_form .= '</tr>';
	
		return $this->_form;
	}

	public function setHiddenText($name, $value) { //hidden text model pertamax
		if(strlen($name) > 0) {
			//$this->_form  = '<tr><td>';
			$this->_form = '<span><input type="hidden" name="'.$name.'" id="'.$name.'" value="'.$value.'"/></span>';
			//$this->_form .= '</td></tr>';
		} else {
			$this->_form ='<br/><label><span>hidden text failed</span></label>';
		}
		return $this->_form;
	}
	
	public function setLabel($label="",$options="") { //label model pertamax
	 	if (!empty($options['model'])) {
			$model_name = &$options['model'];
		
			$this->_ci->load->model($options['model']);
			$gen_value = $this->_ci->$model_name->$options['method'](((empty($options['value']) || $options['value'] == null || $options['value'] == '') ? 0 : $options['value']));
		} else {
			if ($options['relationAt'] != 0) {
				$gen_value = $options['values'][$options['value']];	
			} else {
				$gen_value = $options['value'];
			}
		}
	
		$this->_form  = '<tr>';
		$this->_form .= '<td width="20%" valign="top" class="field">'.$label.'</td>';
	 	if(is_array($options) && count($options)>0) {
			$this->_form .='<td width="71%" class="field_right">';
			$this->_form .= '<input type="hidden" name="'.$options['id'].'" id="'.$options['id'].'" value="'.$options['value'].'"/>';
			$this->_form .= form_label( $gen_value, $options['id'], $options['style'] );
			$this->_form .='</td>';
		} else {
			$this->_form .='<br/><label><span>label failed</span></label>';
		}
		$this->_form .= '</tr>';
	
		return $this->_form;
	}
	
	public function setTextArea($label="",$options="") { //text area model pertamax
		if ($options['required'] == 1) $required = ' *';
		else $required = ' ';
		
		$this->_form  = '<tr>';
		$this->_form .= '<td valign="top" class="field">'.$label.$required.'</td>';
	 	if(is_array($options) && count($options)>0) {
			
			$this->_form .='<td class="field_right">';
			$this->_form .= form_textarea( $options );
			$this->_form .='</td>';
		} else {
			$this->_form .='<br/><label><span>textarea failed</span></label>';
		}
		$this->_form .= '</tr>';
	
		return $this->_form;
	}
	
	public function setFileType($label="", $options="", $process){ //file type upload
		
	 	$base 			= $this->url_base;
		$explode_folder = explode("/",$this->options['url']);
		$app_folder		= $explode_folder[0];
		$mod_folder		= $explode_folder[1];
		$id_folder		= ($this->options['param_id'] > 0) ? $this->options['param_id'] : 0;
		
		if ($options['required'] == 1) $required = ' *';
		else $required = ' ';
		
		$this->_form  = '<script src="'.$base.'assets/js/upload/jquery.upload.file-min.js" type="text/javascript"></script>';
		$this->_form .= '<tr>';
		$this->_form .= '<td width="30%" valign="middle" class="field">'.$label.$required.'</td>';
		 if(is_array($options) && count($options)>0) {
			$this->_form .='<td width="61%" class="field_right">';
			$this->_form .= '<script src="'.$base.'assets/js/upload/jquery.upload.file-min.js" type="text/javascript"></script>';
			
			if($process != 'add'){
				$this->_form .='<div class="list_file">
									<ul class="listStyle" id="list_file_'.$app_folder.'_'.$mod_folder.'_'.$id_folder.'"></ul>
								</div>';
				 
				$this->_form .= '<script language="text/javascript">
									$(document).ready(function() {
										var box_id_list  = "#list_file_'.$app_folder.'_'.$mod_folder.'_'.$id_folder.'";
										var del_cls_file = "del_file_'.$app_folder.'_'.$mod_folder.'_'.$id_folder.'";
										
										var read_target  = "'.$base.'myform_save/read_file/'.$app_folder.'/'.$mod_folder.'/'.$id_folder.'";
										var delete_target= "'.$base.'myform_save/delete_file/'.$app_folder.'/'.$mod_folder.'/'.$id_folder.'";
									 	var url_path_dl  = "'.$base.'files/'.$app_folder.'/'.$mod_folder.'/'.$id_folder.'";
									 	var path_file  	 = "files/'.$app_folder.'/'.$mod_folder.'/'.$id_folder.'";
									 	
										$(box_id_list).empty();
										$.ajax({
											"url"  : read_target,
											"dataType" : "JSON",
											"success" : function(data) {
												var the_file = data.responseText.list_file;
											 	
												$.each(the_file, function() {													
													var name_file = this.replace(/\.[^/.]+$/, "");												
													var list  = "<li id=\'file_"+name_file+"\'>";
														list +=	"<a href=\'"+url_path_dl+"/"+this+"\'>";
														list +=	"<span class=\'box_attach\'>"+this+"</span>";
														list += "</a>";
												';
				
									if ($process != 'view'){		
										$this->_form .= 'list += "<a href=\'#\' id=\'"+this+"\' title=\'delete file\' style=\'left:2px; top:1px;\' class=\'ui-button ui-widget ui-state-default ui-corner-all "+del_cls_file+" \'><span class=\'ui-icon ui-icon-trash\'></span></a>";';
									}
											
											$this->_form .='
														list += "</li>"; 
													$(box_id_list).append(list);
													 
												});
											}
										});
										
										$("."+del_cls_file).live(\'click\', function(){
										 	var txt_conf  = "Delete file. Are you sure?";
											var id_file   = $(this).attr(\'id\');
											var name_file = id_file.replace(/\.[^/.]+$/, "");
											var data_file = "path="+path_file+"&file="+id_file;
										 	
										 	$( "#dialog-confirm-text" ).text(txt_conf);
											$( "#dialog-confirm" ).dialog({
												resizable: false,
												height:140,
												modal: true,
												buttons: {
													Yes: function() {
														$.ajax({
															"url"  : delete_target,
															"data" : data_file,
															"dataType": "json",
															"success" : function(data) {
														 		if (data.success) { 
															 		alert_box(data.responseText.text); 
															 		$("#file_"+name_file).remove();
															 	} else {
																	alert_box(data.responseText.text);
																	return false;
																}
															}
														});
														$( this ).dialog( "close" );
													},
													No: function() {
														$( this ).dialog( "close" );
													}
												}
											});
										});
									});
								</script>';
				$this->_form .= '<br />';
			}
			
			if ($process != 'view'){
			 	$this->_form .= '<ul id="list_upload_'.$options['id'].'" class="unstyled"></ul>';	 	
			 	$this->_form .= "<script language='text/javascript'>";
			 	$this->_form .= 'var errorHandler = function(event, id, fileName, reason) {
							        qq.log("id: " + id + ", fileName: " + fileName + ", reason: " + reason);
							     }; ';
			 	$this->_form .= 'var target  = "'.$base.'myform_save/upload_file/'.$app_folder.'/'.$mod_folder.'/'.$id_folder.'";
			 					 var listBtn = "#list_upload_'.$options['id'].'";
			 					';
			 	$this->_form .= 'var uploader2 = new qq.FineUploader({
							         element: $(listBtn)[0],
							         autoUpload: false,
							         uploadButtonText: "Select Files",
							         request: {	endpoint: target },
							         callbacks: { onError: errorHandler } 
							     });
			 					';
			 	$this->_form .= "</script>";
			}
		 	
			$this->_form .='</td>';
		} else {
			$this->_form .='<br/><label><span>textbox failed</span></label>';
		}
		$this->_form .= '</tr>';
		
		return $this->_form;
	}
		
	public function setFreeObject($options) { //free object
		if (!empty($options['object']) || $options['object'] != '') {
			$this->_form  = '<tr>';
			$this->_form .= '<td colspan="2" width="100%" class="field">';
			$this->_form .= $options['object'];
			$this->_form .= '</td>';
			$this->_form .= '</tr>';
		} else {
			$this->_form  = '<tr>';
			$this->_form .= '<td width="100%">';
			$this->_form .= '<br/><label><span>FreeObject failed</span></label>';
			$this->_form .= '</td>';
			$this->_form .= '</tr>';
		}
		
		return $this->_form;
	}
		
	public function setSubmit($name="submit",$label="Submit",$options=array(),$ajaxSubmit='', $url) { // bikin button submit
		if($ajaxSubmit) {
			//$data['btnSubmit'] = 'input[name='.$name.'_'.$this->no_grid.$this->no_urut.']'; 
			$data['btnSubmit'] = 'input[name='.$name.'_'.$this->no_grid.$this->options['no_urut'].']';
			$data['form']='#'.$this->_formID;
			$data['url']=$this->_formAjaxAction;
			$this->javascript .= $this->_ci->load->view($ajaxSubmit, $data,true);
		}
		
		//$this->_btnSubmit .= form_submit( $name."_".$this->no_grid.$this->no_urut, $label, $options );
		$this->_btnSubmit .= form_submit( $name."_".$this->no_grid.$this->options['no_urut'], $label, $options );
		$this->_btnSubmit .= "
				<script language='text/javascript'>
					$(document).ready(function() {
						$('#submit_".$this->no_grid.$this->options['no_urut']."').click(function() {
							//$.ajax({
							//	'url' : 'index.php/".$url."/processForm',
							//	'data' : 'proc=save&data='+$(\"#".$this->_formID."\").serialize(),
							//	'success' : function(data) {
									//$('#tab_'+no_grid).html(data);
									//jQuery('#grid_'+no_grid).jqGrid('editGridRow',gr,{height:280,reloadAfterSubmit:false});
							//	}
							//});
						});
					});
				</script>
				";
		
		return $this->_btnSubmit;
	}
		
	public function setSave($name, $label, $url, $required_field, $duplicated_field, $prop_tbl, $form_element_to_save, $form_type_to_save, $group_and_modul) { // bikin button submit
		$opt = array(
				'name'=>$name.'_'.$this->no_grid.$this->options['no_urut'],
				'id'=>$name.'_'.$this->no_grid.$this->options['no_urut'],
				'type'=>'button',
				'content'=>$label,
				'class'=>'btn start'
		);
		
		$list = "";
		foreach($required_field as $rf){
			//$list .= '"'.$rf.'",';
			$list .= '"'.$rf.'",';
		} 
		
		//echo $list;
		//die('a');
		
		$dupl = "";
		foreach($duplicated_field as $df) {
			//$dupl .= '"'.$df.'",';
			$dupl .= '"'.$df.'",';
		}
	 	
		$base = $this->url_base ;		
		$this->_button = form_button($opt);
		$this->_button .= "
		<script language='text/javascript'>
			$(document).ready(function() {
				form_element = [ ".$form_element_to_save." ];
				form_type 	 = [ ".$form_type_to_save." ]; 
				required 	 = [ ".$list." ];
				duplicated   = [ ".$dupl." ];
				emptyerror 	 = 'Field is required.';
				duplierror   = 'Field is duplicated. Please check again your data.';
				pk_id        = '".$prop_tbl['pk_id']."';
				pk_val       = '".$prop_tbl['id']."';
				pk_tbl       = '".$prop_tbl['table']."';
				pk_db        = '".$prop_tbl['db']."';		
				st_update    = '';
		";
		
		$this->_button .="
				$('#".$name."_".$this->no_grid.$this->options['no_urut']."').button({icons: { primary: 'ui-icon-disk'} });
				$('.qq-upload-button').addClass('ui-button ui-widget ui-state-default ui-corner-all ');
				$('#".$name."_".$this->no_grid.$this->options['no_urut']."').click(function() {
					var kirim  = new Array();	
					var kirim1 = '';		
					var jml_empty = 0;
					var jml_dupl  = 0;
					
					for (i=0;i<required.length;i++) {
						var input = $('#'+required[i]);
						
						if ((input.val() == \"\") || (input.val() == \"-\") || (input.val() == emptyerror)) {
							input.addClass(\"ui-state-error\");
							$('#error').show();
							$('#error').addClass(\"ui-state-error\");
							$('#errorMessage').html(emptyerror);
						} else {
							input.removeClass(\"ui-state-error\");	
							$('#error').hide();
						}
					}
						
					if ($(\":input\").hasClass(\"ui-state-error\")) {
						return false;
					}
						
					st_update = $('#'+pk_tbl+'_st_update').val();					
					if (st_update != 'edit') {
						for (i=0;i<duplicated.length;i++) {
							var input = $('#'+duplicated[i]);	
							var iada = checkDuplicateData(pk_tbl, pk_db, duplicated[i], input.val());
						
							if (iada == 1) {
								input.addClass(\"ui-state-error\");
								$('#error').show();
								$('#error').addClass(\"ui-state-error\");
								$('#errorMessage').html(duplierror);
							} else {
								input.removeClass(\"ui-state-error\");
							}
						}
						if ($(\":input\").hasClass(\"ui-state-error\")) {							
							return false;
						}
					}
					
					//return false;
					var jwb = confirm('Anda yakin ingin menyimpan data ini ?');
					if (jwb == 1) {
						
						var result = $(\"#".$this->_formID."\").serializeArray();
						var var_name = [];
						var var_valu = [];
						var par_name = [];
						var par_valu = [];
						var var_type = [];
								
						var no_grid = ".$this->no_grid.$this->options['no_urut'].";
						
						//form_element	
						for (i=0;i<form_element.length;i++) {							
							for (j=0;j<result.length;j++) {					
								if (form_element[i] == result[j]['name'])	{
									var_name.push(result[j]['name']);
									var_valu.push('\"'+result[j]['value']+'\"');
								}
							}	
						}

						for (i=0;i<form_element.length;i++) {							
							for (j=0;j<result.length;j++) {	
								if (jQuery.inArray(result[j]['name'], var_name) == -1) {
									if (jQuery.inArray(result[j]['name'], par_name) == -1) {
										par_name.push(result[j]['name']);
										par_valu.push('\"'+result[j]['value']+'\"');
									}									
								}
							}
						}
						 
						var type_ = '';
						for (i=0;i<form_type.length;i++) {
							type_ = (form_type[i]).split('_');		
							if (type_[type_.length - 1] != 'free') {						
								var_type.push(type_[type_.length - 1]);
							}
						}
					 	
						$.post('".$base."myform_save/save', {proc:'save', par_name:par_name,par_valu:par_valu,var_name:var_name,var_valu:var_valu,var_type:var_type,pk_tbl:pk_tbl,pk_id:pk_id,pk_db:pk_db}, function(data) {
							var data1 = data.split('|');									
							var id = data1[1];		
							var lstUpdt = data1[data1.length - 1];													
							var module_id = data1[data1.length - 2];
							var group_id = data1[data1.length - 3];	
								
							//
										
							if (data1[0] == 99) {
								jwb = confirm('Data Sudah diupdate oleh '+lstUpdt+'. Apakah anda ingin mengupdate kembali dgn data anda?');									
								if (jwb == 1) {
									$.ajax({
										'url' : '".$base.$url."/processForm',
										'data' : 'id='+id+'&proc=edit&group_id='+group_id+'&modul_id='+module_id+'&company_id=".$this->company."&parent_id=".$group_and_modul['parent_id']."&no_urut=".$this->options['no_urut']."',
										'success' : function(data) {
											//$('#tab_".$this->no_grid."').html(data);
											$('#tab_'+no_grid).html(data);													
											information_box('Data berhasil disimpan');
											oTable.fnDraw();
											$('#error').hide();
										}
									});
								} else {
									return false;
								}
								
							} else if (data1[0] == 1) {								
								$.ajax({
									'url' : '".$base.$url."/processForm',
									'data' : 'id='+id+'&proc=edit&group_id='+group_id+'&modul_id='+module_id+'&company_id=".$this->company."&parent_id=".$group_and_modul['parent_id']."&no_urut=".$this->options['no_urut']."',
									'success' : function(data) {
									 	//$('#tab_".$this->no_grid."').html(data);
									 	$('#tab_'+no_grid).html(data);
										information_box('Data berhasil disimpan');
										oTable.fnDraw();
										$('#error').hide(); 
									}
								}); ";	
									
								if($this->js_form_upload){
									$this->_button .= "uploader2.uploadStoredFiles();";
								}
								
							$this->_button .= "					
							} else {
								alert('Data Gagal diupdate');
								return false;				
							}	
						});						
					}
				});
				
				// Clears any fields in the form when the user clicks on them
				$(\":input\").focus(function(){		
				   if ($(this).hasClass(\"ui-state-error\") ) {
					 	$(this).removeClass(\"ui-state-error\"); 								
				   }
				});
			});
			
			function checkDuplicateData(tbl, conn, v_var, v_val) {
				return $.ajax({
					type: 'GET', 
					'url'  : '".$base."myform_save/checkDuplicateData',
					'data' : 'pk_db='+conn+'&pk_tbl='+tbl+'&v_var='+v_var+'&v_val='+v_val,
					async:false
				}).responseText
			}
		</script>
	";
	
		return $this->_button;
	}
	
	public function setSaveBackToList($name, $label, $url, $required_field, $duplicated_field, $prop_tbl, $form_element_to_save, $form_type_to_save, $group_and_modul) { // bikin button submit
		$opt = array(
				'name'=>$name.'_'.$this->no_grid.$this->options['no_urut'],
				'id'=>$name.'_'.$this->no_grid.$this->options['no_urut'],
				'type'=>'button',
				'content'=>$label,
				'class'=>'btn start'
		);
	
		$list = "";
		foreach($required_field as $rf){
			//$list .= '"'.$rf.'",';
			$list .= '"'.$rf.'",';
		}
	
		//echo $list;
		//die('a');
	
		$dupl = "";
		foreach($duplicated_field as $df) {
			//$dupl .= '"'.$df.'",';
			$dupl .= '"'.$df.'",';
		}
		 
		$base = $this->url_base ;
		$this->_button = form_button($opt);
		$this->_button .= "
		<script language='text/javascript'>
			$(document).ready(function() {
				form_element = [ ".$form_element_to_save." ];
				form_type 	 = [ ".$form_type_to_save." ];
				required 	 = [ ".$list." ];
				duplicated   = [ ".$dupl." ];
				emptyerror 	 = 'Field is required.';
				duplierror   = 'Field is duplicated. Please check again your data.';
				pk_id        = '".$prop_tbl['pk_id']."';
				pk_val       = '".$prop_tbl['id']."';
				pk_tbl       = '".$prop_tbl['table']."';
				pk_db        = '".$prop_tbl['db']."';
				st_update    = '';
		";
	
		$this->_button .="
				$('#".$name."_".$this->no_grid.$this->options['no_urut']."').button({icons: { primary: 'ui-icon-disk'} });
				$('.qq-upload-button').addClass('ui-button ui-widget ui-state-default ui-corner-all ');
				$('#".$name."_".$this->no_grid.$this->options['no_urut']."').click(function() {
					var kirim  = new Array();
					var kirim1 = '';
					var jml_empty = 0;
					var jml_dupl  = 0;
			
					for (i=0;i<required.length;i++) {
						var input = $('#'+required[i]);
	
						if ((input.val() == \"\") || (input.val() == \"-\") || (input.val() == emptyerror)) {
							input.addClass(\"ui-state-error\");
							$('#error').show();
							$('#error').addClass(\"ui-state-error\");
							$('#errorMessage').html(emptyerror);
						} else {
							input.removeClass(\"ui-state-error\");
							$('#error').hide();
						}
					}
	
					if ($(\":input\").hasClass(\"ui-state-error\")) {
						return false;
					}
	
					st_update = $('#'+pk_tbl+'_st_update').val();
					if (st_update != 'edit') {
						for (i=0;i<duplicated.length;i++) {
							var input = $('#'+duplicated[i]);
							var iada = checkDuplicateData(pk_tbl, pk_db, duplicated[i], input.val());
	
							if (iada == 1) {
								input.addClass(\"ui-state-error\");
								$('#error').show();
								$('#error').addClass(\"ui-state-error\");
								$('#errorMessage').html(duplierror);
							} else {
								input.removeClass(\"ui-state-error\");
							}
						}
						if ($(\":input\").hasClass(\"ui-state-error\")) {
							return false;
						}
					}
			
					//return false;
					var jwb = confirm('Anda yakin ingin menyimpan data ini ?');
					if (jwb == 1) {					
	
						var result = $(\"#".$this->_formID."\").serializeArray();
						var var_name = [];
						var var_valu = [];
						var par_name = [];
						var par_valu = [];
						var var_type = [];
	
						//form_element
						for (i=0;i<form_element.length;i++) {
							for (j=0;j<result.length;j++) {
								if (form_element[i] == result[j]['name'])	{
									var_name.push(result[j]['name']);
									var_valu.push('\"'+result[j]['value']+'\"');
								}
							}
						}
	
						for (i=0;i<form_element.length;i++) {
							for (j=0;j<result.length;j++) {
								if (jQuery.inArray(result[j]['name'], var_name) == -1) {
									if (jQuery.inArray(result[j]['name'], par_name) == -1) {
										par_name.push(result[j]['name']);
										par_valu.push('\"'+result[j]['value']+'\"');
									}
								}
							}
						}
				
						var type_ = '';
						for (i=0;i<form_type.length;i++) {
							type_ = (form_type[i]).split('_');
							if (type_[type_.length - 1] != 'free') {
								var_type.push(type_[type_.length - 1]);
							}
						}
				
						$.post('".$base."myform_save/save', {proc:'save', par_name:par_name,par_valu:par_valu,var_name:var_name,var_valu:var_valu,var_type:var_type,pk_tbl:pk_tbl,pk_id:pk_id,pk_db:pk_db}, function(data) {
							var data1 = data.split('|');
							var id = data1[1];
							var lstUpdt = data1[data1.length - 1];
							var module_id = data1[data1.length - 2];
							var group_id = data1[data1.length - 3];
								
							var no_grid = ".$this->no_grid.$this->options['no_urut'].";
	
							if (data1[0] == 99) {
								jwb = confirm('Data Sudah diupdate oleh '+lstUpdt+'. Apakah anda ingin mengupdate kembali dgn data anda?');
								if (jwb == 1) {
									/*$.ajax({
										'url' : '".$base.$url."/processForm',
										'data' : 'id='+id+'&proc=edit&group_id='+group_id+'&modul_id='+module_id+'&company_id=".$this->company."',
										'success' : function(data) {
											$('#tab_".$this->no_grid."').html(data);
											information_box('Data berhasil disimpan');
											oTable.fnDraw();
											$('#error').hide();
										}
									});
									*/
									$.ajax({
										'type' : 'GET',
										'data': 'company_id=".$this->company."&modul_id='+module_id+'&group_id='+group_id+'&parent_id=".$group_and_modul['parent_id']."&no_urut=".$this->options['no_urut']."',						
										'url' : '".$base.$url."/output',
										'success' : function(data) {
													//alert(no_grid);
													//alert($this->no_grid);
													$('#tab_'+no_grid).html(data);
										}
									});
								} else {
									return false;
								}
	
							} else if (data1[0] == 1) {
								/*$.ajax({
									'url' : '".$base.$url."/processForm',
									'data' : 'id='+id+'&proc=edit&group_id='+group_id+'&modul_id='+module_id+'&company_id=".$this->company."',
									'success' : function(data) {
									 	$('#tab_".$this->no_grid."').html(data);
										information_box('Data berhasil disimpan');
										oTable.fnDraw();
										$('#error').hide();
									}
								}); 
								*/	 
								
								$.ajax({
									'type' : 'GET',
									'data': 'company_id=".$this->company."&modul_id='+module_id+'&group_id='+group_id+'&parent_id=".$group_and_modul['parent_id']."&no_urut=".$this->options['no_urut']."',						
									'url' : '".$base.$url."/output',
									'success' : function(data) {
												//alert(no_grid);
												//$('#tab_'+no_grid).html(data);
												$('#tab_'+no_grid).html(data);
									}
								});			
								";
			
		if($this->js_form_upload){
			$this->_button .= "uploader2.uploadStoredFiles();";
		}
	
		$this->_button .= "
							} else {
								alert('Data Gagal diupdate');
								return false;
							}
						});
					}
				});
	
				// Clears any fields in the form when the user clicks on them
				$(\":input\").focus(function(){
				   if ($(this).hasClass(\"ui-state-error\") ) {
					 	$(this).removeClass(\"ui-state-error\");
				   }
				});
			});
		
			function checkDuplicateData(tbl, conn, v_var, v_val) {
				return $.ajax({
					type: 'GET',
					'url'  : '".$base."myform_save/checkDuplicateData',
					'data' : 'pk_db='+conn+'&pk_tbl='+tbl+'&v_var='+v_var+'&v_val='+v_val,
					async:false
				}).responseText
			}
		</script>
	";
	
		return $this->_button;
	}
	
	public function setCancel($url, $group_and_modul) { // bikin button Cancel		
		$opt = array(
				//'name'=>'cancel_'.$this->no_grid.$this->no_urut,
				'name'=>'cancel_'.$this->no_grid.$this->options['no_urut'],
				//'id'=>'cancel_'.$this->no_grid.$this->no_urut,
				'id'=>'cancel_'.$this->no_grid.$this->options['no_urut'],
				'type'=>'button',
				'content'=>'Back',
				'class'=>'btn'
		);
		
		$base = $this->url_base ;
		$this->_btnCancel = form_button($opt);
		$this->_btnCancel .= "
		<script language='text/javascript'>
			$(document).ready(function() {
				var no_urut = '0';
				$('#cancel_".$this->no_grid.$this->options['no_urut']."').button({icons: { primary: 'ui-icon-arrowreturnthick-1-w'} });
				$('#cancel_".$this->no_grid.$this->options['no_urut']."').click(function() {	
					var no_grid = ".$this->no_grid.$this->options['no_urut'].";					
					$.ajax({
						'type' : 'GET',
						'data': 'company_id=".$this->company."&modul_id=".$group_and_modul['modul_id']."&group_id=".$group_and_modul['group_id']."&parent_id=".$group_and_modul['parent_id']."&no_urut=".$this->options['no_urut']."',						
						'url' : '".$base.$url."/output',
						'success' : function(data) {
									//alert(no_grid);
									$('#tab_'+no_grid).html(data);
						}
					});
				});
			});
		</script>
		";
		//$this->_btnCancel='';
		return $this->_btnCancel;
	}
	
	public function setLookup($label = "", $options = "") {
		if ($options['required'] == 1) $required = ' *';
		else $required = ' ';
		
		$this->_form  = '<tr>';
		$this->_form .= '<td valign="middle" width="30%" class="field">'.$label.$required.'</td>';		
		
		if(is_array($options) && count($options)>0) {
			
			//echo $options['model'];
			if (!empty($options['model'])) {
				$model_name = &$options['model'];
			
				$this->_ci->load->model($options['model']);
				$gen_value = $this->_ci->$model_name->$options['method'](((empty($options['value']) || $options['value'] == null || $options['value'] == '') ? 0 : $options['value']));
				//echo $model_name.'->'.$options['method'].'('.$options['value'].')';
			} else {
				$gen_value = $options['value'];
			}
			
			$this->_form .='<td width="70%" class="field_right">';
			$this->_form .= '<input type="hidden" name="'.$options['name'].'" id="'.$options['name'].'" value="'.$options['value'].'"/>';
			$this->_form .= '<input style="float:left;" type="text" readonly class="fieldTextBox" name="lookup_'.$options['name'].'" id="lookup_'.$options['name'].'" value="'.$gen_value.'" size="'.$options['size'].'"/>';
			$this->_form .= '<input style="float:left; " class="fieldTextBox" type="button" name="bt_'.$options['name'].'" id="bt_'.$options['name'].'" value="[...]"/>';
			$this->_form .='</td>';
		} else {
			$this->_form .='<br/><label><span>lookup failed</span></label>';
		}
		$this->_form .= '</tr>';
		
		return $this->_form;
		
	}
	
	public function output() { // output nya
		$this->_closeForm();
		return $this->_form."\n".$this->javascript;
	}
	
	function getColumnsForForm($data) {		
		$columns = array();
		foreach($data as $dat) {
			if ($dat['showOnForm'] == 1) {
				$columns[] = $dat;
				//unset($data);
			}
		}
		return $columns;
	}
}