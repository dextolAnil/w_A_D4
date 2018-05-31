<?php

defined("BASEPATH") OR exit("No direct script access allow");


class Users extends CI_Model
{
	
	
	
	public function __construct(){
		
		parent::__construct();
		
	}
	
	/*
	*
	*Generating Dextol User ID
	*
	*/
	

	
	
	public function generateDextolUserId(){
		
		
		$i='1';
		
		do{
			
			$id="DEX".random_string("numeric",7);
			
			$chk=$this->db->get_where("dextol_users",array('dextol_user_id'=>$id))->num_rows();
			
			if($chk>0){
				$i='1';
				
			}else{
				$i='10';
			}
			
			
		}while($i<5);
		
		return $id;
	}
// 	public function alert($title="Not Decided",$msg="Empty",$type="warning"){
		
// 		$this->session->set_flashdata("msg",$msg);
// 		$this->session->set_flashdata("type",$type);
// 		$this->session->set_flashdata("title",$title);
// 	}
	
	public function generateUserId(){
		
		$i='1';
		
		do{
			
			$id="UD".random_string("numeric",7);
			
			$chk=$this->db->get_where("users",array('user_id'=>$id))->num_rows();
			
			if($chk>0){
				$i='1';
				
			}else{
				$i='10';
			}
			
			
		}while($i<5);
		
		return $id;
	}
	
// 	public function alert($title="Not Decided",$msg="Empty",$type="warning"){
		
// 		$this->session->set_flashdata("msg",$msg);
// 		$this->session->set_flashdata("type",$type);
// 		$this->session->set_flashdata("title",$title);
// 	}
	
	/*
	*User Current logged profile info
	*/
	
	public function info($column){
		
		return $this->db->get_where("users",array('user_id'=>$this->session->userdata("user_admin_id")))->row()->$column;
		
	}
	
	
	/*
	*Pnotify alert
	*/
// 	public function pnotify($title="Title",$msg="",$type="success"){
		
// 		$this->session->set_flashdata("msg",$msg);
// 		$this->session->set_flashdata("type",$type);
// 		$this->session->set_flashdata("title",$title);
		
// 		return true;
		
// 	}
	
	public function generateDoctorId(){
		$i='1';
		
		do{
			
			$id="DOC".random_string("numeric",7);
			
			$chk=$this->db->get_where("doctors",array('doctor_id'=>$id))->num_rows();
			
			if($chk>0){
				$i='1';
				
			}else{
				$i='10';
			}
			
			
		}while($i<5);
		
		return $id;
	}
	
	
	public function generateServiceId(){
		
		$i='1';
		
		do{
			
			$id="S".random_string("numeric",7);
			
			$chk=$this->db->get_where("doctor_services",array('ds_id'=>$id))->num_rows();
			
			if($chk>0){
				$i='1';
				
			}else{
				$i='10';
			}
			
			
		}while($i<5);
		
		return $id;
	}
	
	
	public function generateMedicalstoreId(){
		$i='1';
		
		do{
			
			$id="MED".random_string("numeric",7);
			
			$chk=$this->db->get_where("medical_stores",array('medical_store_id'=>$id))->num_rows();
			
			if($chk>0){
				$i='1';
				
			}else{
				$i='10';
			}
			
			
		}while($i<5);
		
		return $id;
	}
	
	public function generateDiagnosticId(){
		$i='1';
		
		do{
			
			$id="DIA".random_string("numeric",7);
			
			$chk=$this->db->get_where("diagnostics",array('diagnostic_id'=>$id))->num_rows();
			
			if($chk>0){
				$i='1';
				
			}else{
				$i='10';
			}
			
			
		}while($i<5);
		
		return $id;
	}
// 	public function dextol_user_info($column){
// 		return $this->db->get_where("dextol_users",array('dextol_user_id'=>$this->session->userdata("user_patient_id")))->row()->$column;
		
// 	}
	
	/*
	*Generate Diagnostic Test Id 
	*/
	public  function generateDiagnosticTestId(){
			$i='1';
		
		do{
			
			$id="DT".random_string("numeric",7);
			
			$chk=$this->db->get_where("diagnostics_tests",array('diagnostic_test_id'=>$id))->num_rows();
			
			if($chk>0){
				$i='1';
				
			}else{
				$i='10';
			}
			
			
		}while($i<5);
		
		return $id;
	}
	
	/*
	*Generate Order ID
	*
	*/
	public function generateOrderId(){
			$i='1';
		
		do{
			
			$id="OD".random_string("numeric",7);
			
			$chk=$this->db->get_where("orders",array('order_id'=>$id))->num_rows();
			
			if($chk>0){
				$i='1';
				
			}else{
				$i='10';
			}
			
			
		}while($i<5);
		
		return $id;
	}/*
	*Generate Transaction ID
	*
	*/
	public function generateTxnid(){
			$i='1';
		
		do{
			
			$id="TXN".random_string("alnum",10);
			
			$chk=$this->db->get_where("orders",array('txn_id'=>$id))->num_rows();
			
			if($chk>0){
				$i='1';
				
			}else{
				$i='10';
			}
			
			
		}while($i<5);
		
		return $id;
	}
	
	/*
	*Generate Clinic ID
	*
	*/
	public function generateClinicId(){
			$i='1';
		
		do{
			
			$id="CLI".random_string("alnum",10);
			
			$chk=$this->db->get_where("clinics",array('clinic_id'=>$id))->num_rows();
			
			if($chk>0){
				$i='1';
				
			}else{
				$i='10';
			}
			
			
		}while($i<5);
		
		return $id;
	}
	
	/*
	*Generate Nurse ID
	*
	*/
	public function generateNurseUserId(){
			$i='1';
		
		do{
			
			$id="NU".random_string("numeric",10);
			
			$chk=$this->db->get_where("users",array('user_id'=>$id))->num_rows();
			
			if($chk>0){
				$i='1';
				
			}else{
				$i='10';
			}
			
			
		}while($i<5);
		
		return $id;
	}



}