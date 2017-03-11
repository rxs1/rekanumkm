<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Journal_model extends CI_Model {

        var $table = 'mst_journal';

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }

        
        public function get($id)
        {
                $this->db->where('journal_id', $id);
                
                if($arr = $this->db->get($this->table)->row()){
                                return $arr;                    
                }else{
                        return 0;
                }
        }

        public function getByStoreIdAndJournalTypeId($store_id,$journaltype_id)
        
        {
                $this->db->where('store_id', $store_id);
                 $this->db->where('journaltype_id', $journaltype_id);
                 $this->db->order_by('create_at','desc');
                
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

         public function update($journal_id,$data)
        {
                $this->db->where('journal_id', $journal_id);
                if($this->db->update($this->table, $data)){
                        return 1;
                }else{
                        return 0;
                }
        }
          


        public function delete($id){
          return $this->db->delete($this->table, array('journal_id' => $id)); 
        }

}

?>