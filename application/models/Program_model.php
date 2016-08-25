<?php

class Program_model extends CI_Model {

  public function __construct() 
  {
   $this->load->database();
 }


 function insert_programm_listing($id, $programName)
 {

  $data = Array(
    'code' => 00531,
    'program_name' => $programName,
    'user_id' =>$id
    );

  return  $this->db->insert('programs_list', $data);
}


function  view_programm_listing($id) 
{

  $this->db->order_by('id', 'DESC');
  $this->db->where('user_id', $id);
  $query = $this->db->get("programs_list");
  return $query->result();

}

public function addSubLedger($name,$id)
{

 $data = Array(
  'subledger_name' => $name,
  'subledger_code' =>34343,
  'subledger_status'=>'active',
  );

  $this->db->insert('subledger_info', $data);
  return $this->db->insert_id();

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
 // code for geting all subLegders;

   $this->db->where_in('id', $subLegderIdlist);
   return $this->db->get("subledger_info")->result();
 
   

}



}