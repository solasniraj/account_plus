<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class bank extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('bank_model');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
    }
    
    public function index()
    {
        $url = current_url();
         if ($this->session->userdata('logged_in') == true) {
            
   $user_id=$this->session->userdata('user_id');
   $data['bankAccount']=$this->bank_model->view_bank_account_listing();
   
         $this->load->view('dashboard/templates/header');
          $this->load->view('dashboard/templates/sideNavigation');
          $this->load->view('dashboard/templates/topHead');
          $this->load->view('dashboard/bank/listAccounts', $data);
           $this->load->view('dashboard/templates/footer');
           } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    public function addAccount()
    {
        $url = current_url();
         if ($this->session->userdata('logged_in') == true) { 
              $this->load->view('dashboard/templates/header');
          $this->load->view('dashboard/templates/sideNavigation');
          $this->load->view('dashboard/templates/topHead');
          $this->load->view('dashboard/bank/addAccount');
           $this->load->view('dashboard/templates/footer');
             
    } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function addnewAccount()
    {
        if ($this->session->userdata('logged_in') == true) 
      {
        $user_id=$this->session->userdata('user_id');
       $this->load->library('form_validation');
       $this->form_validation->set_rules('bankName', 'Name of Bank', 'trim|required|callback_xss_clean|max_length[200]');
       $this->form_validation->set_rules('accountNumber', 'Account Number', 'trim|required|callback_xss_clean|max_length[200]');
       $this->form_validation->set_rules('address', 'Address of Bank', 'trim|callback_xss_clean|max_length[200]');
       $this->form_validation->set_rules('contactNumber', 'Contact Number of Bank', 'trim|callback_xss_clean|max_length[200]');
       $this->form_validation->set_error_delimiters('<div class="form-errors">', '</div>'); 

       if ($this->form_validation->run() == FALSE)
       {
        $this->addAccount();
      }
      else 
      {
        $bankName = $this->input->post('bankName');
        $accountNumber = $this->input->post('accountNumber');
        $address = $this->input->post('address');
        $contactNumber = $this->input->post('contactNumber');
        
       
        $result=$this->bank_model->add_new_bank_account($bankName,$accountNumber, $address, $contactNumber);
        if($result)
        {
         $this->session->set_flashdata('flashMessage', 'Bank Account added successfully');
         return redirect('bank/index');
       }
       else 
       {
        $this->session->set_flashdata('flashMessage', 'Sorry ! something went wrong while adding account. Please add again.');
        return redirect('bank/addAccount');
      }


    }
  }
  else {
   return   redirect('login/index/?url=' . $url, 'refresh');
 }
    }
    
    
    public function editAccount($id=null)
    {
        
    }
    
    public function deleteAccount($id=NULL)
    {
        
    }
    
    
    
    
    
    
}