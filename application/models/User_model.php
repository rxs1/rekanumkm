<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

        var $table = 'mst_user';

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }

        public function auth($username,$password)
        {       
                
                $this->db->where('username',$username);
                $this->db->where('password',$password);
                return $this->db->get($this->table)->row();
                
        }

        public function get($id)
        {
                $this->db->where('user_id', $id);
                
                if($arr = $this->db->get($this->table)->row()){
                                return $arr;                    
                }else{
                        return 0;
                }
        }

        public function getByUsername($username)
        {
                $this->db->where('username', $username);
                
                if($arr = $this->db->get($this->table)->row()){
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

         public function update($username,$data)
        {
                $this->db->where('username', $username);
                if($this->db->update($this->table, $data)){
                        return 1;
                }else{
                        return 0;
                }

        }

         public function all()
        {
            if($arr = $this->db->get($this->table)->result())
              {
             return $arr;                
            }else{
              return 0;
            }
        }

        public function delete($id){
        
          return $this->db->delete($this->table, array('user_id' => $id)); 
        }

}

?>