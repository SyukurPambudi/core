<?php

    function w2uiGrid($t, $d=""){
        
        if(isset($d['debug']) && $d['debug'] == 1 ){
            ini_set('display_errors', true);
            error_reporting(E_ALL);
        }
         
        $CI     = &get_instance();
         
        $path_  = explode('processor', $_SERVER['PATH_INFO']); $path_  = $path_[1];
        $r = debug_backtrace();
        $nama_ = $r[1]['file']; $nama_ = explode("\\", $nama_); $nama_ = end($nama_);
        $d['nama_'] =  str_replace(".", "_", $nama_);
         
        $d['dbconn']        = w2uiExcept02($d['dbconn'], "default"); 
        $d['db']            = w2uiExcept02($d['db'], "hrd"); 
        
        if(!isset($d['table']))     $isCustQry      = "Yes";
        if(!isset($d['limit']))     $d['limit']     = "50"; 
        
        $recid              = w2uiExcept02($d['recid'], "ID");
        
        $d['header']        = w2uiExcept( $d['header'], 'header', "---------");
        $d['recid']         = w2uiExcept( $d['recid'], 'recid', $recid);
        $d['show']          = w2uiExcept( $d['show'], 'show', w2uiShow(), 'arr'); 
        $d['fixedBody']     = w2uiExcept( $d['fixedBody'], 'fixedBody', 'true', 'bool');
        $d['toolbar']       = w2uiExcept( $d['toolbar'], 'toolbar', '');
        $d['searches']      = w2uiExcept( $d['searches'], 'searches', ''); 
        $d['columns']       = w2uiColumn($d['columns']);
        $d['columns']       = w2uiExcept( $d['columns'], 'columns', '', 'list');        
        $d['url']           = w2uiExcept( $d['url'], 'url', "..".$path_."/".$d['select_url']);         
        $d['onClick']       = w2uiExcept( $d['onClick'], 'onClick', w2uiOnClick($d), 'event');
        $d['onSearch']      = w2uiExcept( $d['onSearch'], 'onSearch', w2uiOnSearch(), 'event'); 
        $d['onRefresh']     = w2uiExcept( $d['onRefresh'], 'onRefresh', '', 'event'); 
        $d['onAdd']         = w2uiExcept( $d['onAdd'], 'onAdd', w2uiOnAdd(), 'event');
        $d['onEdit']        = w2uiExcept( $d['onEdit'], 'onEdit', w2uiOnEdit(), 'event'); 
        $d['varDelete']     = w2uiExcept02( $d['varDelete'], 'isDeleted'); 
        $d['onDelete']      = w2uiExcept( $d['onDelete'], 'onDelete', w2uiOnDelete($recid,  "..".$path_."/".$d['select_url'], $d['varDelete']), 'event');
        $d['f_header']      = w2uiExcept( $d['f_header'], 'header', "---------"); 
        $d['fields']        = w2uiGenerateForm($d['fields']); //x($d['fields']);
        $d['fields']        = w2uiExcept( $d['fields'], 'fields', '', 'list'); 
        $d['save']          = w2uiExcept( $d['save'], 'actions', w2uiFormSave("..".$path_."/".$d['select_url']), 'event'); 
                        
        $t->load->view('w2ui', $d); 
    }
    
    
    
	function w2uiOnSearch(){
	    
		$r = debug_backtrace();
        $nama_ = $r[1]['file']; $nama_ = explode("\\", $nama_); $nama_ = end($nama_);
        $nama_ =  str_replace(".", "_", $nama_);
		return "function(){
			var grid = this;
			this.postData['gridColumns'] = w2ui['grid_$nama_']['columns'];
		}";
	}
	
     
    
    function w2uiSqlQuery($d){
        if(isset($d['debug']) && $d['debug'] == 1 ){
            ini_set('display_errors', true);
            error_reporting(E_ALL);
        }
        $dbconn        = w2uiExcept02($d['dbconn'], "default");  
        $orderBy       = w2uiExcept02($d['orderBy'], cus_order()); 
        $groupBy       = w2uiExcept02($d['groupBy'], ""); 
        
        $qry = $d['getRecord'];
        if(isset($d['selWhere'])) $qry .= " where ".$d['selWhere']." ";
		$d['selWhere'] = w2uiExcept02($d['selWhere'], ''); 
		
        $req = json_decode($_REQUEST['request']);  
        
        if($req->cmd == "get"){
            if(count($req->search) > 0){ 
                $qry = $qry.cus_search('', $d['selWhere']);  
            } 
            $limitOffset =" limit ".$req->offset.", ".$req->limit;
            $CI     = &get_instance(); 
            $DB1    = $CI->load->database($dbconn, TRUE);  
            $EXEC   = $DB1->query($qry." ".$groupBy." ".$orderBy." ".$limitOffset);
            if(!isset($d['customID'])){
                echo "{ 'records' : ".json_encode($EXEC->result())."}";
            }else{
                $i = 1;
                echo "{ 'records' : [";
                foreach ($EXEC->result() as $row){ 
                   $row->ID = $i++;
                   echo json_encode($row);
               }
               echo "] }";
            }
            
        } else if($req->cmd == "delete"){
            $req = json_decode($_REQUEST['request']);  
            $d['arrDelWhere'] = w2uiExcept02($d['arrDelWhere'], array('ID')); 
            //x(cus_update_gen($d['table'], $req, $d['arrDelWhere']));
            updToTable(cus_update_gen($d['table'], $req, $d['arrDelWhere']), $dbconn);
            $limitOffset =" limit ".$req->offset.", ".$req->limit;
            $CI     = &get_instance(); 
            $DB1    = $CI->load->database($dbconn, TRUE);  
            $EXEC   = $DB1->query($qry." ".$orderBy." ".$limitOffset);
            echo "{ 'records' : ".json_encode($EXEC->result())."}"; 
        }else{
            $post = $req; $isUpdate = 0; if($req->record->recid) $isUpdate = 1;
            $d['arrUpdWhere'] = w2uiExcept02($d['arrUpdWhere'], array('ID'));
            if($d['delInsObj'] != ""){
              $post = rmObj($post, $d['delInsObj']);  
            }else{
              $post = rmObj($post, array('recid'));  
            }   
             
            if($isUpdate == 1){
                if($d['delUpdObj'] != ""){
                    $post = rmObj($post, $d['delUpdObj']);
                } else{
                    $post = rmObj($post, array('recid'));
                } 
                //x(cus_update_gen($d['table'], $post, $d['arrUpdWhere'])); 
                updToTable(cus_update_gen($d['table'], $post, $d['arrUpdWhere']), $dbconn);
                echo "EDIT QRY";
            }else{ 
                if($d['insertID'] != ""){
                    foreach($d['insertID'] as $key => $val)
                    $insComponent =  cus_insert_gen($post, $key,$val);
                }else{
                    $insComponent =  cus_insert_gen($post);
                } 
                
                insToTable($d['table'], $insComponent, $dbconn);
                echo "INSERT QRY";
            }
        }
    }
    
    function w2uiOnDelete($recid, $url, $delVar="isDeleted"){
        $r = debug_backtrace();
        $nama_ = $r[1]['file']; $nama_ = explode("\\", $nama_); $nama_ = end($nama_);
        $nama_ =  str_replace(".", "_", $nama_);
        return "
            function(event){
                var grid = this; 
                var sel = grid.getSelection();
                var ID  = grid.get(sel[0])['".$recid."'];
                this.postData['delwhere']={".$recid.":ID};
                this.postData['record']={".$delVar.":1, ".$recid.":ID};
                this.postData['gridColumns'] = w2ui['grid_$nama_']['columns'];
                this.url = '".$url."';
            }
        ";
    }
	
	function w2uiDelWhere($vars, $op = " and "){
		$whereStr = ""; $i = 0;
		foreach($vars as $key => $value){
			if($i == 0){
				$whereStr .= $key." = '".$value."'";
				$i++;
			}else{
				$whereStr .= $op.$key." = '".$value."'";
			}
		}
		return $whereStr;
	}
    
    function w2uiFormSave($url){
        return "
             {
            Reset: function () {
                this.clear();
            },
            Save: function () {
                var errors = this.validate();
                if (errors.length > 0) return;
                if (this.recid == 0) {
                    this.url = '".$url."';
                    this.save();
                    //this.clear();
                } else {
                    this.url = '".$url."';
                    this.save();
                }
            }
            }
        ";
    }
    
    function w2uiGenerateForm($x){
        try{
            $jsonIterator = new RecursiveIteratorIterator(
            new RecursiveArrayIterator(json_decode($x, TRUE)),
            RecursiveIteratorIterator::SELF_FIRST);
        
            $fields ="{ name: 'recid', type: 'text', html: { caption: 'ID', attr: 'readonly' } },"; $i = 0; 
            foreach ($jsonIterator as $key => $val) { 
                if(is_array($val)) {
                    if($i == 0){
                        $fields .= "{ name:'".$key."'";
                        $i++;
                    }else{
                        $j = 0;
                        if($key == "html"){                        
                            $fields .= ",".$key.": {";
                            $j++;
                        }else{ 
                            $fields .= "} }, { name:'".$key."'";
                        }
                    }
                    
                } else {
                    if($j == 1){
                        $fields .= " ".$key.":'".$val."'";
                    }else{
                        $fields .= ", ".$key.":'".$val."'";
                    }
                    
                }
            }
            
            if($j != 0){
                $fields .= "}}";
            }else{
                $fields .= "}";
            } 
            
            return " [".$fields."]";
        } catch (Exception $e) {
            //echo 'Caught exception: ',  $e->getMessage(), "\n"; exit();
            $fields = $x;
            return " [".$fields."]";
        }
        
    }
    
    function w2uiOnClick($d){
        $r = debug_backtrace();
        $nama_ = $r[1]['file']; $nama_ = explode("\\", $nama_); $nama_ = end($nama_);
        $nama_ =  str_replace(".", "_", $nama_); //echo $nama_; exit();
        if($d['template'] == 4){
            $gridWidth = "100%";
        }else if($d['template'] == 5){
            $gridWidth = "100%";
        }else{
            $gridWidth = "59.9%";
        }
        return "
            function(event) {
                if(w2ui.hasOwnProperty('form01_".$nama_."')){
                    w2ui['form01_".$nama_."'].destroy();
                }
                $('#grid_".$nama_."').width('".$gridWidth."');    
                myForm_".$nama_."();   
                var grid = this;
                this.resize();
                //this.reload();
                var form = w2ui.form01_".$nama_.";
                console.log('_______');
                console.log(event);
                event.onComplete = function () {
                    var sel_".$nama_." = grid.getSelection(); console.log(sel_".$nama_.");
                    if (sel_".$nama_.".length == 1) {
                        form.recid  = sel_".$nama_."[0];
                        form.record = $.extend(true, {}, grid.get(sel_".$nama_."[0]));
                        form.refresh();
                    } else {
                        form.clear();
                    }
                }
            }
        ";
    } 
    
    function w2uiOnEdit(){
        $r = debug_backtrace();
        $nama_ = $r[1]['file']; $nama_ = explode("\\", $nama_); $nama_ = end($nama_);
        $nama_ =  str_replace(".", "_", $nama_); //echo $nama_; exit();
        return "
            function(event){
                if(w2ui.hasOwnProperty('form01_".$nama_."')){
                    w2ui['form01_".$nama_."'].destroy();
                }
                $('#grid_".$nama_."').width('59.9%');
                myForm_".$nama_."();
                
                var grid = this;
                var form = w2ui.form01_".$nama_.";
                
                event.onComplete = function () {
                    var sel = grid.getSelection();
                    if (sel.length == 1) {
                        form.recid  = sel[0];
                        form.record = $.extend(true, {}, grid.get(sel[0]));
                        form.refresh();
                    } else {
                        form.clear();
                    }
                }
                this.resize();
            }
        ";
    }

    function w2uiOnAdd(){
        $r = debug_backtrace();
        $nama_ = $r[1]['file']; $nama_ = explode("\\", $nama_); $nama_ = end($nama_);
        $nama_ =  str_replace(".", "_", $nama_); //echo $nama_; exit();
        return "
            function(event){
            if(w2ui.hasOwnProperty('form01_".$nama_."')){
                w2ui['form01_".$nama_."'].destroy();
            }
            $('#grid_".$nama_."').width('59.9%');  
            myForm_".$nama_."();
            
            var grid = this;
            this.resize();
            
            }
        ";
    }
    
    
    function w2uiColumn($x){ 
        
        try{
            $jsonIterator = new RecursiveIteratorIterator(
            new RecursiveArrayIterator(json_decode($x, TRUE)),
            RecursiveIteratorIterator::SELF_FIRST);
        
            $fields =""; $i = 0;
            foreach ($jsonIterator as $key => $val) { 
                if(is_array($val)) {
                    if($i == 0){
                        $fields .= "{ field:'".$key."'";
                        $i++;
                    }else{
                        $fields .= "}, { field:'".$key."'";
                    }
                    
                } else {
                    $fields .= ", ".$key.":'".$val."'";
                }
            }
            
            $fields .= "}";
            return " [".$fields."]";
        } catch (Exception $e) {
            //echo 'Caught exception: ',  $e->getMessage(), "\n"; exit();
            $fields = $x;
            return " [".$fields."]";
        }
        
        
    }
    
    
    function cus_insert_gen($post, $codeCol="", $code=""){
        $columns = ""; $values = ""; $i = 0;  
        foreach($post->record as $key => $value){
            if($key == $codeCol){
                $value = $code;
            }
            if($key != "recid"){
                if($i == 0){
                    $columns    = $key; ; 
                    if(count((array)$value) > 1){
                        $values     = "'".$value->id."'";  
                    }else{
                        $values     = "'".$value."'";
                    } 
                    
                    $i++;
                }else{
                    $columns    .= ", ".$key;  
                    if(count((array)$value) > 1){
                        $values     .= ", '".$value->id."'";
                    }else{
                        $values     .= ", '".$value."'";
                    } 
                    
                }   
            }
        }         
        return array($columns, $values); 
    }
    
    function genCode($prefix, $tbl, $col){
			$CI = &get_instance();
			$qry    	= "select max(".$col.") as num_ from ".$tbl." s limit 1";
			$DB1    	= $CI->load->database('nplinfra', TRUE);
			$EXEC   	= $DB1->query($qry);
			$row    	= $EXEC->row(); 
			$codeLast	= $row->num_;
            $codeForm   = $prefix."00000";
            if(!$codeLast) $codeLast = $codeForm; 
			$codeSplit 	= explode($prefix, $codeLast);
			$codeNext   = (int)$codeSplit[1] + 1; 
			return substr_replace($codeLast, $codeNext, (strlen($codeForm) - strlen((string)$codeNext)), strlen($codeForm));
		 
    }
    
    function cus_order(){
        
        $post = json_decode($_REQUEST['request']);
        $orderStr = " order by "; $i = 0; 
        if(isset($post->sort)){
            foreach($post->sort as $key => $value){
                $field      = $value->field;
                $sort       = $value->direction;
                if($i == 0){
                    $orderStr   .= $field." ".$sort." "; 
                    $i++;
                }else{
                    $orderStr   .= ", ".$field." ".$sort." ";
                }
                
            }
        }else{
            $orderStr = "";
        }
        
        return $orderStr;
    }
    
    function cus_search($exc="", $firstWhere=''){
        $post = json_decode($_REQUEST['request']);
        $op   = $post->searchLogic; $wh = ""; $i = 0; //z($post->gridColumns);
        $gridCols = $post->gridColumns;
        foreach($post->search as $key => $value){
            $field  = $value->field;
            
            foreach($gridCols as $k){ 
                if($k->prefix && $field == $k->field ) $field = $k->prefix.".".$field;
            }
            //x("$field");
            $val    = $value->value;
            if($i == 0 ){
                if($firstWhere != ''){
                    $wh .= " AND ( ";
                }else{
                    $wh .= " WHERE ";
                }
                
                $i++;
            }else{
                $wh .=  " ".$op." " ;//" AND ";
            }
            if($value->type == 'int'){
                if($exc != ""){
                    foreach($exc as $k => $v){
                        if($k == $field){
                            $wh .= $v." ";
                            break;
                        }
                    }
                }else{
                    $wh .= $field."=".$val;
                }
                
            }else{
                if($exc != ""){
                    foreach($exc as $k => $v){
                        if($k == $field){
                            $wh .= $v." ";
                            break;
                        }
                    }
                }else{
                    $wh .= $field." like '%".$val."%' ";
                }
                
            }
        }
        if($firstWhere != ''){
                    $wh .= " ) ";
        }
        return $wh; 
    }
    
    function cus_update_gen($table_, $post, $wId, $excl_="tUpdatedAt"){
        $columns = ""; $values = ""; $i = 0;  $j=0;
        $str        = "set "; $whereStr = "";
        
        foreach($post->record as $key => $value){
            
            foreach($wId as $w ){
                if($w == $key){
                    if($j == 0){
                        
                        if(count((array)$value) > 1){
                            $whereStr .= " where ".$key."='".$value->id."' "; 
                        }else{
                            $whereStr .= " where ".$key."='".$value."' ";
                        } 
                        $j++;
                    }else{
                        if(count((array)$value) > 1){
                            $whereStr .= " and ".$key."='".$value->id."' "; 
                        }else{
                            $whereStr .= " and ".$key."='".$value."' ";
                        } 
                        
                    }
                }
            }
            
            if($key != "recid" or $key != $excl_){
                if($i == 0){
                    $columns    = $key; ;                     
                    if(count((array)$value) > 1){
                        $str        .= $key."='".$value->id."' "; 
                    }else{
                        $str        .= $key."='".$value."' "; 
                    } 
                    
                    $i++;
                }else{
                    $columns    .= ", ".$key;  
                    if(count((array)$value) > 1){
                        $str        .= ", ".$key."='".$value->id."' "; 
                    }else{
                        $str        .= ", ".$key."='".$value."' "; 
                    } 
                    
                }   
            }
        }   
         
        $str .= $whereStr;
        $str  = "update ".$table_." ".$str;
              
        return $str; 
    }
    
    function cus_post_process($table_, $post, $delInsObj,  $delUpdObj, $arrUpdWhere, $insertID=""){
        if($delInsObj != "") $post = rmObj($post, $delInsObj); 
        if($post->recid > 0 ){             
            if($delUpdObj != "") $post = rmObj($post, $delUpdObj); 
            updToTable(cus_update_gen($table_, $post, $arrUpdWhere));
        }else{ 
            if($insertID != ""){
                foreach($insertID as $key => $val)
                $insComponent =  cus_insert_gen($post, $key,$val);
            }else{
                $insComponent =  cus_insert_gen($post);
            } 
            insToTable($table_, $insComponent);
        }
    }
    
    function w2uiSomeEvent($nama_){
        return "
        onClick: function(event) {
            if(w2ui.hasOwnProperty('form01_$nama_')){
                w2ui['form01_$nama_'].destroy();
            }
            $('#grid_$nama_').width('59.9%');    
            myForm_$nama_();
                    
            var grid = this;
            this.resize();
            var form = w2ui.form01_$nama_; console.log(w2ui.form01_$nama_);
            //$('#vSrvCode').prop('disabled',true);
            event.onComplete = function () {
                var sel = grid.getSelection();
                console.log(sel);
                if (sel.length == 1) {
                    form.recid  = sel[0];
                    form.record = $.extend(true, {}, grid.get(sel[0]));
                    form.refresh();
                } else {
                    form.clear();
                }
            }
        },        
        onEdit: function(event){
            if(w2ui.hasOwnProperty('form01_$nama_')){
                w2ui['form01_$nama_'].destroy();
            }
            myForm_$nama_();
            
            var grid = this;
            var form = w2ui.form01_$nama_;
            
            event.onComplete = function () {
                var sel = grid.getSelection();
                if (sel.length == 1) {
                    form.recid  = sel[0];
                    form.record = $.extend(true, {}, grid.get(sel[0]));
                    form.refresh();
                } else {
                    form.clear();
                }
            }
        },
        onAdd: function(event){
            if(w2ui.hasOwnProperty('form01_$nama_')){
                w2ui['form01_$nama_'].destroy();
            }
            $('#grid_$nama_').width('59.9%');  
            myForm_$nama_();
            
            var grid = this;
            this.resize();
            
        },
        ";
    }
    
    function insToTable($tbl, $insComponent, $dbconn="nplinfra"){
        $CI     = &get_instance();
        $cols   = $insComponent[0]; $vals = $insComponent[1];
        $qry    = "insert into ".$tbl." (".$cols.") values (".$vals.")"; 
        $DB1    = $CI->load->database($dbconn, TRUE);
        $EXEC   = $DB1->query($qry);
    }
    
    function updToTable($qry, $dbconn="nplinfra"){
        $CI     = &get_instance(); 
        $DB1    = $CI->load->database($dbconn, TRUE);
        $EXEC   = $DB1->query($qry);
    }
    
    function rmObj($post, $objs){
        foreach($objs as $k){
            unset($post->record->$k);
        }
        return $post;
    }
    
    function addObj($post, $objs){
        foreach($post->record as $key => $value){
            $isExcludeObject = 0;
            foreach($objs as $k){
                if($k == $key){
                    $isExcludeObject = 1;
                }                
            }
            if($isExcludeObject == 1) unset($post->record->$key);
        }
        
        return $post;
    }
    
    function x($x){
        echo $x;
        exit();
    }
    
    function z($z){
        print_r($z);
        exit();
    }
    
    
    
    function w2uiProp($p, $x, $t="str"){        
        if($t=="str"){
            return ", ".$p.": '".$x."'";
        }else{
            return ", ".$p.": ".$x."";
        }
    } 
    function w2uiShow(){
        return " { 
                toolbar         : true,
            footer          : false,
            toolbarAdd      : true,
            toolbarDelete   : true,
            toolbarSave     : false,
            toolbarEdit     : false,
            selectColumn    : true,
            expandColumn    : false,
            lineNumbers     : true,
            header          : true         
            }
        ";
    }
    
    function w2uiExcept($d, $p, $x, $t="str"){
        if(!isset($d)){
            $d = $x; 
            if($x !=""){
                return w2uiProp($p, $d, $t);
            }else {
                return false;
            } 
        }else{
            return w2uiProp($p, $d, $t); 
        } 
    }
    
    function w2uiExcept02($d, $r){
        if(!isset($d)){
            return $r; 
        }else{
            return $d; 
        } 
    }
    
    function w2uiYesNo($y="Y", $n="N", $txtYes="Yes", $txtNo="No"){
        return '
            items: [
                        {id: "'.$y.'", text:"'.$txtYes.'"}, 
                        {id: "'.$n.'", text:"'.$txtNo.'"},]
        ';
    }
    
    
    function thisName(){ 
	    
		$r = debug_backtrace();
        $nama_ = $r[1]['file']; $nama_ = explode("\\", $nama_); $nama_ = end($nama_);
        $nama_ =  str_replace(".", "_", $nama_);
		return $nama_;
 
    }