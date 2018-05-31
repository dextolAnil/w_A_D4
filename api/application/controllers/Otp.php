<?php

defined("BASEPATH") OR exit("No direct script access allow");

class Otp extends CI_Controller{
    
    
    
    
    public function __construct(){
        
        parent::__construct();
        
    }
    
    
    
	
	public function otpGenerate(){
		
		$phone=$this->input->get("phone",true);
		$email=$this->input->get("email",true);
		
		$otp=generateOtp(4);
		
		$data=array('email'=>$email,'mobile'=>$phone,'verification_key'=>$otp);
		
		$this->sms->send_sms($phone,"Your OTP ".$otp." Dextol");
		$d=$this->db->insert("otp_verification",$data);
		if($d){
			echo 'success';
		}else{
			echo 'fail';
		}
	}
	
	
    
    
    
}