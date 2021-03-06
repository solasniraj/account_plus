    <?php

    class Dbmanager_model extends CI_Model {

        public function __construct() {
            $this->load->database();
        }
        
        public function add_committee_default_user_fiscal_year($dataCommittee, $dataFiscalYear, $dataUser, $dataSuper)
        {
            $this->db->trans_start();
            
           $this->db->insert('committee_info', $dataCommittee);
       $id = $this->db->insert_id();
$q = $this->db->get_where('committee_info', array('id' => $id));

$committeeId = $q->row()->id; 
$committeeCode = $q->row()->code;

            $dataFiscalYear['committee_code'] = $committeeCode;
            $dataFiscalYear['committee_id'] = $committeeId;
        $dataUser['committee_id'] = $committeeId;
        $dataUser['committee_code'] = $committeeCode;
 $dataSuper['committee_id'] = $committeeId;
         $dataSuper['committee_code'] = $committeeCode;
  $this->db->insert('fiscal_year_info', $dataFiscalYear);
 $this->db->insert('user_info', $dataUser);
 $this->db->insert('user_info', $dataSuper);
 $this->db->trans_complete();
 
 if ($this->db->trans_status() === FALSE) {
    # Something went wrong.
    $this->db->trans_rollback();
    return FALSE;
} 
else {
    # Everything is Perfect. 
    # Committing data to the database.
    $this->db->trans_commit();
    return TRUE;
}
 
        }

        public function get_committee_info($committee_id, $committee_code)
        {
            $this->db->where('id', $committee_id);
            $this->db->where('code', $committee_code);
           $this->db->where('status', '1');
            $query = $this->db->get('committee_info');
             return $query->result(); 
        }

        public function get_fiscal_year_code_by_year($fiscalYear)
        {
            $this->db->where('status', '1');
            $this->db->where('fiscal_year', $fiscalYear);
            $this->db->select('fiscal_code');
               $query= $this->db->get("fiscal_year_info")->result();
               if(!empty($query)){
           return $query[0]->fiscal_code;
               }else{
                   return '0';
               }
        }
        
        public function get_latest_unlocked_fiscal_year_info($fiscal_year, $fiscalCode)
        {
            $this->db->where('status', '1');
            $this->db->where('fiscal_year', $fiscal_year);
            $this->db->where('fiscal_code', $fiscalCode);
            $this->db->where('is_closed', '0');
            $query= $this->db->get("fiscal_year_info");
               return $query->result(); 
        }

                public function check_database_for_first_time()
        {
            $this->db->where('status', '1');
            $query = $this->db->get('committee_info');
            if ($query->num_rows() == 1) {          
              return true;
          } else {
            return FALSE;
        }
        }

        
        public function get_latest_unlocked_fiscal_year_start_date()
        {
            $this->db->where('status', '1');
            //$this->db->where('is_closed', '1');
            $this->db->select_max('begin_date');
               $query= $this->db->get("fiscal_year_info")->result();
               if(!empty($query)){
           return $query[0]->begin_date;
               }else{
                   return '0';
               }
        }
        
        public function get_latest_unlocked_fiscal_year_end_date()
        {
            $this->db->select_max('end_date');
               $query= $this->db->get("fiscal_year_info")->result();
               if(!empty($query)){
           return $query[0]->end_date;
               }else{
                   return '0';
               }
        }

        public function get_fiscal_year()
        {
            
               $query= $this->db->get("fiscal_year_info");
               return $query->result(); 
        }

        
   


    }