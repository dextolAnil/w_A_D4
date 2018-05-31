<?php
defined("BASEPATH") OR exit("No direct script access allow");

class Mail extends CI_Model{
	
	
	
	
	public function __construct(){
		
		parent::__construct();
		
		
$config['protocol'] = 'smtp';
//$config['mailpath'] = '/usr/sbin/sendmail';
//$config['charset'] = 'utf-8';
$config['smtp_host'] = 'mail.dextol.com';
$config['smtp_user'] = 'info@dextol.com';
$config['smtp_pass'] = 'dextol@123456789';
$config['smtp_port'] = 26;
$config['smtp_timeout'] = 5;
$config['smtp_keepalive'] = TRUE;
//$config['smtp_crypto'] = 'tls';
$config['mailtype'] = 'html';
		
$config['wordwrap'] = TRUE;
$config['crlf'] = '\r\n';
//$config['newline'] = '\r\n';
$this->email->initialize($config);
	}
	
	
	public function send_email($to,$subject,$message,$from_title,$from='info@dextol.com'){
		
		$this->email->from($from,$from_title);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);
		$d=$this->email->send();
		$this->email->clear();
		
		if($d){
			
			return true;
		}else{
			
			return false;
		}
		
	}
	
	
	
	
	
}