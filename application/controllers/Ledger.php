<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class ledger extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('ledger_model');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
    }
    
    public function index()
    {
        $url = current_url();
         if ($this->session->userdata('logged_in') == true) {
            
//   $user_id=$this->session->userdata('user_id');
//   $data['ledgerDetails']=$this->ledger_model->get_ledger_listing();
//   
//         $this->load->view('dashboard/templates/header');
//          $this->load->view('dashboard/templates/sideNavigation');
//          $this->load->view('dashboard/templates/topHead');
//          $this->load->view('dashboard/ledger/listLedger', $data);
//           $this->load->view('dashboard/templates/footer');
           } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    
    public function accountGroup()
    {
        $url = current_url();
         if ($this->session->userdata('logged_in') == true) {
             
             
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    
    public function createLedger()
    {
        $url = current_url();
         if ($this->session->userdata('logged_in') == true) { 
        $data['accountCharts']=$this->ledger_model->get_account_chart_class();
        $data['accountLedgers'] = $this->ledger_model->get_account_ledger_info();
        $this->load->view('dashboard/templates/header');
          $this->load->view('dashboard/templates/sideNavigation');
          $this->load->view('dashboard/templates/topHead');
          $this->load->view('dashboard/ledger/createLedger', $data);
           $this->load->view('dashboard/templates/footer');
            } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }


    public function addnewLedger()
    {
        if ($this->session->userdata('logged_in') == true) 
      {
        $user_id=$this->session->userdata('user_id');
       $this->load->library('form_validation');
       $this->form_validation->set_rules('ledgerName', 'Ledger name', 'trim|required|callback_xss_clean|max_length[200]');
       $this->form_validation->set_error_delimiters('<div class="form-errors">', '</div>'); 

       if ($this->form_validation->run() == FALSE)
       {
        $this->addLedger();
      }
      else 
      {
        $ledgerName = $this->input->post('ledgerName');     
       
        $result=$this->ledger_model->add_new_ledger($ledgerName);
        if($result)
        {
         $this->session->set_flashdata('flashMessage', 'Ledger added successfully');
         return redirect('ledger/index');
       }
       else 
       {
        $this->session->set_flashdata('flashMessage', 'Sorry ! something went wrong while adding ledger. Please add again.');
        return redirect('bank/addLedger');
      }


    }
  }
  else {
   return   redirect('login/index/?url=' . $url, 'refresh');
 }
    }
    
    public function addLedgerProgram($id)
    {
        
    }

    

    public function editLedger($id=null)
    {
        
    }
    
    public function deleteLedger($id=NULL)
    {
        
    }
    
    
    
    public function xss_clean($str)
{
  if ($this->security->xss_clean($str, TRUE) === FALSE)
  {
    $this->form_validation->set_message('xss_clean', 'The %s is invalid charactor');
    return FALSE;
  }
  else
  {
    return TRUE;
  }
}
    
    
}