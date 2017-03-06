<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Umkm extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	 public function __construct()
        {
               
                parent::__construct();
                $this->load->model('user_model','user');
                $this->load->model('store_model','store');
                if(!$this->session->has_userdata('username')){
                       			redirect(base_url());
        		}
                
        }



    public function add()
	{	

		$data['title']= 'Tambah UMKM dari User: '.$this->session->userdata('username'); 
		$data['user']= $this->user->getByUsername($this->session->userdata('username')); 
		$data['user'] = json_decode(json_encode($data['user']), True);
		
		$this->load->view('user/common_user/head',$data);
		$this->load->view('user/common_user/header',$data);

		$this->load->view('user/common_user/umkm/add_content',$data);
	}

	public function add_process()
	{	

		if($data = $this->input->post()){
			 
			 $this->form_validation->set_rules('name', 'Nama UMKM', 'required');
			 $this->form_validation->set_rules('address', 'Alamat', 'required');
			
			 					 		

			if($this->form_validation->run() == TRUE){

				
				$user['user']= $this->user->getByUsername($this->session->userdata('username')); 
				$user['user'] = json_decode(json_encode($user['user']), True);
				$data['user_id'] = $user['user']['user_id'];
	            if($this->store->insert($data)){
					$data = array('status'=>true,'message'=>'Tambah UMKM Berhasil.','notif_code'=>'profile');
			  		$this->session->set_userdata($data);
			  		redirect('user/common_user/dashboard');

				}else{
					
					$data = array('status'=>false,'message'=>'Add Failed Database.','notif_code'=>'profile');
			  		$this->session->set_userdata($data);
			  		redirect('user/common_user/umkm/add');
					
				}
	        }else{
				$data=$this->form_validation->error_array();
				$data2 = array('status'=>false,'message'=>'Add Failed Form','notif_code'=>'profile');
				$data = array_merge($data,$data2);
			  	$this->session->set_userdata($data);
			  	redirect('user/common_user/umkm/add');
				
	        }
		}
	}

	public function edit()
	{	
		if($this->input->get('umkm_id') == null || $this->input->get('umkm_id') == '' ){
			$json['status']= false;
            $json['message']= "umkm_id kosong";
            $json['notif_code'] = 'get';
           	$this->session->set_userdata($json);
	  		header('Location: ' . $_SERVER['HTTP_REFERER']);
	  		exit();
		}
		$store_id=$this->input->get('umkm_id');
		$data['user']= $this->user->getByUsername($this->session->userdata('username')); 
		$data['user'] = json_decode(json_encode($data['user']), True);
		$data['store'] = $this->store->get($store_id);
		$data['store'] = json_decode(json_encode($data['store']), True);
		$data['title']= 'Personalize '.$data['store']['name'].' dari User: '.$this->session->userdata('username'); 
		
		$this->load->view('user/common_user/head',$data);
		$this->load->view('user/common_user/header',$data);

		$this->load->view('user/common_user/umkm/edit_content',$data);
	}

	public function edit_process()
	{	

		if($data = $this->input->post()){
			 
			 $this->form_validation->set_rules('name', 'Nama UMKM', 'required');
			 $this->form_validation->set_rules('address', 'Alamat', 'required');
			
			 					 		

			if($this->form_validation->run() == TRUE){

				
				$user['user']= $this->user->getByUsername($this->session->userdata('username')); 
				$user['user'] = json_decode(json_encode($user['user']), True);
				$data['user_id'] = $user['user']['user_id'];
	           
	            
	            if($this->store->update($data['store_id'],$data)){
					$data = array('status'=>true,'message'=>'Perubahan UMKM Berhasil.','notif_code'=>'profile');
			  		$this->session->set_userdata($data);
			  		redirect('user/common_user/dashboard');

				}else{
					
					$data = array('status'=>false,'message'=>'Perbahan Failed Database.','notif_code'=>'profile');
			  		$this->session->set_userdata($data);
			  		redirect('user/common_user/umkm/edit');
					
				}
	        }else{
				$data=$this->form_validation->error_array();
				$data2 = array('status'=>false,'message'=>'perubahan Failed Form','notif_code'=>'profile');
				$data = array_merge($data,$data2);
			  	$this->session->set_userdata($data);
			  	redirect('user/common_user/umkm/edit');
				
	        }
		}
	}

	public function delete()
	{	

			
			 					 		



				
				$store_id = $this->input->get('umkm_id');
	            if($this->store->delete($store_id)){
					$data = array('status'=>true,'message'=>'Hapus UMKM Berhasil.','notif_code'=>'profile');
			  		$this->session->set_userdata($data);
			  		redirect('user/common_user/dashboard');

				}else{
					
					$data = array('status'=>false,'message'=>'Delete Failed Database.','notif_code'=>'profile');
			  		$this->session->set_userdata($data);
			  		redirect('user/common_user/umkm/add');
					
				}
	        		
	}


	

}
