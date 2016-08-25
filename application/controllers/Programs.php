    <?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    class programs extends CI_Controller {
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

        } else {
          redirect('login/index/?url=' . $url, 'refresh');
        }
      }
      


      public function addProgram()
      {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) {
         $this->load->view('dashboard/templates/header');
         $this->load->view('dashboard/templates/sideNavigation');
         $this->load->view('dashboard/templates/topHead');
         $this->load->view('dashboard/program/addProgram');
         $this->load->view('dashboard/templates/footer');
       } else {
        redirect('login/index/?url=' . $url, 'refresh');
      }
    }

    public function addnewProgram()
    { 
      $url = current_url();
      if ($this->session->userdata('logged_in') == true) 
      {
        $user_id=$this->session->userdata('user_id');
       $this->load->library('form_validation');
       $this->form_validation->set_rules('programName', 'Program Name', 'trim|required|callback_xss_clean|max_length[200]');
       $this->form_validation->set_error_delimiters('<div class="form-errors">', '</div>'); 

       if ($this->form_validation->run() == FALSE)
       {
        $this->addProgram();
      }
      else 
      {       
        $programName=$this->input->post('programName');        
        
        $result=$this->program_model->insert_programm_listing($user_id, $programName);
        if($result)
        {
         $this->session->set_flashdata('flashMessage', 'Programm added successfully');
         return redirect('programs/programListing');
       }
       else 
       {
        $this->session->set_flashdata('flashMessage', 'error occur while adding programm');

        return redirect('programs/programListing');
      }


    }
  }
  else {
   return   redirect('login/index/?url=' . $url, 'refresh');
 }
}

public function programListing()
{
  $url = current_url();
  if ($this->session->userdata('logged_in') == true) {
  
   $user_id=$this->session->userdata('user_id');
   $data['program_list']=$this->program_model->view_programm_listing($user_id);
   $this->load->view('dashboard/templates/header');
   $this->load->view('dashboard/templates/sideNavigation');
   $this->load->view('dashboard/templates/topHead');
   $this->load->view('dashboard/program/listProgram',$data);
   $this->load->view('dashboard/templates/footer');
 } else {
  redirect('login/index/?url=' . $url, 'refresh');
}
}

public function editProgram($id=NULL)
{
  $url = current_url();
  if ($this->session->userdata('logged_in') == true) {

  } else {
    redirect('login/index/?url=' . $url, 'refresh');
  }
}

public function createSubLedger($id=NULL)
{
    $url = current_url();
  if ($this->session->userdata('logged_in') == true) {
    $data['program_id']=$this->uri->segment(3);
    $this->load->view('dashboard/templates/header');
    $this->load->view('dashboard/templates/sideNavigation');
    $this->load->view('dashboard/templates/topHead');
    $this->load->view('dashboard/program/addSubLedger',$data);
    $this->load->view('dashboard/templates/footer');  
      
      
  } else {
    redirect('login/index/?url=' . $url, 'refresh');
  }
}


public function addSubLedger()
{
    
      $url = current_url();
      $data['program_id']=$this->input->post('program_id');
      if ($this->session->userdata('logged_in') == true) 
      {
         $user_id=$this->session->userdata('user_id');
         $this->load->library('form_validation');
         $this->form_validation->set_rules('subLedgerName', 'Sub-ledger Name', 'trim|required|callback_xss_clean|max_length[200]');
         $this->form_validation->set_error_delimiters('<div class="form-errors">', '</div>'); 

       if ($this->form_validation->run() == FALSE)
       {

            $this->load->view('dashboard/templates/header');
            $this->load->view('dashboard/templates/sideNavigation');
            $this->load->view('dashboard/templates/topHead');
            $this->load->view('dashboard/program/addSubLedger',$data);
            $this->load->view('dashboard/templates/footer');
        }

       else 

         { 
             $subLedgerName=$this->input->post('subLedgerName');        
             $this->load->model('program_model');
             $currentProgramId=$this->input->post('program_id');
             $isAddSubledger=$this->program_model->addSubLedger($subLedgerName,$currentProgramId);
             $isupdateProgrammSubIds=$this->program_model->updateProgrammSublederIds($isAddSubledger,$currentProgramId);
             if($isupdateProgrammSubIds)
                {
                  $this->session->set_flashdata('flashMessage', 'SubLedger  added successfully');
                  return redirect('programs/programListing');
                }
             else 
               {
    
                 $this->session->set_flashdata('flashMessage', 'error occur while adding programm');
                 return redirect('programs/programListing');
              }
          }
   }

    else 
   {

    return   redirect('login/index/?url=' . $url, 'refresh');
   }
}



public function viewSubLedger($id=NULL)
{
    $url = current_url();
  if ($this->session->userdata('logged_in') == true) {
             $currentProgramId=$this->uri->segment(3);
             $this->load->model('program_model');
             $data['subLegderDetails']=$this->program_model->viewSubLedgerofSingleProgramm($currentProgramId);
             $this->load->view('dashboard/templates/header');
             $this->load->view('dashboard/templates/sideNavigation');
             $this->load->view('dashboard/templates/topHead');
             $this->load->view('dashboard/program/viewSubLedger',$data);
             $this->load->view('dashboard/templates/footer');
  } else {
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