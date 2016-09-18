<?php

class Transaction_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_transactions_details()
    {
        $this->db->distinct();
        $this->db->group_by('journal_voucher_no');
        $this->db->where('status', '1');
        $this->db->select('*');
        $this->db->from('gl_trans_info');
        $this->db->join('gl_trans_comment_details', 'gl_trans_comment_details.trans_no = gl_trans_info.journal_voucher_no');
         $query = $this->db->get();
        return $query->result();               
    }
    
    public function get_single_transaction_details($id)
    {
        $this->db->where('journal_voucher_no', $id);
        $this->db->where('status', '1');
        $this->db->select('*');
        $this->db->from('gl_trans_info');
$this->db->join('gl_trans_comment_details', 'gl_trans_comment_details.trans_no = gl_trans_info.journal_voucher_no');
$query = $this->db->get();
 return $query->result();   
    }

    public function add_gl_transaction($journalNo, $datepicker, $lmcode, $accCode, $subLedger_id, $donar_id, $ledgerType, $description, $Amount, $chequeNo)
    {
        $data = Array(
            'journal_voucher_no' => $journalNo,            
            'tran_date' => $datepicker,
                'ledger_master_code' => $lmcode,
                'account_ledger_head_code' => $accCode,
                'sub_ledger_code' => $subLedger_id,
                'donor_code' => $donar_id,
                'ledger_type_code' => $ledgerType,
                'memo' => $description,
                'amount' => $Amount,
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