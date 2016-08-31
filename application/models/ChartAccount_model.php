    <?php

    class ChartAccount_model extends CI_Model {

        public function __construct() {
            $this->load->database();
        }

        public function get_ledger_listing()
        {
            $this->db->where('ledger_status', 'Active');
            $query = $this->db->get('ledger_info');
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

        



        
   


    }