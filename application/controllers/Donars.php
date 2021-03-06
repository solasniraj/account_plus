<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class donars extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('donar_model');
        $this->load->model('dbuser');
        $this->load->model('dbmanager_model');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
        $this->load->library('form_validation');
        if(is_trans_pending())
        {
        $this->session->set_flashdata("flashMessage", '<div class="alert alert-info" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please take action on draft journals first to make journal entry.</div>');
        redirect('transaction/journalList', 'refresh');
        }
    }
    
    public function index()
    {
        $url = current_url();
         if ($this->session->userdata('logged_in') == true) {
            
   $user_id = $this->session->userdata('user_id');
             $username = $this->session->userdata('username');
             $committee_id = $this->session->userdata('committee_id');
             $committee_code = $this->session->userdata('committee_code');
             $fiscal_year = $this->session->userdata('fiscal_year'); 
             $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);         
         $data['userRole'] = $this->dbuser->get_user_role_by_user_name_and_id($username, $user_id);
   $data['donars']=$this->donar_model->get_all_donar();
   
         $this->load->view('dashboard/templates/header', $data);
          $this->load->view('dashboard/templates/sideNavigation');
          $this->load->view('dashboard/templates/topHead');
          $this->load->view('dashboard/donars/listDonars', $data);
           $this->load->view('dashboard/templates/footer');
           } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    public function addDonar()
    {
        $url = current_url();
         if ($this->session->userdata('logged_in') == true) { 
             $user_id = $this->session->userdata('user_id');
             $username = $this->session->userdata('username');
             $committee_id = $this->session->userdata('committee_id');
             $committee_code = $this->session->userdata('committee_code');
             $fiscal_year = $this->session->userdata('fiscal_year'); 
             $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);         
         $data['userRole'] = $this->dbuser->get_user_role_by_user_name_and_id($username, $user_id);
            $data['donarInfo'] = $this->donar_model->get_all_donar();
              $this->load->view('dashboard/templates/header', $data);
              $this->load->view('dashboard/templates/sideNavigation');
              $this->load->view('dashboard/templates/topHead');
              $this->load->view('dashboard/donars/addDonar', $data);
              $this->load->view('dashboard/templates/footer');
             
    } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function addNewDonar()
    {
        if ($this->session->userdata('logged_in') == true) 
      {
        
       $this->form_validation->set_rules('donarName', 'Donar Name', 'trim|regex_match[/^[a-z,0-9,A-Z_\-., ]{2,200}$/]|required|callback_xss_clean|max_length[1000]');
       $this->form_validation->set_rules('donarAddress', 'Donar Address', 'trim|regex_match[/^[a-z,0-9,A-Z_\-., ]{2,200}$/]|callback_xss_clean|max_length[1000]');
       $this->form_validation->set_rules('emailId', 'Donar Email ID', 'trim|regex_match[/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/]|callback_xss_clean|max_length[100]');
       $this->form_validation->set_rules('contactNumber', 'Contact Number', 'trim|regex_match[/^[0-9\+-]{6,20}$/]|callback_xss_clean|max_length[50]');
       $this->form_validation->set_rules('contactPerson', 'Contact Person', 'trim|regex_match[/^[a-z,A-Z_\-., ]{2,200}$/]|callback_xss_clean|max_length[1000]');
       $this->form_validation->set_rules('contactPCellNo', 'Contact Person Contact No.', 'trim|regex_match[/^[0-9\+-]{6,20}$/]|callback_xss_clean|max_length[50]');
       $this->form_validation->set_error_delimiters('<div class="form-errors">', '</div>'); 

       if ($this->form_validation->run() == FALSE)
       {
        $this->addDonar();
      }
      else 
      {
        $donarName = $this->input->post('donarName');
        $donarAddress = $this->input->post('donarAddress');
        $emailId = $this->input->post('emailId');
        $contactNumber = $this->input->post('contactNumber');
        $contactPerson = $this->input->post('contactPerson');
        $contactPCellNo = $this->input->post('contactPCellNo');
        
       $donorLastId = $this->donar_model->get_last_code_of_donor();
        $countDonars = $this->donar_model->count_donars();
        $newDCode = $donorLastId + '1';
        
        $newDonarCode = str_pad($newDCode, 2, "0", STR_PAD_LEFT);
        if($countDonars <  100){
        $result=$this->donar_model->add_new_donar($newDonarCode, $donarName,$donarAddress, $emailId, $contactNumber, $contactPerson, $contactPCellNo);
        if($result)
        {
            $a = base_url();
              echo '<html>
<head><script src="'. $a . 'contents/js/jquery-1.12.4.min.js"></script><script type="text/javascript">
window.onunload = function(){
  window.opener.location.reload();
};
function loaded()
{
    window.setTimeout(CloseMe, 1000);
}

function CloseMe() 
{
    window.close();
}
</script></head>
<body onLoad="loaded()">
Donor created successfully
</body>';
         //$this->session->set_flashdata('flashMessage', 'Donar added successfully');
         //return redirect('donars/index');
       }
       else 
       {
         $this->session->set_flashdata("flashMessage", '<div class="alert alert-info" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Sorry ! </strong><br/>Something went wrong while adding donor. Please add again.</div>');
        return redirect('donars/addDonar');
      }
        }else{
            
            $this->session->set_flashdata("flashMessage", '<div class="alert alert-info" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Sorry ! </strong><br/>You have reached the limit of donors. New donor can not be added.</div>');
        return redirect('donars/addDonar');
        }


    }
  }
  else {
   return   redirect('login/index/?url=' . $url, 'refresh');
 }
    }





    public function xss_clean($str=NULL)
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