    <?php

    class Bank_model extends CI_Model {

        public function __construct() {
            $this->load->database();
        }

        public function get_all_donars()
        {
            $this->db->where('status', 'Active');
            $query = $this->db->get('donar_info');
             return $query->result();
        }

        public function add_new_donar($bankName,$accountNumber, $address, $contactNumber)
        {
            $data = Array(
            'donar_name' => $bankName,
            'donar_address' => $address,
                'donar_contact_no' => $accountNumber,
                'donar_code' => $contactNumber,
                'donar_email' => NULL,
                'user_id' => NULL,
                'committee_id' => NULL,
                'status' => 'Active');
       return  $this->db->insert('donar_info', $data);
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