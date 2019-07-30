<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lib_utilitas {
	private $_ci;
	public $url;
	public $session;
	public $userinfo;
	public $moduleinfo;
	public $tmp;
	public function __construct() {
		$this->_ci=& get_instance();
	
	}
	public function set_url($url) {
		$this->url = $url;
	}
	function send_email($to, $cc, $subject, $content) {
		$this->_ci->load->helper('email');
		$this->_ci->load->library('email');
		
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = '10.1.48.4';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['wordwrap'] = FALSE;
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$config['crlf'] = "\r\n";
		$config['newline'] = "\r\n";
		
		$from = "postmaster@novellpharm.com";
		$to = "dinny.rachma@novellpharm.com"; 
		//$to=$to;
		$cc = "eka.yuni@novellpharm.com"; //$cc;
		//$cc = "eka.yuni@novellpharm.com;devina.nur@novellpharm.com; asa.ratna@novellpharm.com"; //$cc;
		$subject = $subject;
		$content = $content;
		
		
		$this->_ci->email->initialize($config);
		$this->_ci->email->from($from, 'MIS-PLC');
		$this->_ci->email->to($to);
		$this->_ci->email->cc($cc);
		//if(valid_email($cc))$this->_ci->email->cc($cc);
		$this->_ci->email->subject($subject);
		$this->_ci->email->message($content);
		
		$this->_ci->email->send();
	}
	
}