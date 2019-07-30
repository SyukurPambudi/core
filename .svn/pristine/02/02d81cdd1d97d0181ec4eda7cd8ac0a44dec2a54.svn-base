<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_change_profile0 extends CI_Model{
	public $table;
	public $db;

	function __construct(){
		parent::__construct();
		$this->db	 = set_db('hrd', true);
		$this->load->library("jsonci");
	}

	function getEmployeeProfile($nip){
		if($nip=='') return false;

		$result	  = array();
		try{
			$sql 	= "SELECT a.cNip AS NIP, a.vName AS Nama, b.vDescription AS Divisi, c.vDescription AS Departemen, d.vDescription AS Posisi,
											e.vCompName AS Perusahaan, e2.vAreaName AS Area_Kerja,  a.vEmail AS EmailKantor, e.cPhoneCC AS HandPhone0,
											substr(a.vhp, (CHAR_LENGTH(e.cPhoneCC) + 1) ) AS HandPhone ,
											a.vPersonalEmail AS PerSonalMail, a.mphoto AS Photo
								FROM hrd.employee a
								LEFT JOIN hrd.msdivision b ON b.iDivID = a.iDivisionID AND b.lDeleted = 0
								LEFT JOIN hrd.msdepartement c ON c.iDeptID = a.iDepartementID AND c.lDeleted = 0
								LEFT JOIN hrd.position d ON d.iPostId = a.iPostID AND d.lDeleted = 0
								LEFT JOIN hrd.company e ON e.iCompanyId = a.iCompanyID AND e.lDeleted = 0
								LEFT JOIN hrd.area e2 on e2.iAreaID = a.iArea and e2.lDeleted = 0
								WHERE a.cNip = '".$nip."'  AND a.lDeleted = 0 LIMIT 1;";
			$query 	= $this->db->query($sql);
			$result  	= ($query->num_rows() > 0) ? $query->row_array() : array();

		}catch(Exception $e) {
			$result = array('return'=> '2', 'text' => 'Error. '.$e);
		}

		return $result;
	}

	function updateProfile($nip, $post) {
		$result	  = array();
		try{
      $today      = date('Y-m-d H:i:s', mktime());

			//update data hrd.employee
			$sqli	 = "UPDATE hrd.employee SET vEmail= '".$post['email']."', vPersonalEmail = '".$post['PersoEmail']."', vhp = '".$post['Hp']."'
									WHERE cNip =  '".$nip."' AND lDeleted = 0;";
			$query 	= $this->db->query($sqli);

			//update status nip phone bool menjadi deleted
			$sqli 	= "UPDATE general.phonebk SET lDeleted = 1, lErp2fox = 0 WHERE cNIP = '".$nip."'  ;";
      $query = $this->db->query($sqli);

      //cari apakah ada list phonebk yang sesuai kalau ada maka ubah statusnya menjadi Active
			$sql 	= "SELECT * FROM general.phonebk WHERE cNIP = '".$nip."' AND cHP = '".$post['Hp']."' AND vEmail = '".$post['email']."' ;";
      $query = $this->db->query($sql);
      if ($query->num_rows() > 0) {
				$sql 	= "UPDATE general.phonebk SET
																							vEmail = '".$post['email']."', cHP = '".$post['Hp']."' , lErp2fox = 1, lDeleted = 0
																				WHERE
																							 cNIP = '".$nip."' AND cHP = '".$post['Hp']."' AND vEmail = '".$post['email']."' ;";
      	$query = $this->db->query($sql);
				$result 	 = array('return'=> '1', 'text' => 'Profile updated.');
      }else{
      //Kalau data tidak ada diphone book maka insert baru kembali.
      	$vName 	= $this->get_name_by_nip( $nip );
				$sql 		= "INSERT INTO general.phonebk (cNip,vName,cHP,vEmail,lErp2fox,lDeleted,tCreated,cCreatedBy,tUpdated,cUpdatedBy)
              					VALUES ('".$nip."','".$vName."','".$post['Hp']."',  '".$post['email']."', '1', '0', '".$today."', '".$nip."', '".$today."',
              					 '".$nip."' ) ";
				$query 	= $this->db->query($sql);
				$result 	 = array('return'=> '1', 'text' => 'Profile updated.');
      }
		}catch(Exception $e) {
			$result = array('return'=> '2', 'text' => 'Error. '.$e);
		}

		$this->jsonci->sendJSONsuccess($result);
	}

	function updatePassword($nip, $post, $np) {
		$old_pass = trim(md5($op));
		$new_pass = trim(md5($np));
		$cur_pass = '';

		$result	  = array();

		try{
			$sql 	= "SELECT cNip, vPassword FROM employee where cNip = '".$nip."' ;";
			$query 	= $this->db->query($sql);
			$data  	= $query->result_array();

			foreach($data as $dt){
				$cur_pass = $dt['vPassword'];
				if ($old_pass !== $cur_pass){
					$result = array('return'=> '0', 'text' => 'Wrong current password.');
				}else{
					$sqlUpdate 	 = "UPDATE employee SET vPassword = '$new_pass' WHERE cNip='".$nip."'";
					$queryUpdate = $this->db->query($sqlUpdate);
					$result 	 = array('return'=> '1', 'text' => 'Password updated.');
				}
			}
		}catch(Exception $e) {
			$result = array('return'=> '2', 'text' => 'Error. '.$e);
		}

		$this->jsonci->sendJSONsuccess($result);
	}

	function get_name_by_nip($nip='') {
		if($nip=='') return false;
		$sql = "SELECT * FROM hrd.employee where cNip = '$nip' LIMIT 1";
		$query = $this->db->query( $sql );
		if($query->num_rows()>0) {
			$row = $query->row_array();
			$name = $row['vName'];
			return $name;
		}
		return false;
	}

}