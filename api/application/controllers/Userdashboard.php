<?php
defined("BASEPATH") OR exit("No direct script access allow");


class Userdashboard extends CI_Controller
{
	
	
	public function __construct()
    {
		
		parent::__construct();
		
		
	}
    
    public function getUser()
    {
        $id=$this->input->post("dextol_user_id",true);
		
		if(empty($id))
        {
			
			echo json_encode(array('response_status'=>'0','message'=>'Dextol User ID Emtpy'));
			exit;
			
		}
		
		
		$chk=$this->db->query("select * from dextol_users where dextol_user_id = '$id' ")->num_rows();
		
		if($chk=='0')
        {
			
					echo json_encode(array('response_status'=>'0','message'=>'User ID Not Found'));
			exit;
			
		}
		
        $u=$this->input->get_where('dextol_users',array('dextol_user_id'=>'$id'))->row();
        
        
        if($u->gender == "Male")
        {
						$a = 13.7516 * $u->weight;
						$b = 5.0033 * $u->height;
						$c = 6.7550 * $u->age;
						$bmrm = 66.4730 + $a + $b - $c; 
            echo json_encode(array('response_status'=>'1','message'=>'$bmrm'));
            exit;
            
        }else{
            
            
        }
        if($u->gender == "Female"){
						$a = 9.5634 * $u->weight;
						$b = 1.8496 * $u->height;
						$c = 4.6756 * $u->age;
						$bmrf = 655.0955 + $a + $b - $c; 
		
	}else{
            
        }
        
        
		
		echo json_encode(array('response_status'=>'1','message'=>'success','
        dextol_user_id'=>$this->db->query("select * from dextol_users where dextol_user_id = '$id'")->row()));
		exit;
//        $weight = $u->weight;
//								$height = ($u->height/100);
//								
//								$bmi = $weight/($height*$height);
//        
        
    }
	
	


}