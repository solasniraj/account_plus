<?php

class Report_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    
    public function get_journal_entry_for_day($day) {
        $this->db->where('tran_date_english', $day);
        $this->db->group_by('journal_voucher_no');
        $this->db->select('*');
        $this->db->from('gl_trans_info');
$this->db->join('gl_trans_comment_details', 'gl_trans_comment_details.trans_no = gl_trans_info.journal_voucher_no');
//$this->db->join('ledger_master', 'ledger_master.ledger_master_code = gl_trans_info.ledger_master_code');
$query = $this->db->get();
 return $query->result();  
    }
    
    
}