<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class donars extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('donar_model');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
        $this->load->library('form_validation');
    }
    
    public function index()
    {
        $url = current_url();
         if ($this->session->userdata('logged_in') == true) {
            
   $user_id=$this->session->userdata('user_id');
   $data['donars']=$this->donar_model->get_all_donars();
   
         $this->load->view('dashboard/templates/header');
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
              $this->load->view('dashboard/templates/header');
              $this->load->view('dashboard/templates/sideNavigation');
              $this->load->view('dashboard/templates/topHead');
              $this->load->view('dashboard/donars/addDonar');
              $this->load->view('dashboard/templates/footer');
             
    } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function addNewDonar()
    {
        if ($this->session->userdata('logged_in') == true) 
      {
        $user_id=$this->session->userdata('user_id');
       
       $this->form_validation->set_rules('donarCode', 'Donar Code', 'trim|required|callback_xss_clean|max_length[200]');
       $this->form_validation->set_rules('donarName', 'Donar Name', 'trim|required|callback_xss_clean|max_length[1000]');
       $this->form_validation->set_rules('donarAddress', 'Donar Address', 'trim|callback_xss_clean|max_length[1000]');
       $this->form_validation->set_rules('emailId', 'Donar Email ID', 'trim|callback_xss_clean|max_length[100]');
       $this->form_validation->set_rules('contactNumber', 'Contact Number of Bank', 'trim|callback_xss_clean|max_length[50]');
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
        $donarCode = $this->input->post('donarCode');
       
        $result=$this->donar_model->add_new_donar($donarName,$donarAddress, $emailId, $contactNumber, $donarCode);
        if($result)
        {
         $this->session->set_flashdata('flashMessage', 'Donar added successfully');
         return redirect('donars/index');
       }
       else 
       {
        $this->session->set_flashdata('flashMessage', 'Sorry ! something went wrong while adding donar. Please add again.');
        return redirect('donars/addDonar');
      }


    }
  }
  else {
   return   redirect('login/index/?url=' . $url, 'refresh');
 }
    }
    
    
    public function assignDonars($progId=null)
    {
          $url = current_url();
          if ($this->session->userdata('logged_in') == true)
           {

            $currentProgramId=$this->uri->segment(3);
            $user_id=$this->session->userdata('user_id');
            $this->load->model('donar_model');
            $data['listAllDonerByUserid']=$this->donar_model->getAllDonarsByUserid($user_id);
            $this->load->view('dashboard/templates/header');
            $this->load->view('dashboard/templates/sideNavigation');
            $this->load->view('dashboard/templates/topHead');
            $this->load->view('dashboard/donars/assignDonars',$data);
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