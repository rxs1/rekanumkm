<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akuntansi extends CI_Controller {

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
                $this->load->model('transactioncategory_model','transactioncategory');
                $this->load->model('subtransactioncategory_model','subtransactioncategory');
                $this->load->model('paymentmethod_model','paymentmethod');
                if(!$this->session->has_userdata('username')){
                       			redirect(base_url());
        		}
                
        }



    public function allJurnal($store_id)
	{	
		
		
		$data['user']= $this->user->getByUsername($this->session->userdata('username')); 
		$data['user'] = json_decode(json_encode($data['user']), True);
		$data['store'] = $this->store->get($store_id);
		$data['store'] = json_decode(json_encode($data['store']), True);
		$data['title']= 'Akuntansi Management Untuk : '.$data['store']['name'] ; 
		$this->load->view('user/common_user/head',$data);
		$this->load->view('user/common_user/header',$data);
		$this->load->view('user/common_user/accounting/accounting_content',$data);
		


	}

	public function jurnalPembelian($store_id,$journaltype_id)
	{	
		
		
		$data['user']= $this->user->getByUsername($this->session->userdata('username')); 
		$data['user'] = json_decode(json_encode($data['user']), True);
		$data['store'] = $this->store->get($store_id);
		$data['store'] = json_decode(json_encode($data['store']), True);
		$data['purchasejournals'] = $this->journal->getByStoreIdAndJournalTypeId($store_id,$journaltype_id);
		
		$data['purchasejournals'] = json_decode(json_encode($data['purchasejournals']), True);

		$data['transactioncategory_obj'] = $this->transactioncategory;
		$data['paymentmethod_obj'] = $this->paymentmethod;
		$data['title']= 'Jurnal Pembelian Untuk : '.$data['store']['name'] ; 
		$this->load->view('user/common_user/head',$data);
		$this->load->view('user/common_user/header',$data);
		$this->load->view('user/common_user/accounting/purchasejournal/purchasejournal_content',$data);
	}

	public function tambahTransaksiJurnalPembelian($store_id,$journaltype_id)
	{	
		$data['user']= $this->user->getByUsername($this->session->userdata('username')); 
		$data['user'] = json_decode(json_encode($data['user']), True);
		$data['store'] = $this->store->get($store_id);
		$data['store'] = json_decode(json_encode($data['store']), True);
		$data['transactioncategory'] = $this->transactioncategory-> getAllJournalTypeId($journaltype_id);
		$data['transactioncategory'] = json_decode(json_encode($data['transactioncategory']), True);
		$data['paymentmethods'] = $this->paymentmethod->getAll();
		$data['paymentmethods'] = json_decode(json_encode($data['paymentmethods']), True);
		$data['title']= 'Tamah Jurnal Pembelian Untuk : '.$data['store']['name'] ; 
		$this->load->view('user/common_user/head',$data);
		$this->load->view('user/common_user/header',$data);
		$this->load->view('user/common_user/accounting/purchasejournal/addPurchasejournalTransaction_content',$data);

	}

	public function tambahTransaksiJurnalPembelian_proses($store_id)
	{	
		
	   $this->form_validation->set_message('required', 'harus diisi');
	   $this->form_validation->set_rules('description', 'Deskripsi Transaksi', 'required');
	   $this->form_validation->set_rules('transactioncategory_id', 'Tipe Pembelian', 'required');
	   $this->form_validation->set_rules('paymentmethod_id', 'Transaksi Secara', 'required');
	   $this->form_validation->set_rules('nominal', 'Nominal', 'required');
       

	 	if($this->form_validation->run() == TRUE){
	 		$data_x=$this->input->post();
	 		$data_x['store_id']=$store_id ;
	 		$data_x['journaltype_id']=1;//tipe pembelian
	 		
		  	if($this->journal->insert($data_x)){
		  		$data = array('status'=>true,'message'=>'Sukses Tambah data.','notif_code'=>'add');
		  		$this->session->set_userdata($data);
		  		redirect(base_url().'user/common_user/akuntansi/jurnalpembelian/'.$store_id.'/1');

			  }else{
			  	$data = array('status'=>false,'message'=>'Gagal tambah data.','notif_code'=>'add');
		  		$this->session->set_userdata($data);
		  		header('Location: ' . $_SERVER['HTTP_REFERER']);
				  		exit();
			  }
		  
		}else{
			$error= $this->form_validation->error_array();
			$error= json_decode(json_encode($error), True);	
			$errors='<br>';
			foreach ($error as $key => $value) {
				if($key=='description'){
					$key = 'Deskripsi';
					$errors.=$key.' '.$value.'<br>';
				}

				if($key=='transactioncategory_id'){
					$key = 'Tipe Pembelian';
					$errors.=$key.' '.$value.'<br>';
				}

				if($key=='paymentmethod_id'){
					$key = 'Transaksi Secara';
					$errors.=$key.' '.$value.'<br>';
				}


				if($key=='nominal'){
					$key = 'Nominal';
					$errors.=$key.' '.$value.'<br>';
				}
			}
			
			$data = array('status'=>false,'message'=>$errors,'notif_code'=>'add');
	  		$this->session->set_userdata($data);
	  		header('Location: ' . $_SERVER['HTTP_REFERER']);
				  		exit();
		}

	}


	public function editTransaksiJurnalPembelian($store_id,$journal_id,$journaltype_id)
	{	
		$data['user']= $this->user->getByUsername($this->session->userdata('username')); 
		$data['user'] = json_decode(json_encode($data['user']), True);
		$data['store'] = $this->store->get($store_id);
		$data['store'] = json_decode(json_encode($data['store']), True);
		$data['journal'] = $this->journal->get($journal_id);
		$data['journal'] = json_decode(json_encode($data['journal']), True);
		$data['transactioncategory'] = $this->transactioncategory-> getAllJournalTypeId($journaltype_id);
		$data['transactioncategory'] = json_decode(json_encode($data['transactioncategory']), True);
		$data['paymentmethods'] = $this->paymentmethod->getAll();
		$data['paymentmethods'] = json_decode(json_encode($data['paymentmethods']), True);
		$data['title']= ' Edit Jurnal Pembelian Untuk : '.$data['store']['name'].' | '. $data['journal']['description'] ; 
		$this->load->view('user/common_user/head',$data);
		$this->load->view('user/common_user/header',$data);
		$this->load->view('user/common_user/accounting/purchasejournal/editPurchasejournalTransaction_content',$data);
	}

	public function editTransaksiJurnalPembelian_proses($journal_id)
	{	
		
	   $this->form_validation->set_message('required', 'harus diisi');
	   $this->form_validation->set_rules('description', 'Deskripsi Transaksi', 'required');
	   $this->form_validation->set_rules('transactioncategory_id', 'Tipe Pembelian', 'required');
	   $this->form_validation->set_rules('paymentmethod_id', 'Transaksi Secara', 'required');
	   $this->form_validation->set_rules('nominal', 'Nominal', 'required');
       

	 	if($this->form_validation->run() == TRUE){
	 		$data_x=$this->input->post();
	 		;
	 		
		  	if($this->journal->update($journal_id,$data_x)){
		  		$data = array('status'=>true,'message'=>'Sukses Edit data.','notif_code'=>'edit');
		  		$this->session->set_userdata($data);
		  		header('Location: ' . $_SERVER['HTTP_REFERER']);
				  		exit();

			  }else{
			  	$data = array('status'=>false,'message'=>'Gagal edit data.','notif_code'=>'edit');
		  		$this->session->set_userdata($data);
		  		header('Location: ' . $_SERVER['HTTP_REFERER']);
				  		exit();
			  }
		  
		}else{
			$error= $this->form_validation->error_array();
			$error= json_decode(json_encode($error), True);	
			$errors='<br>';
			foreach ($error as $key => $value) {
				if($key=='description'){
					$key = 'Deskripsi';
					$errors.=$key.' '.$value.'<br>';
				}

				if($key=='transactioncategory_id'){
					$key = 'Tipe Pembelian';
					$errors.=$key.' '.$value.'<br>';
				}

				if($key=='paymentmethod_id'){
					$key = 'Transaksi Secara';
					$errors.=$key.' '.$value.'<br>';
				}


				if($key=='nominal'){
					$key = 'Nominal';
					$errors.=$key.' '.$value.'<br>';
				}
			}
			
			$data = array('status'=>false,'message'=>$errors,'notif_code'=>'add');
	  		$this->session->set_userdata($data);
	  		header('Location: ' . $_SERVER['HTTP_REFERER']);
				  		exit();
		}

	}

	public function deleteJurnalPembelian($journal_id){

	

	 	if($journal_id != ''){
		  	if($this->journal->delete($journal_id)){
		  	
		  		$data = array('status'=>true,'message'=>'Sukses hapus data.','notif_code'=>'delete');
		  		$this->session->set_userdata($data);
		  		header('Location: ' . $_SERVER['HTTP_REFERER']);
				  		exit();

			  }else{
			  	$data = array('status'=>false,'message'=>'Gagal delete data.','notif_code'=>'delete');
		  		$this->session->set_userdata($data);
		  		header('Location: ' . $_SERVER['HTTP_REFERER']);
				  		exit();
			  }
		  
		}else{
			$data = array('status'=>false,'message'=>'Data yang diminta tidak ada.','notif_code'=>'delete');
	  		$this->session->set_userdata($data);
	  		header('Location: ' . $_SERVER['HTTP_REFERER']);
				  		exit();
		}

	 }



	 public function jurnalPengeluaranKas($store_id,$journaltype_id)
	{	
		
		
		$data['user']= $this->user->getByUsername($this->session->userdata('username')); 
		$data['user'] = json_decode(json_encode($data['user']), True);
		$data['store'] = $this->store->get($store_id);
		$data['store'] = json_decode(json_encode($data['store']), True);
		$data['cashpaymentjournals'] = $this->journal->getByStoreIdAndJournalTypeId($store_id,$journaltype_id);
		
		$data['cashpaymentjournals'] = json_decode(json_encode($data['cashpaymentjournals']), True);

		$data['transactioncategory_obj'] = $this->transactioncategory;
		$data['subtransactioncategory_obj'] = $this->subtransactioncategory;
		$data['paymentmethod_obj'] = $this->paymentmethod;
		$data['title']= 'Jurnal Pengeluaran Kas Untuk : '.$data['store']['name'] ; 
		$this->load->view('user/common_user/head',$data);
		$this->load->view('user/common_user/header',$data);
		$this->load->view('user/common_user/accounting/cashpaymentjournal/cashpaymentjournal_content',$data);
		
	}

	public function tambahTransaksijurnalPengeluaranKas($store_id,$journaltype_id)
	{	
		$data['user']= $this->user->getByUsername($this->session->userdata('username')); 
		$data['user'] = json_decode(json_encode($data['user']), True);
		$data['store'] = $this->store->get($store_id);
		$data['store'] = json_decode(json_encode($data['store']), True);
		$data['transactioncategory'] = $this->transactioncategory-> getAllJournalTypeId($journaltype_id);
		$data['transactioncategory'] = json_decode(json_encode($data['transactioncategory']), True);
		
		$data['title']= 'Tambah Jurnal Pengeluaran Kas Untuk : '.$data['store']['name'] ; 
		$this->load->view('user/common_user/head',$data);
		$this->load->view('user/common_user/header',$data);
		$this->load->view('user/common_user/accounting/cashpaymentjournal/addCashpaymentjournalTransaction_content',$data);

	}


	public function tambahTransaksijurnalPengeluaranKas_proses($store_id)
	{	
		$this->form_validation->set_message('required', 'harus diisi');
	   	$this->form_validation->set_rules('description', 'Deskripsi Transaksi', 'required');
	   	$this->form_validation->set_rules('transactioncategory_id', 'Tipe Pembelian', 'required');
	   	$this->form_validation->set_rules('transactioncategory_id', 'Tipe Pembelian', 'required');
	   	$this->form_validation->set_rules('paymentmethod_id', 'Transaksi Secara', 'required');
	   	$this->form_validation->set_rules('nominal', 'Nominal', 'required');
        $this->form_validation->set_rules('journal_date', 'Tanggal Pencatatan', 'required');       

	 	if($this->form_validation->run() == TRUE){
	 		$data_x=$this->input->post();
	 		$data_x['store_id']=$store_id;
			$data_x['journaltype_id']=2;//jurnal pengeluaran kas
	 			 		
	 		
		  	if($this->journal->insert($data_x)){
		  		$data = array('status'=>true,'message'=>'Sukses add data.','notif_code'=>'edit');
		  		$this->session->set_userdata($data);
				redirect(base_url().'user/common_user/akuntansi/jurnal_pengeluaran_kas/'.$store_id.'/2');

			  }else{
			  	$data = array('status'=>false,'message'=>'Gagal edit data.','notif_code'=>'edit');
		  		$this->session->set_userdata($data);
		  		header('Location: ' . $_SERVER['HTTP_REFERER']);
				  		exit();
			  }
		  
		}else{
			$error= $this->form_validation->error_array();
			$error= json_decode(json_encode($error), True);	
			$errors='<br>';
			foreach ($error as $key => $value) {
				if($key=='description'){
					$key = 'Deskripsi';
					$errors.=$key.' '.$value.'<br>';
				}

				if($key=='transactioncategory_id'){
					$key = 'Tipe Transaksi';
					$errors.=$key.' '.$value.'<br>';
				}


				if($key=='transactioncategory_id'){
					$key = 'Tujuan Transaksi';
					$errors.=$key.' '.$value.'<br>';
				}

				if($key=='paymentmethod_id'){
					$key = 'Transaksi Secara';
					$errors.=$key.' '.$value.'<br>';
				}


				if($key=='nominal'){
					$key = 'Nominal';
					$errors.=$key.' '.$value.'<br>';
				}
			}
			
			$data = array('status'=>false,'message'=>$errors,'notif_code'=>'add');
	  		$this->session->set_userdata($data);
	  		header('Location: ' . $_SERVER['HTTP_REFERER']);
				  		exit();
		} 
	}

