<?php

class Report_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    
    public function get_journal_entry_for_day($day) {
        $this->db->where('gl_trans_status', '1');
        $this->db->where('tran_date_english', $day);
        $this->db->group_by('journal_voucher_no');
        $this->db->select('*');
        $this->db->from('gl_trans_info');
$this->db->join('gl_trans_comment_details', 'gl_trans_comment_details.trans_no = gl_trans_info.journal_voucher_no');
//$this->db->join('ledger_master', 'ledger_master.ledger_master_code = gl_trans_info.ledger_master_code');
$query = $this->db->get();
 return $query->result();  
    }
    
    public function get_transaction_details_of_ledger_with_in_dates($ledger, $fromN, $fromE, $toN, $toE)
    {
        $this->db->where('ledger_master_code', $ledger);
        $this->db->where('gl_trans_status', '1');
        if(!empty($fromN) && (!empty($fromE))){ 
        $this->db->where('tran_date >=', $fromN);
        $this->db->where('tran_date_english >=', $fromE);
        }
         if(!empty($toN) && (!empty($toE))){
        $this->db->where('tran_date <=', $toN);
        $this->db->where('tran_date_english <=', $toE);
         }
        $this->db->select('*');
        $this->db->from('gl_trans_info');
$this->db->join('gl_trans_comment_details', 'gl_trans_comment_details.trans_no = gl_trans_info.journal_voucher_no');
//$this->db->join('ledger_master', 'ledger_master.ledger_master_code = gl_trans_info.ledger_master_code');
$query = $this->db->get();
 return $query->result();  
    }
    
    public function get_transaction_details_of_sub_ledger_with_in_dates($subledger, $fromN, $fromE, $toN, $toE)
    {
        $this->db->where('sub_ledger_code', $subledger);
        $this->db->where('gl_trans_status', '1');
        if(!empty($fromN) && (!empty($fromE))){ 
        $this->db->where('tran_date >=', $fromN);
        $this->db->where('tran_date_english >=', $fromE);
        }
         if(!empty($toN) && (!empty($toE))){
        $this->db->where('tran_date <=', $toN);
        $this->db->where('tran_date_english <=', $toE);
         }
        $this->db->select('*');
        $this->db->from('gl_trans_info');
$this->db->join('gl_trans_comment_details', 'gl_trans_comment_details.trans_no = gl_trans_info.journal_voucher_no');
//$this->db->join('ledger_master', 'ledger_master.ledger_master_code = gl_trans_info.ledger_master_code');
$query = $this->db->get();
 return $query->result();  
    }
    
    public function get_sum_of_amount_for_donar_by_code($donorCode)
    {

     $query = $this->db->query("SELECT SUM(CASE WHEN gl_code = '01' OR gl_code = '04' THEN amount END) AS t_amount,
       SUM(CASE WHEN gl_code = '02' OR gl_code = '03' THEN amount END) AS t_amount
  FROM gl_trans_info where (ledger_master_code=$donorCode AND gl_trans_status ='1')")->result();;
        
      if(!empty($query)){
           return $query[0]->t_amount;
               }else{
                   return '0';
               }   
       
        
        
//  
//        if('gl_trans_info.gl_code' =='01' || 'gl_trans_info.gl_code' =='04')
//        {
//            $this->db->select('SUM(amount) AS amount', FALSE);
//$this->db->where('trans_type', 'dr');
//        }elseif ('gl_trans_info.gl_code' =='02' || 'gl_trans_info.gl_code' =='03') {
//            $this->db->select('SUM(amount) AS amount', FALSE);
//$this->db->where('trans_type', 'cr');
//        }else{
//            
//        }
//      $query =  $this->db->get('gl_trans_info');
     
     
    }
    
    public function get_sum_of_expenditure_to_last_date($donorCode, $fromN, $fromE)
    {

     $query = $this->db->query("SELECT SUM(CASE WHEN gl_code = '02' OR gl_code = '03' THEN amount END) AS t_amount,
       SUM(CASE WHEN gl_code = '01' OR gl_code = '04' THEN amount END) AS t_amount
  FROM gl_trans_info where (donor_code=$donorCode  AND gl_trans_status ='1')")->result();
   
   if(!empty($query)){
           return $query[0]->t_amount;
               }else{
                   return '0';
               }
    }
    //AND tran_date <= $fromN AND tran_date_english <= $fromE
    public function get_sum_of_expenditure_from_last_report_to_now($donorCode, $fromN, $fromE, $toN, $toE)
    {
        $query = $this->db->query("SELECT SUM(CASE WHEN gl_code = '02' OR gl_code = '03' THEN amount END) AS t_amount,
       SUM(CASE WHEN gl_code = '01' OR gl_code = '04' THEN amount END) AS t_amount
  FROM gl_trans_info where (donor_code=$donorCode AND tran_date > $fromN AND tran_date_english > $fromE AND tran_date <= $toN AND tran_date_english <= $toE AND gl_trans_status ='1')")->result();
      
   if(!empty($query)){
           return $query[0]->t_amount;
               }else{
                   return '0';
               }
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
    
    public function get_sum_of_amounts_for_dr_of_ledger_master_from_journal_entry($code, $fromE, $fromN, $toE, $toN)
    {
        if(!empty($fromN) && (!empty($fromE))){ 
        $this->db->where('tran_date >=', $fromN);
        $this->db->where('tran_date_english >=', $fromE);
        }
         if(!empty($toN) && (!empty($toE))){
        $this->db->where('tran_date <=', $toN);
        $this->db->where('tran_date_english <=', $toE);
         }
        $this->db->where('gl_trans_status', '1');
        $this->db->where('ledger_master_code', $code);    
        $this->db->select_sum('amount');
        $this->db->where('trans_type', 'dr');        
      $query =  $this->db->get('gl_trans_info')->result();    
     if(!empty($query)){
                return $query[0]->amount;
               }else{
                   return '0';
               }
    
    }
    
    public function get_sum_of_amounts_for_cr_of_ledger_master_from_journal_entry($code, $fromE, $fromN, $toE, $toN)
    {
        if(!empty($fromN) && (!empty($fromE))){ 
        $this->db->where('tran_date >=', $fromN);
        $this->db->where('tran_date_english >=', $fromE);
        }
         if(!empty($toN) && (!empty($toE))){
        $this->db->where('tran_date <=', $toN);
        $this->db->where('tran_date_english <=', $toE);
         }
        $this->db->where('gl_trans_status', '1');
        $this->db->where('ledger_master_code', $code);    
         $this->db->select_sum('amount');
        $this->db->where('trans_type', 'cr');        
      $query =  $this->db->get('gl_trans_info')->result();    
      if(!empty($query)){
           return $query[0]->amount;
               }else{
                   return '0';
               }
    
    }
    
    public function get_sum_of_amounts_for_ledger_master_from_journal_entry($code, $fromE, $fromN, $toE, $toN)
    {
        if(!empty($fromN) && (!empty($fromE))){ 
        $this->db->where('tran_date >=', $fromN);
        $this->db->where('tran_date_english >=', $fromE);
        }
         if(!empty($toN) && (!empty($toE))){
        $this->db->where('tran_date <=', $toN);
        $this->db->where('tran_date_english <=', $toE);
         }
        $this->db->where('gl_trans_status', '1');
        $this->db->where('ledger_master_code', $code);    
         $this->db->select_sum('amount');    
      $query =  $this->db->get('gl_trans_info')->result();    
      if(!empty($query)){
           return $query[0]->amount;
               }else{
                   return '0';
               }
    }
    
    
    
    
    
}