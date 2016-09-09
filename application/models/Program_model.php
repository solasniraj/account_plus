  <?php

  class Program_model extends CI_Model {

    public function __construct() 
    {
     $this->load->database();
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
   
   public function count_active_sub_ledgers()
   {
       $query = $this->db->query("SELECT * FROM subledger_info where `subledger_status`='active' ");
  return $query->num_rows();   
   }
   
   public function count_active_programs()
   {
       $query = $this->db->query("SELECT * FROM programs_list where `status`='Active' ");
  return $query->num_rows();   
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

  public function addSubLedger($subLedgerName,$currentProgramId, $newsubLedgerCode)
  {

   $data = Array(
    'subledger_name' => $subLedgerName,
    'subledger_code' => $newsubLedgerCode,
    'subledger_status'=>'active',
    'program_id' => $currentProgramId);

    $this->db->insert('subledger_info', $data);
    return $this->db->insert_id();
  }
  
  public function get_chart_class_master()
  {
    $this->db->order_by('account_code', 'ASC');
   // $this->db->group_by('chart_class_id');
    $query = $this->db->get("chart_master");
    return $query->result();
  

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