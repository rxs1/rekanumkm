<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Paymentmethod_model extends CI_Model {

        var $table = 'mst_paymentmethod';

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }

        
        public function get($id)
        {
                $this->db->where('paymentmethod_id', $id);
                
                if($arr = $this->db->get($this->table)->row()){
                                return $arr;                    
                }else{
                        return 0;
                }
        }

        public function getNameById($id){
        
            $this->db->where('paymentmethod_id', $id);
                
                if($arr = $this->db->get($this->table)->row()){
                                return $arr->name;                    
                }else{
                        return 0;
                }
        }

        public function getAll()
        {
            
                if($arr = $this->db->get($this->table)->result()){
                                return $arr;                    
                }else{
                        return 0;
                }
        }



        public function insert($data)
        {
              if($this->db->insert($this->table, $data)){
                    return $this->db->insert_id();                  
              }else{
                        return 0;
              }
        }

         public function update($paymentmethod_id,$data)
        {
                $this->db->where('paymentmethod_id', $paymentmethod_id);
                if($this->db->update($this->table, $data)){
                        return 1;
                }else{
                        return 0;
                }

        }
          


        public function delete($id){
        
          return $this->db->delete($this->table, array('paymentmethod_id' => $id)); 
        }

}

?>