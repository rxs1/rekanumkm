<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Neraca extends CI_Controller {

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



    public function kalkulasi($store_id)
	{	
		$data['user']= $this->user->getByUsername($this->session->userdata('username')); 
		$data['user'] = json_decode(json_encode($data['user']), True);
		$data['store'] = $this->store->get($store_id);
		$data['store'] = json_decode(json_encode($data['store']), True);
		$data['title']= 'Kalkulasi Neraca Untuk : '.$data['store']['name'] ;

		$this->load->view('user/common_user/head',$data);
		$this->load->view('user/common_user/header',$data);
		$this->load->view('user/common_user/neraca/neraca_content',$data);
	}


	public function kalkulasi_proses($store_id)
	{	
		$this->form_validation->set_message('required', 'harus diisi');
	   $this->form_validation->set_rules('bulan-tahun', 'BUlan Tahun', 'required');
	 
       

	 	if($this->form_validation->run() == TRUE){
	 		$data_x=$this->input->post();
	 		
	 		
		  		$bukubesaraset = $this->subsidiaryledge->aset_proses($store_id,$data_x['bulan-tahun']);
		  		$bukubesarkewajiban = $this->subsidiaryledge->kewajiban_proses($store_id,$data_x['bulan-tahun']);
		  		$bukubesarekuitas = $this->subsidiaryledge->ekuitas_proses($store_id,$data_x['bulan-tahun']);
		  		$bukubesarpend_hpp = $this->subsidiaryledge->pend_hpp_proses($store_id,$data_x['bulan-tahun']);
				$bukubesarlainlain = $this->subsidiaryledge->lainlain_proses($store_id,$data_x['bulan-tahun']);
				$bukubesarbeban = $this->subsidiaryledge->beban_proses($store_id,$data_x['bulan-tahun']);
		  		
				$data = array('status'=>true,'message'=>'Sukses Tambah data.','notif_code'=>'calculate');

		  		$data['bukubesaraset'] = $bukubesaraset;
		  		$data['bukubesarkewajiban'] = $bukubesarkewajiban;
		  		$data['bukubesarekuitas'] = $bukubesarekuitas;	
		  		$data['bukubesarlainlain'] = $bukubesarlainlain;
		  		$data['bukubesarpend_hpp'] = $bukubesarpend_hpp;
		  		$data['bukubesarbeban'] = $bukubesarbeban;	
		  		$data['bulan-tahun'] = $data_x['bulan-tahun'];	
		  		
		  		

		  		$this->session->set_userdata($data);
		  		redirect(base_url().'user/common_user/neraca/resultNeraca/'.$store_id);

			 
		  
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


	public function resultNeraca($store_id){

		$data['user']= $this->user->getByUsername($this->session->userdata('username'));
		$data['user'] = json_decode(json_encode($data['user']), True);
		$data['store'] = $this->store->get($store_id);
		$data['store'] = json_decode(json_encode($data['store']), True);
		
		$data['title']= 'Neraca Untuk : '.$data['store']['name'] ; 
		$this->load->view('user/common_user/head',$data);
		$this->load->view('user/common_user/header',$data);
		$this->load->view('user/common_user/neraca/resultneraca_content',$data);
	}

}