public function editTransaksijurnalPengeluaranKas($store_id,$journal_id,$journaltype_id)
	{	
		$data['user']= $this->user->getByUsername($this->session->userdata('username'));
		$data['user'] = json_decode(json_encode($data['user']), True);
		$data['store'] = $this->store->get($store_id);
		$data['store'] = json_decode(json_encode($data['store']), True);
		$data['journal'] = $this->journal->get($journal_id);
		$data['journal'] = json_decode(json_encode($data['journal']), True);
		$data['transactioncategory'] = $this->transactioncategory-> getAllJournalTypeId($journaltype_id);
		$data['transactioncategory'] = json_decode(json_encode($data['transactioncategory']), True);
		$data['subtransactioncategory'] = $this->subtransactioncategory->getAllTransactioncategoryId($data['journal']['transactioncategory_id']);
		$data['subtransactioncategory'] = json_decode(json_encode($data['subtransactioncategory']), True);
		$paymentmethod = $this->subtransactioncategory->getPaymentmethodsById($data['journal']['subtransactioncategory_id']);
		$paymentmethod = json_decode(json_encode($paymentmethod), True);
		$paymentmethod = json_decode($paymentmethod['paymentmethods']);
		$paymentmethods =array();
		$data_y = array();

		foreach ($paymentmethod as $list) {	
			$tmp = $this->paymentmethod->get($list);
  			$tmp = json_decode(json_encode($tmp), True);
  			$data_y['paymentmethod_id'] = $tmp['paymentmethod_id'];
  			$data_y['name']=$tmp['name'];
  			$paymentmethods[] = $data_y;
  		}	

		$data['paymentmethods'] = $paymentmethods;	
		$data['title']= ' Edit Jurnal Pengeluaran Kas Untuk : '.$data['store']['name'].' | '. $data['journal']['description'] ; 

		$this->load->view('user/common_user/head',$data);
		$this->load->view('user/common_user/header',$data);
		$this->load->view('user/common_user/accounting/cashpaymentjournal/editCashpaymentjournalTransaction_content',$data);
	}

