<?php

class Transaction_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_transactions_details()
    {
        $this->db->where('status', 'Active');
            $query = $this->db->get('bank_info');
             return $query->result();
    }

        public function add_gl_transaction($journalNo, $ledgerName, $datepicker, $journalType, $indexNumber, $pCode, $accountHead, $account_id, $subLedgerName, $subLedger_id, $donarName, $donar_id, $ledgerType, $description, $debitAmount, $chequeNo)
    {
        $data = Array(
            'gl_no' => $journalNo,
            'type' => "Assets",
            'type_no' => $journalType,
                'account_code' => $account_id,
                'account_head' => $accountHead,
                'sub_ledger' => $subLedgerName,
                'donor_id' => $donar_id,
                'ledger_type' => $ledgerType,
                'memo' => $description,
                'amount' => $debitAmount,
                'cheque_no' => $chequeNo,
                'status' => "Active",
                );
       return  $this->db->insert('gl_trans_info', $data);
     		
    }
    
    public function add_comment_of_transaction($journalNo, $comment, $summary)
    {
        $data = Array(
            'trans_no' => $journalNo,
                'detailed_comment' => $comment,
                'summary_comment' => $summary
                );
       return  $this->db->insert('gl_trans_comment_details', $data);
    }
    
    
}