<?php
defined("BASEPATH")  OR exit("No direct script access allow");


class Locations extends CI_Controller{
    
    
    
    public function __construct(){
        
        parent::__construct();
        
        
    }
    
    
    public function getBloodGroup(){
        
        
        $b=$this->db->get_where("blood_groups")->result();
        
        
        
        echo json_encode(array("response_status"=>"1","blood_groups"=>$b));
        
    }
    
    
    public function getCountry(){
        
        $c=$this->db->get_where("countries")->result();
        
        
        echo json_encode(array("response_status"=>"1","countries"=>$c));
        
        exit;
        
        
    }
    
    
    
    public function getStates(){
        
      	$id=$this->input->post("country",true);
		
		$d=$this->db->get_where("states",array('country_id'=>$id))->result();
		
	echo json_encode(array("response_status"=>"1","states"=>$d));
	exit;
    }
    
    public function getDistricts(){
        
        $id=$this->input->post("state",true);
		
		$d=$this->db->get_where("districts",array('state_id'=>$id))->result();
		
	
	echo json_encode(array("response_status"=>"1","districts"=>$d));
	exit;
    }
    
    
    public function getCity(){
        
        $id=$this->input->post("district",true);
		
		$d=$this->db->get_where("cities",array('district_id'=>$id))->result();
		
	
	
	echo json_encode(array("response_status"=>"1","cities"=>$d));
	
	exit;
	
    }
    
    
    public function getarea(){
        
        	$id=$this->input->post("city",true);
		
		$d=$this->db->get_where("area",array('city_id'=>$id))->result();
		
	    echo json_encode(array("response_status"=>"1","areas"=>$d));
	    exit;
    }
    
    
}