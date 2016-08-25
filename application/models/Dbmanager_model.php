    <?php

    class Dbmanager_model extends CI_Model {

        public function __construct() {
            $this->load->database();
        }

        public function check_database_for_first_time()
        {
            $this->db->where('status', 'Active');
            $query = $this->db->get('committee_info');
            if ($query->num_rows() == 1) {
              $user_id=$query->row()->id;
             
              return true;
          } else {
            return FALSE;
        }
        }

        public function add_committee($commiteName, $address, $phone)
        {
            $data = Array(
            'committee_name' => $commiteName,
            'address' => $address,
                'phone' => $phone,
                'code' => '12345',
                'status' => 'Active');
       return  $this->db->insert('committee_info', $data);
        }

        public function add_fiscal_year($commiteName, $fiscalYear)
        {
            $data = Array(
            'committee_name' => $commiteName,
            'fiscal_year' => $fiscalYear,
                'status' => 'Active');
       return  $this->db->insert('fiscal_year_info', $data);
        }



        
   


    }