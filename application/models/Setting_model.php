    <?php

    class Setting_model extends CI_Model {

        public function __construct() {
            $this->load->database();
        }

        public function get_committee_detils($committee_id, $committee_code)
        {
            $this->db->where('status', '1');
            $this->db->where('code', $committee_code);
            $this->db->where('id', $committee_id);
            $query = $this->db->get('committee_info');
             return $query->result();
        }

        public function get_user_details($user_id, $username,$committee_code)
        {
            $this->db->where('status', '1');
            $this->db->where('user_name', $username);
            $this->db->where('committee_code', $committee_code);
            $this->db->where('id', $user_id);
            $query = $this->db->get('user_info');
             return $query->result();
        }
        
        public function update_user_info($user_id, $userName, $fullName, $emailId, $contactNumber)
        {
             $data = array(
            'user_name' => $userName,
            'full_name' => $fullName,
            'email_address' => $emailId,
            'contact_no' => $contactNumber);
        $this->db->where('id', $user_id);
        $this->db->update('user_info', $data);
        }
   


    }