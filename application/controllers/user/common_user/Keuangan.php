<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keuangan extends CI_Controller {

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



    public function ratio($store_id)
	{	
		$data['user']= $this->user->getByUsername($this->session->userdata('username')); 
		$data['user'] = json_decode(json_encode($data['user']), True);
		$data['store'] = $this->store->get($store_id);
		$data['store'] = json_decode(json_encode($data['store']), True);
		$data['title']= 'Keuangan Untuk : '.$data['store']['name'] ;

		$this->load->view('user/common_user/head',$data);
		$this->load->view('user/common_user/header',$data);
		$this->load->view('user/common_user/keuangan/keuangan_content',$data);
	}

	public function ratio_kalkulasi($store_id,$type_ratio)
	{	
		$data['user']= $this->user->getByUsername($this->session->userdata('username')); 
		$data['user'] = json_decode(json_encode($data['user']), True);
		$data['store'] = $this->store->get($store_id);
		$data['store'] = json_decode(json_encode($data['store']), True);

		if($type_ratio == 'likuiditas'){
			$data['subtypes'] =array(
				'A1'=>'Ratio Lancar',
				'A2'=>'Ratio Cair'

				);
			$ratio ='Likuiditas';
		}else if($type_ratio == 'solvensi'){
			$data['subtypes'] =array(
				'B1'=>'Leverage ratio',
				'B2'=>'Debt to assets'

				);
			$ratio ='Solvensi';
		}else if($type_ratio == 'aktivitas'){
			$data['subtypes'] =array(
				'D1'=>'Perputaran barang',
				'D2'=>'Perputaran piutang',
				'D3'=>'Perputaran utang'
				);

			$ratio ='Aktivitas';
		}else if($type_ratio == 'profitabilitas'){
			$data['subtypes'] =array(
				'C1'=>'Rasio laba kotor',
				'C2'=>'Rasio laba bersih'
				);

			$ratio ='Profitabilitas';
		}else{
			$data = array('status'=>false,'message'=>'Tipe Ratio Tidak Ada','notif_code'=>'calculate');
	  		$this->session->set_userdata($data);
	  		header('Location: ' . $_SERVER['HTTP_REFERER']);
				  		exit();
		}
		
		
		$data['ratio']=$type_ratio;
		$data['title']= 'Analisa Keuangan '.$ratio.'  Untuk : '.$data['store']['name'] ;

		$this->load->view('user/common_user/head',$data);
		$this->load->view('user/common_user/header',$data);
		$this->load->view('user/common_user/keuangan/ratio_kalkulasi_content',$data);
	}


	public function ratio_kalkulasi_proses($store_id,$ratio_type)
	{	
		$this->form_validation->set_message('required', 'harus diisi');
	   $this->form_validation->set_rules('bulan-tahun', 'BUlan Tahun', 'required');
	 	
	 	$this->form_validation->set_rules('subratio_type', 'Sub Tipe', 'required');
	        
	 
       

	 	if($this->form_validation->run() == TRUE){
	 			$data_x=$this->input->post();
	 		$bukubesaraset = $this->subsidiaryledge->aset_proses($store_id,$data_x['bulan-tahun']);
		  	$bukubesarkewajiban = $this->subsidiaryledge->kewajiban_proses($store_id,$data_x['bulan-tahun']);
		  	$bukubesarekuitas = $this->subsidiaryledge->ekuitas_proses($store_id,$data_x['bulan-tahun']);

		  	$bukubesarpend_hpp = $this->subsidiaryledge->pend_hpp_proses($store_id,$data_x['bulan-tahun']);
			$bukubesarbeban = $this->subsidiaryledge->beban_proses($store_id,$data_x['bulan-tahun']);
		  	$bukubesarlainlain = $this->subsidiaryledge->lainlain_proses($store_id,$data_x['bulan-tahun']);

	 		$asetlancar= $bukubesaraset['kas_total'] + $bukubesaraset['bank_total'] +$bukubesaraset['persediaan_barang_dagang_total'] + $bukubesaraset['perlengkapan_total'];
	 		$kewajibanlancar=(-1*$bukubesarkewajiban['utang_bank_total']) + (-1*$bukubesarkewajiban['utang_usaha_total']);
	 		$persediaanbarangdagang = $bukubesaraset['persediaan_barang_dagang_total'];
	
	 		$totalaset = $bukubesaraset['tanah_total'] + $bukubesaraset['peralatan_toko_total'] +$bukubesaraset['kendaraan_total']+$bukubesaraset['kas_total'] + $bukubesaraset['bank_total'] +$bukubesaraset['persediaan_barang_dagang_total'] + $bukubesaraset['perlengkapan_total'];

	 		$totalkewajiban =(-1*$bukubesarkewajiban['utang_bank_total']) + (-1*$bukubesarkewajiban['utang_usaha_total'])+(-1*$bukubesarkewajiban['utang_bank_jangkapanjang_total']);
	 		$totalekuitas=(-1*$bukubesarekuitas['modal_pemilik_total']) + (-1*$bukubesarekuitas['penarikan_modal_total']);
	 		$labakotor=$bukubesarpend_hpp['pendapatan_penjualan_total']+$bukubesarpend_hpp['beban_pokokpenjualan_total'];
	 		$pendapatan=$bukubesarpend_hpp['pendapatan_penjualan_total'];
	 		$lababersih=$bukubesarbeban['beban_bungabank_total']+$bukubesarlainlain['pendapatan_bungabank_total']+$bukubesarlainlain['beban_administrasibank_total']+$bukubesarbeban['beban_sewa_tempatusaha_total']+$bukubesarbeban['beban_gajikaryawan_total']+$bukubesarbeban['beban_listrik_total']+$bukubesarbeban['beban_telepon_total']+$bukubesarbeban['beban_air_total']+$bukubesarbeban['beban_pengiriman_total']+$bukubesarpend_hpp['pendapatan_penjualan_total']+$bukubesarpend_hpp['beban_pokokpenjualan_total']+$bukubesarbeban['beban_pajak_total'];
	 		$hargapokokpenjualan = $bukubesarpend_hpp['beban_pokokpenjualan_total'];
	 		$piutangusaha =$bukubesaraset['piutang_usaha_total'] ;
	 		$hutangusaha = -1*$bukubesarkewajiban['utang_usaha_total'];


	 		if($ratio_type == 'likuiditas'){
	 			if($data_x['subratio_type'] == 'A1'){
	 				
	 				$result = (float) ($asetlancar/$kewajibanlancar);
	 				$data['ratio_result'] = number_format( $result,2);
	 				$data['subratio_type'] = 'Ratio Lancar';
	 				
	 			}else if($data_x['subratio_type'] == 'A2'){
	 					
	 				$result = (float) ($asetlancar - $persediaanbarangdagang)/$kewajibanlancar;
	 				$data['ratio_result'] = number_format($result ,2);
	 					$data['subratio_type'] = 'Ratio Cair';
	 			}else{
	 				$data = array('status'=>false,'message'=>'Tipe Sub Ratio Tidak Ada','notif_code'=>'calculate');
			  		$this->session->set_userdata($data);
			  		header('Location: ' . $_SERVER['HTTP_REFERER']);
						  		exit();
	 			}
	 		}else if($ratio_type == 'solvensi'){
	 			if($data_x['subratio_type'] == 'B1'){
	 				
	 				$result = (float) ($totalkewajiban/$totalekuitas);
	 				$data['ratio_result'] = number_format( $result,2);
	 				$data['subratio_type'] = 'Leverage ratio';
	 				
	 			}else if($data_x['subratio_type'] == 'B2'){

	 				$result = (float) ($totalkewajiban/$totalaset);
	 				$data['ratio_result'] = number_format($result ,2);
	 					$data['subratio_type'] = 'Debt to assets';
	 			}else{
	 				$data = array('status'=>false,'message'=>'Tipe Sub Ratio Tidak Ada','notif_code'=>'calculate');
			  		$this->session->set_userdata($data);
			  		header('Location: ' . $_SERVER['HTTP_REFERER']);
						  		exit();
	 			}
	 		}else if($ratio_type =='profitabilitas'){
	 			if($data_x['subratio_type'] == 'C1'){
	 				
	 				$result = (float) ($labakotor/$pendapatan);
	 				$data['ratio_result'] = number_format( $result,2);
	 				$data['subratio_type'] = 'Rasio laba kotor';
	 				
	 			}else if($data_x['subratio_type'] == 'C2'){

	 				$result = (float) ($lababersih/$pendapatan);
	 				$data['ratio_result'] = number_format($result ,2);
	 					$data['subratio_type'] = 'Rasio laba bersih';
	 			}else{
	 				$data = array('status'=>false,'message'=>'Tipe Sub Ratio Tidak Ada','notif_code'=>'calculate');
			  		$this->session->set_userdata($data);
			  		header('Location: ' . $_SERVER['HTTP_REFERER']);
						  		exit();
	 			}
	 		}else if($ratio_type =='aktivitas'){
	 			if($data_x['subratio_type'] == 'D1'){
	 				
	 				$result = (float) ($persediaanbarangdagang/$hargapokokpenjualan);
	 				$data['ratio_result'] = number_format( $result,2);
	 				$data['subratio_type'] = 'Perputaran Barang';
	 				
	 			}else if($data_x['subratio_type'] == 'D2'){
	 				
	 				$result = (float) ($piutangusaha/$pendapatan);
	 				$data['ratio_result'] = number_format($result ,2);
	 				$data['subratio_type'] = 'Perputaran Piutang';
	 			}else if($data_x['subratio_type'] == 'D3'){
	 				
	 				$result = (float) ($hutangusaha/$hargapokokpenjualan);
	 				$data['ratio_result'] = number_format($result ,2);
	 					$data['subratio_type'] = 'Perputaran Utang';
	 			}else{
	 				$data = array('status'=>false,'message'=>'Tipe Sub Ratio Tidak Ada','notif_code'=>'calculate');
			  		$this->session->set_userdata($data);
			  		header('Location: ' . $_SERVER['HTTP_REFERER']);
						  		exit();
	 			}
	 		}

	 		
		  		
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

}
