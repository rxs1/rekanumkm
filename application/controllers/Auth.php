<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

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
                
                
        }



    public function index()
	{	
		redirect('auth/login','refresh');
	}
	    
	public function login()
	{	

		if($this->session->has_userdata('username')){
                	redirect(base_url().'user/common_user/dashboard');
        }

		
		$this->load->view('user/login',array('title'=>'Login | REKAN'));
        
	}

		public function register()
	{	

		if($this->session->has_userdata('username')){
                	redirect(base_url().'user/common_user/dashboard');
        }

		
		$this->load->view('user/register',array('title'=>'Daftar | REKAN'));
        
	}

	public function logout()
	{	
		$this->session->unset_userdata('username');	
		redirect(base_url());
     }



	public function verification()
	{	

		if($this->input->post()){
			 $this->form_validation->set_rules('username', 'Username', 'required');
			 $this->form_validation->set_rules('password', 'Password', 'required');
			
			if($this->form_validation->run() == TRUE){
	            $username= $this->input->post('username');
				$password= $this->input->post('password');
				if($this->user->auth($username,$password)){
					$this->session->set_userdata(array(
                            'username'      => $username   
                    ));

					redirect('user/common_user/dashboard');
				}else{
					
					$data['err_message']='cant authenticate to admin dashboard, please insert correctly !';
					$data['title']='Login | REKAN';
					$this->load->view('user/login',$data);
					
				}
	        }else{
	            
	            
				$data=$this->form_validation->error_array();
				$data['title']='Login | REKAN';
				$this->load->view('user/login',$data);
				
	        }
		} 
	}

	public function register_process()
	{	

		if($this->input->post()){
			 $this->form_validation->set_rules('username', 'Username', 'required|is_unique[mst_user.username]');
			 $this->form_validation->set_rules('password', 'Password', 'required');
			 $this->form_validation->set_rules('repassword', 'Password ke 2', 'required');
			 $this->form_validation->set_rules('email', 'Email', 'required|is_unique[mst_user.email]');

			if($this->form_validation->run() == TRUE){
								
				
	            $username= $this->input->post('username');
				$password= $this->input->post('password');
				$repassword= $this->input->post('repassword');
				$email= $this->input->post('email');
				if($password != $repassword){
					$data['err_message']='Password didn\'t match';

					$data['title']='Daftar | REKAN';
					$this->load->view('user/register',$data);
				}else{

					$data['username']= $this->input->post('username');
					$data['password']= $this->input->post('password');
					$data['email']= $this->input->post('email');
					$data['role']= 2;

					if($this->user->insert($data)){

					$data = array('status'=>true,'message'=>'Register Success.','notif_code'=>'register');
			  		$this->session->set_userdata($data);
			  		redirect('auth/login');

				  	}else{
				  		$data = array('status'=>false,'message'=>'Register Failed.','notif_code'=>'register');
				  		$this->session->set_userdata($data);
				  		redirect('auth/register');
				  	}
				}
	        }else{
	            
	            
				$data=$this->form_validation->error_array();
				$data['title']='Daftar | REKAN';
				$this->load->view('user/register',$data);
				echo "gagal";
	        }
		} 
	}

}
