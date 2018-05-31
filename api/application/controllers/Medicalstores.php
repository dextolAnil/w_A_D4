 <?php

defined("BASEPATH") OR exit("No direct script access allow");


class Medicalstores extends CI_Controller
{
	
	
	
	public function __construct(){
		
		parent::__construct();
		
		
		
	}
	
	public function getAllMedicalStores()
	{
	   
	

		
		
		
		echo json_encode(array('response_status'=>'1','message'=>'success','medical_stores'=>$this->db->query("select * from medical_stores ")->result()));
		exit;
	
	
	}
	
	public function getMedicalStoreById()
	{
	    
	   $id=$this->input->post("medicalstoreid",true); 
	   
	   	if(empty($id)){
			
			echo json_encode(array('response_status'=>'0','message'=>'Medical Store ID Emtpy'));
			exit;
			
		}
		
		
		$chk=$this->db->query("select * from medical_stores where medical_store_id = '$id' ")->num_rows();
		
		if($chk=='0'){ 
			
					echo json_encode(array('response_status'=>'0','message'=>'Medical Store  ID Not Found'));
			exit;
			
		}
		
		
		
		echo json_encode(array('response_status'=>'1','message'=>'success','medical_stores'=>$this->db->query("select * from medical_stores where medical_store_id = '$id'")->row()));
		exit;
	    
	}
	
	public function insertOrder(){
	    
	     $id=$this->input->post("medicalstoreid",true); 
	     
	      	if(empty($id)){
			
			echo json_encode(array('response_status'=>'0','message'=>'Medical Store ID Emtpy'));
			exit;
			
		}
		
		$chk=$this->db->query("select * from medical_stores where medical_store_id = '$id' ")->num_rows();
		
			if($chk=='0'){
			
					echo json_encode(array('response_status'=>'0','message'=>'Medical Store  ID Not Found'));
			exit;
			
		}
		
		
	     
// 		 $orders = array();
//  		 $orders_medical_stores = array();
// 		 $service_providers_orders = array();
		 
// 		 $orders['order_id'] = $this->users->generateOrderId();
		 
// 		 $order_id = $this->encryption->encrypt($orders['order_id']);
		 
// 		 $orders['dextol_user_id'] = $this->session->userdata("user_patient_id");
// 		 $orders['order_type'] = "medical";
// 		 $orders['type_of_order'] = $this->input->post("type_of_order",true);
		
		 
		 
// 		 $orders_medical_stores['order_id'] = $orders['order_id'];
// 		 $orders_medical_stores['dextol_user_id'] = $this->session->userdata("user_patient_id");
// 		 $orders_medical_stores['medical_store_id'] = $this->input->post('medical_store_id', true);
// 			//upload prescription 
		
// 		$service_provider_id=$this->db->get_where("medical_stores",array("medical_store_id"=>$orders_medical_stores['medical_store_id']))->row()->created_by_user_id; 
// 		$orders['user_id'] =$service_provider_id;
// 		$orders['date_of_order'] =date("Y-m-d H:i:s");
// 		 		$config['upload_path']          = './uploads/user/prescription/';
//                 $config['allowed_types']        = 'jpg|png|jpeg|pdf|doc|docx';
//                 $config['encrypt_name']             = TRUE;
// 		        $this->load->library('upload', $config);
// 		$this->upload->do_upload("prescription_path");
// 		$d=$this->upload->data();
// 		$prescription_path='uploads/user/prescription/'.$d['file_name'];
		
// 		$orders_medical_stores['prescription_path'] = $prescription_path;
// 		$orders_medical_stores['type_of_order'] =  $this->input->post("type_of_order",true);
// 		$orders_medical_stores['user_prescription_description'] = $this->input->post('user_prescription_description', true);
// 		$orders_medical_stores['date_of_order'] = date("Y-m-d H:i:s");
		
		
// 		$service_providers_orders['user_id'] = $this->input->post('user_id', true);
// 		$service_providers_orders['order_id'] = $orders['order_id'];
// 		$service_providers_orders['order_type'] = "medical";
// 		$service_providers_orders['date_of_order'] = date("Y-m-d H:i:s");
// 		$d1 = $this->db->insert('orders', $orders);
		
		
// 			if(!$d1){
// 			    echo json_encode(array('response_status'=>'1','message'=>'success','order_id'=>$order_id,'order'=>$this->db->get_where("orders",array('order_id'=>$order_id))->row()));
// 			exit;
		
// 			}
// 	    $d2 = $this->db->insert('orders_medical_stores', $orders_medical_stores);
// 			if(!$d2){
// 				  echo json_encode(array('response_status'=>'1','message'=>'success','order_id'=>$order_id,'order_medical_store'=>$this->db->get_where("orders_medical_stores",array('order_id'=>$order_id))->row()));
// 			exit;
		

		
// 			}
//     	$d3 = $this->db->insert('service_providers_orders', $service_providers_orders);
// 			if(!$d3){
// 			      echo json_encode(array('response_status'=>'1','message'=>'success','order_id'=>$order_id,'order_medical_store'=>$this->db->get_where("orders_medical_stores",array('order_id'=>$order_id))->row()));
// 			exit;
			
// 			}
			
// 			elseif($d1 && $d2 && $d3){
				
// 		exit;
// 			}
			
// 			else{
// 			 	echo json_encode(array('response_status'=>'0','message'=>'Medical Store  ID Not Found'));
// 			exit;
// 			}
		   
	}
	
	function insertBooking(){
		 $order_id = $this->input->post('order_id', true);
		 $data = array(
		 'country' => $this->input->post('country', true),
		 'state' => $this->input->post('state', true),
		 'district' => $this->input->post('district', true),
		 'city' => $this->input->post('city', true),
		 'area' => $this->input->post('area', true),
		 'address' => $this->input->post('address', true),
		 'pincode' => $this->input->post('pincode', true),
		'payment_status'=>'calculation_pending',
			 'order_status'=>'calculation_pending'
		 );
		 
		 $this->db->set($data);
		 $this->db->where("order_id",$order_id);
		 $d = $this->db->update("orders");
		
		$d2=array('status'=>'pending');
		$this->db->set($d2);
		$this->db->where("order_id",$order_id);
		$this->db->update("orders_medical_stores");
		 if($d){
		 $this->users->pnotify("Success","Order Successfully Placed","success");
		 redirect('thank-you/'.$order_id);
		 }else{
		 $this->users->pnotify("Error","Error occurred during placing an order please try again","error");
		 redirect("order/".$orders['order_id']);
		 }
	}
}