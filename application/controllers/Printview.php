  <?php if (!defined('BASEPATH'))
  exit('No direct script access allowed');
  class printview extends CI_Controller {
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
    
    public function printJoural($id= NULL )
    {
     if ($this->session->userdata('logged_in') == true)
      {
         $url = current_url();
         if( $id === NULL )
         {
          return redirect('dashboard', 'refresh');
         }
      $glNo = urldecode($id);
        $glNos = str_replace('&#47;', '/', $glNo);
     $user_id = $this->session->userdata('user_id');
             $username = $this->session->userdata('username');
             $committee_id = $this->session->userdata('committee_id');
             $committee_code = $this->session->userdata('committee_code');
             $fiscal_year = $this->session->userdata('fiscal_year'); 
             
             $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
        $data['singleGLDetails'] = $this->transaction_model->get_single_transaction_details($glNos);     
      
      $this->load->view('printPreview/printView/templates/header');
      $this->load->view('printPreview/printView/transaction/singleJournalEntryPrint', $data);
      $this->load->view('printPreview/printView/templates/footer');
       }
        else 
        {
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
       
             $this->load->view('printPreview/printView/templates/header');
      $this->load->view('printPreview/printView/report/trialBalance', $data);
      $this->load->view('printPreview/printView/templates/footer');
      
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
       
             $this->load->view('printPreview/printView/templates/header');
      $this->load->view('printPreview/printView/report/trialBalance', $data);
      $this->load->view('printPreview/printView/templates/footer');
      
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
       
             $this->load->view('printPreview/printView/templates/header');
      $this->load->view('printPreview/printView/report/trialBalance', $data);
      $this->load->view('printPreview/printView/templates/footer');
      
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
       
             $this->load->view('printPreview/printView/templates/header');
      $this->load->view('printPreview/printView/report/trialBalance', $data);
      $this->load->view('printPreview/printView/templates/footer');
      
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
       
             $this->load->view('printPreview/printView/templates/header');
      $this->load->view('printPreview/printView/report/trialBalance', $data);
      $this->load->view('printPreview/printView/templates/footer');
      
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
       
             $this->load->view('printPreview/printView/templates/header');
      $this->load->view('printPreview/printView/report/trialBalance', $data);
      $this->load->view('printPreview/printView/templates/footer');
      
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
       
             $this->load->view('printPreview/printView/templates/header');
      $this->load->view('printPreview/printView/report/trialBalance', $data);
      $this->load->view('printPreview/printView/templates/footer');
             
             
     } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
}