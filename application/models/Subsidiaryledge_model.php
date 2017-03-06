<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Subsidiaryledge_model extends CI_Model {

        var $table = 'mst_subsidiaryledge';

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }

        
        public function get($id)
        {
                $this->db->where('subsidiaryledge_id', $id);
                
                if($arr = $this->db->get($this->table)->row()){
                                return $arr;                    
                }else{
                        return 0;
                }
        }

        public function getByStoreId($store_id)
        {
                $this->db->where('store_id', $store_id);
                
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

         public function update($subsidiaryledge_id,$data)
        {
                $this->db->where('subsidiaryledge_id', $subsidiaryledge_id);
                if($this->db->update($this->table, $data)){
                        return 1;
                }else{
                        return 0;
                }

        }
          


        public function delete($id){
        
          return $this->db->delete($this->table, array('subsidiaryledge_id' => $id)); 
        }

}

?>