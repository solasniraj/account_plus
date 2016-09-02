    <?php

    class Bank_model extends CI_Model {

        public function __construct() {
            $this->load->database();
        }

        public function view_bank_account_listing()
        {
            $this->db->where('status', 'Active');
            $query = $this->db->get('bank_info');
             return $query->result();
        }

        public function add_new_bank_account($bankName,$accountNumber, $address, $contactNumber)
        {
            $data = Array(
            'bank_name' => $bankName,
            'bank_address' => $address,
                'bank_account_number' => $accountNumber,
                'bank_phone_no' => $contactNumber,
                'committee_id' => NULL,
                'user_id' => NULL,
                'status' => 'Active');
       return  $this->db->insert('bank_info', $data);
        }

        public function add_fiscal_year($commiteName, $fiscalYear)
        {
            $data = Array(
            'committee_name' => $commiteName,
            'fiscal_year' => $fiscalYear,
                'status' => 'Active');
       return  $this->db->insert('fiscal_year_info', $data);
        }

        public function get_total_bank_balance_of_related_bank($bankId)
        {
            $this->db->select_sum('amount');
    $this->db->from('bank_trans_info');
    $this->db->where('bank_id', $bankId);
    $query = $this->db->get();
    return $query->row()->amount;
        }
        
        public function get_total_balance_of_all_banks_from_trans_info()
        {
            $this->db->select_sum('amount');
    $this->db->from('bank_trans_info');
     $this->db->where('bank_id!=', NULL);
    $query = $this->db->get();
    return $query->row()->amount;
        }

        
   


    }