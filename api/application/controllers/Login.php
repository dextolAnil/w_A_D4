<?php
defined("BASEPATH") or exit("No direct script access allow");

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function doLogin()
    {
      
      
	
		$me=$this->input->post_get("me",true);
		$user_type='';
		$otp='';
		$pass=$this->input->post_get("password",true);
		
		
		if(empty($me)){
			
			echo json_encode(array("response_status"=>"0","message"=>"Please enter registered email/mobile"));
			exit;
		}
		
		
		if(empty($pass)){
			
			echo json_encode(array("response_status"=>"0","message"=>"Please Enter Password"));
			exit;
		}
		
		if(is_numeric($me)){
			//if login with number
			if(empty($user_type)){
			
			$dc=$this->db->get_where("users",array('mobile'=>$me))->num_rows();
				
				if($dc=='1'){
					
					$user_type='service_provider';
				}else{
					
					$pc=$this->db->get_where("dextol_users",array('mobile'=>$me))->num_rows();
					if($pc=='1'){
						
					$user_type='user';
					}else{
						
						$this->users->alert("Error","Mobile Number Not registered with us","error");
					
					
					echo json_encode(array("response_status"=>'0','message'=>'Your provided information not registered with us '));
					exit;
					
					}
				}
				
				
		}
				if($user_type=='service_provider'){
					
					$pat=$this->db->get_where("users",array('mobile'=>$me))->num_rows();
				if($pat=='0'){
		
		
		echo json_encode(array("response_status"=>"0","message"=>"Mobile number not registered with us"));
		exit;
		
					
				}elseif($pat=='1'){
			
					$r1=$this->db->get_where("users",array('mobile'=>$me))->row();
						if($pass==$this->encryption->decrypt($r1->password)){
						
					//code here to login service providers
						
							
					$r=$this->db->get_where("users",array('mobile'=>$me))->row();
						
						
				
						echo json_encode(array("response_status"=>"1","user_id"=>$r->user_id,'email'=>$r->email,'user_type'=>'service_provider','user_permission'=>$r->user_role,'user_details'=>$r));
						
						exit;
						
						
						
					}else{
						$r=$this->db->get_where("users",array('mobile'=>$me))->row();
						$attempts=$r->login_attempts+1;
						
						$data=array('login_attempts'=>$attempts);
						$this->db->set($data);
						$this->db->where("mobile",$me);
						$this->db->update("users");
					
					
					
					echo json_encode(array("response_status"=>"0","message"=>"Wrong Password"));
					exit;
					
					
					}
				
				
				
			}
			
					
				}elseif($user_type=='user'){
					
					
					$pat=$this->db->get_where("dextol_users",array('mobile'=>$me))->num_rows();
				if($pat=='0'){
					
					$this->users->alert("Error","Mobile Number Not Registered with us","error");
		
		
		echo json_encode(array("response_status"=>"0","message"=>"Mobile number not registered with us"));
		
		exit;
		
					
				}elseif($pat=='1'){
			
					$r1=$this->db->get_where("dextol_users",array('mobile'=>$me))->row();
						if($pass==$this->encryption->decrypt($r1->password)){	
						//user dashboard login
						
					
						$r=$this->db->get_where("dextol_users",array('mobile'=>$me))->row();
						
						
						echo json_encode(array("response_status"=>"1","user_id"=>$r->dextol_user_id,'email'=>$r->email,'user_type'=>'patient','user_details'=>$r));
						
						exit;
						
					}else{
						$r=$this->db->get_where("dextol_users",array('mobile'=>$me))->row();
						$attempts=$r->login_attempts+1;
						
						$data=array('login_attempts'=>$attempts);
						$this->db->set($data);
						$this->db->where("mobile",$me);
						$this->db->update("dextol_users");
						$this->users->alert("Error","Wrong OTP","error");
					
					echo json_encode(array("response_status"=>"0","message"=>"Wrong Password"));
					
					exit;
					
					}
				
			}
			
				}
			
			
			
		
		//mobile login end
		
		}else{
		
				if(empty($user_type)){
			
			$dc=$this->db->get_where("users",array('email'=>$me))->num_rows();
				
				if($dc=='1'){
					
					$user_type='service_provider';
				}else{
					
					$pc=$this->db->get_where("dextol_users",array('email'=>$me))->num_rows();
					if($pc=='1'){
						
					$user_type='user';
					}else{
						
//						$this->users->alert("Error","Email Not registered with us","error");
						
						echo json_encode(array("response_status"=>"0","message"=>"Email not registered with us"));
						
						exit;
						
					}
				}
		}
			
			
			
			
			
				if($user_type=='service_provider'){
					
					$pat=$this->db->get_where("users",array('email'=>$me))->num_rows();
				if($pat=='0'){
					
					$this->users->alert("Error","Email Not Registered with us","error");
					
					echo json_encode(array("response_status"=>"0","message"=>"Email Not registered with us "));
					
					exit;
					
					
				}elseif($pat=='1'){
			
						$r1=$this->db->get_where("users",array('email'=>$me))->row();
						if($pass==$this->encryption->decrypt($r1->password)){
						
					//code here to login service providers
						
					
						$r=$this->db->get_where("users",array('email'=>$me))->row();
						
						
						echo json_encode(array("response_status"=>"1","user_id"=>$r->user_id,'email'=>$r->email,'user_type'=>'service_provider','user_permission'=>$r->user_role,'user_details'=>$r));
						
						exit;
						
						
					}else{
						$r=$this->db->get_where("users",array('email'=>$me))->row();
						$attempts=$r->login_attempts+1;
						
						$data=array('login_attempts'=>$attempts);
						$this->db->set($data);
						$this->db->where("email",$me);
						$this->db->update("dextol_users");
						$this->users->alert("Error","Wrong Password","error");
					
					
					
					echo json_encode(array("response_status"=>"0","message"=>"Wrong Password"));
					
					exit;
					
					
					}
				
				
				
			}
			
					
				}elseif($user_type=='user'){
					
					
					$pat=$this->db->get_where("dextol_users",array('email'=>$me))->num_rows();
				if($pat=='0'){
					
					$this->users->alert("Error","Email Not Registered with us","error");
		
		
		echo json_encode(array("response_status"=>"0","message"=>"Email Not Reigstered with us"));
		
		exit;
					
				}elseif($pat=='1'){
			
					
						$r1=$this->db->get_where("dextol_users",array('email'=>$me))->row();
						if($pass==$this->encryption->decrypt($r1->password)){
							
						//user dashboard login
						
					
						$r=$this->db->get_where("dextol_users",array('email'=>$me))->row();
				
					
					
						
						echo json_encode(array("response_status"=>"1","user_id"=>$r->dextol_user_id,'email'=>$r->email,'user_type'=>'patient','user_details'=>$r));
						
						exit;
						
						
						
					}else{
						$r=$this->db->get_where("dextol_users",array('email'=>$me))->row();
						$attempts=$r->login_attempts+1;
						
						$data=array('login_attempts'=>$attempts);
						$this->db->set($data);
						$this->db->where("email",$me);
						$this->db->update("dextol_users");
						$this->users->alert("Error","Wrong Password","error");
					
					
					echo json_encode(array("response_status"=>"0","message"=>"wrong password"));
					exit;
					
					
					}
				
			}
			
				}
			
			
		}
		
		if(empty($me)){
			redirect("login");
		}
	
      
    }
}