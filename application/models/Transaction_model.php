<?php

class Transaction_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_transactions_details()
    {
        $this->db->distinct();
        $this->db->group_by('journal_voucher_no');
        $this->db->select('*');
        $this->db->from('gl_trans_info');
        $this->db->join('gl_trans_comment_details', 'gl_trans_comment_details.trans_no = gl_trans_info.journal_voucher_no');
         $query = $this->db->get();
        return $query->result();               
    }
    
    public function get_debit_credit_amount($id)
    {
        $this->db->select('SUM(ABS(amount)) AS sum', false);
        $this->db->from('gl_trans_info');
        $this->db->where('journal_voucher_no', $id);
        $query = $this->db->get();
        return $query->result();
    }

        public function get_single_transaction_details($id)
    {
        $this->db->where('journal_voucher_no', $id);
        $this->db->select('*');
        $this->db->from('gl_trans_info');
$this->db->join('gl_trans_comment_details', 'gl_trans_comment_details.trans_no = gl_trans_info.journal_voucher_no');
$this->db->join('donar_info', 'donar_info.donar_code = gl_trans_info.donor_code');
$this->db->join('ledger_master', 'ledger_master.ledger_master_code = gl_trans_info.ledger_master_code');
$query = $this->db->get();
 return $query->result();   
    }

    public function add_gl_transaction($journalNo, $datepicker, $lmcode, $accCode, $subLedger_id, $donar_id, $ledgerType, $description, $Amount, $chequeNo, $type)
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
                'trans_type' => $type,
                'gl_trans_status' => Null,
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
    
    public function update_transaction_status_to_approved($journalNo)
    {
         $this->db->where('journal_voucher_no', $journalNo);
       $data = array('gl_trans_status' => '1');
    return $this->db->update('gl_trans_info', $data);
    }
    
    public function update_transaction_status_to_pending($journalNo)
    {
         $this->db->where('journal_voucher_no', $journalNo);
       $data = array('gl_trans_status' => '2');
    return $this->db->update('gl_trans_info', $data);
    }
    
    
}