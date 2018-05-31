<?php
defined("BASEPATH") or exit("No direct script access allow");

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_userid()
    {
        $ext = $this->admin->get_option("default_patient_id");
        
        echo json_encode(array(
            'response_status' => '1',
            'message' => 'success',
            'patient_id' => $ext . date("YmdHis")
        ));
        exit();
    }

    public function createUser()
    {
        $name = $this->input->post("name", true);
        
        $patientid = $this->users->generateDextolUserId();
        
        $mobile = $this->input->post("mobile", true);
        $pass = $this->input->post("password", true);
        $email = $this->input->post("email", true);
        
        // if(empty($mobile)){
        //
        // echo json_encode(array('response_status'=>'0','msg'=>'Mobile Field Empty'));
        //
        // }
        //
        // if(empty($email)){
        //
        // echo json_encode(array('response_status'=>'0','msg'=>'Email Field Empty'));
        //
        // }
        //
        //
        
        $data = array(
            'dextol_user_id' => $patientid,
            'name' => $name,
            'email' => $email,
            'mobile' => $mobile,
            'password' => $this->encryption->encrypt($pass),
            'date_of_register' => date("Y-m-d H:i:s")
        );
        
        $d = $this->db->insert("dextol_users", $data);
        
        if ($d) {
            
            echo json_encode(array(
                'response_status' => '1',
                'message' => 'success',
                'dextol_user_id' => $patientid,
                'user_details' => $this->db->get_where("dextol_users", array(
                    'dextol_user_id' => $patientid
                ))->row()
            ));
            exit();
        } else {
            
            echo json_encode((array(
                'response_status' => '0',
                'message' => 'Error occurred during patient profile creating please check you net work '
            )));
            exit();
        }
    }

    

    public function updateUserDetails()
    {
        $name = $this->input->post("name", true);
        $email = $this->input->post("email", true);
        $mobile = $this->input->post("mobile", true);
        
        $userid = $this->input->post("userid", true);
      $gender = $this->input->post("gender", true);
      $country = $this->input->post("country", true);
      $state = $this->input->post("state", true);
      $district = $this->input->post("district", true);
      $city= $this->input->post("city", true);
      $area = $this->input->post("area", true);
      $pincode= $this->input->post("pincode", true);
      $donate = $this->input->post("donate", true);
            $blood = $this->input->post("blood", true);
            $dob = $this->input->post("dob", true);
            $height = $this->input->post("height", true);
            $weight = $this->input->post("weight", true);
            
            
            $pic = $this->input->post("pic", true);

$dd=date("Y",strtotime($dob));

$age=date("Y")-$dd;

        if(empty($userid)){
			
			echo json_encode(array('response_status'=>'0','meesage'=>'Please Enter User ID'));
			exit;
	
        }
		if(empty($email)){
		    echo json_encode(array('response_status'=>'0','meesage'=>'Please Enter Email'));
			exit;
		     
		}
		
	
		
		if(empty($mobile))
		{
		    echo json_encode(array('response_status'=>'0','meesage'=>'Please Enter Mobile'));
		    
		    exit;
		    
		    
		}
		
       
         $binary=base64_decode($pic);
    header('Content-Type: bitmap; charset=utf-8');
		write_file(base_url().'uploads/profiles/'.$userid.'.jpg',$binary,'wb');
			$pi='uploads/user/'.$userid.'.jpg';
			
        
      $data = array(
			'name'=>$name,
			'email'=>$email,
			'mobile'=>$mobile,
			'age'=>$age,
			'dob'=>$dob,
			'blood_group'=>$blood,
			'is_interest_to_donate_blood'=>$donate,
			
			'height'=>$height,
			'weight'=>$weight,
			'country'=>$country,
			'state'=>$state,
			'district'=>$district,
			'city'=>$city,
			'area'=>$area,
			'pincode'=>$pincode,
			'gender'=>$gender,
			'profile_pic'=>$pi
		);
        $this->db->set($data);
        $this->db->where("dextol_user_id", $userid);
        $d = $this->db->update("dextol_users");
        
        if ($d) {
            
            echo json_encode(array(
                'response_status' => '1',
                'message' => 'success',
                'dextol_user_id' => $userid,
                'user_details' => $this->db->get_where("dextol_users", array(
                    'dextol_user_id' => $userid
                ))->row()
            ));
            exit();
        } else {
            
            echo json_encode((array(
                'response_status' => '0',
                'message' => 'Error occurred during User profile Updating please check you net work '
            )));
            exit();
        }
    }

    public function resetPassword()
    {
        $pass = $this->input->post("oldpassword", true);
        
        $userid = $this->input->post("userid", true);
        
        $npass = $this->input->post("newpassword", true);
        
        $cpass = $this->input->post("confirmpassword", true);
        
        $chkd = $this->db->get_where("dextol_users", array(
            'dextol_user_id' => $userid
        ))->num_rows();
        
        if ($chkd == '1') {
            
            $opass = $this->db->get_where("dextol_users", array(
                "dextol_user_id" => $userid
            ))->row();
            
            if ($pass == $this->encryption->decrypt($opass->password)) {
                
                $data = array(
                    'password' => $this->encryption->encrypt($npass)
                );
                
                $this->db->set($data);
                $this->db->where("dextol_user_id", $userid);
                
                $dd = $this->db->update("dextol_users");
                
                if ($dd) {
                    
                    echo json_encode(array(
                        'status' => '1',
                        'message' => 'success',
                        'dextol_user_id' => $userid,
                        'user_details' => $this->db->get_where("dextol_users", array(
                            'dextol_user_id' => $userid
                        ))->row()
                    ));
                    
                    exit();
                } else {
                    echo json_encode(array(
                        'status' => '0',
                        'message' => 'Error occurred during User Password Updating please check you net work '
                    ));
                    exit();
                }
            } else {
                echo json_encode(array(
                    'status' => '0',
                    'message' => 'Error occurred during User Password Not Matched please check your password '
                ));
                exit();
            }
        } else 
        {
            
            echo json_encode(array(
                'status' => '0',
                'message' => 'Error occurred Userid Not Exist'
            ));
            exit();
        }
    }

    public function forgetPassword()
    {
        $email = $this->input->post("emailormobile", true);
        
        $fpass = $this->db->get_where("dextol_users", array(
            "email" => $email
        ))->row();
        
        if ($fpass == '1') {
            // $newpass = $this->input->post("newpassword", true);
            
            // $data = array(
            //     "password" => $this->encryption->encrypt($newpass)
            // );
            
            // $this->db->set($data);
            
            // $this->db->where("dextol_user_id", $userid);
            
            // $ss = $this->db->update("dextol_users");
            
            // if ($ss) {
                
            //     echo json_encode(array(
            //         'status' => '1',
            //         'message' => 'success',
            //         'dextol_user_id' => $userid,
            //         'user_details' => $this->db->get_where("dextol_users", array(
            //             'dextol_user_id' => $userid
            //         ))->row()
            //     ));
                
                echo json_encode(array(
                    'status' => '1',
                    'message' => 'Your Pasword is'.$this->encryption->decrypt($fpass->password)
                ));
                exit();
            // } else {
                
            //     echo json_encode(array(
            //         'status' => '0',
            //         'message' => 'Error occured during Update Password please check network'
            //     ));
                
            //     exit();
            // }
        } 
        else {
            
            $fpass = $this->db->get_where("dextol_users", array(
                "mobile" => $email
            ))->row();
            if ($fpass == '1') {
                echo json_encode(array(
                    'status' => '1',
                    'message' => 'Your Pasword is'.$this->encryption->decrypt($fpass->password)
                ));
            } else {
                echo json_encode(array(
                    'status' => '0',
                    'message' => 'Error Email && Mobile Not Matched'
                ));
                exit();
            }
        }
    }
}
?>