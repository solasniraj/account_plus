    <?php

    class Bank_model extends CI_Model {

        public function __construct() {
            $this->load->database();
        }

        public function get_bank_account_type_details()
        {
            $this->db->where('status', '1');
            $query = $this->db->get('bank_account_type');
             return $query->result();
        }

        public function get_last_code_of_bank()
        {
             $this->db->select_max('account_code');
               $query= $this->db->get("bank_info")->result();
               if(!empty($query)){
           return $query[0]->account_code;
               }else{
                   return '0';
               }
        }

        
        public function view_bank_account_listing()
        {
            $this->db->where('status', '1');
            $query = $this->db->get('bank_info');
             return $query->result();
        }

        public function add_new_bank_account($bankCode, $bankAccountName, $accountType, $bankName,$accountNumber, $address, $contactNumber)
        {
            $data = Array(
                'account_code' => $bankCode,
                'bank_account_name' => $bankAccountName,
                'account_type' => $accountType,
            'bank_name' => $bankName,
            'bank_address' => $address,
                'bank_account_number' => $accountNumber,
                'bank_phone_no' => $contactNumber,
                'committee_id' => NULL,
                'user_id' => NULL,
                'status' => '1');
        $this->db->insert('bank_info', $data);
        $insert_id = $this->db->insert_id();

     return  $insert_id;
        }
        
        public function add_new_bank_account_from_ledger($subLedId, $name, $code)
        {
            $data = Array(
                'account_code' => NULL,
                'subledger_code' =>$code,
                'subledger_id' => $subLedId,
                'bank_account_name' => $name,               
                'account_type' => NULL,
            'bank_name' => null,
            'bank_address' => NULL,
                'bank_account_number' => NULL,
                'bank_phone_no' => NULL,
                'committee_id' => NULL,
                'user_id' => NULL,
                'status' => '1');
        $this->db->insert('bank_info', $data);
        $insert_id = $this->db->insert_id();
     return  $insert_id;
        }

                public function add_new_chart_master($bankCode, $bankAccountName, $accountGLCode, $result1)
        {
            $data = Array(
            'account_code' => $newCode,
                'account_name' => $bankAccountName,
                'account_status' => 'Active',
                'chart_class_id' => $accountGLCode,
                'program_id' => NULL,
                'bank_id' => $result1);
       return  $this->db->insert('chart_master', $data);
        }

        public function add_fiscal_year($commiteName, $fiscalYear)
        {
            $data = Array(
            'committee_name' => $commiteName,
            'fiscal_year' => $fiscalYear,
                'status' => '1');
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