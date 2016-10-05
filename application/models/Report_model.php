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
    
    public function get_transaction_details_of_ledger_with_in_dates($ledger, $fromE, $toE)
    {
        $this->db->where('ledger_master_code', $ledger);
        $this->db->where('gl_trans_status', '1');
        $this->db->select('*');
        $this->db->from('gl_trans_info');
$this->db->join('gl_trans_comment_details', 'gl_trans_comment_details.trans_no = gl_trans_info.journal_voucher_no');
//$this->db->join('ledger_master', 'ledger_master.ledger_master_code = gl_trans_info.ledger_master_code');
$query = $this->db->get();
 return $query->result();  
    }
    
    public function get_transaction_details_of_sub_ledger_with_in_dates($ledger, $fromE, $toE)
    {
        $this->db->where('sub_ledger_code', $ledger);
        $this->db->where('gl_trans_status', '1');
        $this->db->select('*');
        $this->db->from('gl_trans_info');
$this->db->join('gl_trans_comment_details', 'gl_trans_comment_details.trans_no = gl_trans_info.journal_voucher_no');
//$this->db->join('ledger_master', 'ledger_master.ledger_master_code = gl_trans_info.ledger_master_code');
$query = $this->db->get();
 return $query->result();  
    }
    
    public function get_sum_of_amount_for_donar_by_code($donorCode)
    {
        $this->db->where('gl_trans_status', '1');
        $this->db->where('gl_code', $chartId);
        $this->db->where('donor_code', $donorCode);
        $this->db->where('ledger_type_code', '01');
        if('gl_code' =='01' || 'gl_code' =='04')
        {
            $this->db->select('SUM(amount) AS amount', FALSE);
$this->db->where('trans_type', 'dr');
        }elseif ('gl_code' =='02' || 'gl_code' =='03') {
            $this->db->select('SUM(amount) AS amount', FALSE);
$this->db->where('trans_type', 'cr');
        }else{
            
        }
      $query =  $this->db->get('gl_trans_info');
     
      return $query->result(); 
    }
    
    public function get_sum_of_expenditure_to_last_date($donorCode)
    {
        $this->db->where('gl_trans_status', '1');
        $this->db->where('donor_code', $donorCode);
        $this->db->where('ledger_type_code', '01');
        if('gl_code' =='01' || 'gl_code' =='04')
        {
            $this->db->select('SUM(amount) AS amount', FALSE);
$this->db->where('trans_type', 'dr');
die('here 14');
        }elseif ('gl_code' =='02' || 'gl_code' =='03') {
            $this->db->select('SUM(amount) AS amount', FALSE);
$this->db->where('trans_type', 'cr');
die('here 23');
        }else{
            
        }
      $query =  $this->db->get('gl_trans_info');
      
      return $query->result(); 
    }
    
    public function get_sum_of_expenditure_from_last_report_to_now($chartId, $donorCode)
    {
        $this->db->where('gl_trans_status', '1');
        $this->db->where('gl_code', $chartId);
        $this->db->where('donor_code', $donorCode);
        $this->db->where('ledger_type_code', '01');
        if($chartId ==1 || $chartId ==4)
        {
            $this->db->select('SUM(amount) AS amount', FALSE);
$this->db->where('trans_type', 'cr');
        }elseif ($chartId ==2 || $chartId ==3) {
            $this->db->select('SUM(amount) AS amount', FALSE);
$this->db->where('trans_type', 'dr');
        }else{
            
        }
      $query =  $this->db->get('gl_trans_info');
      
      return $query->result(); 
    }
    
    public function get_sum_of_expenditure_of_internal_and_labour_from_last_report_to_now($chartId, $donorCode)
    {
        $this->db->where('gl_trans_status', '1');
        $this->db->where('gl_code', $chartId);
        $this->db->where('donor_code', $donorCode);
        $this->db->where('ledger_type_code !=', '01');
        if($chartId ==1 || $chartId ==4)
        {
            $this->db->select('SUM(amount) AS amount', FALSE);
$this->db->where('trans_type', 'cr');
        }elseif ($chartId ==2 || $chartId ==3) {
            $this->db->select('SUM(amount) AS amount', FALSE);
$this->db->where('trans_type', 'dr');
        }else{
            
        }
      $query =  $this->db->get('gl_trans_info');
     
      return $query->result(); 
    }
    
    
    
}