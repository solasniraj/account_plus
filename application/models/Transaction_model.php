<?php

class Transaction_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_transactions_details()
    {
        $this->db->distinct();
        $this->db->group_by('gl_no');
        $this->db->where('status', '1');
        $this->db->select('*');
        $this->db->from('gl_trans_info');
        $this->db->join('gl_trans_comment_details', 'gl_trans_comment_details.trans_no = gl_trans_info.gl_no');
         $query = $this->db->get();
        return $query->result();               
    }
    
    public function get_single_transaction_details($id)
    {
        $this->db->where('gl_no', $id);
        $this->db->where('status', '1');
        $this->db->select('*');
        $this->db->from('gl_trans_info');
$this->db->join('gl_trans_comment_details', 'gl_trans_comment_details.trans_no = gl_trans_info.gl_no');
$query = $this->db->get();
 return $query->result();   
    }

    public function add_gl_transaction($journalNo, $ledgerName, $datepicker, $journalType, $indexNumber, $pCode, $accountHead, $account_id, $subLedgerName, $subLedger_id, $donarName, $donar_id, $ledgerType, $description, $debitAmount, $chequeNo)
    {
        $data = Array(
            'gl_no' => $journalNo,
            'type' => "Assets",
            'type_no' => $journalType,
            'tran_date' => $datepicker,
                'account_code' => $account_id,
                'account_head' => $accountHead,
                'sub_ledger' => $subLedgerName,
                'donor_id' => $donar_id,
                'ledger_type' => $ledgerType,
                'memo' => $description,
                'amount' => $debitAmount,
                'cheque_no' => $chequeNo,
                'status' => "1",
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