<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pajak extends CI_Controller {

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



    public function pajak_konten($store_id)
	{	
		$data['user']= $this->user->getByUsername($this->session->userdata('username')); 
		$data['user'] = json_decode(json_encode($data['user']), True);
		$data['store'] = $this->store->get($store_id);
		$data['store'] = json_decode(json_encode($data['store']), True);
		$data['title']= 'Pajak Untuk : '.$data['store']['name'] ;

		$this->load->view('user/common_user/head',$data);
		$this->load->view('user/common_user/header',$data);
		$this->load->view('user/common_user/pajak/pajak_content',$data);
	}

	 public function pajak_kalkulasi_manual($store_id)
	{	
		$data['user']= $this->user->getByUsername($this->session->userdata('username')); 
		$data['user'] = json_decode(json_encode($data['user']), True);
		$data['store'] = $this->store->get($store_id);
		$data['store'] = json_decode(json_encode($data['store']), True);
		$data['title']= 'Pajak Untuk : '.$data['store']['name'] ;

		$this->load->view('user/common_user/head',$data);
		$this->load->view('user/common_user/header',$data);
		$this->load->view('user/common_user/pajak/pajak_manual_content',$data);
	}

	public function pajak_kalkulasi($store_id,$type_pajak)
	{	
		$data['user']= $this->user->getByUsername($this->session->userdata('username')); 
		$data['user'] = json_decode(json_encode($data['user']), True);
		$data['store'] = $this->store->get($store_id);
		$data['store'] = json_decode(json_encode($data['store']), True);

		if($type_pajak != 'kawin' && $type_pajak != 'tidak-kawin'){
			$data = array('status'=>false,'message'=>'Tipe Pajak Tidak Ada','notif_code'=>'calculate');
	  		$this->session->set_userdata($data);
	  		header('Location: ' . $_SERVER['HTTP_REFERER']);
			exit();
		}

		$data['pajak']=$type_pajak;
		$data['title']= 'Analisa Pajak '.$type_pajak.'  Untuk : '.$data['store']['name'] ;
		$this->load->view('user/common_user/head',$data);
		$this->load->view('user/common_user/header',$data);
		$this->load->view('user/common_user/pajak/pajak_kalkulasi_content',$data);
	}

	



	public function pajak_kalkulasi_proses($store_id,$pajak_type,$type_input=null)
	{	
		$this->form_validation->set_message('required', 'harus diisi');
	   	$this->form_validation->set_rules('bulan-tahun', 'Bulan Tahun', 'required');
	 	$this->form_validation->set_rules('jumlah-tanggungan', 'Tanggungan', 'required');
	 	if($this->form_validation->run() == TRUE){
	 		$data_x=$this->input->post();
	 		
	 		

	 		$bukubesaraset = $this->subsidiaryledge->aset_proses($store_id,$data_x['bulan-tahun']);
		  	$bukubesarkewajiban = $this->subsidiaryledge->kewajiban_proses($store_id,$data_x['bulan-tahun']);
		  	$bukubesarekuitas = $this->subsidiaryledge->ekuitas_proses($store_id,$data_x['bulan-tahun']);

		  	$bukubesarpend_hpp = $this->subsidiaryledge->pend_hpp_proses($store_id,$data_x['bulan-tahun']);
			$bukubesarbeban = $this->subsidiaryledge->beban_proses($store_id,$data_x['bulan-tahun']);
		  	$bukubesarlainlain = $this->subsidiaryledge->lainlain_proses($store_id,$data_x['bulan-tahun']);

	 		$lababersih=$bukubesarbeban['beban_bungabank_total']+$bukubesarlainlain['pendapatan_bungabank_total']+$bukubesarlainlain['beban_administrasibank_total']+$bukubesarbeban['beban_sewa_tempatusaha_total']+$bukubesarbeban['beban_gajikaryawan_total']+$bukubesarbeban['beban_listrik_total']+$bukubesarbeban['beban_telepon_total']+$bukubesarbeban['beban_air_total']+$bukubesarbeban['beban_pengiriman_total']+$bukubesarpend_hpp['pendapatan_penjualan_total']+$bukubesarpend_hpp['beban_pokokpenjualan_total']+$bukubesarbeban['beban_pajak_total'];
	 		$lababersihyear = 12 * abs($lababersih);

	 		if($type_input == 'manual'){
	 			$lababersihyear= $this->input->post('inputlabarugi') *12;


	 			$pajak_type = $this->input->post('status_kawin');	
	 		}

	 		$totalptkp =  54000000 ;
	 	
	 		$tanggungan = $data_x['jumlah-tanggungan'];
	 		if($pajak_type =='kawin' ){
	 			
	 			$totalptkp += 4500000;
	 		}

	 		//menghitung sesuai jumlah tanggunngan
	 		for ($i=1; $i <=$tanggungan ; $i++) { 
	 			
	 			$totalptkp += 4500000;
	 		}

	 		$phkpyear = $lababersihyear - $totalptkp ;
	 
	 		//pembulatan
	 		if(1000 < $phkpyear){
	 			$pengurang = $phkpyear % 1000;
	 			$phkpyear = $phkpyear-$pengurang;
	 		}

		  	$data['pajak_result']= floor($this->kriteriaChecker($phkpyear)/12);
		  	 
 			$data['pajak_result']="Rp " . number_format($data['pajak_result'],2,',','.');
		  	
 			$data['date']=$data_x['bulan-tahun'];
	  		$this->session->set_userdata($data);
	  		header('Location: ' . $_SERVER['HTTP_REFERER']);
			exit();

			 
		  
		}else{
			$error= $this->form_validation->error_array();
			$error= json_decode(json_encode($error), True);	
			$errors='<br>';
			foreach ($error as $key => $value) {
				if($key=='bulan-tahun'){
					$key = 'Bulan Tahun';
					$errors.=$key.' '.$value.'<br>';
				}
			
				if($key=='suybratio_type'){
					$key = 'Sub Tipe';
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



	function kriteriaChecker($data){

			$batasatas1 = 50000000;
			$batasatas2 = 250000000;
			$batasatas3 = 500000000;
			$kriteria1 = (float) 50000000 * 0.05 ;
			$kriteria2 = (float) (($data-$batasatas1) * 0.15) ;
			$kriteria3 = (float) (($data-$batasatas1-$batasatas2) * 0.25) ;
			$kriteria4 = (float) (($data-$batasatas1-$batasatas2-$batasatas3) * 0.3);	
			if($data > 500000000){
			
				return $kriteria1+$kriteria2+$kriteria3+$kriteria4;
			}
			if(($data > 250000000) && $data <=500000000){
				return $kriteria1+$kriteria2 +$kriteria3;
					
			}
			if(($data>50000000) && $data <=250000000){
						
				return $kriteria1+$kriteria2 ;
				
			}
			if(($data > 0) &&  $data<=50000000){
				// $kriteria1 = 50000000 * 5%;
				return $kriteria1;
				
			}	
	}

}
