    <?php

    class Donar_model extends CI_Model {

        public function __construct() {
            $this->load->database();
        }

        public function get_all_donars()
        {
            $this->db->where('status', 'Active');
            $query = $this->db->get('donar_info');
             return $query->result();
        }

        public function add_new_donar($donarName,$donarAddress, $emailId, $contactNumber, $donarCode)
        {
            $data = Array(
            'donar_name' => $donarName,
            'donar_address' => $donarAddress,
                'donar_contact_no' => $contactNumber,
                'donar_code' => $donarCode,
                'donar_email' => $emailId,
                'user_id' => NULL,
                'committee_id' => NULL,
                'status' => 'Active');
       return  $this->db->insert('donar_info', $data);

        }

     public function getAllDonarsByUserid($user_id)

   {

      $this->db->where('status', 'Active');
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