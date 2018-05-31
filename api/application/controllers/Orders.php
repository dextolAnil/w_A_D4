<?php

defined("BASEPATH") OR exit("No direct script access allow");


class Orders extends CI_Controller
{
	
	
	
	public function __construct()
    {
		
		parent::__construct();
		
		
		
	}
    
    public function getOrders()
    {
        
        $id=$this->input->post("dextoluserid",true);
        
        if(empty($id))
        {
            echo json_encode(array('response_status'=>'0','message'=>'Dextol ID Emtpy'));
			exit;
        }
        	$chk=$this->db->query("select * from orders where dextol_user_id = '$id' ")->num_rows();
		
		if($chk=='0'){
			
					echo json_encode(array('response_status'=>'0','message'=>'Dextol ID Not Found'));
			exit;
			
		}
		
		
		
		echo json_encode(array('response_status'=>'1','message'=>'success','orders'=>$this->db->query("select * from orders where dextol_user_id = '$id'")->result()));
		exit;
	
        
    }
    
    public function getOrderById()
    {
        $id=$this->input->post("orderid",true);
        
        $order_type='';
        
        if(empty($id))
        {
            echo json_encode(array('response_status'=>'0','message'=>'Order Id  Emtpy'));
            exit();
            
        }
        
       $chk=$this->db->query("select * from orders where order_id= '$id' ")->num_rows();
       if($chk=='0')
       {
           echo json_encode(array('response_status'=>'0','message'=>'Order ID Not Found'));
			exit;
       }
       
   if(empty($order_type))
   {
       
       $dc=$this->db->get_where("orders",array('order_id'=>$id))->num_rows();
       
       if($dc=='1')
       {
           
           $order_type='appointment';
           
       }
       else 
       {
          	$pc=$this->db->get_where("dextol_users",array('mobile'=>$me))->num_rows();
           
           if($pc=='1'){
						
					$order_type='medical';
					}
					else
					{
						
						
					
					
					echo json_encode(array("response_status"=>'0','message'=>'Your provided information not registered with us '));
					exit;
					
					}
           
       }
   }
   
   
   
    }
	
	
}