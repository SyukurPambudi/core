<?php
class lib_sub_core { 	
	private $_ci;
    private $sess_auth;
    function __construct() {
        $this->_ci=&get_instance();
        $this->_ci->load->library('Zend', 'Zend/Session/Namespace');
        $this->sess_auth = new Zend_Session_Namespace('auth');
        $this->logged_nip = $this->sess_auth->gNIP;
    }
    function user() {
		return $this->sess_auth;
	}
	

	/*-------------------------------------------------  auth    					start-------------------------------------------------------*/

	

	/*-------------------------------------------------  auth       				end --------------------------------------------------------*/

	function getApptableLog($modul_id){
		$sql='select * 
				from erp_privi.m_application a
				join erp_privi.m_modul b on b.iM_application=a.iM_application
				where b.idprivi_modules = "'.$modul_id.'"  
				limit 1';

		$data = $this->_ci->db->query($sql)->row_array();
		
		return $data;
	}
	/*get activity  modul*/
	
	function get_module_activities($modul_id){
		$sql = '
				select * 
				from erp_privi.m_modul a 
				join erp_privi.m_modul_activity b on b.iM_modul=a.iM_modul
				join erp_privi.m_activity c on c.iM_activity=b.iM_activity
				where a.lDeleted=0
				and b.lDeleted=0
				and c.lDeleted=0
				and a.idprivi_modules= 	"'.$modul_id.'"
				';
		$datas = $this->_ci->db->query($sql)->result_array();
		
		return $datas;
	}

	function get_module_activities_last($modul_id){

		$sql = '
				select * 
				from erp_privi.m_modul a 
				join erp_privi.m_modul_activity b on b.iM_modul=a.iM_modul
				join erp_privi.m_activity c on c.iM_activity=b.iM_activity
				where a.lDeleted=0
				and b.lDeleted=0
				and c.lDeleted=0
				and a.idprivi_modules= "'.$modul_id.'"
				order by b.iSort DESC
				limit 1
				';
		//echo '<pre>'.$sql;
		$data = $this->_ci->db->query($sql)->row_array();
		
		return $data;

	}

