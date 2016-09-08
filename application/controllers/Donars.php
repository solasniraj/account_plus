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
        $contactPerson = $this->input->post('contactPerson');
        $contactPCellNo = $this->input->post('contactPCellNo');
        
       
        $result=$this->donar_model->add_new_donar($donarName,$donarAddress, $emailId, $contactNumber, $contactPerson, $contactPCellNo);
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

            $currentProgramId = $progId;
            $data['programId'] = $currentProgramId;
            $user_id=$this->session->userdata('user_id');           
            $data['donars']=$this->donar_model->get_all_donars();
            $data['assignedDonors'] = $this->donar_model->get_all_assigned_donors_to_program($progId);
            $this->load->view('dashboard/templates/header');
            $this->load->view('dashboard/templates/sideNavigation');
            $this->load->view('dashboard/templates/topHead');
            $this->load->view('dashboard/donars/assignDonars',$data);
            $this->load->view('dashboard/templates/footer'); 
    } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }   
    }
    
    public function assignToProgram()
    {
        $url = current_url();
          if ($this->session->userdata('logged_in') == true)
           {
           $programId = $this->input->post('programId');             
       $this->form_validation->set_rules('donorName', 'Donar Name', 'trim|required|callback_xss_clean|max_length[1000]');
       $this->form_validation->set_rules('budget', 'Budget Amount', 'trim|callback_xss_clean|max_length[1000]');
       $this->form_validation->set_error_delimiters('<div class="form-errors">', '</div>'); 

       if ($this->form_validation->run() == FALSE)
       {
        $this->assignDonars($programId);
      }
      else 
      {
        
          $donarName = $this->input->post('donorName');
        $budget = $this->input->post('budget');
       
        $result=$this->donar_model->assign_donor_to_program($donarName,$budget, $programId);
        if($result)
        {
         $this->session->set_flashdata('flashMessage', 'Donor assigned successfully');
         return redirect('donars/assignDonars/'.$programId);
       }
       else 
       {
        $this->session->set_flashdata('flashMessage', 'Sorry ! something went wrong while assigning donor. Please assign again.');
        return redirect('donars/assignDonars/'.$programId);
      }
          
      }
              
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