<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

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
                if(!$this->session->has_userdata('username')){
                       			redirect(base_url());
        		}
                
        }



    public function index()
	{	

		$data['title']= 'Profile '.$this->session->userdata('username'); 
		$data['user']= $this->user->getByUsername($this->session->userdata('username')); 
		$data['user'] = json_decode(json_encode($data['user']), True);
		$this->load->view('user/common_user/head',$data);
		$this->load->view('user/common_user/header',$data);
		$this->load->view('user/common_user/profile/profile_content',$data);
		


	}

	public function update()
	{	

		if($data = $this->input->post()){
			 
			 $this->form_validation->set_rules('first_name', 'Nama Depan', 'required');
			 $this->form_validation->set_rules('last_name', 'Nama Belakang', 'required');
			 $this->form_validation->set_rules('address', 'Alamat', 'required');
			 $this->form_validation->set_rules('gender', 'Gender', 'required');
			 $this->form_validation->set_rules('phone_number', 'No Handphone', 'required');
			 $this->form_validation->set_rules('birthdate', 'Tanggal Lahir', 'required');
			 					 		

			if($this->form_validation->run() == TRUE){

				$user = $this->user->getByUsername($this->session->userdata('username'));
				$user =  json_decode(json_encode($user), True);
				if(isset($_FILES['picture']) && !empty($_FILES['picture']['name'])){
                    $config['upload_path']          = './public/assets/avatar_img';
                    $config['allowed_types']        = "*";
                    $config['max_size']             = 10000;
                    $config['max_width']            = 2000000000;
                    $config['max_height']           = 2000000000;

                    $file_name=$user['username'];


                    $config['file_name']            = $file_name;

                    $this->load->library('upload', $config); 
                    if (!$this->upload->do_upload('picture'))
                    {
                    	$error =  $this->upload->display_errors();
                        $json['status']= false;
                        $json['message']= strip_tags($error);
                        $json['notif_code']= 'image';
                       
				  		$this->session->set_userdata($json);
				  		header('Location: ' . $_SERVER['HTTP_REFERER']);
				  		exit();
                    }else{
                    	if($user['picture']){
	                    	if( $unlink = unlink($user['picture'])){
	                    		//do nothing if success delete file
	                        }else{
	                            $json['status']= false;
	                            $json['message']= "Error While Unlink Last Photo  !";
	                            $json['notif_code'] = 'Unlink State is : '. $unlink;
	                           	$this->session->set_userdata($json);
						  		header('Location: ' . $_SERVER['HTTP_REFERER']);
						  		exit();
	                        }
                        }

                    	$file = $this->upload->data();
                    	$data['picture']="public/assets/avatar_img/".$file['file_name'];
                    	
                    }
				}

	            if($this->user->update($this->session->userdata('username'),$data)){
					$data = array('status'=>true,'message'=>'Update Success.','notif_code'=>'profile');
			  		$this->session->set_userdata($data);
			  		redirect('user/common_user/profile');

				}else{
					
					$data = array('status'=>false,'message'=>'Update Failed.','notif_code'=>'profile');
			  		$this->session->set_userdata($data);
			  		redirect('user/common_user/profile');
					
				}
	        }else{
				$data=$this->form_validation->error_array();
				$data2 = array('status'=>false,'message'=>'Update Failed.','notif_code'=>'profile');
				$data = array_merge($data,$data2);
			  	$this->session->set_userdata($data);
			  	redirect('user/common_user/profile');
				
	        }
		}
		


	}

	


	

}
