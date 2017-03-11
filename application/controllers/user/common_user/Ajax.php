<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

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
          //       if(!$this->session->has_userdata('username')){
          //              			redirect(base_url());
        		// }
                
        }



	public function getAllSubTransactionCategoryByTransactionCategoryId()
	{	
		
	   $this->form_validation->set_message('required', 'harus diisi');
	   $this->form_validation->set_rules('transactioncategory_id', 'transactioncategory_id', 'required');
       

	 	if($this->form_validation->run() == TRUE){
	 		$data_x=$this->input->post();
	 		
		  	if($data = $this->subtransactioncategory->getAllTransactioncategoryId($data_x['transactioncategory_id'])){
		  		$data = json_decode(json_encode($data), True);
		  		
		  		$return=array();
		  		foreach ($data as $list) {
		  			$data_x['subtransactioncategory_id']=$list['subtransactioncategory_id'];
		  			$data_x['transactioncategory_id']=$list['transactioncategory_id'];
		  			$data_x['name']=$list['name'];
		  			$data_x['paymentmethods']=$list['paymentmethods'];	
		  			$return[] = $data_x; 	
		  		}

		  		echo json_encode($return,JSON_UNESCAPED_SLASHES);
		  		
			  }else{
			  	echo 0;
			  }
		  
		}else{
			echo 0;
		}

	}


	public function getAllPaymentmethodBySubTransactionCategoryId()
	{	
		
	   $this->form_validation->set_message('required', 'harus diisi');
	   $this->form_validation->set_rules('subtransactioncategory_id', 'subtransactioncategory_id', 'required');
       

	 	if($this->form_validation->run() == TRUE){
	 		$data_x=$this->input->post();
	 		
		  	if($data = $this->subtransactioncategory->getPaymentmethodsById($data_x['subtransactioncategory_id'])){
		  		$data = json_decode(json_encode($data), True);
		  		$data = json_decode($data['paymentmethods']);
		  		$return = array();
		  		$data_y =array();
		  		$i=0;
		  		foreach ($data as $list) {
		  			$tmp = $this->paymentmethod->get($list);
		  			$tmp = $data = json_decode(json_encode($tmp), True);
		  			$data_y['paymentmethod_id'] = $tmp['paymentmethod_id'];
		  			$data_y['name']=$tmp['name'];
		  			$return[] = $data_y;
		  			$i++;
		  		}

		  		echo json_encode($return);
		  		
			  }else{
			  	echo 0;
			  }
		  
		}else{
			echo 0;
		}

	}


	

	




	




	

}