public function editTransaksijurnalPengeluaranKas_proses($journal_id)
	{	
		$this->form_validation->set_message('required', 'harus diisi');
	   	$this->form_validation->set_rules('description', 'Deskripsi Transaksi', 'required');
	   	$this->form_validation->set_rules('transactioncategory_id', 'Tipe Pembelian', 'required');
	   	$this->form_validation->set_rules('subtransactioncategory_id', 'Tujuan Pembelian', 'required');
	   	$this->form_validation->set_rules('paymentmethod_id', 'Transaksi Secara', 'required');
	   	$this->form_validation->set_rules('nominal', 'Nominal', 'required');
        $this->form_validation->set_rules('journal_date', 'Tanggal Pencatatan', 'required');       

	 	if($this->form_validation->run() == TRUE){
	 		$data_x=$this->input->post();
	 
	 		
		  	if($this->journal->update($journal_id,$data_x)){
		  		$data = array('status'=>true,'message'=>'Sukses edit data.','notif_code'=>'edit');
		  		$this->session->set_userdata($data);
				header('Location: ' . $_SERVER['HTTP_REFERER']);
				  		exit();
			  }else{
			  	$data = array('status'=>false,'message'=>'Gagal edit data.','notif_code'=>'edit');
		  		$this->session->set_userdata($data);
		  		header('Location: ' . $_SERVER['HTTP_REFERER']);
				  		exit();
			  }
		  
		}else{
			$error= $this->form_validation->error_array();
			$error= json_decode(json_encode($error), True);	
			$errors='<br>';
			foreach ($error as $key => $value) {
				if($key=='description'){
					$key = 'Deskripsi';
					$errors.=$key.' '.$value.'<br>';
				}

				if($key=='transactioncategory_id'){
					$key = 'Tipe Transaksi';
					$errors.=$key.' '.$value.'<br>';
				}


				if($key=='transactioncategory_id'){
					$key = 'Tujuan Transaksi';
					$errors.=$key.' '.$value.'<br>';
				}

				if($key=='paymentmethod_id'){
					$key = 'Transaksi Secara';
					$errors.=$key.' '.$value.'<br>';
				}


				if($key=='nominal'){
					$key = 'Nominal';
					$errors.=$key.' '.$value.'<br>';
				}
			}
			
			$data = array('status'=>false,'message'=>$errors,'notif_code'=>'add');
	  		$this->session->set_userdata($data);
	  		header('Location: ' . $_SERVER['HTTP_REFERER']);
				  		exit();
		} 
	}

	public function deleteJurnalPengeluaranKas($journal_id){

	

	 	if($journal_id != ''){
		  	if($this->journal->delete($journal_id)){
		  	
		  		$data = array('status'=>true,'message'=>'Sukses hapus data.','notif_code'=>'delete');
		  		$this->session->set_userdata($data);
		  		header('Location: ' . $_SERVER['HTTP_REFERER']);
				  		exit();

			  }else{
			  	$data = array('status'=>false,'message'=>'Gagal delete data.','notif_code'=>'delete');
		  		$this->session->set_userdata($data);
		  		header('Location: ' . $_SERVER['HTTP_REFERER']);
				  		exit();
			  }
		  
		}else{
			$data = array('status'=>false,'message'=>'Data yang diminta tidak ada.','notif_code'=>'delete');
	  		$this->session->set_userdata($data);
	  		header('Location: ' . $_SERVER['HTTP_REFERER']);
				  		exit();
		}

	 }

	

}
