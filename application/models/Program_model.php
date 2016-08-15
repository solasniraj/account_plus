<?php

class Program_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    
    function validate() {
        $this->db->where('user_name', $this->input->post('userName'));
        $this->db->where('password', md5($this->input->post('userPass')));
        $this->db->where('status', '1');
        $query = $this->db->get('user_info');
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return FALSE;
        }
    }
    
    
}