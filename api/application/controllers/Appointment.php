<?php

defined("BASEPATH") OR exit("No direct script access allow");


class Appointment extends CI_Controller{
	
	
	
	public function __construct(){
		
		parent::__construct();
		
		
		
	}
	
	
	
	
	public function getAllAppointments()
	{
	$id=$this->input->post("dextoluserid",true);
		
		if(empty($id)){
			
			echo json_encode(array('response_status'=>'0','message'=>'Dextol ID Emtpy'));
			exit;
			
		}
	
	$chk=$this->db->query("select * from orders_appointment where dextol_user_id = '$id' ")->num_rows();
		
		if($chk=='0'){
			
					echo json_encode(array('response_status'=>'0','message'=>'Dextol ID Not Found'));
			exit;
			
		}
		
		
		
		echo json_encode(array('response_status'=>'1','message'=>'success','orders_appointment'=>$this->db->query("select * from orders_appointment where dextol_user_id = '$id'")->result()));
		exit;
	
	
	}
	
	
	public function getAppointmentDetailsById(){
	
	$id=$this->input->post("appointment_id",true);
		
		if(empty($id)){
			
			echo json_encode(array('response_status'=>'0','message'=>'Appointment ID Emtpy'));
			exit;
			
		}
		
		
		$chk=$this->db->query("select * from orders_appointment where appointment_id = '$id' ")->num_rows();
		
		if($chk=='0'){
			
					echo json_encode(array('response_status'=>'0','message'=>'Appointment  ID Not Found'));
			exit;
			
		}
		
		
		
		echo json_encode(array('response_status'=>'1','message'=>'success','orders_appointment'=>$this->db->query("select * from orders_appointment where appointment_id = '$id'")->row()));
		exit;
	}
	
	
	
}
		
		