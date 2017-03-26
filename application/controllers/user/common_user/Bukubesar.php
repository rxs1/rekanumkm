<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bukubesar extends CI_Controller {

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
                $this->load->model('subsidiaryledge_model','subsidiaryledge');
                $this->load->model('journal_model','journal');
                $this->load->model('journaltype_model','journaltype');
                $this->load->model('transactioncategory_model','transactioncategory');
                $this->load->model('subtransactioncategory_model','subtransactioncategory');
                $this->load->model('paymentmethod_model','paymentmethod');
                if(!$this->session->has_userdata('username')){
                       			redirect(base_url());
        		}
                
        }



    public function semuaBukubesar($store_id)
	{	
		$data['user']= $this->user->getByUsername($this->session->userdata('username')); 
		$data['user'] = json_decode(json_encode($data['user']), True);
		$data['store'] = $this->store->get($store_id);
		$data['store'] = json_decode(json_encode($data['store']), True);
		$data['title']= 'Buku Besar Untuk : '.$data['store']['name'] ; 
		$this->load->view('user/common_user/head',$data);
		$this->load->view('user/common_user/header',$data);
		$this->load->view('user/common_user/subsidiaryledge/subsidiaryledge_content',$data);
	}

	public function aset($store_id)
	{	
		$data['user']= $this->user->getByUsername($this->session->userdata('username')); 
		$data['user'] = json_decode(json_encode($data['user']), True);
		$data['store'] = $this->store->get($store_id);
		$data['store'] = json_decode(json_encode($data['store']), True);
		$data['title']= 'Buku Besar Aset Untuk : '.$data['store']['name'] ; 
		$this->load->view('user/common_user/head',$data);
		$this->load->view('user/common_user/header',$data);
		$this->load->view('user/common_user/subsidiaryledge/aset/aset_content',$data);
	}

	public function aset_proses($store_id)
	{	
		  $this->form_validation->set_message('required', 'harus diisi');
	   $this->form_validation->set_rules('bulan-tahun', 'BUlan Tahun', 'required');
	 
       

	 	if($this->form_validation->run() == TRUE){
	 		$data_x=$this->input->post();
	 		
	 		
		  	if($x = $this->subsidiaryledge->aset_proses($store_id,$data_x['bulan-tahun'])){
		  		$data = array('status'=>true,'message'=>'Sukses Tambah data.','notif_code'=>'calculate');
		  		$data['data'] = $x;	
		  		$data['bulan-tahun'] = $data_x['bulan-tahun'];	

		  		$this->session->set_userdata($data);
		  		redirect(base_url().'user/common_user/bukubesar/resultAset/'.$store_id);

			  }else{
			  	$data = array('status'=>false,'message'=>'Gagal proses data.','notif_code'=>'calculate');

		  		$this->session->set_userdata($data);
		  		header('Location: ' . $_SERVER['HTTP_REFERER']);
				  		exit();
			  }
		  
		}else{
			$error= $this->form_validation->error_array();
			$error= json_decode(json_encode($error), True);	
			$errors='<br>';
			foreach ($error as $key => $value) {
				if($key=='bulan-tahun'){
					$key = 'Bulan Tahun';
					$errors.=$key.' '.$value.'<br>';
				}

				
			}
			
			$data = array('status'=>false,'message'=>$errors,'notif_code'=>'calculate');
	  		$this->session->set_userdata($data);
	  		header('Location: ' . $_SERVER['HTTP_REFERER']);
				  		exit();
		}
	}

	public function resultAset($store_id){

		$data['user']= $this->user->getByUsername($this->session->userdata('username'));
		$data['user'] = json_decode(json_encode($data['user']), True);
		$data['store'] = $this->store->get($store_id);
		$data['store'] = json_decode(json_encode($data['store']), True);
		$data['transactioncategory_obj'] = $this->transactioncategory;
		$data['paymentmethod_obj'] = $this->paymentmethod;
		$data['subtransactioncategory_obj'] = $this->subtransactioncategory;
		$data['journaltype_obj'] = $this->journaltype;
		$data['title']= 'Buku Besar Aset Untuk : '.$data['store']['name'] ; 
		$this->load->view('user/common_user/head',$data);
		$this->load->view('user/common_user/header',$data);
		$this->load->view('user/common_user/subsidiaryledge/aset/resultaset_content',$data);
	}


	public function Kewajiban($store_id)
	{	
		$data['user']= $this->user->getByUsername($this->session->userdata('username')); 
		$data['user'] = json_decode(json_encode($data['user']), True);
		$data['store'] = $this->store->get($store_id);
		$data['store'] = json_decode(json_encode($data['store']), True);
		$data['title']= 'Buku Besar Kewajiban Untuk : '.$data['store']['name'] ; 
		$this->load->view('user/common_user/head',$data);
		$this->load->view('user/common_user/header',$data);
		$this->load->view('user/common_user/subsidiaryledge/kewajiban/kewajiban_content',$data);
	}

	public function kewajiban_proses($store_id)
	{	
		  $this->form_validation->set_message('required', 'harus diisi');
	   $this->form_validation->set_rules('bulan-tahun', 'BUlan Tahun', 'required');
	 
       

	 	if($this->form_validation->run() == TRUE){
	 		$data_x=$this->input->post();
	 		
	 		
		  	if($x = $this->subsidiaryledge->kewajiban_proses($store_id,$data_x['bulan-tahun'])){
		  		$data = array('status'=>true,'message'=>'Sukses Tambah data.','notif_code'=>'calculate');
		  		$data['data'] = $x;	
		  		$data['bulan-tahun'] = $data_x['bulan-tahun'];	

		  		$this->session->set_userdata($data);
		  		redirect(base_url().'user/common_user/bukubesar/resultKewajiban/'.$store_id);

			  }else{
			  	$data = array('status'=>false,'message'=>'Gagal proses data.','notif_code'=>'calculate');

		  		$this->session->set_userdata($data);
		  		header('Location: ' . $_SERVER['HTTP_REFERER']);
				  		exit();
			  }
		  
		}else{
			$error= $this->form_validation->error_array();
			$error= json_decode(json_encode($error), True);	
			$errors='<br>';
			foreach ($error as $key => $value) {
				if($key=='bulan-tahun'){
					$key = 'Bulan Tahun';
					$errors.=$key.' '.$value.'<br>';
				}

				
			}
			
			$data = array('status'=>false,'message'=>$errors,'notif_code'=>'calculate');
	  		$this->session->set_userdata($data);
	  		header('Location: ' . $_SERVER['HTTP_REFERER']);
				  		exit();
		}
	}


	public function resultKewajiban($store_id){

		$data['user']= $this->user->getByUsername($this->session->userdata('username'));
		$data['user'] = json_decode(json_encode($data['user']), True);
		$data['store'] = $this->store->get($store_id);
		$data['store'] = json_decode(json_encode($data['store']), True);
		$data['transactioncategory_obj'] = $this->transactioncategory;
		$data['paymentmethod_obj'] = $this->paymentmethod;
		$data['subtransactioncategory_obj'] = $this->subtransactioncategory;
		$data['journaltype_obj'] = $this->journaltype;
		$data['title']= 'Buku Besar Kewajiban Untuk : '.$data['store']['name'] ; 
		$this->load->view('user/common_user/head',$data);
		$this->load->view('user/common_user/header',$data);
		$this->load->view('user/common_user/subsidiaryledge/kewajiban/resultkewajiban_content',$data);
	}




	public function ekuitas($store_id)
	{	
		$data['user']= $this->user->getByUsername($this->session->userdata('username')); 
		$data['user'] = json_decode(json_encode($data['user']), True);
		$data['store'] = $this->store->get($store_id);
		$data['store'] = json_decode(json_encode($data['store']), True);
		$data['title']= 'Buku Besar Ekuitas Untuk : '.$data['store']['name'] ; 
		$this->load->view('user/common_user/head',$data);
		$this->load->view('user/common_user/header',$data);
		$this->load->view('user/common_user/subsidiaryledge/ekuitas/ekuitas_content',$data);
	}

	public function ekuitas_proses($store_id)
	{	
		  $this->form_validation->set_message('required', 'harus diisi');
	   $this->form_validation->set_rules('bulan-tahun', 'BUlan Tahun', 'required');
	 
       

	 	if($this->form_validation->run() == TRUE){
	 		$data_x=$this->input->post();
	 		
	 		
		  	if($x = $this->subsidiaryledge->ekuitas_proses($store_id,$data_x['bulan-tahun'])){
		  		$data = array('status'=>true,'message'=>'Sukses Tambah data.','notif_code'=>'calculate');
		  		$data['data'] = $x;	
		  		$data['bulan-tahun'] = $data_x['bulan-tahun'];	

		  		$this->session->set_userdata($data);
		  		redirect(base_url().'user/common_user/bukubesar/resultEkuitas/'.$store_id);

			  }else{
			  	$data = array('status'=>false,'message'=>'Gagal proses data.','notif_code'=>'calculate');

		  		$this->session->set_userdata($data);
		  		header('Location: ' . $_SERVER['HTTP_REFERER']);
				  		exit();
			  }
		  
		}else{
			$error= $this->form_validation->error_array();
			$error= json_decode(json_encode($error), True);	
			$errors='<br>';
			foreach ($error as $key => $value) {
				if($key=='bulan-tahun'){
					$key = 'Bulan Tahun';
					$errors.=$key.' '.$value.'<br>';
				}

				
			}
			
			$data = array('status'=>false,'message'=>$errors,'notif_code'=>'calculate');
	  		$this->session->set_userdata($data);
	  		header('Location: ' . $_SERVER['HTTP_REFERER']);
				  		exit();
		}
	}


	public function resultEkuitas($store_id){

		$data['user']= $this->user->getByUsername($this->session->userdata('username'));
		$data['user'] = json_decode(json_encode($data['user']), True);
		$data['store'] = $this->store->get($store_id);
		$data['store'] = json_decode(json_encode($data['store']), True);
		$data['transactioncategory_obj'] = $this->transactioncategory;
		$data['paymentmethod_obj'] = $this->paymentmethod;
		$data['subtransactioncategory_obj'] = $this->subtransactioncategory;
		$data['journaltype_obj'] = $this->journaltype;
		$data['title']= 'Buku Besar Ekuitas Untuk : '.$data['store']['name'] ; 
		$this->load->view('user/common_user/head',$data);
		$this->load->view('user/common_user/header',$data);
		$this->load->view('user/common_user/subsidiaryledge/ekuitas/resultekuitas_content',$data);
	}


	public function pend_hpp($store_id)
	{	
		$data['user']= $this->user->getByUsername($this->session->userdata('username')); 
		$data['user'] = json_decode(json_encode($data['user']), True);
		$data['store'] = $this->store->get($store_id);
		$data['store'] = json_decode(json_encode($data['store']), True);
		$data['title']= 'Buku Besar Pend + HPP Untuk : '.$data['store']['name'] ; 
		$this->load->view('user/common_user/head',$data);
		$this->load->view('user/common_user/header',$data);
		$this->load->view('user/common_user/subsidiaryledge/pend_hpp/pend_hpp_content',$data);
	}

	public function pend_hpp_proses($store_id)
	{	
		 $this->form_validation->set_message('required', 'harus diisi');
	   $this->form_validation->set_rules('bulan-tahun', 'BUlan Tahun', 'required');
	 	if($this->form_validation->run() == TRUE){
	 		$data_x=$this->input->post();
	 		
	 		
		  	if($x = $this->subsidiaryledge->pend_hpp_proses($store_id,$data_x['bulan-tahun'])){
		  		$data = array('status'=>true,'message'=>'Sukses Tambah data.','notif_code'=>'calculate');
		  		$data['data'] = $x;	
		  		$data['bulan-tahun'] = $data_x['bulan-tahun'];	

		  		$this->session->set_userdata($data);
		  		redirect(base_url().'user/common_user/bukubesar/resultPendhpp/'.$store_id);

			  }else{
			  	$data = array('status'=>false,'message'=>'Gagal proses data.','notif_code'=>'calculate');

		  		$this->session->set_userdata($data);
		  		header('Location: ' . $_SERVER['HTTP_REFERER']);
				  		exit();
			  }
		  
		}else{
			$error= $this->form_validation->error_array();
			$error= json_decode(json_encode($error), True);	
			$errors='<br>';
			foreach ($error as $key => $value) {
				if($key=='bulan-tahun'){
					$key = 'Bulan Tahun';
					$errors.=$key.' '.$value.'<br>';
				}

				
			}
			
			$data = array('status'=>false,'message'=>$errors,'notif_code'=>'calculate');
	  		$this->session->set_userdata($data);
	  		header('Location: ' . $_SERVER['HTTP_REFERER']);
				  		exit();
		}
	}


	public function resultPendhpp($store_id){

		$data['user']= $this->user->getByUsername($this->session->userdata('username'));
		$data['user'] = json_decode(json_encode($data['user']), True);
		$data['store'] = $this->store->get($store_id);
		$data['store'] = json_decode(json_encode($data['store']), True);
		$data['transactioncategory_obj'] = $this->transactioncategory;
		$data['paymentmethod_obj'] = $this->paymentmethod;
		$data['subtransactioncategory_obj'] = $this->subtransactioncategory;
		$data['journaltype_obj'] = $this->journaltype;
		$data['title']= 'Buku Besar Pend + HPP Untuk : '.$data['store']['name'] ; 
		$this->load->view('user/common_user/head',$data);
		$this->load->view('user/common_user/header',$data);
		$this->load->view('user/common_user/subsidiaryledge/pend_hpp/resultpend_hpp_content',$data);
	}


	public function beban($store_id)
	{	
		$data['user']= $this->user->getByUsername($this->session->userdata('username')); 
		$data['user'] = json_decode(json_encode($data['user']), True);
		$data['store'] = $this->store->get($store_id);
		$data['store'] = json_decode(json_encode($data['store']), True);
		$data['title']= 'Buku Besar Beban Untuk : '.$data['store']['name'] ; 
		$this->load->view('user/common_user/head',$data);
		$this->load->view('user/common_user/header',$data);
		$this->load->view('user/common_user/subsidiaryledge/beban/beban_content',$data);
	}

	public function beban_proses($store_id)
	{	
		 $this->form_validation->set_message('required', 'harus diisi');
	   $this->form_validation->set_rules('bulan-tahun', 'BUlan Tahun', 'required');
	 	if($this->form_validation->run() == TRUE){
	 		$data_x=$this->input->post();
	 		
	 		
		  	if($x = $this->subsidiaryledge->beban_proses($store_id,$data_x['bulan-tahun'])){
		  		$data = array('status'=>true,'message'=>'Sukses Tambah data.','notif_code'=>'calculate');
		  		$data['data'] = $x;	
		  		$data['bulan-tahun'] = $data_x['bulan-tahun'];	

		  		$this->session->set_userdata($data);
		  		redirect(base_url().'user/common_user/bukubesar/resultBeban/'.$store_id);

			  }else{
			  	$data = array('status'=>false,'message'=>'Gagal proses data.','notif_code'=>'calculate');

		  		$this->session->set_userdata($data);
		  		header('Location: ' . $_SERVER['HTTP_REFERER']);
				  		exit();
			  }
		  
		}else{
			$error= $this->form_validation->error_array();
			$error= json_decode(json_encode($error), True);	
			$errors='<br>';
			foreach ($error as $key => $value) {
				if($key=='bulan-tahun'){
					$key = 'Bulan Tahun';
					$errors.=$key.' '.$value.'<br>';
				}

				
			}
			
			$data = array('status'=>false,'message'=>$errors,'notif_code'=>'calculate');
	  		$this->session->set_userdata($data);
	  		header('Location: ' . $_SERVER['HTTP_REFERER']);
				  		exit();
		}
	}


	public function resultBeban($store_id){

		$data['user']= $this->user->getByUsername($this->session->userdata('username'));
		$data['user'] = json_decode(json_encode($data['user']), True);
		$data['store'] = $this->store->get($store_id);
		$data['store'] = json_decode(json_encode($data['store']), True);
		$data['transactioncategory_obj'] = $this->transactioncategory;
		$data['paymentmethod_obj'] = $this->paymentmethod;
		$data['subtransactioncategory_obj'] = $this->subtransactioncategory;
		$data['journaltype_obj'] = $this->journaltype;
		$data['title']= 'Buku Besar Beban Untuk : '.$data['store']['name'] ; 
		$this->load->view('user/common_user/head',$data);
		$this->load->view('user/common_user/header',$data);
		$this->load->view('user/common_user/subsidiaryledge/beban/resultbeban_content',$data);
	}


	public function lainlain($store_id)
	{	
		$data['user']= $this->user->getByUsername($this->session->userdata('username')); 
		$data['user'] = json_decode(json_encode($data['user']), True);
		$data['store'] = $this->store->get($store_id);
		$data['store'] = json_decode(json_encode($data['store']), True);
		$data['title']= 'Buku Besar Lain-Lain Untuk : '.$data['store']['name'] ; 
		$this->load->view('user/common_user/head',$data);
		$this->load->view('user/common_user/header',$data);
		$this->load->view('user/common_user/subsidiaryledge/lainlain/lainlain_content',$data);
	}

	public function lainlain_proses($store_id)
	{	
		 $this->form_validation->set_message('required', 'harus diisi');
	   $this->form_validation->set_rules('bulan-tahun', 'BUlan Tahun', 'required');
	 	if($this->form_validation->run() == TRUE){
	 		$data_x=$this->input->post();
	 		
	 		
		  	if($x = $this->subsidiaryledge->lainlain_proses($store_id,$data_x['bulan-tahun'])){
		  		$data = array('status'=>true,'message'=>'Sukses Tambah data.','notif_code'=>'calculate');
		  		$data['data'] = $x;	
		  		$data['bulan-tahun'] = $data_x['bulan-tahun'];	

		  		$this->session->set_userdata($data);
		  		redirect(base_url().'user/common_user/bukubesar/resultLainlain/'.$store_id);

			  }else{
			  	$data = array('status'=>false,'message'=>'Gagal proses data.','notif_code'=>'calculate');

		  		$this->session->set_userdata($data);
		  		header('Location: ' . $_SERVER['HTTP_REFERER']);
				  		exit();
			  }
		  
		}else{
			$error= $this->form_validation->error_array();
			$error= json_decode(json_encode($error), True);	
			$errors='<br>';
			foreach ($error as $key => $value) {
				if($key=='bulan-tahun'){
					$key = 'Bulan Tahun';
					$errors.=$key.' '.$value.'<br>';
				}

				
			}
			
			$data = array('status'=>false,'message'=>$errors,'notif_code'=>'calculate');
	  		$this->session->set_userdata($data);
	  		header('Location: ' . $_SERVER['HTTP_REFERER']);
				  		exit();
		}
	}


	public function resultLainlain($store_id){

		$data['user']= $this->user->getByUsername($this->session->userdata('username'));
		$data['user'] = json_decode(json_encode($data['user']), True);
		$data['store'] = $this->store->get($store_id);
		$data['store'] = json_decode(json_encode($data['store']), True);
		$data['transactioncategory_obj'] = $this->transactioncategory;
		$data['paymentmethod_obj'] = $this->paymentmethod;
		$data['subtransactioncategory_obj'] = $this->subtransactioncategory;
		$data['journaltype_obj'] = $this->journaltype;
		$data['title']= 'Buku Besar Lain-Lain Untuk : '.$data['store']['name'] ; 
		$this->load->view('user/common_user/head',$data);
		$this->load->view('user/common_user/header',$data);
		$this->load->view('user/common_user/subsidiaryledge/lainlain/resultlainlain_content',$data);
	}













}
