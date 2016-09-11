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
      
     $user_id = $this->session->userdata('user_id');
             $username = $this->session->userdata('username');
             $committee_id = $this->session->userdata('committee_id');
             $committee_code = $this->session->userdata('committee_code');
             $fiscal_year = $this->session->userdata('fiscal_year'); 
             
             $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
             
      // $data['singleGLDetails'] = $this->transaction_model->get_single_transaction_details($id);
      $this->load->view('printPreview/print/templates/header');
      $this->load->view('printPreview/print/transaction/singleJournalEntryPrint', $data);
      $this->load->view('printPreview/print/templates/footer');
       }
        else 
        {
          redirect('login/index/?url=' . $url, 'refresh');
    }
  }
}