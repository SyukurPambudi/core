<?php
	if (!function_exists('func_Pendidikan_Formal')) {
		function func_Pendidikan_Formal($id) {
			$data = array(0=>'Tidak', 1=>'Ya');
			return $data[$id];
		}
	}
	
	if (!function_exists('func_Status_Record')) {
		function func_Status_Record($id) {
			$data = array(0=>'Aktif', 1=>'Deleted');
			
			return $data[$id];
		}
	}
	
	if (!function_exists('func_Status_Karyawan')) {
		function func_Status_Karyawan($id) {
			$data = array('A'=>'Aktif', 'C'=>'Cuti', 'O'=>'Off', 'M'=>'-', '0'=>'-', '-'=>'-');
			
			
			return $data[$id];
			
		}
	}
	
	if (!function_exists('func_Marketing')) {
		function func_Marketing($id) {
			$data = array('0'=>'Tidak', '1'=>'Ya');
				
				
			return $data[$id];
				
		}
	}
	
	if (!function_exists('func_Jns_Kelamin')) {
		function func_Jns_Kelamin($id) {
			$data = array('W'=>'Wanita', 'P'=>'Pria', ''=>'');
			return $data[$id];
		}
	}
	
	if (!function_exists('func_Tgl_Lahir')) {
		function func_Tgl_Lahir($id) {
			$tgl = '';
			if (!empty($id) || $id != null) {
				$tgl = date('d-m-Y', strtotime($id));
			} else {
				$tgl = '00-00-0000';
			}
			
			return $tgl;
		}				
	}
	
	if (!function_exists('func_Tgl_Psikotest')) {
		function func_Tgl_Psikotest($tgl, $id) {
			$CI = &get_instance();
			$dbset = $CI->load->database('hrd', 'true');
			$SQL = "SELECT dPsiko1, dPsiko2, dPsiko3 from rs_applicant where iRegId = '{$id}'";
			
			$result = $dbset->query($SQL);
			if($result->num_rows() > 0) {
				$rslt = $result->row();
				$dPsiko1 = $rslt->dPsiko1;
				$dPsiko2 = $rslt->dPsiko2;
				$dPsiko3 = $rslt->dPsiko3;
			} else {
				$dPsiko1 = '0000-00-00';
				$dPsiko2 = '0000-00-00';
				$dPsiko3 = '0000-00-00';
			}
			
			if (!is_null($dPsiko3) || !empty($dPsiko3)) {
				$dTglPsikotest = date('d-m-Y', strtotime($dPsiko3));
			} else if ((!is_null($dPsiko2) || !empty($dPsiko2)) && (is_null($dPsiko3) || empty($dPsiko3))) {
				$dTglPsikotest = date('d-m-Y', strtotime($dPsiko2));
			} else if ((is_null($dPsiko2) || empty($dPsiko2)) && (is_null($dPsiko3) || empty($dPsiko3))) {
				$dTglPsikotest = date('d-m-Y', strtotime($dPsiko1));
			} else {
				$dTglPsikotest = "-";
			}
				
			return $dTglPsikotest;
		}
	}
	
	if (!function_exists('func_Waktu_Dibuat')) {
		function func_Waktu_Dibuat($tgl) {
			if (!empty($tgl) || $tgl != null) {
				return date('d-m-Y', strtotime($tgl));
			} else {
				return '';
			}
		}
	}
	
	if (!function_exists('func_Waktu_Diubah')) {
		function func_Waktu_Diubah($tgl) {
			if (!empty($tgl) || $tgl != null) {
				return date('d-m-Y H:i:s', strtotime($tgl));
			} else {
				return '';
			}
		}
	}
	
	if (!function_exists('func_Dibuat_Oleh')) {
		function func_Dibuat_Oleh($tgl) {
			$CI = &get_instance();
			$dbset = $CI->load->database('hrd', 'true');
			$CI->load->model('Privilege/m_employee', 'priv_empl');
			
			$nama = $CI->priv_empl->getNameOnlyByNIP($tgl);
			return $nama;
		}
	}
	
	if (!function_exists('func_Diubah_Oleh')) {
		function func_Diubah_Oleh($tgl) {
			$CI = &get_instance();
			$dbset = $CI->load->database('hrd', 'true');
			$CI->load->model('Privilege/m_employee', 'priv_empl');
				
			$nama = $CI->priv_empl->getNameOnlyByNIP($tgl);
			return $nama;
		}
	}
?>