    <?php

    class Dbuser extends CI_Model {

        public function __construct() {
            $this->load->database();
        }
        
                function validate() {
            $this->db->where('user_name', $this->input->post('userName'));
            $this->db->where('password', md5($this->input->post('userPass')));
            $this->db->where('status', '1');
            $query = $this->db->get('user_info');
            if ($query->num_rows() == 1) {
              $user_id=$query->row()->id;
              $user_name = $query->row()->user_name;
              $committee_id = $query->row()->committee_id;
              $committee_code = $query->row()->committee_code;
              
              $data = array(
                    'username' => $user_name,
                    'user_id' => $user_id,
                    'committee_id' => $committee_id,
                    'committee_code' => $committee_code,
                    'logged_in' => true                   
                );
                $this->session->set_userdata($data);
              return true;
          } else {
            return FALSE;
        }
    }

    public function get_all_active_users()
    {
 $this->db->order_by('id', 'DESC');
    $query = $this->db->get("user_info");
    return $query->result();
    }


    }