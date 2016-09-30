<?php

class Transaction_model extends CI_Model {

    var $column_order = array(null, 'journal_voucher_no','memo','tran_date','amount','gl_trans_status','id'); //set column field database for datatable orderable
    var $column_search = array('journal_voucher_no','ledger_master_description','ledger_master_code','memo','amount','tran_date'); //set column field database for datatable searchable 
    var $order = array('journal_voucher_no' => 'desc'); // default order 
    
    public function __construct() {
        $this->load->database();
    }
    
    public function get_bank_details_by_subledger_id($subLedger_id)
    {
        $this->db->where('subledger_code', $subLedger_id);
        $this->db->where('status', '1');
            $query = $this->db->get('bank_info')->result();
               if(!empty($query)){
           return $query[0]->id;
               }else{
                   return ' ';
               }
    }
    
    public function add_transaction_to_bank_transaction($journalNo, $datepicker, $lmcode, $description, $debitAmount, $bankId, $type)
    {
        $data = Array(
            'trans_no' => $journalNo,  
            'type' => $type,
            'trans_date' => $datepicker,
            'ledger_master_code' => $lmcode,
            'memo' => $description,
                'amount' => $debitAmount,
                'bank_id' => $bankId,
                'status' => '1');
       return  $this->db->insert('bank_trans_info', $data);
    }

    
    private function _get_datatables_query()
    {        
       $this->db->distinct();
        $this->db->group_by('journal_voucher_no');
        $this->db->select('*');
        $this->db->from('gl_trans_info');
        $this->db->join('gl_trans_comment_details', 'gl_trans_comment_details.trans_no = gl_trans_info.journal_voucher_no');
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->distinct();
        $this->db->group_by('journal_voucher_no');
        $this->db->from('gl_trans_info');
        return $this->db->count_all_results();
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
    
    public function add_comment_of_transaction($journalNo, $comment)
    {
        $data = Array(
            'trans_no' => $journalNo,
                'detailed_comment' => $comment
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
    
    public function get_donar_name_by_code($donorCode)
    {
        $this->db->where('donar_code', $donorCode);
        $this->db->where('status', '1');
      $query= $this->db->get("donar_info")->result();
               if(!empty($query)){
           return $query[0]->donar_name;
               }else{
                   return ' ';
               }
    }
    
    
    
    
}