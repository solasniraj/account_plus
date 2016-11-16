  <?php

  class ledger_model extends CI_Model {
    var $table = 'ledger_master';
      var $column_order = array(null, 'ledger_master_code','ledger_master_name','id'); //set column field database for datatable orderable
    var $column_search = array('ledger_master_code','ledger_master_name','ledger_master_code','status'); //set column field database for datatable searchable 
    var $order = array('id' => 'desc'); // default order 
      
     
    public function __construct() 
    {
     $this->load->database();
   }
   
   private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
 
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
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
   
    public function get_subledger_details($accSubLedger)
    {
        $this->db->where('subledger_code', $accSubLedger);
        $this->db->where('subledger_status', '1');
            $query = $this->db->get('subledger_info');
             return $query->result();
    }

    



    public function search_ledger_by_key_or_description($searchKey)
   {
       $this->db->select('id, ledger_master_code, ledger_master_name');
        $this->db->where("status", "1");
        $where = "(ledger_master_code LIKE '%$searchKey%' 
          OR ledger_master_name LIKE '%$searchKey%')";
        $this->db->where($where);
        $query = $this->db->get('ledger_master');

        return $query->result(); 
   }
   
   public function check_for_code_in_existing_ledger($codeNo)
   {
       $this->db->where('ledger_master_code', $codeNo);         
       $query = $this->db->get('ledger_master');
            if ($query->num_rows() == 1) {
              return true;
          } else {
            return FALSE;
        }
   }

   public function search_ledger_master_for_submitted_key($searchKey)
   {
       $this->db->select('id, ledger_master_code, ledger_master_name');
        $this->db->where("status", "1");
        $where = "(ledger_master_code LIKE '%$searchKey%' 
          OR ledger_master_name LIKE '%$searchKey%')";
        $this->db->where($where);
        $query = $this->db->get('ledger_master');
        return $query->result(); 
   }
                 
     public function get_all_ledger()
        {
            $this->db->where('account_ledger_status', '1');
            $query = $this->db->get('account_ledger_info');
             return $query->result();
        }

             
        public function get_all_subledger()
        {

          $this->db->where('subledger_status', '1');
          $query = $this->db->get('subledger_info');
           return $query->result();
        }

   
   
   public function search_ledger_master_for_submitted_key_only_in_code($searchKey)
   {
       $this->db->select('id, ledger_master_code, ledger_master_name');
        $this->db->where("status", "1");
        $where = "(ledger_master_code LIKE '%$searchKey%')";
        $this->db->where($where);
        $query = $this->db->get('ledger_master');
        return $query->result(); 
   }

   public function get_account_chart_class()
        {
            $this->db->where('chart_status', '1');
            $query = $this->db->get('chart_class');
             return $query->result();
        }
        
        public function get_account_ledger_by_chard_class_id($currentCharClassId)
        {
           
$query = $this->db->query("SELECT DISTINCT account_ledger_info.id, account_ledger_info.ledger_code, account_ledger_info.ledger_name FROM `account_ledger_info` JOIN `ledger_master` ON `account_ledger_info`.`ledger_code` = `ledger_master`.`ledger_code` WHERE `ledger_master`.`account_code` = $currentCharClassId ");
     return $query->result();         
                
        }
        
        public function get_account_sub_ledger_by_chard_class_id($currentCharClassId)
        {
            $query = $this->db->query("SELECT DISTINCT subledger_info.id, subledger_info.subledger_code, subledger_info.subledger_name FROM `subledger_info` JOIN `ledger_master` ON `subledger_info`.`subledger_code` = `ledger_master`.`subledger_code` WHERE `ledger_master`.`account_code` = $currentCharClassId");
     return $query->result(); 
        }
        
        public function get_account_donor_by_chard_class_id($currentCharClassId)
        {
            $query = $this->db->query("SELECT DISTINCT donar_info.id, donar_info.donar_code, donar_info.donar_name FROM `donar_info` JOIN `ledger_master` ON `donar_info`.`donar_code` = `ledger_master`.`donor_code` WHERE `ledger_master`.`account_code` = $currentCharClassId");
     return $query->result(); 
        }
        
        public function get_account_ledger_type_by_chard_class_id($currentCharClassId)
        {
             $query = $this->db->query("SELECT DISTINCT ledger_type_info.id, ledger_type_info.ledger_type_code, ledger_type_info.ledger_type_name FROM `ledger_type_info` JOIN `ledger_master` ON `ledger_type_info`.`ledger_type_code` = `ledger_master`.`ledger_type_code` WHERE `ledger_master`.`account_code` = $currentCharClassId");
     return $query->result(); 
        }

        public function get_subledger_of_ledger($accountId, $currentCharClassId)
        {
            $query = $this->db->query("SELECT DISTINCT subledger_info.id, subledger_info.subledger_code, subledger_info.subledger_name FROM `subledger_info` JOIN `ledger_master` ON `subledger_info`.`subledger_code` = `ledger_master`.`subledger_code` WHERE (`ledger_master`.`ledger_code` = $accountId && `ledger_master`.`account_code` = $currentCharClassId)");
            return $query->result();  
        }

        public function get_account_donor_by_chard_class_id_and_ledger($accountId, $currentCharClassId)
        {
            $query = $this->db->query("SELECT DISTINCT donar_info.id, donar_info.donar_code, donar_info.donar_name FROM `donar_info` JOIN `ledger_master` ON `donar_info`.`donar_code` = `ledger_master`.`donor_code` WHERE (`ledger_master`.`ledger_code` = $accountId && `ledger_master`.`account_code` = $currentCharClassId)");
     return $query->result(); 
        }
        
        public function get_account_ledger_type_by_chard_class_id_and_ledger($accountId, $currentCharClassId)
        {
            $query = $this->db->query("SELECT DISTINCT ledger_type_info.id, ledger_type_info.ledger_type_code, ledger_type_info.ledger_type_name FROM `ledger_type_info` JOIN `ledger_master` ON `ledger_type_info`.`ledger_type_code` = `ledger_master`.`ledger_type_code` WHERE (`ledger_master`.`ledger_code` = $accountId && `ledger_master`.`account_code` = $currentCharClassId)");
     return $query->result(); 
        }
        
        public function get_donor_of_ledger_and_subledger($accountId, $currentCharClassId, $subLedgerId)
        {
            $query = $this->db->query("SELECT DISTINCT donar_info.id, donar_info.donar_code, donar_info.donar_name FROM `donar_info` JOIN `ledger_master` ON `donar_info`.`donar_code` = `ledger_master`.`donor_code` WHERE (`ledger_master`.`ledger_code` = $accountId && `ledger_master`.`account_code` = $currentCharClassId && `ledger_master`.`subledger_code` = $subLedgerId)");
     return $query->result(); 
        }
        
        public function get_account_ledger_type_by_chard_class_id_ledger_and_subledger($accountId, $currentCharClassId, $subLedgerId)
        {
            $query = $this->db->query("SELECT DISTINCT ledger_type_info.id, ledger_type_info.ledger_type_code, ledger_type_info.ledger_type_name FROM `ledger_type_info` JOIN `ledger_master` ON `ledger_type_info`.`ledger_type_code` = `ledger_master`.`ledger_type_code` WHERE (`ledger_master`.`ledger_code` = $accountId && `ledger_master`.`account_code` = $currentCharClassId && `ledger_master`.`subledger_code` = $subLedgerId)");
     return $query->result();
        }
        
        public function get_account_ledger_type_by_chard_class_id_ledger_subledger_and_donar($accountId, $currentCharClassId, $subLedgerId, $donar)
        {
            $query = $this->db->query("SELECT DISTINCT ledger_type_info.id, ledger_type_info.ledger_type_code, ledger_type_info.ledger_type_name FROM `ledger_type_info` JOIN `ledger_master` ON `ledger_type_info`.`ledger_type_code` = `ledger_master`.`ledger_type_code` WHERE (`ledger_master`.`ledger_code` = $accountId && `ledger_master`.`account_code` = $currentCharClassId && `ledger_master`.`subledger_code` = $subLedgerId && `ledger_master`.`donor_code` = $donar)");
     return $query->result();
        }
        
        public function check_ledger_master_for_code($mCode)
        {
             $this->db->where('ledger_master_code', $mCode);
            $this->db->where('status', '1');
            $query = $this->db->get('ledger_master');
            if ($query->num_rows() == 1) {
                return true;
            } else {
            return FALSE;
        }
        }

        








        public function get_account_ledger_info()
        {
            $this->db->where('account_ledger_status', '1');
            $query = $this->db->get('account_ledger_info');
             return $query->result();
        }

   public function add_new_ledger($newAccountCode, $ledgerName, $chartClass)
   {
       $data = Array(
      'ledger_code' => $newAccountCode,
      'ledger_name' => $ledgerName,
       'chart_class_code' => $chartClass,    
      'account_ledger_status' => '1'
      );

     $this->db->insert('account_ledger_info', $data);
     $insert_id = $this->db->insert_id();
     return  $insert_id;      
   }
   
   public function count_ledger()
   {
       $query = $this->db->query("SELECT * FROM account_ledger_info");
  return $query->num_rows();  
   }

   public function get_last_code_of_ledger($chartClass)
   {
       $this->db->where('chart_class_code', $chartClass);
       $this->db->where('account_ledger_status', '1');
              $this->db->select_max('ledger_code');
               $query= $this->db->get("account_ledger_info")->result();
               if(!empty($query)){
           return $query[0]->ledger_code;
               }else{
                   return '0';
               }
   }
   
   public function get_sub_ledger_info()
        {
            $this->db->where('subledger_status', '1');
            $query = $this->db->get('subledger_info');
             return $query->result();
        }
   
   public function add_new_sub_ledger($newAccountCode, $subledgerName)
   {
       $data = Array(
      'subledger_code' => $newAccountCode,
      'subledger_name' => $subledgerName,
      'subledger_status' => '1'
      );

     $this->db->insert('subledger_info', $data);
     $insert_id = $this->db->insert_id();
     return  $insert_id;  
   }

   public function get_last_code_of_subledger()
   {
        $this->db->select_max('subledger_code');
               $query= $this->db->get("subledger_info")->result();
               if(!empty($query)){
           return $query[0]->subledger_code;
               }else{
                   return '0';
               }
   }
   
    public function count_subledger()
   {
       $query = $this->db->query("SELECT * FROM subledger_info");
  return $query->num_rows();   
   }

   public function add_new_ledger_master($chartNo, $accLedger, $accSubLedger, $donorType, $ledgerType, $codeNo, $accDescription, $fiscalCode)
   {
       
       $data = Array(
      'ledger_master_code' => $codeNo,
      'ledger_master_name' => $accDescription,
           'account_code' => $chartNo,
           'ledger_code' => $accLedger,
           'subledger_code' => $accSubLedger,
           'donor_code' => $donorType,
           'ledger_type_code' => $ledgerType,
           'fiscal_code' => $fiscalCode,
      'status' => '1'
      );

     $this->db->insert('ledger_master', $data);
     $insert_id = $this->db->insert_id();
     return  $insert_id;       
   }
   
   public function get_ledger_master_listing()
   {
       $this->db->where('status', '1');
            $query = $this->db->get('ledger_master');
             return $query->result();
   }
   
   public function get_ledger_master_listing_of_income_and_expn()
   {
       $this->db->where('status', '1');
       $this->db->where('account_code', '03');
       $this->db->or_where('account_code', '04');
            $query = $this->db->get('ledger_master');
             return $query->result();
   }
   
   public function get_ledger_master_listing_of_assets_and_liability()
   {
       $this->db->where('status', '1');
       $this->db->where('account_code', '01');
       $this->db->or_where('account_code', '02');
            $query = $this->db->get('ledger_master');
             return $query->result();
   }

   public function get_ledger_master_name_by_code($lmCode)
   {
             $this->db->select('ledger_master_name');
             $this->db->where('status', '1');
             $this->db->where('ledger_master_code', $lmCode);
               $query= $this->db->get("ledger_master")->result();
               if(!empty($query)){
           return $query[0]->ledger_master_name;
               }else{
                   return '0';
               }
             
             
   }
   
   public function get_ledger_details_by_ledger_code($ledger)
   {
             $this->db->where('status', '1');
             $this->db->where('ledger_master_code', $ledger);
               $query= $this->db->get("ledger_master");
                return $query->result();
   }
   
   public function get_sub_ledger_info_by_code($subledger)
   {
       $this->db->where('subledger_status', '1');
             $this->db->where('subledger_code', $subledger);
               $query= $this->db->get("subledger_info");
                return $query->result();
   }
   
   public function get_all_donar()
        {
            $this->db->where('status', '1');
            $query = $this->db->get('donar_info');
             return $query->result();
        }

    public function get_ledger_master_associated_to_donar($donar)
    {
        $this->db->where('status', '1');
             $this->db->where('donor_code', $donar);
             $this->db->where('ledger_type_code', '01');
               $query= $this->db->get("ledger_master");
                return $query->result();
    }

    public function get_donor_info_by_code($donar)
    {
        $this->db->where('status', '1');
        $this->db->where('donar_code', $donar);
            $query = $this->db->get('donar_info');
             return $query->result();
    }

    public function get_account_ledger_info_by_account_code($accCode)
    {
         $this->db->select('ledger_name');
        $this->db->where('account_ledger_status', '1');
        $this->db->where('ledger_code', $accCode);
            $query = $this->db->get('account_ledger_info')->result();
             if(!empty($query)){
           return $query[0]->ledger_name;
               }else{
                   return NULL;
               }
             
    }

    









    public function get_last_code_of_program()
   {
              $this->db->select_max('program_code');
               $query= $this->db->get("programs_list")->result();
               if(!empty($query)){
           return $query[0]->program_code;
               }else{
                   return '0';
               }
   }
   
  
   
   public function count_active_programs()
   {
       $query = $this->db->query("SELECT * FROM programs_list where `status`='Active' ");
  return $query->num_rows();   
   }

        
   public function get_all_subledger_related_to_program($id)
   {
        $this->db->order_by('id', 'DESC');
    $this->db->where('program_id', $id);
    $query = $this->db->get("subledger_info");
    return $query->result();
   }
           
   function insert_programm_listing($id, $newProgramCode, $programName)
   {

    $data = Array(
      'program_code' => $newProgramCode,
      'program_name' => $programName,
      'user_id' =>$id
      );

     $this->db->insert('programs_list', $data);
     $insert_id = $this->db->insert_id();

     return  $insert_id;
  }


  function  view_programm_listing($id) 
  {

    $this->db->order_by('id', 'DESC');
    $this->db->where('user_id', $id);
    $query = $this->db->get("programs_list");
    return $query->result();

  }

  public function get_program_details($id, $user_id)
  {
      $this->db->where('id', $id);
    $this->db->where('user_id', $user_id);
    $query = $this->db->get("programs_list");
    return $query->result();
  }

  public function update_program($id, $programName, $user_id)
  {
      $this->db->where('id', $id);
       $data = array('program_name' => $programName);
    $this->db->where('user_id', $user_id);
    return $this->db->update('programs_list', $data);
  }

  
  
  public function updateProgrammSublederIds($subLegId, $prgmUpdateId)

  {
    
    $this->db->select('subledger_id');
    $this->db->where('id', $prgmUpdateId);
    $query = $this->db->get("programs_list");
    $result=$query->row();
    $subledgerIds =$result->subledger_id;
   if(empty($subledgerIds))
   {
     $updateSubledgerId= $subLegId;
   }
    else 
    {
     $updateSubledgerId=$subledgerIds."<##>".$subLegId;
    } 

    $data = Array(
      'subledger_id' => $updateSubledgerId,
      );

    $this->db->where('id', $prgmUpdateId);
    return $this->db->update('programs_list', $data);

  }

  public function viewSubLedgerofSingleProgramm($currentPrmId)

  {

     $this->db->select('subledger_id');
     $this->db->where('id', $currentPrmId);
     $query = $this->db->get("programs_list");
     $data=$query->row()->subledger_id;
     $subLegderIdlist= explode("<##>",$data);
     $this->db->where_in('id', $subLegderIdlist);
     return $this->db->get("subledger_info")->result();
   
    
  }



  function getCurrentJournalNumer()

  {

    $table_row_count = $this->db->count_all('gl_trans_info');
    return  $table_row_count + 1;

  }

  function getJournalTypes()
  {
    
   return  $this->db->get("chart_class")->result();

  }


  function getProgrammListForCurrentChartName($id)
  {

    $this->db->order_by('id', 'DESC');
    $this->db->where('chart_class_id',$id);
    return $this->db->get("chart_master")->result();

  }

  function getSingleProgramCode($id)
  {

    $this->db->where('id',$id);
    return $this->db->get("chart_master")->row();

  }


  function getSingleProgramSubledgers($id)
  {

   $this->db->where('program_id',$id);
   return $this->db->get("subledger_info")->result();

  }

  function getSingleProgramDonerIdsFromDonarBudgetInfo($id)
  {
     $this->db->select('donar_id');
     $this->db->where('program_id',$id);
     return $this->db->get("donar_budget_info")->result();
  }

  function getdonerListFromProgamBydonerId($ids)
  { 

       if(count($ids))
       {
        $this->db->order_by('id', 'DESC');
       $this->db->where_in('id',$ids);
       return $this->db->get("donar_info")->result();

       }
       return "";
  

  }







  }