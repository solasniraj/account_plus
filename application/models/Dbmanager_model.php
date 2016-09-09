    <?php

    class Dbmanager_model extends CI_Model {

        public function __construct() {
            $this->load->database();
        }

        public function check_database_for_first_time()
        {
            $this->db->where('status', '1');
            $query = $this->db->get('committee_info');
            if ($query->num_rows() == 1) {
              $user_id=$query->row()->id;
             
              return true;
          } else {
            return FALSE;
        }
        }

        public function add_committee($commiteName, $address, $phone)
        {
            //$this->session->set_userdata("committee_code",'12345');
            $data = Array(
            'committee_name' => $commiteName,
            'address' => $address,
                'phone' => $phone,
                'code' => '12345',
                'status' => '1');
       return  $this->db->insert('committee_info', $data);
        
        }
        
        public function get_latest_unlocked_fiscal_year_start_date()
        {
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

        public function add_fiscal_year($commiteName, $fiscalYear)
        {
           // $this->session->set_userdata("fiscalYear",'16');
            $data = Array(
            'committee_name' => $commiteName,
            'fiscal_year' => $fiscalYear,
                'status' => '1');
       return  $this->db->insert('fiscal_year_info', $data);
        }



        
   


    }