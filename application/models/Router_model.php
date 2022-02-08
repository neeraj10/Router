<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Router_model extends CI_model {

	
function user_insert($sap_id,$host_name,$mac_address,$loopback){
   
	$status='1';
	$created_at=date("Y-m-d H:i:s");
	
    $data = array(
        'sap_id'=>$sap_id,
        'host_name'=>$host_name,
		'loopback'=>$loopback,
		'mac_address'=>$mac_address,
		'status'=>$status,
		'created_at'=>$created_at
	
	);
	
	if ($this->db->insert('router_details', $data)) {
		
		
		return 'success';
	} else {
		return 'error';
	}
} 
   
	
	function active($id) {
		$data = array('status'=>'0');
		return $this->db->update('router_details', $data, "id =$id");
    }

function update(){
	
	$sap_id=$this->input->post('sap_id');
    $host_name=$this->input->post('host_name');
	$loopback=$this->input->post('loopback');
	$mac_address=$this->input->post('mac_address');
	$id=$this->input->post('id');
	
    $data = array(
        'sap_id'=>$sap_id,
        'host_name'=>$host_name,
		'loopback'=>$loopback,
		'mac_address'=>$mac_address);
		return $this->db->update('router_details', $data, "id =$id");

	}
	
	function getUserDetails($id) {
		$this->db->select("*");
		$this->db->from("router_details");
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
    }
	

	
	function getDeatils() {
		$this->db->select("*");
		$this->db->from("router_details");
		$this->db->where('status', '1');
		
		$query = $this->db->get();
		return $query->result_array();
    }
	

}
