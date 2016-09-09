  <?php if (!defined('BASEPATH'))
  exit('No direct script access allowed');
  class prints extends CI_Controller {
    function __construct() {
      parent::__construct();
      $this->load->library('session');
      $this->load->model('program_model');
       $this->load->model('bank_model');
        $this->load->model('transaction_model');
       
      $this->load->helper('url');
      $this->load->helper(array('form', 'url'));
      $this->load->library('pagination');
    }

    public function singleJournalEntryPrint($id= NULL )
    {
     if ($this->session->userdata('logged_in') == true)
      {
         $url = current_url();
         if( $id === NULL )
         {
          return redirect('dashboard', 'refresh');
         }
      
      // $userId = $this->session->userdata("user_id");
      // $data['singleGLDetails'] = $this->transaction_model->get_single_transaction_details($id);
      $this->load->view('printPreview/print/templates/header');
      $this->load->view('printPreview/print/transaction/singleJournalEntryPrint');
      $this->load->view('printPreview/print/templates/footer');
       }
        else 
        {
          redirect('login/index/?url=' . $url, 'refresh');
    }
  }
}