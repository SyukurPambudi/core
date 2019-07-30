<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_login extends CI_Model{
	
	function __construct(){
		parent::__construct();
		
	}
	
	public function validate($username, $password, $company){
		$result	= '';
		$data	= array();
		$DB1 	= $this->load->database('default', FALSE);
		$DB2 	= $this->load->database('hrd', TRUE);
		
		//$this->db->where('cNip', $username);
		//$query = $this->db->get('privi_password');
		
		$DB2->where('cNip', $username);
		$query = $DB2->get('employee');
		
		if($query->num_rows == 1){
			
			//$this->db->where('cNip', $username);
			//$this->db->where('vPassword', md5($password));
			//$query2 = $this->db->get('privi_password');
			/*change by mansur 20181029 req by pak eddy on group WA Me Tech Tech*/
			$DB2->where('cNip', $username);
			$DB2->where('vPassword', md5(addslashes($password)));
			$query2 = $DB2->get('employee');

			
			if ( $query2->num_rows() > 0) {
			
				$row  = $query2->row();
                                
				//GET ATTR
				//$this->$db->where('cNip', $username);
				//$query3 = $this->db->get('employee');
				//$row3	= $query3->row();
				
				//GET COMPANY
				//$this->db->where('idPT', $company);
				//$query4 = $this->db->get('privi_pt');
				//$row4 	= $query4->row();
				
				$DB2->where('iCompanyId', $company);
				$query4 = $DB2->get('company');
				$row4 	= $query4->row();
				
				//cek auth list
				$DB1 	 = $this->load->database('default', TRUE);
				$DB2 	 = $this->load->database('hrd', FALSE);
				$arrayApp= array();
				$sql5 = "SELECT    ( t1.cNIP ) AS 'nip'
								, ( t1.iCompanyId ) AS 'comId'
								, ( SELECT tx1.vCompName FROM hrd.company tx1 WHERE tx1.iCompanyId = t1.iCompanyId) AS 'compName'
								, ( t1.idprivi_apps)AS 'idApp'
								, ( SELECT tx2.vAppName FROM privi_apps tx2 WHERE tx2.idprivi_apps = t1.idprivi_apps) AS 'appName'
							FROM
								privi_authlist t1
								#left join
								#privi_group_pt_app t2 on t2.iCompanyId = t1.iCompanyId and t2.idprivi_apps = t1.idprivi_apps
								#left join
								#privi_group_pt_app_mod t3 on t3.idprivi_group = t2.idprivi_group
							WHERE
								t1.cNIP = '".$username."'
								AND
								t1.iCompanyId 	= $company
								#and
								#t1.idprivi_apps = 1
								#and
								#t2.idprivi_group = 1
							;";
				
				$query5 	= $DB1->query($sql5);
				$data5  	= $query5->result_array();
				if($data5){
					foreach ($data5 as $row5){
						$idApplication 	= $row5['idApp'];
						$arrayApp[] = array('IdApp' => $idApplication);
					}
				}
                                
                $DB1 	 = $this->load->database('default', FALSE);
				$DB2 	 = $this->load->database('hrd', TRUE);
                                
                //divisi
                $DB2->where('iDivId', $row->iDivisionID);
				$query6 = $DB2->get('msdivision');
				$row6 	= $query6->row();
				$nama_div = empty($row6->vDescription) ? '' : $row6->vDescription;
				
                //departement                
                $DB2->where('iDeptId', $row->iDepartementID);
				$query7 = $DB2->get('msdepartement');
				$row7 	= $query7->row();
				$nama_dept = empty($row7->vDescription) ? '' : $row7->vDescription; 
				
				//$data = array('ID' => $row->cNip, 'C_NIP' => $row->cNip, 'V_NAME' => '', 'COMP' => $row4->vCompName, 'validated' => 1, 'GROUP'=>$row->idprivi_group_access);
				//$data = array('ID' => $row->cNip, 'C_NIP' => $row->cNip, 'V_NAME' => $row->vName, 'COMP' => $row4->vCompName, 'validated' => 1, 'GROUP'=>$arrayApp);
                                $data = array('ID'   => $row->cNip, 
                                            'C_NIP'  => $row->cNip, 
                                            'V_NAME' => $row->vName, 
                                            'COMP'   => $row4->vCompName, 
                                            'DIVID'  => $row->iDivisionID,
                                            'DIV'    => $nama_div, 
                                            'DEPTID' => $row->iDepartementID,
                                            'DEPT'   => $nama_dept,
                                            'validated' => 1, 'GROUP'=>$arrayApp);
				
				
				$result = $data;
			} else {
				//$data = array('ID' => '', 'C_NIP' => '',  'V_NAME' => '', 'COMP' => '', 'validated' => 2, 'GROUP'=>'');
                                $data = array('ID'     => '', 
                                              'C_NIP'  => '',  
                                              'V_NAME' => '', 
                                              'COMP'   => '', 
                                              'DIVID'  => '',
                                              'DIV'    => '', 
                                              'DEPTID' => '',
                                              'DEPT'   => '',
                                              'validated' => 2, 
                                              'GROUP'  =>'');
				$result = $data ;
			}
		} else {
			//$data = array('ID' => '', 'C_NIP' => '','V_NAME' => '',  'COMP' => '', 'validated' => 3, 'GROUP'=>'' );
                                $data = array('ID'     => '', 
                                      'C_NIP'  => '', 
                                      'V_NAME' => '',  
                                      'COMP'   => '', 
                                      'DIVID'  => '',
                                      'DIV'    => '', 
                                      'DEPTID' => '',
                                      'DEPT'   => '',
                                      'validated' => 3, 
                                      'GROUP'  =>'' );
			$result = $data ;
		}
		return $result;
	}
	
	public function getCompModel(){
		$result	= '';
		$data	= array();
		$DB2 	= $this->load->database('hrd', TRUE);
		
		$table		= 'company';
		$sql		= "SELECT iCompanyId, vCompName, vAcronim, lDeleted  FROM $table WHERE  lDeleted =  b'0' " ;
		$query 		= $DB2->query($sql);
		$data  		= $query->result_array();
		if($data){
			foreach ($data as $row){
				$idComp 	= $row['iCompanyId'];
				$exp 		= explode(".", $row['vCompName']);
				$nameComp	= $exp[0].'. '.ucwords(strtolower($exp[1]));
				$codeComp	= $row['vAcronim']; 
				$preference[] = array( 'idComp'		=> $idComp
									, 'nameComp'	=> $nameComp
									, 'codeComp'	=> $codeComp  );
			}
		}else{
			$preference[] = array( 'idComp'	=> '0'
								, 'nameComp'	=> ''
								, 'codeComp'	=> ''  );
		}
		return $preference;
	}
	
	
}
?>