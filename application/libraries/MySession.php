<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MySession {
	private $_ci;
	private $_sess_auth;
	public function __construct() {
		$this->_ci=&get_instance();
		$this->_ci->load->model('m_privi_sess_hist');
		$this->_ci->load->library('Zend','Zend/Session/Namespace');
		$this->_sess_auth = new Zend_Session_Namespace('auth');
	}
	function sess_check() {
		$is_logged 	= Modules::run('login/is_logged');
		
		if(!$is_logged) { //belum login atau session timeout
			if( $this->_ci->input->is_ajax_request() ) {
				//redirect( 'login' );
				echo 'error';
				exit();
				//exit();
				//$this->output->append_output(array('gelo'=>true));
				//echo 'ajax request coy';
				//exit();
			} else {
				redirect( 'login' );
			}
		} else { //sudah login, tetapi bisa jadi login ditempat lain
			if(!$this->_sess_check_log()) { //force di signout
				redirect( 'login/signout' );
			}
		}
	}
	function _sess_check_log() {
		$sess_auth = $this->_sess_auth;
		
		$nip = isset($sess_auth->gNIP)?$sess_auth->gNIP:'';
		$select='*';
		$where=array('cNip'=>$nip);
		$result = $this->_ci->m_privi_sess_hist->select_where($select,$where,true);
		if($result) { // sudah ada, cek dulu sama atau tidak
			if( session_id()==$result['vSessionID'] ) { //aman
				return true;
			} else { //beda log
				return false;
			}
		} else { // belum ada, aman
			//return false;
			return true;
		}
	}
	function sess_in_log() {
		$sess_auth = $this->_sess_auth;
		
		$nip = isset($sess_auth->gNIP)?$sess_auth->gNIP:'';
		$select='*';
		$where=array('cNip'=>$nip);
		$result = $this->_ci->m_privi_sess_hist->select_where($select,$where,true);
		if($result) { // sudah ada, update
			$data=array(
					'cNip'=>$sess_auth->gNIP,
					'iCompanyId'=>$sess_auth->gComId,
					'vSessionID'=>session_id(),
					'dLoginAt'=>$sess_auth->timestamp,
					'dLogoutAt'=>'0000-00-00 00:00:00',
					'vIPSource'=>$this->_ci->input->ip_address(),
			);
			$where=array('cNip'=>$nip);
			$this->_ci->m_privi_sess_hist->update($data,$where);
			
		} else { // belum ada, insert
			$data=array(
					'cNip'=>$sess_auth->gNIP,
					'iCompanyId'=>$sess_auth->gComId,
					'vSessionID'=>session_id(),
					'dLoginAt'=>$sess_auth->timestamp,
					'dLogoutAt'=>'0000-00-00 00:00:00',
					'vIPSource'=>$this->_ci->input->ip_address(),
			);
			$this->_ci->m_privi_sess_hist->insert($data);
		}
		
	}
	function sess_out_log() {
		$sess_auth = $this->_sess_auth;
		
		$nip = isset($sess_auth->gNIP)?$sess_auth->gNIP:'';
		$select='*';
		$where=array('cNip'=>$nip);
		$result = $this->_ci->m_privi_sess_hist->select_where($select,$where,true);
		if($result) { // sudah ada, update
			if($result['vSessionID'] == session_id()) {
				$data=array( 'dLogoutAt'=>date('Y-m-d H:i:s') );
				$where=array('cNip'=>$nip);
				$this->_ci->m_privi_sess_hist->update($data,$where);
			}
		} 
	}
}
