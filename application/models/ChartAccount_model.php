    <?php

    class ChartAccount_model extends CI_Model {

        public function __construct() {
            $this->load->database();
        }

        public function get_account_chart_class()
        {
            $this->db->where('chart_status', 'Active');
            $query = $this->db->get('chart_class');
             return $query->result();
        }

        public function add_new_ledger($ledgerName)
        {
            $data = Array(
            'ledger_name' => $ledgerName,
                'ledger_code' => NULL,
                'committee_id' => NULL,
                'user_id' => NULL,
                'ledger_status' => 'Active');
       return  $this->db->insert('ledger_info', $data);
        }

        public function get_last_code_of_related_chart($chartAccType)
        {
            $this->db->where('chart_class_id', $chartAccType);
          // $this->db->where('account_status', 'Active');
            $this->db->select_max('account_code');
             $query= $this->db->get("chart_master")->result();
         return $query[0]->account_code;
        }

        public function add_new_chart_master($newCode, $programName, $chartAccType, $result)
        {
            $data = Array(
            'account_code' => $newCode,
                'account_code2' => NULL,
                'account_name' => $programName,
                'account_status' => 'Active',
                'chart_class_id' => $chartAccType,
                'program_id' => $result);
       return  $this->db->insert('chart_master', $data);
        }
            

        
   


    }