    <?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    class programs extends CI_Controller {
      function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('program_model');
         $this->load->model('chartAccount_model');
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
             $data['accountCharts']=$this->chartAccount_model->get_account_chart_class();
         $this->load->view('dashboard/templates/header');
         $this->load->view('dashboard/templates/sideNavigation');
         $this->load->view('dashboard/templates/topHead');
         $this->load->view('dashboard/program/addProgram', $data);
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
       $this->form_validation->set_rules('programName', 'Account Heading', 'trim|required|callback_xss_clean|max_length[200]');
        $this->form_validation->set_rules('chartAccType', 'Account Type', 'trim|required|callback_xss_clean');
       $this->form_validation->set_error_delimiters('<div class="form-errors">', '</div>'); 

       if ($this->form_validation->run() == FALSE)
       {
        $this->addProgram();
      }
      else 
      {       
        $programName = $this->input->post('programName');        
        $chartAccType = $this->input->post('chartAccType');
        $plastId = $this->program_model->get_last_code_of_program();
        $newPCode = $plastId + '1';
        $newProgramCode = str_pad($newPCode, 2, "0", STR_PAD_LEFT);
        if($newProgramCode <  100){
        $lastId = $this->chartAccount_model->get_last_code_of_related_chart($chartAccType);
        $newCode = $lastId + '1';
       
        $result = $this->program_model->insert_programm_listing($user_id, $newProgramCode, $programName);
        $result1 = $this->chartAccount_model->add_new_chart_master($newCode, $programName, $chartAccType, $result);
        if($result && $result1)
        {
         $this->session->set_flashdata('flashMessage', 'Programm added successfully');
         return redirect('programs/programListing');
       }
       else 
       {
        $this->session->set_flashdata('flashMessage', 'error occur while adding programm');

        return redirect('programs/programListing');
      }
        }else{
            $this->session->set_flashdata('flashMessage', 'You have reached the limit of programs. New program can not be added');

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

public function edit($id=NULL)
{
  $url = current_url();
  if ($this->session->userdata('logged_in') == true) {
      $user_id=$this->session->userdata('user_id');
      $data['programDetails'] = $this->program_model->get_program_details($id, $user_id);
$data['accountCharts']=$this->chartAccount_model->get_account_chart_class();
         $this->load->view('dashboard/templates/header');
         $this->load->view('dashboard/templates/sideNavigation');
         $this->load->view('dashboard/templates/topHead');
         $this->load->view('dashboard/program/editProgram', $data);
         $this->load->view('dashboard/templates/footer');
  } else {
    redirect('login/index/?url=' . $url, 'refresh');
  }
}

public function updateProgram()
{
    $url = current_url();
  if ($this->session->userdata('logged_in') == true) {
      $user_id=$this->session->userdata('user_id');
       $id = $this->input->post('pId');
      $this->load->library('form_validation');
       $this->form_validation->set_rules('programName', 'Account Heading', 'trim|required|callback_xss_clean|max_length[200]');
       $this->form_validation->set_error_delimiters('<div class="form-errors">', '</div>'); 

       if ($this->form_validation->run() == FALSE)
       {
       $user_id=$this->session->userdata('user_id');
      $data['programDetails'] = $this->program_model->get_program_details($id, $user_id);
$data['accountCharts']=$this->chartAccount_model->get_account_chart_class();
         $this->load->view('dashboard/templates/header');
         $this->load->view('dashboard/templates/sideNavigation');
         $this->load->view('dashboard/templates/topHead');
         $this->load->view('dashboard/program/editProgram', $data);
         $this->load->view('dashboard/templates/footer');
      }
      else 
      {  
          $programName = $this->input->post('programName');
         $result = $this->program_model->update_program($id, $programName, $user_id);
         $result1 = $this->chartAccount_model->update_chart_master($id, $programName);
          
           if($result && $result1)
        {
         $this->session->set_flashdata('flashMessage', 'Programm updated successfully');
         return redirect('programs/programListing');
       }
       else 
       {
        $this->session->set_flashdata('flashMessage', 'error occur while updating programm');
        return redirect('programs/programListing');
      }
          
      }
      
      
      } else {
    redirect('login/index/?url=' . $url, 'refresh');
  }
}
//<a href="#" onclick="window.open('newpage.htm', 'newwindow', 'width=300, height=250'); return false;">Click here to open new window</a>
//<SCRIPT TYPE = "text/javascript">
//function popup(mylink, windowname) {
//if (!window.focus)return true;
//var href;
//if (typeof(mylink) == 'string') href = mylink;
//else href = mylink.href;
//window.open(href, windowname, 'width=400,height=200,scrollbars=yes');
//return false;
//}
//</SCRIPT>
//<a href="popupbasic.html" onClick="return popup(this, 'stevie')">my popup</a>
public function createSubLedger($id=NULL)
{
    $url = current_url();
  if ($this->session->userdata('logged_in') == true) {
    $data['program_id']=$id;
    $data['subledgerInfo'] = $this->program_model->get_all_subledger_related_to_program($id);
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
             $subLedgerName = $this->input->post('subLedgerName');                    
             $currentProgramId = $this->input->post('program_id');
             $sLlastId = $this->program_model->get_last_code_of_subledger();
        $newSLCode = $sLlastId + '1';
        $newsubLedgerCode = str_pad($newSLCode, 2, "0", STR_PAD_LEFT);
        if($newsubLedgerCode <  100){
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
        }else{
             $this->session->set_flashdata('flashMessage', 'You have reached the limit of sub-ledgers. New sub ledger can not be added');
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