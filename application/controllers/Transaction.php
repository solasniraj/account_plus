<?php if (!defined('BASEPATH'))
exit('No direct script access allowed');
class transaction extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->model('program_model');
    $this->load->helper('url');
    $this->load->helper(array('form', 'url'));
    $this->load->library('pagination');
  }

  public function index()
  {
    $url = current_url();
    if ($this->session->userdata('logged_in') == true) {
     $this->load->view('dashboard/templates/header');
     $this->load->view('dashboard/templates/sideNavigation');
     $this->load->view('dashboard/templates/topHead');
     $this->load->view('dashboard/dashboard/dashboardPanel');
     $this->load->view('dashboard/templates/footer');
   } else {
    redirect('login/index/?url=' . $url, 'refresh');
  }
}

public function journalEntry()
{
 $url = current_url();
 if ($this->session->userdata('logged_in') == true) {

   $user_id=$this->session->userdata('user_id');
   $data['program_list']=$this->program_model->view_programm_listing($user_id);
   $this->load->view('dashboard/templates/header');
   $this->load->view('dashboard/templates/sideNavigation');
   $this->load->view('dashboard/templates/topHead');
   $this->load->view('dashboard/transaction/journalEntry', $data);
   $this->load->view('dashboard/templates/footer');   
 } else {
  redirect('login/index/?url=' . $url, 'refresh');
}
}


public function get_subledgers()
{
  $url = current_url();
  if ($this->session->userdata('logged_in') == true) {

    $userId = $this->session->userdata("user_id");

    if (isset($_POST['pId'])) {
      $currentProgramId = $_POST['pId'];
      $subLegderDetails=$this->program_model->viewSubLedgerofSingleProgramm($currentProgramId);
      $a= "";
      if(!empty($subLegderDetails)){
       foreach ($subLegderDetails as $lDetails){
        $a .= '<option value="'.$lDetails->subledger_name.'">'.$lDetails->subledger_name.'</option>';
      }}else{
        $a .= '<option value="">Select Subledger</option>';
      }
      echo $a;

    }
  } else {
    redirect('login/index/?url=' . $url, 'refresh');
  }

}


public function  addJournal()
{
 $url = current_url();
 if ($this->session->userdata('logged_in') == true) {
      // transType programType  subLedgerType description amount  chequeNo
   $user_id=$this->session->userdata('user_id');
   $this->load->library('form_validation');
   $this->form_validation->set_rules('transType', 'transType', 'trim|required|callback_xss_clean|max_length[200]');
   $this->form_validation->set_rules('program_name', 'program name', 'trim|required|callback_xss_clean|max_length[200]');
   $this->form_validation->set_rules('subLedger_name', 'subLedger name', 'trim|required|callback_xss_clean|max_length[200]');
   $this->form_validation->set_rules('description', 'description', 'trim|required|callback_xss_clean|max_length[200]');
   $this->form_validation->set_rules('amount', 'amount', 'trim|required|callback_xss_clean|max_length[200]');
   $this->form_validation->set_rules('chequeNo', 'chequeNo', 'trim|required|callback_xss_clean|max_length[200]');
   $this->form_validation->set_rules('ledgerType', 'ledgerType', 'trim|required|callback_xss_clean|max_length[200]');

   
   $this->form_validation->set_error_delimiters('<div class="form-errors">', '</div>'); 

   if ($this->form_validation->run() == FALSE)
       {

// echo validation_errors(); 
// exit;
   $data['program_list']=$this->program_model->view_programm_listing($user_id);
   $this->load->view('dashboard/templates/header');
   $this->load->view('dashboard/templates/sideNavigation');
   $this->load->view('dashboard/templates/topHead');
   $this->load->view('dashboard/transaction/journalEntry', $data);
   $this->load->view('dashboard/templates/footer');   


      }
      else 
      {
          echo "success";
        
      }

 } 

 else 
 {

  redirect('login/index/?url=' . $url, 'refresh');
  
}

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