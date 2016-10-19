<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class preview extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('program_model');
       $this->load->model('bank_model');
        $this->load->model('transaction_model');
        $this->load->model('dbmanager_model');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
        $this->load->helper('csv');
        $this->load->library('Numbertowords');
        if(is_trans_pending())  // if you add in constructor no need write each function in above controller. 
        {
          $this->session->set_flashdata('flashMessage', 'Please take action on draft journals first to make journal entry.');
         redirect('transaction/journalList', 'refresh');
        }
    }
    
    public function index()
    {
         $url = current_url();
        if ($this->session->userdata('logged_in') == true) {
            
       } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function jounalView($id=null) {
        
        
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) {
$glNo = urldecode($id);
        $glNos = str_replace('&#47;', '/', $glNo);
            $orientation = 'landscape';
             $committee_id = $this->session->userdata('committee_id');
             $committee_code = $this->session->userdata('committee_code');
        $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
        $data['singleGLDetails'] = $this->transaction_model->get_single_transaction_details($glNos);     
            $this->load->view('printPreview/download/templates/header');
      $this->load->view('printPreview/download/transaction/singleJournalEntryPrint', $data);
      $this->load->view('printPreview/download/templates/footer');
            // Get output html
            $html = $this->output->get_output();
            // Load library
            $this->load->library('dompdf_gen');

            // Convert to PDF
            $this->dompdf->load_html($html);
            $this->dompdf->set_paper('a4', $orientation);
//            $this->dompdf->set_option('isHtml5ParserEnabled', true);
            $this->dompdf->render();
            $this->dompdf->stream($glNos.".pdf");
            die;
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function csv($filename = 'CSV_Report.csv') {
        $this->load->dbutil();
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "rn";
        $query = $this->db->query("select * from `bank_info`");
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download($filename, $data);
    }

    public function createCsv() {

        $query = $this->db->query('SELECT * FROM  `bank_info`');
        $num = $query->num_fields();
        $var = array();
        $i = 1;
        $fname = "";
        while ($i <= $num) {
            $test = $i;
            $value = $this->input->post($test);

            if ($value != '') {
                $fname = $fname . " " . $value;
                array_push($var, $value);
            }
            $i++;
        }

        $fname = trim($fname);

        $fname = str_replace(' ', ',', $fname);

        $this->db->select($fname);
        $quer = $this->db->get('bank_info');

        query_to_csv($quer, TRUE, 'bank_info_' . date('dMy') . '.csv');
    }
    
    public function jounalViewtds($id) {
        
        
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) {

            $orientation = 'landscape';       
        
     $url = current_url();
         if( $id === NULL )
         {
          return redirect('dashboard', 'refresh');
         }
      
     $user_id = $this->session->userdata('user_id');
             $username = $this->session->userdata('username');
             $committee_id = $this->session->userdata('committee_id');
             $committee_code = $this->session->userdata('committee_code');
             $fiscal_year = $this->session->userdata('fiscal_year'); 
             
             $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
        $data['singleGLDetails'] = $this->transaction_model->get_single_transaction_details($id);     
      
      $this->load->view('printPreview/download/templates/header');
      $this->load->view('printPreview/download/transaction/singleJournalEntryPrint', $data);
      $this->load->view('printPreview/download/templates/footer');
    
         
            // Get output html
            $html = $this->output->get_output();

            // Load library
            $this->load->library('dompdf_gen');

            // Convert to PDF
            $this->dompdf->load_html($html);
            $this->dompdf->set_paper('a4', $orientation);
            $this->dompdf->render();
            $this->dompdf->stream("Journal.pdf");
            die;
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    public function ledgerReport()
    {
       $url = current_url();
        if ($this->session->userdata('logged_in') == true) { 
      $user_id = $this->session->userdata('user_id');
             $username = $this->session->userdata('username');
             $committee_id = $this->session->userdata('committee_id');
             $committee_code = $this->session->userdata('committee_code');
             $fiscal_year = $this->session->userdata('fiscal_year');      
            
             $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
       
      
      $this->load->view('printPreview/download/templates/header');
      $this->load->view('printPreview/download/report/ledgerReport', $data);
      $this->load->view('printPreview/download/templates/footer');
    
         
            // Get output html
            $html = $this->output->get_output();

            // Load library
            $this->load->library('dompdf_gen');

            // Convert to PDF
            $this->dompdf->load_html($html);
            $this->dompdf->set_paper('a4', $orientation);
            $this->dompdf->render();
            $this->dompdf->stream("Journal.pdf");
            die;
            
     } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    public function subLedgerReport()
    {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) { 
      $user_id = $this->session->userdata('user_id');
             $username = $this->session->userdata('username');
             $committee_id = $this->session->userdata('committee_id');
             $committee_code = $this->session->userdata('committee_code');
             $fiscal_year = $this->session->userdata('fiscal_year');      
            
             $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
       
      
      $this->load->view('printPreview/download/templates/header');
      $this->load->view('printPreview/download/report/subLedgerReport', $data);
      $this->load->view('printPreview/download/templates/footer');
    
         
            // Get output html
            $html = $this->output->get_output();

            // Load library
            $this->load->library('dompdf_gen');

            // Convert to PDF
            $this->dompdf->load_html($html);
            $this->dompdf->set_paper('a4', $orientation);
            $this->dompdf->render();
            $this->dompdf->stream("Journal.pdf");
            die;
            
     } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    public function donorReport()
    {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) { 
      $user_id = $this->session->userdata('user_id');
             $username = $this->session->userdata('username');
             $committee_id = $this->session->userdata('committee_id');
             $committee_code = $this->session->userdata('committee_code');
             $fiscal_year = $this->session->userdata('fiscal_year');      
            
             $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
       
      
      $this->load->view('printPreview/download/templates/header');
      $this->load->view('printPreview/download/report/donorReport', $data);
      $this->load->view('printPreview/download/templates/footer');
    
         
            // Get output html
            $html = $this->output->get_output();

            // Load library
            $this->load->library('dompdf_gen');

            // Convert to PDF
            $this->dompdf->load_html($html);
            $this->dompdf->set_paper('a4', $orientation);
            $this->dompdf->render();
            $this->dompdf->stream("Journal.pdf");
            die;
            
     } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    public function dayBook()
    {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) { 
      $user_id = $this->session->userdata('user_id');
             $username = $this->session->userdata('username');
             $committee_id = $this->session->userdata('committee_id');
             $committee_code = $this->session->userdata('committee_code');
             $fiscal_year = $this->session->userdata('fiscal_year');      
            
             $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
       
      
      $this->load->view('printPreview/download/templates/header');
      $this->load->view('printPreview/download/report/dayBook', $data);
      $this->load->view('printPreview/download/templates/footer');
    
         
            // Get output html
            $html = $this->output->get_output();

            // Load library
            $this->load->library('dompdf_gen');

            // Convert to PDF
            $this->dompdf->load_html($html);
            $this->dompdf->set_paper('a4', $orientation);
            $this->dompdf->render();
            $this->dompdf->stream("Journal.pdf");
            die;
            
     } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    public function iEReport()
    {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) { 
      $user_id = $this->session->userdata('user_id');
             $username = $this->session->userdata('username');
             $committee_id = $this->session->userdata('committee_id');
             $committee_code = $this->session->userdata('committee_code');
             $fiscal_year = $this->session->userdata('fiscal_year');      
            
             $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
       
      
      $this->load->view('printPreview/download/templates/header');
      $this->load->view('printPreview/download/report/iEReport', $data);
      $this->load->view('printPreview/download/templates/footer');
    
         
            // Get output html
            $html = $this->output->get_output();

            // Load library
            $this->load->library('dompdf_gen');

            // Convert to PDF
            $this->dompdf->load_html($html);
            $this->dompdf->set_paper('a4', $orientation);
            $this->dompdf->render();
            $this->dompdf->stream("Journal.pdf");
            die;
            
     } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    public function balanceSheet()
    {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) { 
      $user_id = $this->session->userdata('user_id');
             $username = $this->session->userdata('username');
             $committee_id = $this->session->userdata('committee_id');
             $committee_code = $this->session->userdata('committee_code');
             $fiscal_year = $this->session->userdata('fiscal_year');      
            
             $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
       
      
      $this->load->view('printPreview/download/templates/header');
      $this->load->view('printPreview/download/report/balanceSheet', $data);
      $this->load->view('printPreview/download/templates/footer');
    
         
            // Get output html
            $html = $this->output->get_output();

            // Load library
            $this->load->library('dompdf_gen');

            // Convert to PDF
            $this->dompdf->load_html($html);
            $this->dompdf->set_paper('a4', $orientation);
            $this->dompdf->render();
            $this->dompdf->stream("Journal.pdf");
            die;
            
     } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    public function trialBalance()
    {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) { 
      $user_id = $this->session->userdata('user_id');
             $username = $this->session->userdata('username');
             $committee_id = $this->session->userdata('committee_id');
             $committee_code = $this->session->userdata('committee_code');
             $fiscal_year = $this->session->userdata('fiscal_year');      
            
             $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
       
      
      $this->load->view('printPreview/download/templates/header');
      $this->load->view('printPreview/download/report/trialBalance', $data);
      $this->load->view('printPreview/download/templates/footer');
    
         
            // Get output html
            $html = $this->output->get_output();

            // Load library
            $this->load->library('dompdf_gen');

            // Convert to PDF
            $this->dompdf->load_html($html);
            $this->dompdf->set_paper('a4', $orientation);
            $this->dompdf->render();
            $this->dompdf->stream("Journal.pdf");
            die;
            
     } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    
    
    
    

}
