<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Store_model extends CI_Model {

        var $table = 'mst_store';

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }

        
        public function get($id)
        {
                $this->db->where('store_id', $id);
                
                if($arr = $this->db->get($this->table)->row()){
                                return $arr;                    
                }else{
                        return 0;
                }
        }

        public function getByUserId($user_id)
        {
                $this->db->where('user_id', $user_id);
                
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

         public function update($store_id,$data)
        {
                $this->db->where('store_id', $store_id);
                if($this->db->update($this->table, $data)){
                        return 1;
                }else{
                        return 0;
                }

        }
          


        public function delete($id){
        
          return $this->db->delete($this->table, array('store_id' => $id)); 
        }

}

?>