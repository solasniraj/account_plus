    <?php

    class Donar_model extends CI_Model {

        public function __construct() {
            $this->load->database();
        }

        public function get_all_donar()
        {
            $this->db->where('status', '1');
            $query = $this->db->get('donar_info');
             return $query->result();
        }
        
        public function get_last_code_of_donor()
        {
            $this->db->select_max('donar_code');
               $query= $this->db->get("donar_info")->result();
               if(!empty($query)){
           return $query[0]->donar_code;
               }else{
                   return '0';
               }
        }
        
        public function count_donars()
        {
            $query = $this->db->query("SELECT * FROM donar_info");
  return $query->num_rows(); 
        }

        public function add_new_donar($newDCode, $donarName,$donarAddress, $emailId, $contactNumber, $contactPerson, $contactPCellNo)
        {
            $data = Array(
            'donar_name' => $donarName,
            'donar_address' => $donarAddress,
                'donar_contact_no' => $contactNumber,
                'donar_code' => $newDCode,
                'donar_email' => $emailId,
                'contact_person' => $contactPerson,
                'contact_person_cell_no' => $contactPCellNo,
                'status' => '1');
       return  $this->db->insert('donar_info', $data);

        }

     public function getAllDonarsByUserid($user_id)

   {

      $this->db->where('status', '1');
      $this->db->where('user_id', $user_id);
      $query = $this->db->get('donar_info');
      return $query->result();


    }
    
    public function get_all_assigned_donors_to_program($progId)
    {
         $this->db->where('program_id', $progId);
      $query = $this->db->get('donar_budget_info');
      return $query->result();
    }

    public function assign_donor_to_program($donarName,$budget, $programId)
    {
         $data = Array(
            'donar_id' => $donarName,
            'donation_amount' => $budget,
                'program_id' => $programId);
       return  $this->db->insert('donar_budget_info', $data);
    }

    public function get_donor_info($id)
    {
        $this->db->where('id', $id);
      $query = $this->db->get('donar_info');
      return $query->result();
    }

        
   


    }