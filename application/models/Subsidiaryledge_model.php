<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Subsidiaryledge_model extends CI_Model {

        var $table = 'mst_journal';

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }


        public function aset_proses($store_id,$bulantahun){

        	$data['kas'] = array();
        	$data['kas'] = $this->kasPembelian($store_id,$bulantahun,$data['kas']);
        	$data['kas'] = $this->kasPenjualan($store_id,$bulantahun,$data['kas']);
        	$data['kas'] = $this->kasPengeluarankas($store_id,$bulantahun,$data['kas']);
			$data['kas'] = $this->kasPenerimaankas($store_id,$bulantahun,$data['kas']);
			$data['kas'] = $this->kasModal($store_id,$bulantahun,$data['kas']);
			$data['kas'] = json_decode(json_encode($data['kas']), True);
			$sumnominal =0;
			foreach ($data['kas'] as $list) {
				$sumnominal +=$list['nominal'];
			}
			$data['kas_total'] = $sumnominal;

       		$data['bank'] =array();
        	$data['bank'] = $this->bankPembelian($store_id,$bulantahun,$data['bank']);
        	$data['bank'] = $this->bankPenjualan($store_id,$bulantahun,$data['bank']);
        	$data['bank'] = $this->bankPengeluarankas($store_id,$bulantahun,$data['bank']);
        	$data['bank'] = $this->bankPenerimaankas($store_id,$bulantahun,$data['bank']);
        	$data['bank'] = $this->bankModal($store_id,$bulantahun,$data['bank']);
        	$sumnominal =0;
			foreach ($data['bank'] as $list) {
				$sumnominal +=$list['nominal'];
			}
			$data['bank_total'] = $sumnominal;


        	$data['piutang_usaha'] =array();
        	$data['piutang_usaha'] = $this->piusPenjualan($store_id,$bulantahun,$data['piutang_usaha']);
        	$data['piutang_usaha'] = $this->piusPenerimaankas($store_id,$bulantahun,$data['piutang_usaha']);
        	$sumnominal =0;
			foreach ($data['piutang_usaha'] as $list) {
				$sumnominal +=$list['nominal'];
			}
			$data['piutang_usaha_total'] = $sumnominal;

        	$data['persediaan_barang_dagang'] =array();
        	$data['persediaan_barang_dagang'] = $this->pedabaPenjualan($store_id,$bulantahun,$data['persediaan_barang_dagang']);
        	$data['persediaan_barang_dagang'] = $this->pedabaPembelian($store_id,$bulantahun,$data['persediaan_barang_dagang']);
        	$sumnominal =0;
			foreach ($data['persediaan_barang_dagang'] as $list) {
				$sumnominal +=$list['nominal'];
			}
			$data['persediaan_barang_dagang_total'] = $sumnominal;

        	$data['perlengkapan'] =array();
        	$data['perlengkapan'] = $this->perlengkapanPembelian($store_id,$bulantahun,$data['perlengkapan']);
        	$sumnominal =0;
			foreach ($data['perlengkapan'] as $list) {
				$sumnominal +=$list['nominal'];
			}
			$data['perlengkapan_total'] = $sumnominal;

        	$data['tanah'] =array();
        	$data['tanah'] = $this->tanahModal($store_id,$bulantahun,$data['tanah']);
        	$sumnominal =0;
			foreach ($data['tanah'] as $list) {
				$sumnominal +=$list['nominal'];
			}
			$data['tanah_total'] = $sumnominal;
			
			$data['bangunan_toko'] =array();
        	$data['bangunan_toko'] = $this->bakoModal($store_id,$bulantahun,$data['bangunan_toko']);
        	$sumnominal =0;
			foreach ($data['bangunan_toko'] as $list) {
				$sumnominal +=$list['nominal'];
			}
			$data['bangunan_toko_total'] = $sumnominal;


        	$data['peralatan_toko'] =array();
        	$data['peralatan_toko'] = $this->pekoPembelian($store_id,$bulantahun,$data['peralatan_toko']);
        	$sumnominal =0;
			foreach ($data['peralatan_toko'] as $list) {
				$sumnominal +=$list['nominal'];
			}
			$data['peralatan_toko_total'] = $sumnominal;

        	$data['kendaraan'] =array();
        	$data['kendaraan'] = $this->kendaraanModal($store_id,$bulantahun,$data['kendaraan']);

        	$sumnominal =0;
			foreach ($data['kendaraan'] as $list) {
				$sumnominal +=$list['nominal'];
			}
			$data['kendaraan_total'] = $sumnominal;

			return json_decode(json_encode($data), True);

        }


        function kasPembelian($store_id,$bulantahun,$data){
        	$this->db->where('store_id', $store_id);
        	$this->db->where("(transactioncategory_id=1 OR transactioncategory_id=2 OR transactioncategory_id=3)", NULL, FALSE); 
        	$this->db->where('paymentmethod_id', 1);
        	$this->db->where('journaltype_id', 1);
        	$this->db->like('journal_date', $bulantahun);
        	$data_jurnal = $this->db->get($this->table)->result();
        	$data_jurnal = json_decode(json_encode($data_jurnal), True);
        	foreach ($data_jurnal as $list) {
        			$data[] = array(
        				'journaltype_id'=>$list['journaltype_id'],
        				'transactioncategory_id'=>$list['transactioncategory_id'],
        				'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
        				'paymentmethod_id'=>$list['paymentmethod_id'],
        				'description'=>$list['description'],
        				'journal_date'=>$list['journal_date'],
        				'nominal'=>-$list['nominal'],
        				'type'=>'Kredit'
        				);
        		}
        		
        	return $data;	
        }

        function kasPenjualan($store_id,$bulantahun,$data){
        	$this->db->where('store_id', $store_id);
        	$this->db->where("(transactioncategory_id=6)", NULL, FALSE); 
        	$this->db->where('paymentmethod_id', 1);
        	$this->db->where('journaltype_id', 3);
        	$this->db->like('journal_date', $bulantahun);
        	$data_jurnal = $this->db->get($this->table)->result();
        	$data_jurnal = json_decode(json_encode($data_jurnal), True);
        	foreach ($data_jurnal as $list) {
        			$data[] = array(
        				'journaltype_id'=>$list['journaltype_id'],
        				'transactioncategory_id'=>$list['transactioncategory_id'],
        				'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
        				'paymentmethod_id'=>$list['paymentmethod_id'],
        				'description'=>$list['description'],
        				'journal_date'=>$list['journal_date'],
        				'nominal'=>$list['nominal'],
        				'type'=>'Debit'
        				);
        		}
        	
        	return $data;	
        }

        function kasPengeluarankas($store_id,$bulantahun,$data){
        	$this->db->where('store_id', $store_id);
        	$this->db->where("(transactioncategory_id=4 OR transactioncategory_id=5)", NULL, FALSE); 
        	$this->db->where("(subtransactioncategory_id=1 OR subtransactioncategory_id=2 OR subtransactioncategory_id=12 OR subtransactioncategory_id=13 OR subtransactioncategory_id=14 OR subtransactioncategory_id=15 OR subtransactioncategory_id=16 OR subtransactioncategory_id=17 OR subtransactioncategory_id=19 OR subtransactioncategory_id=20)", NULL, FALSE); 
        	$this->db->where('paymentmethod_id', 1);
        	$this->db->where('journaltype_id', 2);
        	$this->db->like('journal_date', $bulantahun);
        	$data_jurnal = $this->db->get($this->table)->result();
        	$data_jurnal = json_decode(json_encode($data_jurnal), True);
        	foreach ($data_jurnal as $list) {
        			$data[] = array(
        				'journaltype_id'=>$list['journaltype_id'],
        				'transactioncategory_id'=>$list['transactioncategory_id'],
        				'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
        				'paymentmethod_id'=>$list['paymentmethod_id'],
        				'description'=>$list['description'],
        				'journal_date'=>$list['journal_date'],
        				'nominal'=>-$list['nominal'],
        				'type'=>'Kredit'
        				);
        		}
        		
        	return $data;	
        }

        function kasPenerimaankas($store_id,$bulantahun,$data){
        	$this->db->where('store_id', $store_id);
        	$this->db->where("(transactioncategory_id=7 OR transactioncategory_id=8)", NULL, FALSE); 
        	$this->db->where("(subtransactioncategory_id=21 OR subtransactioncategory_id=22)", NULL, FALSE); 
        	$this->db->where('paymentmethod_id', 1);
        	$this->db->where('journaltype_id', 4);
        	$this->db->like('journal_date', $bulantahun);
        	$data_jurnal = $this->db->get($this->table)->result();
        	$data_jurnal = json_decode(json_encode($data_jurnal), True);
        	foreach ($data_jurnal as $list) {
        			$data[] = array(
        				'journaltype_id'=>$list['journaltype_id'],
        				'transactioncategory_id'=>$list['transactioncategory_id'],
        				'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
        				'paymentmethod_id'=>$list['paymentmethod_id'],
        				'description'=>$list['description'],
        				'journal_date'=>$list['journal_date'],
        				'nominal'=>$list['nominal'],
        				'type'=>'Debit'
        				);
        		}
        		
        	return $data;	
        }

        function kasModal($store_id,$bulantahun,$data){
        	$this->db->where('store_id', $store_id);
        	$this->db->where("(transactioncategory_id=10 OR transactioncategory_id=11)", NULL, FALSE); 
        	$this->db->where("(subtransactioncategory_id=24 OR subtransactioncategory_id=25)", NULL, FALSE); 
        	$this->db->where('paymentmethod_id', 1);
        	$this->db->where('journaltype_id', 5);
        	$this->db->like('journal_date', $bulantahun);
        	$data_jurnal = $this->db->get($this->table)->result();
        	$data_jurnal = json_decode(json_encode($data_jurnal), True);
        	foreach ($data_jurnal as $list) {
        			if($list['transactioncategory_id'] == 10){
        				$data[] = array(
        				'journaltype_id'=>$list['journaltype_id'],
        				'transactioncategory_id'=>$list['transactioncategory_id'],
        				'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
        				'paymentmethod_id'=>$list['paymentmethod_id'],
        				'description'=>$list['description'],
        				'journal_date'=>$list['journal_date'],
        				'nominal'=>-$list['nominal'],
        				'type'=>'Kredit'
        				);
        			}else{
        			$data[] = array(
        				'journaltype_id'=>$list['journaltype_id'],
        				'transactioncategory_id'=>$list['transactioncategory_id'],
        				'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
        				'paymentmethod_id'=>$list['paymentmethod_id'],
        				'description'=>$list['description'],
        				'journal_date'=>$list['journal_date'],
        				'nominal'=>$list['nominal'],
        				'type'=>'Debit'
        				);
        			}
        		}
        		
        	return $data;	
        }


        function bankPembelian($store_id,$bulantahun,$data){
        	$this->db->where('store_id', $store_id);
        	$this->db->where("(transactioncategory_id=1 OR transactioncategory_id=2 OR transactioncategory_id=3)", NULL, FALSE); 
        	$this->db->where('paymentmethod_id', 2);
        	$this->db->where('journaltype_id', 1);
        	$this->db->like('journal_date', $bulantahun);
        	$data_jurnal = $this->db->get($this->table)->result();
        	$data_jurnal = json_decode(json_encode($data_jurnal), True);
        	foreach ($data_jurnal as $list) {
        			
        				$data[] = array(
        				'journaltype_id'=>$list['journaltype_id'],
        				'transactioncategory_id'=>$list['transactioncategory_id'],
        				'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
        				'paymentmethod_id'=>$list['paymentmethod_id'],
        				'description'=>$list['description'],
        				'journal_date'=>$list['journal_date'],
        				'nominal'=>-$list['nominal'],
        				'type'=>'Kredit'
        				);
        			
        		}
        	
        	return $data;	
        }

        function bankPenjualan($store_id,$bulantahun,$data){
        	$this->db->where('store_id', $store_id);
        	$this->db->where("(transactioncategory_id=6)", NULL, FALSE); 
        	$this->db->where('paymentmethod_id', 2);
        	$this->db->where('journaltype_id', 3);
        	$this->db->like('journal_date', $bulantahun);
        	$data_jurnal = $this->db->get($this->table)->result();
        	$data_jurnal = json_decode(json_encode($data_jurnal), True);
        	foreach ($data_jurnal as $list) {
        			$data[] = array(
        				'journaltype_id'=>$list['journaltype_id'],
        				'transactioncategory_id'=>$list['transactioncategory_id'],
        				'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
        				'paymentmethod_id'=>$list['paymentmethod_id'],
        				'description'=>$list['description'],
        				'journal_date'=>$list['journal_date'],
        				'nominal'=>$list['nominal'],
        				'type'=>'Debit'
        				);
        		}
        	
        	return $data;	
        }


        function bankPengeluarankas($store_id,$bulantahun,$data){
        	$this->db->where('store_id', $store_id);
        	$this->db->where("(transactioncategory_id=4 OR transactioncategory_id=5)", NULL, FALSE); 
        	$this->db->where("(subtransactioncategory_id=1 OR subtransactioncategory_id=2 OR subtransactioncategory_id=12 OR subtransactioncategory_id=18 )", NULL, FALSE); 
        	$this->db->where('paymentmethod_id', 2);
        	$this->db->where('journaltype_id', 2);
        	$this->db->like('journal_date', $bulantahun);
        	$data_jurnal = $this->db->get($this->table)->result();
        	$data_jurnal = json_decode(json_encode($data_jurnal), True);
        	foreach ($data_jurnal as $list) {
        			$data[] = array(
        				'journaltype_id'=>$list['journaltype_id'],
        				'transactioncategory_id'=>$list['transactioncategory_id'],
        				'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
        				'paymentmethod_id'=>$list['paymentmethod_id'],
        				'description'=>$list['description'],
        				'journal_date'=>$list['journal_date'],
        				'nominal'=>-$list['nominal'],
        				'type'=>'Kredit'
        				);
        		}
        		
        	return $data;	
        }

         function bankPenerimaankas($store_id,$bulantahun,$data){
        	$this->db->where('store_id', $store_id);
        	$this->db->where("(transactioncategory_id=7 OR transactioncategory_id=8 OR transactioncategory_id=9)", NULL, FALSE); 
        	$this->db->where("(subtransactioncategory_id=21 OR subtransactioncategory_id=22 OR subtransactioncategory_id=23)", NULL, FALSE); 
        	$this->db->where("(paymentmethod_id=2 OR paymentmethod_id=4)", NULL, FALSE);
        	$this->db->where('journaltype_id', 4);
        	$this->db->like('journal_date', $bulantahun);
        	$data_jurnal = $this->db->get($this->table)->result();
        	$data_jurnal = json_decode(json_encode($data_jurnal), True);
        	foreach ($data_jurnal as $list) {
        			$data[] = array(
        				'journaltype_id'=>$list['journaltype_id'],
        				'transactioncategory_id'=>$list['transactioncategory_id'],
        				'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
        				'paymentmethod_id'=>$list['paymentmethod_id'],
        				'description'=>$list['description'],
        				'journal_date'=>$list['journal_date'],
        				'nominal'=>$list['nominal'],
        				'type'=>'Debit'
        				);
        		}
        
        	return $data;	
        }

         function bankModal($store_id,$bulantahun,$data){
        	$this->db->where('store_id', $store_id);
        	$this->db->where("(transactioncategory_id=10 OR transactioncategory_id=11)", NULL, FALSE); 
        	$this->db->where("(subtransactioncategory_id=24 OR subtransactioncategory_id=25)", NULL, FALSE); 
        	$this->db->where('paymentmethod_id', 2);
        	$this->db->where('journaltype_id', 5);
        	$this->db->like('journal_date', $bulantahun);
        	$data_jurnal = $this->db->get($this->table)->result();
        	$data_jurnal = json_decode(json_encode($data_jurnal), True);
        	foreach ($data_jurnal as $list) {
        			if($list['transactioncategory_id'] == 10){
        				$data[] = array(
        				'journaltype_id'=>$list['journaltype_id'],
        				'transactioncategory_id'=>$list['transactioncategory_id'],
        				'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
        				'paymentmethod_id'=>$list['paymentmethod_id'],
        				'description'=>$list['description'],
        				'journal_date'=>$list['journal_date'],
        				'nominal'=>-$list['nominal'],
        				'type'=>'Kredit'
        				);
        			}else{
        			$data[] = array(
        				'journaltype_id'=>$list['journaltype_id'],
        				'transactioncategory_id'=>$list['transactioncategory_id'],
        				'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
        				'paymentmethod_id'=>$list['paymentmethod_id'],
        				'description'=>$list['description'],
        				'journal_date'=>$list['journal_date'],
        				'nominal'=>$list['nominal'],
        				'type'=>'Debit'
        				);
        			}
        		}
        		
        	return $data;	
        }

        function piusPenerimaankas($store_id,$bulantahun,$data){
        	$this->db->where('store_id', $store_id);
        	$this->db->where("(transactioncategory_id=7 OR transactioncategory_id=8 OR transactioncategory_id=9)", NULL, FALSE); 
        	$this->db->where("(subtransactioncategory_id=21 )", NULL, FALSE); 
        	$this->db->where("(paymentmethod_id=2 OR paymentmethod_id=1)", NULL, FALSE);
        	$this->db->where('journaltype_id', 4);
        	$this->db->like('journal_date', $bulantahun);
        	$data_jurnal = $this->db->get($this->table)->result();
        	$data_jurnal = json_decode(json_encode($data_jurnal), True);
        	foreach ($data_jurnal as $list) {
        			$data[] = array(
        				'journaltype_id'=>$list['journaltype_id'],
        				'transactioncategory_id'=>$list['transactioncategory_id'],
        				'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
        				'paymentmethod_id'=>$list['paymentmethod_id'],
        				'description'=>$list['description'],
        				'journal_date'=>$list['journal_date'],
        				'nominal'=>-$list['nominal'],
        				'type'=>'Kredit'
        				);
        		}
        
        	return $data;	
        }

        function piusPenjualan($store_id,$bulantahun,$data){
        	$this->db->where('store_id', $store_id);
        	$this->db->where("(transactioncategory_id=6)", NULL, FALSE); 
        	$this->db->where('paymentmethod_id', 3);
        	$this->db->where('journaltype_id', 3);
        	$this->db->like('journal_date', $bulantahun);
        	$data_jurnal = $this->db->get($this->table)->result();
        	$data_jurnal = json_decode(json_encode($data_jurnal), True);
        	foreach ($data_jurnal as $list) {
        			$data[] = array(
        				'journaltype_id'=>$list['journaltype_id'],
        				'transactioncategory_id'=>$list['transactioncategory_id'],
        				'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
        				'paymentmethod_id'=>$list['paymentmethod_id'],
        				'description'=>$list['description'],
        				'journal_date'=>$list['journal_date'],
        				'nominal'=>$list['nominal'],
        				'type'=>'Debit'
        				);
        		}
        	
        	return $data;	
        }


        function pedabaPembelian($store_id,$bulantahun,$data){
        	$this->db->where('store_id', $store_id);
        	$this->db->where('transactioncategory_id',1); 
        	$this->db->where("(paymentmethod_id=1 OR paymentmethod_id=2 OR paymentmethod_id=3)", NULL, FALSE);
        	$this->db->where('journaltype_id', 1);
        	$this->db->like('journal_date', $bulantahun);
        	$data_jurnal = $this->db->get($this->table)->result();
        	$data_jurnal = json_decode(json_encode($data_jurnal), True);
        	foreach ($data_jurnal as $list) {
        			$data[] = array(
        				'journaltype_id'=>$list['journaltype_id'],
        				'transactioncategory_id'=>$list['transactioncategory_id'],
        				'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
        				'paymentmethod_id'=>$list['paymentmethod_id'],
        				'description'=>$list['description'],
        				'journal_date'=>$list['journal_date'],
        				'nominal'=>$list['nominal'],
        				'type'=>'Debit'
        				);
        		}
        		
        	return $data;	
        }

        function pedabaPenjualan($store_id,$bulantahun,$data){
        	$this->db->where('store_id', $store_id);
        	$this->db->where('transactioncategory_id',6); 
        	$this->db->where("(paymentmethod_id=1 OR paymentmethod_id=2 OR paymentmethod_id=3)", NULL, FALSE);
        	$this->db->where('journaltype_id', 3);
        	$this->db->like('journal_date', $bulantahun);
        	$data_jurnal = $this->db->get($this->table)->result();
        	$data_jurnal = json_decode(json_encode($data_jurnal), True);
        	foreach ($data_jurnal as $list) {
        			$data[] = array(
        				'journaltype_id'=>$list['journaltype_id'],
        				'transactioncategory_id'=>$list['transactioncategory_id'],
        				'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
        				'paymentmethod_id'=>$list['paymentmethod_id'],
        				'description'=>$list['description'],
        				'journal_date'=>$list['journal_date'],
        				'nominal'=>-$list['nominal_2nd'],
        				'type'=>'Kredit'
        				);
        		}
        	
        	return $data;	
        }


        function perlengkapanPembelian($store_id,$bulantahun,$data){
        	$this->db->where('store_id', $store_id);
        	$this->db->where('transactioncategory_id',2); 
        	$this->db->where("(paymentmethod_id=1 OR paymentmethod_id=2 OR paymentmethod_id=3)", NULL, FALSE);
        	$this->db->where('journaltype_id', 1);
        	$this->db->like('journal_date', $bulantahun);
        	$data_jurnal = $this->db->get($this->table)->result();
        	$data_jurnal = json_decode(json_encode($data_jurnal), True);
        	foreach ($data_jurnal as $list) {
        			$data[] = array(
        				'journaltype_id'=>$list['journaltype_id'],
        				'transactioncategory_id'=>$list['transactioncategory_id'],
        				'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
        				'paymentmethod_id'=>$list['paymentmethod_id'],
        				'description'=>$list['description'],
        				'journal_date'=>$list['journal_date'],
        				'nominal'=>$list['nominal'],
        				'type'=>'Debit'
        				);
        		}
        		
        	return $data;	
        }


        function tanahModal($store_id,$bulantahun,$data){
        	$this->db->where('store_id', $store_id);
        	$this->db->where("(transactioncategory_id=11)", NULL, FALSE); 
        	$this->db->where("(subtransactioncategory_id=27 )", NULL, FALSE); 
        	$this->db->where('paymentmethod_id', 4);
        	$this->db->where('journaltype_id', 5);
        	$this->db->like('journal_date', $bulantahun);
        	$data_jurnal = $this->db->get($this->table)->result();
        	$data_jurnal = json_decode(json_encode($data_jurnal), True);
        	foreach ($data_jurnal as $list) {
        	
        			$data[] = array(
        				'journaltype_id'=>$list['journaltype_id'],
        				'transactioncategory_id'=>$list['transactioncategory_id'],
        				'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
        				'paymentmethod_id'=>$list['paymentmethod_id'],
        				'description'=>$list['description'],
        				'journal_date'=>$list['journal_date'],
        				'nominal'=>$list['nominal'],
        				'type'=>'Debit'
        				);
        			
        		}
        		
        	return $data;	
        }

         function bakoModal($store_id,$bulantahun,$data){
        	$this->db->where('store_id', $store_id);
        	$this->db->where("(transactioncategory_id=11)", NULL, FALSE); 
        	$this->db->where("(subtransactioncategory_id=28 )", NULL, FALSE); 
        	$this->db->where('paymentmethod_id', 4);
        	$this->db->where('journaltype_id', 5);
        	$this->db->like('journal_date', $bulantahun);
        	$data_jurnal = $this->db->get($this->table)->result();
        	$data_jurnal = json_decode(json_encode($data_jurnal), True);
        	foreach ($data_jurnal as $list) {
        	
        			$data[] = array(
        				'journaltype_id'=>$list['journaltype_id'],
        				'transactioncategory_id'=>$list['transactioncategory_id'],
        				'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
        				'paymentmethod_id'=>$list['paymentmethod_id'],
        				'description'=>$list['description'],
        				'journal_date'=>$list['journal_date'],
        				'nominal'=>$list['nominal'],
        				'type'=>'Debit'
        				);
        			
        		}
        		
        	return $data;	
        }


         function pekoPembelian($store_id,$bulantahun,$data){
        	$this->db->where('store_id', $store_id);
        	$this->db->where('transactioncategory_id',3); 
        	$this->db->where("(paymentmethod_id=1 OR paymentmethod_id=2 OR paymentmethod_id=3)", NULL, FALSE);
        	$this->db->where('journaltype_id', 1);
        	$this->db->like('journal_date', $bulantahun);
        	$data_jurnal = $this->db->get($this->table)->result();
        	$data_jurnal = json_decode(json_encode($data_jurnal), True);
        	foreach ($data_jurnal as $list) {
        			$data[] = array(
        				'journaltype_id'=>$list['journaltype_id'],
        				'transactioncategory_id'=>$list['transactioncategory_id'],
        				'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
        				'paymentmethod_id'=>$list['paymentmethod_id'],
        				'description'=>$list['description'],
        				'journal_date'=>$list['journal_date'],
        				'nominal'=>$list['nominal'],
        				'type'=>'Debit'
        				);
        		}
        		
        	return $data;	
        }


        function kendaraanModal($store_id,$bulantahun,$data){
        	$this->db->where('store_id', $store_id);
        	$this->db->where("(transactioncategory_id=11)", NULL, FALSE); 
        	$this->db->where("(subtransactioncategory_id=26 )", NULL, FALSE); 
        	$this->db->where('paymentmethod_id', 4);
        	$this->db->where('journaltype_id', 5);
        	$this->db->like('journal_date', $bulantahun);
        	$data_jurnal = $this->db->get($this->table)->result();
        	$data_jurnal = json_decode(json_encode($data_jurnal), True);
        	foreach ($data_jurnal as $list) {
        	
        			$data[] = array(
        				'journaltype_id'=>$list['journaltype_id'],
        				'transactioncategory_id'=>$list['transactioncategory_id'],
        				'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
        				'paymentmethod_id'=>$list['paymentmethod_id'],
        				'description'=>$list['description'],
        				'journal_date'=>$list['journal_date'],
        				'nominal'=>$list['nominal'],
        				'type'=>'Debit'
        				);
        			
        		}
        		
        	return $data;	
        }



        public function kewajiban_proses($store_id,$bulantahun){

            $data['utang_bank'] = array();
            $data['utang_bank'] = $this->ubPengeluarankas($store_id,$bulantahun,$data['utang_bank']);
           
            $data['utang_bank'] = json_decode(json_encode($data['utang_bank']), True);
            $sumnominal =0;
            foreach ($data['utang_bank'] as $list) {
                $sumnominal +=$list['nominal'];
            }
            $data['utang_bank_total'] = $sumnominal;


            $data['utang_usaha'] = array();
            $data['utang_usaha'] = $this->usaPengeluarankas($store_id,$bulantahun,$data['utang_usaha']);
             $data['utang_usaha'] = $this->usaPembelian($store_id,$bulantahun,$data['utang_usaha']);
           
            $data['utang_usaha'] = json_decode(json_encode($data['utang_usaha']), True);
            $sumnominal =0;
            foreach ($data['utang_usaha'] as $list) {
                $sumnominal +=$list['nominal'];
            }
            $data['utang_usaha_total'] = $sumnominal;


            $data['utang_bank_jangkapanjang'] = array();
            $data['utang_bank_jangkapanjang'] = $this->ubjpPenerimaankas($store_id,$bulantahun,$data['utang_bank_jangkapanjang']);
           
            $data['utang_bank_jangkapanjang'] = json_decode(json_encode($data['utang_bank_jangkapanjang']), True);
            $sumnominal =0;
            foreach ($data['utang_bank_jangkapanjang'] as $list) {
                $sumnominal +=$list['nominal'];
            }
            $data['utang_bank_jangkapanjang_total'] = $sumnominal;
            




            return json_decode(json_encode($data), True);

        }


        function ubPengeluarankas($store_id,$bulantahun,$data){
            $this->db->where('store_id', $store_id);
            $this->db->where("(transactioncategory_id=4 )", NULL, FALSE); 
            $this->db->where("(subtransactioncategory_id=2 )", NULL, FALSE); 
            $this->db->where("(paymentmethod_id=1 OR paymentmethod_id=2)", NULL, FALSE);
            $this->db->where('journaltype_id', 2);
            $this->db->like('journal_date', $bulantahun);
            $data_jurnal = $this->db->get($this->table)->result();
            $data_jurnal = json_decode(json_encode($data_jurnal), True);
            foreach ($data_jurnal as $list) {
                    $data[] = array(
                        'journaltype_id'=>$list['journaltype_id'],
                        'transactioncategory_id'=>$list['transactioncategory_id'],
                        'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
                        'paymentmethod_id'=>$list['paymentmethod_id'],
                        'description'=>$list['description'],
                        'journal_date'=>$list['journal_date'],
                        'nominal'=>$list['nominal'],
                        'type'=>'Debit'
                        );
                }
                
            return $data;   
        }

        function usaPengeluarankas($store_id,$bulantahun,$data){
            $this->db->where('store_id', $store_id);
            $this->db->where("(transactioncategory_id=4 )", NULL, FALSE); 
            $this->db->where("(subtransactioncategory_id=1 )", NULL, FALSE); 
            $this->db->where("(paymentmethod_id=1 OR paymentmethod_id=2)", NULL, FALSE);
            $this->db->where('journaltype_id', 2);
            $this->db->like('journal_date', $bulantahun);
            $data_jurnal = $this->db->get($this->table)->result();
            $data_jurnal = json_decode(json_encode($data_jurnal), True);
            foreach ($data_jurnal as $list) {
                    $data[] = array(
                        'journaltype_id'=>$list['journaltype_id'],
                        'transactioncategory_id'=>$list['transactioncategory_id'],
                        'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
                        'paymentmethod_id'=>$list['paymentmethod_id'],
                        'description'=>$list['description'],
                        'journal_date'=>$list['journal_date'],
                        'nominal'=>$list['nominal'],
                        'type'=>'Debit'
                        );
                }
                
            return $data;   
        }


        function usaPembelian($store_id,$bulantahun,$data){
            $this->db->where('store_id', $store_id);
            $this->db->where("(transactioncategory_id=1 OR transactioncategory_id=2 OR transactioncategory_id=3)", NULL, FALSE); 
            $this->db->where("(paymentmethod_id=3)", NULL, FALSE);
            $this->db->where('journaltype_id', 1);
            $this->db->like('journal_date', $bulantahun);
            $data_jurnal = $this->db->get($this->table)->result();
            $data_jurnal = json_decode(json_encode($data_jurnal), True);
            foreach ($data_jurnal as $list) {
                    $data[] = array(
                        'journaltype_id'=>$list['journaltype_id'],
                        'transactioncategory_id'=>$list['transactioncategory_id'],
                        'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
                        'paymentmethod_id'=>$list['paymentmethod_id'],
                        'description'=>$list['description'],
                        'journal_date'=>$list['journal_date'],
                        'nominal'=>-$list['nominal'],
                        'type'=>'Kredit'
                        );
                }
                
            return $data;   
        }


        function ubjpPenerimaankas($store_id,$bulantahun,$data){
            $this->db->where('store_id', $store_id);
            $this->db->where("(transactioncategory_id=8)", NULL, FALSE); 
            $this->db->where("(subtransactioncategory_id=22 )", NULL, FALSE); 
            $this->db->where("(paymentmethod_id=2 OR paymentmethod_id=1)", NULL, FALSE);
            $this->db->where('journaltype_id', 4);
            $this->db->like('journal_date', $bulantahun);
            $data_jurnal = $this->db->get($this->table)->result();
            $data_jurnal = json_decode(json_encode($data_jurnal), True);
            foreach ($data_jurnal as $list) {
                    $data[] = array(
                        'journaltype_id'=>$list['journaltype_id'],
                        'transactioncategory_id'=>$list['transactioncategory_id'],
                        'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
                        'paymentmethod_id'=>$list['paymentmethod_id'],
                        'description'=>$list['description'],
                        'journal_date'=>$list['journal_date'],
                        'nominal'=>-$list['nominal'],
                        'type'=>'Kredit'
                        );
                }
        
            return $data;   
        }



        public function ekuitas_proses($store_id,$bulantahun){

            $data['modal_pemilik'] = array();
            $data['modal_pemilik'] = $this->mpModal($store_id,$bulantahun,$data['modal_pemilik']);
           
            $data['modal_pemilik'] = json_decode(json_encode($data['modal_pemilik']), True);
            $sumnominal =0;
            foreach ($data['modal_pemilik'] as $list) {
                $sumnominal +=$list['nominal'];
            }
            $data['modal_pemilik_total'] = $sumnominal;


            $data['penarikan_modal'] = array();
            $data['penarikan_modal'] = $this->pmModal($store_id,$bulantahun,$data['penarikan_modal']);
           
            $data['penarikan_modal'] = json_decode(json_encode($data['penarikan_modal']), True);
            $sumnominal =0;
            foreach ($data['penarikan_modal'] as $list) {
                $sumnominal +=$list['nominal'];
            }

            $data['penarikan_modal_total'] = $sumnominal;
            return json_decode(json_encode($data), True);

        }


        function mpModal($store_id,$bulantahun,$data){
            $this->db->where('store_id', $store_id);
            $this->db->where("(transactioncategory_id=11)", NULL, FALSE); 
            $this->db->where("(subtransactioncategory_id=26 OR subtransactioncategory_id=25 OR subtransactioncategory_id=27 OR subtransactioncategory_id=28)", NULL, FALSE); 
            $this->db->where("(paymentmethod_id=1 OR paymentmethod_id=2 OR paymentmethod_id=4 )", NULL, FALSE);
            $this->db->where('journaltype_id', 5);
            $this->db->like('journal_date', $bulantahun);
            $data_jurnal = $this->db->get($this->table)->result();
            $data_jurnal = json_decode(json_encode($data_jurnal), True);
            foreach ($data_jurnal as $list) {
            
                    $data[] = array(
                        'journaltype_id'=>$list['journaltype_id'],
                        'transactioncategory_id'=>$list['transactioncategory_id'],
                        'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
                        'paymentmethod_id'=>$list['paymentmethod_id'],
                        'description'=>$list['description'],
                        'journal_date'=>$list['journal_date'],
                        'nominal'=>-$list['nominal'],
                        'type'=>'Kredit'
                        );
                    
                }
                
            return $data;   
        }


        function pmModal($store_id,$bulantahun,$data){
            $this->db->where('store_id', $store_id);
            $this->db->where("(transactioncategory_id=10)", NULL, FALSE); 
            $this->db->where("(subtransactioncategory_id=24)", NULL, FALSE); 
            $this->db->where("(paymentmethod_id=1 OR paymentmethod_id=2)", NULL, FALSE);
            $this->db->where('journaltype_id', 5);
            $this->db->like('journal_date', $bulantahun);
            $data_jurnal = $this->db->get($this->table)->result();
            $data_jurnal = json_decode(json_encode($data_jurnal), True);
            foreach ($data_jurnal as $list) {
            
                    $data[] = array(
                        'journaltype_id'=>$list['journaltype_id'],
                        'transactioncategory_id'=>$list['transactioncategory_id'],
                        'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
                        'paymentmethod_id'=>$list['paymentmethod_id'],
                        'description'=>$list['description'],
                        'journal_date'=>$list['journal_date'],
                        'nominal'=>$list['nominal'],
                        'type'=>'Debit'
                        );
                    
                }
                
            return $data;   
        }



        public function pend_hpp_proses($store_id,$bulantahun){

            $data['pendapatan_penjualan'] = array();
            $data['pendapatan_penjualan'] = $this->pjPenjualan($store_id,$bulantahun,$data['pendapatan_penjualan']);
           
            $data['pendapatan_penjualan'] = json_decode(json_encode($data['pendapatan_penjualan']), True);
            $sumnominal =0;
            foreach ($data['pendapatan_penjualan'] as $list) {
                $sumnominal +=$list['nominal'];
            }
            $data['pendapatan_penjualan_total'] = $sumnominal;


             $data['beban_pokokpenjualan'] = array();
            $data['beban_pokokpenjualan'] = $this->bppPenjualan($store_id,$bulantahun,$data['beban_pokokpenjualan']);
           
            $data['beban_pokokpenjualan'] = json_decode(json_encode($data['beban_pokokpenjualan']), True);
            $sumnominal =0;
            foreach ($data['beban_pokokpenjualan'] as $list) {
                $sumnominal +=$list['nominal'];
            }
            $data['beban_pokokpenjualan_total'] = $sumnominal;

          
            return json_decode(json_encode($data), True);

        }


        function pjPenjualan($store_id,$bulantahun,$data){
            $this->db->where('store_id', $store_id);
            $this->db->where('transactioncategory_id',6); 
            $this->db->where("(paymentmethod_id=1 OR paymentmethod_id=2 OR paymentmethod_id=3)", NULL, FALSE);
            $this->db->where('journaltype_id', 3);
            $this->db->like('journal_date', $bulantahun);
            $data_jurnal = $this->db->get($this->table)->result();
            $data_jurnal = json_decode(json_encode($data_jurnal), True);
            foreach ($data_jurnal as $list) {
                    $data[] = array(
                        'journaltype_id'=>$list['journaltype_id'],
                        'transactioncategory_id'=>$list['transactioncategory_id'],
                        'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
                        'paymentmethod_id'=>$list['paymentmethod_id'],
                        'description'=>$list['description'],
                        'journal_date'=>$list['journal_date'],
                        'nominal'=>-$list['nominal'],
                        'type'=>'Kredit'
                        );
                }
            
            return $data;   
        }


        function bppPenjualan($store_id,$bulantahun,$data){
            $this->db->where('store_id', $store_id);
            $this->db->where('transactioncategory_id',6); 
            $this->db->where("(paymentmethod_id=1 OR paymentmethod_id=2 OR paymentmethod_id=3)", NULL, FALSE);
            $this->db->where('journaltype_id', 3);
            $this->db->like('journal_date', $bulantahun);
            $data_jurnal = $this->db->get($this->table)->result();
            $data_jurnal = json_decode(json_encode($data_jurnal), True);
            foreach ($data_jurnal as $list) {
                    $data[] = array(
                        'journaltype_id'=>$list['journaltype_id'],
                        'transactioncategory_id'=>$list['transactioncategory_id'],
                        'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
                        'paymentmethod_id'=>$list['paymentmethod_id'],
                        'description'=>$list['description'],
                        'journal_date'=>$list['journal_date'],
                        'nominal'=>$list['nominal_2nd'],
                        'type'=>'Debit'
                        );
                }
            
            return $data;   
        }



        public function beban_proses($store_id,$bulantahun){

            $data['beban_sewa_tempatusaha'] = array();
            $data['beban_sewa_tempatusaha'] = $this->bstuPengeluarankas($store_id,$bulantahun,$data['beban_sewa_tempatusaha']);
           
            $data['beban_sewa_tempatusaha'] = json_decode(json_encode($data['beban_sewa_tempatusaha']), True);
            $sumnominal =0;
            foreach ($data['beban_sewa_tempatusaha'] as $list) {
                $sumnominal +=$list['nominal'];
            }
            $data['beban_sewa_tempatusaha_total'] = $sumnominal;


            $data['beban_gajikaryawan'] = array();
            $data['beban_gajikaryawan'] = $this->bgkPengeluarankas($store_id,$bulantahun,$data['beban_gajikaryawan']);
           
            $data['beban_gajikaryawan'] = json_decode(json_encode($data['beban_gajikaryawan']), True);
            $sumnominal =0;
            foreach ($data['beban_gajikaryawan'] as $list) {
                $sumnominal +=$list['nominal'];
            }
            $data['beban_gajikaryawan_total'] = $sumnominal;

            $data['beban_listrik'] = array();
            $data['beban_listrik'] = $this->blPengeluarankas($store_id,$bulantahun,$data['beban_listrik']);
           
            $data['beban_listrik'] = json_decode(json_encode($data['beban_listrik']), True);
            $sumnominal =0;
            foreach ($data['beban_listrik'] as $list) {
                $sumnominal +=$list['nominal'];
            }
            $data['beban_listrik_total'] = $sumnominal;

            $data['beban_telepon'] = array();
            $data['beban_telepon'] = $this->btPengeluarankas($store_id,$bulantahun,$data['beban_telepon']);
           
            $data['beban_telepon'] = json_decode(json_encode($data['beban_telepon']), True);
            $sumnominal =0;
            foreach ($data['beban_telepon'] as $list) {
                $sumnominal +=$list['nominal'];
            }
            $data['beban_telepon_total'] = $sumnominal;

            $data['beban_air'] = array();
            $data['beban_air'] = $this->baPengeluarankas($store_id,$bulantahun,$data['beban_air']);
           
            $data['beban_air'] = json_decode(json_encode($data['beban_air']), True);
            $sumnominal =0;
            foreach ($data['beban_air'] as $list) {
                $sumnominal +=$list['nominal'];
            }
            $data['beban_air_total'] = $sumnominal;

            $data['beban_pengiriman'] = array();
            $data['beban_pengiriman'] = $this->bpengPengeluarankas($store_id,$bulantahun,$data['beban_pengiriman']);
           
            $data['beban_pengiriman'] = json_decode(json_encode($data['beban_pengiriman']), True);
            $sumnominal =0;
            foreach ($data['beban_pengiriman'] as $list) {
                $sumnominal +=$list['nominal'];
            }
            $data['beban_pengiriman_total'] = $sumnominal;

            $data['beban_bungabank'] = array();
            $data['beban_bungabank'] = $this->bbbPengeluarankas($store_id,$bulantahun,$data['beban_bungabank']);
           
            $data['beban_bungabank'] = json_decode(json_encode($data['beban_bungabank']), True);
            $sumnominal =0;
            foreach ($data['beban_bungabank'] as $list) {
                $sumnominal +=$list['nominal'];
            }
            $data['beban_bungabank_total'] = $sumnominal;

            $data['beban_pajak'] = array();
            $data['beban_pajak'] = $this->bpajakPengeluarankas($store_id,$bulantahun,$data['beban_pajak']);
           
            $data['beban_pajak'] = json_decode(json_encode($data['beban_pajak']), True);
            $sumnominal =0;
            foreach ($data['beban_pajak'] as $list) {
                $sumnominal +=$list['nominal'];
            }
            $data['beban_pajak_total'] = $sumnominal;

          
            return json_decode(json_encode($data), True);

        }

        function bstuPengeluarankas($store_id,$bulantahun,$data){
            $this->db->where('store_id', $store_id);
            $this->db->where("(transactioncategory_id=5 )", NULL, FALSE); 
            $this->db->where("(subtransactioncategory_id=12 )", NULL, FALSE); 
            $this->db->where("(paymentmethod_id=1)", NULL, FALSE);
            $this->db->where('journaltype_id', 2);
            $this->db->like('journal_date', $bulantahun);
            $data_jurnal = $this->db->get($this->table)->result();
            $data_jurnal = json_decode(json_encode($data_jurnal), True);
            foreach ($data_jurnal as $list) {
                    $data[] = array(
                        'journaltype_id'=>$list['journaltype_id'],
                        'transactioncategory_id'=>$list['transactioncategory_id'],
                        'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
                        'paymentmethod_id'=>$list['paymentmethod_id'],
                        'description'=>$list['description'],
                        'journal_date'=>$list['journal_date'],
                        'nominal'=>$list['nominal'],
                        'type'=>'Debit'
                        );
                }
                
            return $data;   
        }

        function bpajakPengeluarankas($store_id,$bulantahun,$data){
            $this->db->where('store_id', $store_id);
            $this->db->where("(transactioncategory_id=5 )", NULL, FALSE); 
            $this->db->where("(subtransactioncategory_id=18 )", NULL, FALSE); 
            $this->db->where("(paymentmethod_id=2)", NULL, FALSE);
            $this->db->where('journaltype_id', 2);
            $this->db->like('journal_date', $bulantahun);
            $data_jurnal = $this->db->get($this->table)->result();
            $data_jurnal = json_decode(json_encode($data_jurnal), True);
            foreach ($data_jurnal as $list) {
                    $data[] = array(
                        'journaltype_id'=>$list['journaltype_id'],
                        'transactioncategory_id'=>$list['transactioncategory_id'],
                        'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
                        'paymentmethod_id'=>$list['paymentmethod_id'],
                        'description'=>$list['description'],
                        'journal_date'=>$list['journal_date'],
                        'nominal'=>$list['nominal'],
                        'type'=>'Debit'
                        );
                }
                
            return $data;   
        }

         function bpengPengeluarankas($store_id,$bulantahun,$data){
            $this->db->where('store_id', $store_id);
            $this->db->where("(transactioncategory_id=5 )", NULL, FALSE); 
            $this->db->where("(subtransactioncategory_id=17 )", NULL, FALSE); 
            $this->db->where("(paymentmethod_id=1)", NULL, FALSE);
            $this->db->where('journaltype_id', 2);
            $this->db->like('journal_date', $bulantahun);
            $data_jurnal = $this->db->get($this->table)->result();
            $data_jurnal = json_decode(json_encode($data_jurnal), True);
            foreach ($data_jurnal as $list) {
                    $data[] = array(
                        'journaltype_id'=>$list['journaltype_id'],
                        'transactioncategory_id'=>$list['transactioncategory_id'],
                        'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
                        'paymentmethod_id'=>$list['paymentmethod_id'],
                        'description'=>$list['description'],
                        'journal_date'=>$list['journal_date'],
                        'nominal'=>$list['nominal'],
                        'type'=>'Debit'
                        );
                }
                
            return $data;   
        }

        function btPengeluarankas($store_id,$bulantahun,$data){
            $this->db->where('store_id', $store_id);
            $this->db->where("(transactioncategory_id=5 )", NULL, FALSE); 
            $this->db->where("(subtransactioncategory_id=15 )", NULL, FALSE); 
            $this->db->where("(paymentmethod_id=1)", NULL, FALSE);
            $this->db->where('journaltype_id', 2);
            $this->db->like('journal_date', $bulantahun);
            $data_jurnal = $this->db->get($this->table)->result();
            $data_jurnal = json_decode(json_encode($data_jurnal), True);
            foreach ($data_jurnal as $list) {
                    $data[] = array(
                        'journaltype_id'=>$list['journaltype_id'],
                        'transactioncategory_id'=>$list['transactioncategory_id'],
                        'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
                        'paymentmethod_id'=>$list['paymentmethod_id'],
                        'description'=>$list['description'],
                        'journal_date'=>$list['journal_date'],
                        'nominal'=>$list['nominal'],
                        'type'=>'Debit'
                        );
                }
                
            return $data;   
        }

        function baPengeluarankas($store_id,$bulantahun,$data){
            $this->db->where('store_id', $store_id);
            $this->db->where("(transactioncategory_id=5 )", NULL, FALSE); 
            $this->db->where("(subtransactioncategory_id=16 )", NULL, FALSE); 
            $this->db->where("(paymentmethod_id=1)", NULL, FALSE);
            $this->db->where('journaltype_id', 2);
            $this->db->like('journal_date', $bulantahun);
            $data_jurnal = $this->db->get($this->table)->result();
            $data_jurnal = json_decode(json_encode($data_jurnal), True);
            foreach ($data_jurnal as $list) {
                    $data[] = array(
                        'journaltype_id'=>$list['journaltype_id'],
                        'transactioncategory_id'=>$list['transactioncategory_id'],
                        'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
                        'paymentmethod_id'=>$list['paymentmethod_id'],
                        'description'=>$list['description'],
                        'journal_date'=>$list['journal_date'],
                        'nominal'=>$list['nominal'],
                        'type'=>'Debit'
                        );
                }
                
            return $data;   
        }

        function bgkPengeluarankas($store_id,$bulantahun,$data){
            $this->db->where('store_id', $store_id);
            $this->db->where("(transactioncategory_id=5 )", NULL, FALSE); 
            $this->db->where("(subtransactioncategory_id=13 )", NULL, FALSE); 
            $this->db->where("(paymentmethod_id=1)", NULL, FALSE);
            $this->db->where('journaltype_id', 2);
            $this->db->like('journal_date', $bulantahun);
            $data_jurnal = $this->db->get($this->table)->result();
            $data_jurnal = json_decode(json_encode($data_jurnal), True);
            foreach ($data_jurnal as $list) {
                    $data[] = array(
                        'journaltype_id'=>$list['journaltype_id'],
                        'transactioncategory_id'=>$list['transactioncategory_id'],
                        'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
                        'paymentmethod_id'=>$list['paymentmethod_id'],
                        'description'=>$list['description'],
                        'journal_date'=>$list['journal_date'],
                        'nominal'=>$list['nominal'],
                        'type'=>'Debit'
                        );
                }
                
            return $data;   
        }

        function bbbPengeluarankas($store_id,$bulantahun,$data){
            $this->db->where('store_id', $store_id);
            $this->db->where("(transactioncategory_id=5 )", NULL, FALSE); 
            $this->db->where("(subtransactioncategory_id=19 )", NULL, FALSE); 
            $this->db->where("(paymentmethod_id=1)", NULL, FALSE);
            $this->db->where('journaltype_id', 2);
            $this->db->like('journal_date', $bulantahun);
            $data_jurnal = $this->db->get($this->table)->result();
            $data_jurnal = json_decode(json_encode($data_jurnal), True);
            foreach ($data_jurnal as $list) {
                    $data[] = array(
                        'journaltype_id'=>$list['journaltype_id'],
                        'transactioncategory_id'=>$list['transactioncategory_id'],
                        'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
                        'paymentmethod_id'=>$list['paymentmethod_id'],
                        'description'=>$list['description'],
                        'journal_date'=>$list['journal_date'],
                        'nominal'=>$list['nominal'],
                        'type'=>'Debit'
                        );
                }
                
            return $data;   
        }

        function blPengeluarankas($store_id,$bulantahun,$data){
            $this->db->where('store_id', $store_id);
            $this->db->where("(transactioncategory_id=5 )", NULL, FALSE); 
            $this->db->where("(subtransactioncategory_id=14 )", NULL, FALSE); 
            $this->db->where("(paymentmethod_id=1)", NULL, FALSE);
            $this->db->where('journaltype_id', 2);
            $this->db->like('journal_date', $bulantahun);
            $data_jurnal = $this->db->get($this->table)->result();
            $data_jurnal = json_decode(json_encode($data_jurnal), True);
            foreach ($data_jurnal as $list) {
                    $data[] = array(
                        'journaltype_id'=>$list['journaltype_id'],
                        'transactioncategory_id'=>$list['transactioncategory_id'],
                        'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
                        'paymentmethod_id'=>$list['paymentmethod_id'],
                        'description'=>$list['description'],
                        'journal_date'=>$list['journal_date'],
                        'nominal'=>$list['nominal'],
                        'type'=>'Debit'
                        );
                }
                
            return $data;   
        }



        public function lainlain_proses($store_id,$bulantahun){

            $data['pendapatan_bungabank'] = array();
            $data['pendapatan_bungabank'] = $this->pbbPenerimaankas($store_id,$bulantahun,$data['pendapatan_bungabank']);
           
            $data['pendapatan_bungabank'] = json_decode(json_encode($data['pendapatan_bungabank']), True);
            $sumnominal =0;
            foreach ($data['pendapatan_bungabank'] as $list) {
                $sumnominal +=$list['nominal'];
            }
            $data['pendapatan_bungabank_total'] = $sumnominal;

            $data['beban_administrasibank'] = array();
            $data['beban_administrasibank'] = $this->babPengeluarankas($store_id,$bulantahun,$data['beban_administrasibank']);
           
            $data['beban_administrasibank'] = json_decode(json_encode($data['beban_administrasibank']), True);
            $sumnominal =0;
            foreach ($data['beban_administrasibank'] as $list) {
                $sumnominal +=$list['nominal'];
            }
            $data['beban_administrasibank_total'] = $sumnominal;
            return json_decode(json_encode($data), True);

        }

        function pbbPenerimaankas($store_id,$bulantahun,$data){
            $this->db->where('store_id', $store_id);
            $this->db->where("(transactioncategory_id=9)", NULL, FALSE); 
            $this->db->where("(subtransactioncategory_id=23 )", NULL, FALSE); 
            $this->db->where("(paymentmethod_id=4)", NULL, FALSE);
            $this->db->where('journaltype_id', 4);
            $this->db->like('journal_date', $bulantahun);
            $data_jurnal = $this->db->get($this->table)->result();
            $data_jurnal = json_decode(json_encode($data_jurnal), True);
            foreach ($data_jurnal as $list) {
                    $data[] = array(
                        'journaltype_id'=>$list['journaltype_id'],
                        'transactioncategory_id'=>$list['transactioncategory_id'],
                        'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
                        'paymentmethod_id'=>$list['paymentmethod_id'],
                        'description'=>$list['description'],
                        'journal_date'=>$list['journal_date'],
                        'nominal'=>-$list['nominal'],
                        'type'=>'Kredit'
                        );
                }
        
            return $data;   
        }

         function babPengeluarankas($store_id,$bulantahun,$data){
            $this->db->where('store_id', $store_id);
            $this->db->where("(transactioncategory_id=5 )", NULL, FALSE); 
            $this->db->where("(subtransactioncategory_id=20 )", NULL, FALSE); 
            $this->db->where("(paymentmethod_id=1)", NULL, FALSE);
            $this->db->where('journaltype_id', 2);
            $this->db->like('journal_date', $bulantahun);
            $data_jurnal = $this->db->get($this->table)->result();
            $data_jurnal = json_decode(json_encode($data_jurnal), True);
            foreach ($data_jurnal as $list) {
                    $data[] = array(
                        'journaltype_id'=>$list['journaltype_id'],
                        'transactioncategory_id'=>$list['transactioncategory_id'],
                        'subtransactioncategory_id'=>$list['subtransactioncategory_id'],
                        'paymentmethod_id'=>$list['paymentmethod_id'],
                        'description'=>$list['description'],
                        'journal_date'=>$list['journal_date'],
                        'nominal'=>$list['nominal'],
                        'type'=>'Debit'
                        );
                }
                
            return $data;   
        }

        
        

}

?>