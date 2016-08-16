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
    function insert_programm_listing($id,$code, $programName, $programBudget, $category)
    {
        $data = Array(
            'code' => $code,
            'programName' => $programName,
            'programBudget' => $programBudget,
            'category' => $category,
            'user_id' =>$id
            );
       return  $this->db->insert('user_programs_list', $data);
    }
  function  view_programm_listing($id) 
  {
    $this->db->order_by('id', 'DESC');
    $this->db->where('user_id', $id);
    $query = $this->db->get("user_programs_list");
    return $query->result();

  }

    
    
}