<?php

defined("BASEPATH") OR exit("No direct script access allow");


class Doctors extends CI_Controller
{
	
	
	
	public function __construct()
    {
		
		parent::__construct();
		
		
		
	}
    
    public function getallDoctors()
    {
        
        	
		echo json_encode(array('response_status'=>'1','message'=>'success','doctors'=>$this->db->query("select * from doctors ")->result()));
		exit;
	
	
        
    }
    
    public function getDoctorById()
    {
        
         $id=$this->input->post("doctorid",true); 
	   
	   	if(empty($id)){
			
			echo json_encode(array('response_status'=>'0','message'=>'Doctor ID Emtpy'));
			exit;
			
		}
		
		
		$chk=$this->db->query("select * from doctors where doctor_id = '$id' ")->num_rows();
		
		if($chk=='0'){
			
					echo json_encode(array('response_status'=>'0','message'=>'Doctor  ID Not Found'));
			exit;
			
		}
		
		
		
		echo json_encode(array('response_status'=>'1','message'=>'success','doctors'=>$this->db->query("select * from doctors where doctor_id = '$id'")->row()));
		exit;
        
    }
    
    
}
	