	function get_last_module_activity($modul_id,$iKey_id){
		$getApp = $this->getApptableLog($modul_id);
		$applogTable = $getApp ['vTable_log_activity'];
		$sql ='sELECT IFNULL( (	select   b1.iSort
								from erp_privi.'.$applogTable.' a1 
								join erp_privi.m_modul c1 on c1.idprivi_modules=a1.idprivi_modules
								join erp_privi.m_modul_activity b1 on b1.iM_activity=a1.iM_activity and b1.iM_modul=c1.iM_modul and b1.iSort=a1.iSort
								where a1.idprivi_modules="'.$modul_id.'"  and a1.iKey_id="'.$iKey_id.'"
								and a1.lDeleted=0
								and b1.lDeleted=0
								and c1.lDeleted=0
								order by b1.iSort DESC limit 1) ,0) as last_sort ';
		$data = $this->_ci->db->query($sql)->row_array();
		
		return $data;
	}

	function get_current_module_activities($modul_id,$iKey_id){
		 $getApp = $this->getApptableLog($modul_id);
		 $applogTable = $getApp ['vTable_log_activity'];
		$sql = '
				select * 
				from erp_privi.m_modul a 
				join erp_privi.m_modul_activity b on b.iM_modul=a.iM_modul
				join erp_privi.m_activity c on c.iM_activity=b.iM_activity
				where a.lDeleted=0
				and b.lDeleted=0
				and c.lDeleted=0
				and a.idprivi_modules= "'.$modul_id.'"

				and b.iSort > (
							SELECT IFNULL( (	select   b1.iSort
								from erp_privi.'.$applogTable.' a1 
								join erp_privi.m_modul c1 on c1.idprivi_modules=a1.idprivi_modules
								join erp_privi.m_modul_activity b1 on b1.iM_activity=a1.iM_activity and b1.iM_modul=c1.iM_modul and b1.iSort=a1.iSort
								where a1.idprivi_modules="'.$modul_id.'"  and a1.iKey_id="'.$iKey_id.'"
								and a1.lDeleted=0
								and b1.lDeleted=0
								and c1.lDeleted=0
								order by b1.iSort DESC limit 1) ,0) as last_sort
				)
				limit 1

				';
				/*echo '<pre>'.$sql;*/
		$datas = $this->_ci->db->query($sql)->result_array();
		
		return $datas;
	}

	function getLastactivity($modul_id,$iKey_id){

		
		$iFinish = 0;
		$activity_last_mapping = $this->get_module_activities_last($modul_id);
		$last_mapping = $activity_last_mapping['iSort'];

		$last_module_activity = $this->get_last_module_activity($modul_id,$iKey_id);
		$last_sort = $last_module_activity['last_sort'];

		
		if( $last_sort == $last_mapping){
			$iFinish = 1;
		}

		return $iFinish;

	}

	function getCurrent_modul($iupb_id){
		$getApp = $this->getApptableLog($modul_id);
		$applogTable = $getApp ['vTable_log_activity'];
		$sql = 'select c.vNama_modul,d.iUrut
				from erp_privi.m_modul_log_upb a 
				join erp_privi.'.$applogTable.' b on b.iM_modul_log_activity=a.iM_modul_log_activity
				join erp_privi.m_modul c on c.idprivi_modules=b.idprivi_modules 
				join erp_privi.m_flow_proses d on d.iM_modul=c.iM_modul and d.iM_flow=1
				where a.lDeleted=0 and  a.iupb_id = "'.$iupb_id.'" 
				order by d.iUrut DESC
				limit 1';

		$dMod = $this->_ci->db->query($sql)->row_array();

		if(empty($dMod)){
			$data['vNama_modul'] = 'Log Modul tidak ditemukan';
			$data['iUrut'] = 0;
		}else{
			$data['vNama_modul'] = $dMod['vNama_modul'];
			$data['iUrut'] = $dMod['iUrut'];
		}

		/*print_r($data);*/
		return $data;
	}

	function getOpenEditing($modul_id,$iKey_id){

		
		$iOpen = 0;

		$sql = '
				select * 
				from erp_privi.m_modul a 
				join erp_privi.t_modul_open b on b.idprivi_modules=a.idprivi_modules
				where a.lDeleted=0
				and b.lDeleted=0
				and a.idprivi_modules= "'.$modul_id.'"
				and b.iKey_id = "'.$iKey_id.'"
				and b.iActive = 1
				';
		
		$data = $this->_ci->db->query($sql)->row_array();
		
		if(!empty($data)){
			$iOpen = 1;	
		}


		return $iOpen;

	}

	function getLastStatusApprove($modul_id,$iKey_id){
		$getApp = $this->getApptableLog($modul_id);
		$applogTable = $getApp ['vTable_log_activity'];

		$sql='select a.iApprove 
			from erp_privi.'.$applogTable.' a 
			where a.lDeleted=0 
			and a.iKey_id = "'.$iKey_id.'"
			and a.idprivi_modules= "'.$modul_id.'"
			and a.iM_activity <> 1
			order by a.iSort DESC
			limit 1
			';

		$data = $this->_ci->db->query($sql)->row_array();
		$iBoleh = false;

		if(!empty($data)){
			if($data['iApprove']==2){
				$iBoleh = true;	
			}else{
				$iBoleh = false;	
			}
			
		}else{
			$iBoleh = true;	
		}


		return $iBoleh;

	}

	function getIDActivityAndSort($iM_modul_activity){
		$sql = 'select * from erp_privi.m_modul_activity a where a.iM_modul_activity = "'.$iM_modul_activity.'" 		';
		$dAct = $this->_ci->db->query($sql)->row_array();

		if(empty($dMod)){
			$data = $dAct;
		}else{
			$data = array();
		}

		/*print_r($data);*/
		return $data;



	}

	function MigrasiInsertActivityModule($iupb_ids,$modul_id,$iKey_id,$iM_activity,$iSort,$vRemark='',$iApprove=0,$dapp,$capp){
		$isTrue = 0;
		$data=array();
		$data['iKey_id'] =$iKey_id;
		$data['idprivi_modules'] = $modul_id;
		$data['iM_activity'] = $iM_activity;
		$data['iSort'] = $iSort;

		$data['vRemark'] = $vRemark;
		$data['iApprove'] = $iApprove;
		$data['dCreate'] = $dapp;
		$data['cCreated'] = $capp;
		

		/* $data['dCreate'] = date('Y-m-d H:i:s');
		$data['cCreated'] = $this->logged_nip; */

		/* check sudah ada belum , jika sudah / jangan masukin */
		$ins = $this->_ci->db-> insert('erp_privi.'.$applogTable.'', $data);	
		$insertID =$this->_ci->db->insert_id();

		//echo $insertID;
		//print_r($iupb_ids);
		

		if($ins){
			

			foreach ($iupb_ids as $key => $value) {
				$data2['iM_modul_log_activity'] = $insertID;
				$data2['iupb_id'] = $value;
				$data2['dCreate'] = date('Y-m-d H:i:s');
				$data2['cCreated'] = $this->logged_nip;
				$ins2 = $this->_ci->db-> insert('erp_privi.m_modul_log_upb', $data2);	

			}

			$isTrue = 1;
		}
		

		
		return $isTrue;

	}

	function InsertActivityModule($iupb_ids,$modul_id,$iKey_id,$iM_activity,$iSort,$vRemark='',$iApprove=0){
		$getApp = $this->getApptableLog($modul_id);
		$applogTable = $getApp ['vTable_log_activity'];
		
		$isTrue = 0;
		$data=array();
		$data['iKey_id'] =$iKey_id;
		$data['idprivi_modules'] = $modul_id;
		$data['iM_activity'] = $iM_activity;
		$data['iSort'] = $iSort;

		$data['vRemark'] = $vRemark;
		$data['iApprove'] = $iApprove;
		

		$data['dCreate'] = date('Y-m-d H:i:s');
		$data['cCreated'] = $this->logged_nip;
		$ins = $this->_ci->db-> insert('erp_privi.'.$applogTable.'', $data);	
		$insertID =$this->_ci->db->insert_id();

		//echo $insertID;
		//print_r($iupb_ids);
		

		if($ins){
			
			/* update Header Table jika sudah didefine di Setup Modul */

			$sql_get_flow_modul_activity = '
						select *
						from erp_privi.m_modul a
						JOIN erp_privi.m_modul_activity b ON b.iM_modul=a.iM_modul
						JOIN erp_privi.m_activity c ON c.iM_activity=b.iM_activity
						where a.lDeleted=0
						and b.lDeleted=0
						and c.lDeleted = 0
						and a.idprivi_modules = "'.$modul_id.'"
						and b.iM_activity = "'.$iM_activity.'"
						and b.iSort = "'.$iSort.'"
					
					';

			$activity = $this->_ci->db->query($sql_get_flow_modul_activity)->row_array();			

			$what   = ( array_key_exists($activity['vFieldName'], $data) ) ? $data[$activity['vFieldName']] : 0;
			$when   = ( array_key_exists($activity['dFieldName'], $data) ) ? $data[$activity['dFieldName']] : null;
			$who    = ( array_key_exists($activity['cFieldName'], $data) ) ? $data[$activity['cFieldName']] : null;
			$why    = ( array_key_exists($activity['tFieldName'], $data) ) ? $data[$activity['tFieldName']] : '-';

			if ( !empty($what) && intval($what) > 0 ){
				
				$datalog=array();
				$datalog[$activity['vFieldName']] = $what;
				$datalog[$activity['dFieldName']] = $when;
				$datalog[$activity['cFieldName']] = $who;
				$datalog[$activity['tFieldName']] = $why;

				$selPK 		= "SHOW KEYS FROM ".$activity['vTable_name']." WHERE Key_name = 'PRIMARY' ";
				$dPeka 		= $this->_ci->db->query($selPK)->row_array();
				$vCode_key 	= $dPeka['Column_name'];
							
				$this->_ci->db->where($vCode_key, $iKey_id);
				$this->_ci->db->update($vTable_name, $datalog);

			} else {
				/* bukan submit ataupun approval  */
			}


			/* if(!empty($iupb_ids)){
				foreach ($iupb_ids as $key => $value) {
					$data2['iM_modul_log_activity'] = $insertID;
					$data2['iupb_id'] = $value;
					$data2['dCreate'] = date('Y-m-d H:i:s');
					$data2['cCreated'] = $this->logged_nip;
					$ins2 = $this->_ci->db-> insert('erp_privi.m_modul_log_upb', $data2);	

				}
			} */
			

			$isTrue = 1;
		}
		

		
		return $isTrue;

	}

	function getAuthorModul($modul_id){		

		$sql = 'select * 
				from erp_privi.m_modul a 
				where a.lDeleted=0 
				and a.idprivi_modules="'.$modul_id.'"

				';
		$query = $this->_ci->db->query($sql);
		$jmlRow = $query->num_rows();
		if ($jmlRow > 0) {
			$rows = $query->row_array();
		}

		return $rows;
	}

	function getIModulID($modul_id){

		$sql = 'select *
				from erp_privi.m_modul a 
				where a.lDeleted=0 
				and a.idprivi_modules="'.$modul_id.'"

				';
				/* echo $sql; */
		$query = $this->_ci->db->query($sql);
		$jmlRow = $query->num_rows();
		$rows=array();
		if ($jmlRow > 0) {
			$rows = $query->row_array();
		}
		$return=isset($rows['iM_modul'])?$rows['iM_modul']:'';
		return $return;

	}


	function getHistoryActivity($modul_id, $iKey_id, $showDeleted = false){
		$getApp = $this->getApptableLog($modul_id);
		$applogTable = $getApp ['vTable_log_activity'];

	    $sql = 'SELECT b.vNama_activity, a.dCreate, c.vName, a.vRemark,
	    			IF(a.iApprove = 2, "Approve" , IF(a.iApprove = 1, "Reject", "-")) AS setatus
	            FROM erp_privi.'.$applogTable.' a 
	            JOIN erp_privi.m_activity b ON b.iM_activity=a.iM_activity
	            JOIN hrd.employee c ON c.cNip=a.cCreated
	            WHERE a.idprivi_modules ="'.$modul_id.'"
	            	AND a.iKey_id ="'.$iKey_id.'"';
	    $sql .= ( $showDeleted == true ) ? '' : ' AND a.lDeleted = 0';   
	    $sql .= ' ORDER BY a.iM_modul_log_activity DESC';

	    $query = $this->_ci->db->query($sql);
		$jmlRow = $query->num_rows();
		
		$html = '';

		if ($jmlRow > 0) {
			$rows = $query->result_array();
			$i=0;
			foreach ($rows as $data ) {
				$html .='
                    <tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
                        <td style="border: 1px solid #dddddd; width: 30%; text-align: center;">
                            <span class="">'.$data['vNama_activity'].'</span>
                        </td>
                        <td style="border: 1px solid #dddddd; width: 20%; text-align: center;">
                            <span class="">'.$data['setatus'].'</span>
                        </td>
                        <td style="border: 1px solid #dddddd; width: 20%; text-align: center;">
                            <span class="">'.$data['dCreate'].'</span>
                        </td>
                        <td style="border: 1px solid #dddddd; width: 20%; text-align: center;">
                            <span class="">'.$data['vName'].'</span>
                        </td>
                        <td style="border: 1px solid #dddddd; width: 30%; text-align: center;">
                            <span class="">'.$data['vRemark'].'</span>
                        </td>
                    </tr>';


				$i++;
			}
		}else{
			$html .='
                    <tr style="border: 1px solid #dddddd; border-collapse: collapse; background: #ffffff; ">
                        <td colspan="5" style="border: 1px solid #dddddd; text-align: center;">
                            <span class="">No Data</span>
                        </td>
                    </tr>';


		}

		return $html;

	}

	function isAdmin($isNiP=0){
		$this->_ci->db->like('vContent',$isNiP);
		$this->_ci->db->where('cVariable','ADMINPLCACCESS');
		$query = $this->_ci->db->get('plc2.plc_sysparam');
		$ret=false;
		if($query->num_rows()>0){
			$ret=true;
		}
		return $ret;
	}

	function whoAmI($nip) { 
        $sql = 'select b.vDescription as vdepartemen,a.*,b.*,c.iLvlemp 
                        from hrd.employee a 
                        join hrd.msdepartement b on b.iDeptID=a.iDepartementID
                        join hrd.position c on c.iPostId=a.iPostID
                        where a.cNip ="'.$nip.'"
                        ';
        
        $data = $this->_ci->db->query($sql)->row_array();
        return $data;
    }
    


	function getUploadFileFromField($iModul_id){
		$where=array(
				"m_modul_fields.iM_jenis_field"=>16
				,"m_modul.idprivi_modules"=>$iModul_id
			);
		$this->_ci->db->select("*")
						->from("erp_privi.m_modul_fields")
						->join("erp_privi.m_modul","m_modul.iM_modul=m_modul_fields.iM_modul")
						->join("erp_privi.sys_masterdok","sys_masterdok.iM_modul_fields=m_modul_fields.iM_modul_fields")
						->where($where);
		$q=$this->_ci->db->get();
		$row=array();
		if($q->num_rows()>=1){
			$row=$q->result_array();
		}
		return $row;
	}


	function generateFilename ($filename){
		$exDot = explode('.', $filename);
		$ext = $exDot[count($exDot)-1];
		$generated = str_replace(' ', '_', $filename);
		$generated = str_replace('.'.$ext, '', $generated);
		$generated = preg_replace('/[^A-Za-z0-9\-]/', '_', $generated);
		return $generated.'.'.$ext;
	}

	/* Get Upload File Upload */
	function get_data_prev($urlpath){
		$this->input=$this->_ci->input;
		$this->db_plc0=$this->_ci->load->database('plc0',false, true);
    	$post=$this->input->post();
    	$get=$this->input->get();
    	$nmTable=isset($post["nmTable"])?$post["nmTable"]:"0";
    	$grid=isset($post["grid"])?$post["grid"]:"0";
    	$ireq=isset($post["iReq"])?$post["iReq"]:"0";
    	$namefield=isset($post["namefield"])?$post["namefield"]:"0";

    	$this->db_plc0->select("*")
    				->from("erp_privi.sys_masterdok")
    				->where("filename",$namefield);
        $row=$this->db_plc0->get()->row_array();
		
		// Get upload file
		$sql1='select * from erp_privi.m_modul mo 
			join erp_privi.m_application ap on mo.iM_application=ap.iM_application
			where mo.lDeleted=0 and ap.lDeleted=0 and mo.idprivi_modules='.$this->input->get('modul_id');
		$row2=$this->db_plc0->query($sql1)->row_array();		

		$where=array('iDeleted'=>0,'idHeader_File'=>$post["id"],'iM_modul_fields'=>$row['iM_modul_fields']);
		$this->db_plc0->where($where);
		$q=$this->db_plc0->get($row2['vTable_file']);
		$rsel=array('vFilename','tKeterangan','iact');
		$data = new StdClass;
		$data->records=$q->num_rows();
		$i=0;
		foreach ($q->result() as $k) {
			$data->rows[$i]['id']=$i;
			$z=0;

			$value=$k->vFilename_generate;
			$id=$k->idHeader_File;
			$linknya = 'No File';
			if($value != '') {
				if (file_exists('./'.$row["filepath"].'/'.$id.'/'.$value)) {
					$link = base_url().'processor/'.$urlpath.'?action=download&id='.$id.'&file='.$value.'&path='.$row['filename'];
					$linknya = '<a class="ui-button-text" href="javascript:;" onclick="window.location=\''.$link.'\'">[Download]</a>&nbsp;&nbsp;&nbsp;';
				}
			}
			$linknya=$linknya.'<a class="ui-button-text" href="javascript:;" onclick="javascript:hapus_row_'.$nmTable.'('.$i.')">[Hapus]</a><input type="hidden" class="num_rows_'.$nmTable.'" value="'.$i.'" /><input type="hidden" name="'.$post["namefield"].'_iFile[]" value="'.$k->iFile.'" />';


			foreach ($rsel as $dsel => $vsel) {
				if($vsel=="iact"){
					$dataar[$dsel]=$linknya;
				}else{
					$dataar[$dsel]=$k->{$vsel};
				}
				$z++;
			}
			$data->rows[$i]['cell']=$dataar;
			$i++;
		}
		if($q->num_rows()==0 && $ireq>0){
			$data = new StdClass;
			$data->records=1;
			$dataar[0]="<input type='hidden' class='num_rows_".$nmTable."' value='1' /><input type='file' id='".$grid."_upload_file_1' class='fileupload1 multi multifile required' name='".$grid."_upload_file[]' style='width: 90%' /> *";
			$dataar[1]="<textarea class='' id='".$grid."_fileketerangan_1' name='".$grid."_fileketerangan[]' style='width: 290px; height: 50px;' size='290'></textarea>";
			$dataar[2]="<button id='ihapus_".$nmTable."' class='ui-button-text icon_hapus' style='width:75px' onclick='javascript:hapus_row_".$nmTable."(1)' type='button'>Hapus</button>";
			$data->rows[0]['cell']=$dataar;
		}
		return json_encode($data);
    }


	function getFields($iModul_id) { 
			$sql = 'SELECT a.*
			,b.vKode_modul,b.idprivi_modules,b.vCodeModule,b.iType_modul,b.vTable_name
			,b.vDept_author,b.vNip_author,b.vDept_participant,b.vNip_participant
			,b.vNotif_sql,b.vNotif_content
			,c.iM_application
			,c.idprivi_apps,c.vAplication_code,c.iHave_flow
			,c.iM_flow,c.vTable_log_activity,c.vTable_file
			,c.vParent_path_file
			from erp_privi.m_modul_fields a
			JOIN erp_privi.m_modul b ON b.iM_modul=a.iM_modul
			JOIN erp_privi.m_application c ON c.iM_application=b.iM_application 
			where a.lDeleted=0 
			AND b.lDeleted=0
			AND c.lDeleted=0
			and  a.iM_modul='.$iModul_id.' 
			order by a.iSort ASC';
		
		$data = $this->_ci->db->query($sql)->result_array();
		return $data;
	}


	
}
