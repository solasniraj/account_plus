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
              $this->session->set_userdata("user_id",$user_id);
              return true;
          } else {
            return FALSE;
        }
    }

    public function get_all_active_users()
    {

    }


    }