<?php defined("BASEPATH") OR exit("No direct script access allow"); 

	
	
	
	
	
	
	class Sms extends CI_Model{
		
		
		public $username='Madhu8307';
		public $password='Coding@123';
		public $from='DEXTOL';
		public function __construct(){
			
			
			
			parent::__construct();
			
		}
		
		
		
		
		
	
	
	public function send_sms($mobile,$message){
		
		
		   
				$url="http://www.metamorphsystems.com/index.php/api/bulk-sms?username=".$this->username."&password=".$this->password."&from=".$this->from."&to=".$mobile."&message=".urlencode($message)."&sms_type=2";
				$ch = curl_init(); 
				curl_setopt($ch, CURLOPT_URL, $url); 
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
				$output = curl_exec($ch);       
				curl_close($ch);
		log_message("info",$this->from);
		log_message("info",$this->password);
		log_message("info",$this->username);
		log_message("info",$mobile);
		log_message("info",$message);
		
		
		
	}

		
		
		
		
	}