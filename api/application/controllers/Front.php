<?php

defined("BASEPATH") OR exit("No direct script access allow");


class Front extends CI_Controller{
    
    
    public function __construct(){
        
        parent::__construct();
    }
    
    
    public function getSpecilizations(){
        
        $d=$this->db->query("select * from specilizations where icon !=''")->result();
        
        $as=array();
        foreach($d as $dd){
        
        $as[]=array("specilization_name"=>$dd->specilization_name,"icon"=>"http://dextol.com/".$dd->icon,"specilization_id"=>$dd->id);    
        }
        
        
        echo json_encode(array("response_status"=>"1","message"=>"success","specilizations"=>$as));
    }
    
    
    
}