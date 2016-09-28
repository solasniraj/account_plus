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

        
        
   


    }