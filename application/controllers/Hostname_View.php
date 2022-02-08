<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hostname_View extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->helper('url');
		$this->load->model('Router_model');

        
    }   
	public function index()
	{
		$data = array();
		$data['result'] = $this->Router_model->getDeatils();
		$this->load->view('hostname_view',$data);
		
	}
	public function importdata()
	{ 
		$this->load->view('import_data');
		if(isset($_POST["submit"]) && !empty($_FILES['file']['tmp_name']))
		{
			$file = $_FILES['file']['tmp_name'];
			//if(!empty($file))
			$handle = fopen($file, "r");
			$c = 0;//
			$count = 0;
			
			while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
			{
				$count++;
				if ($count == 1){ 
					continue;
				}
				$sap_id = $filesop[0];
				$host_name = $filesop[1];
				$mac_address = $filesop[2];
				$loopback = $filesop[3];
				
					$this->Router_model->user_insert($sap_id,$host_name,$mac_address,$loopback);
				
			}
			 redirect('hostname_view');
				
		}
	}

	public function edit($id)
	{
		 
			$data['result'] = $this->Router_model->getUserDetails($id);
			$this->load->view('update',$data);
		
	}
	
	public function submit()
	{
		
		if($_POST)
			{
				$result = $this->Router_model->update();	
				if($result=='1')
				{
					redirect('hostname_view');
					
				}
				else{
					
					redirect('update/edit/'.$_POST['id']);
				}
			}
	}
	public function active()
	{
		$id = $this->input->post('id');
		$result = $this->Router_model->active($id);
		redirect('hostname_view');
		
	}
	
	
	
	
}
