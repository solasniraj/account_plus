<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class bank extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('bank_model');
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
            $data['chartMaster'] = $this->program_model->get_chart_class_master();
            $data['accountTypes'] = $this->bank_model->get_bank_account_type_details();
            $this->load->view('dashboard/templates/header');
          $this->load->view('dashboard/templates/sideNavigation');
          $this->load->view('dashboard/templates/topHead');
          $this->load->view('dashboard/bank/addAccount', $data);
           $this->load->view('dashboard/templates/footer');
             
    } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function addnewAccount()
    {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) 
      {
        $user_id=$this->session->userdata('user_id');
       $this->load->library('form_validation');
       $this->form_validation->set_rules('bankAccountName', 'Bank Account Name', 'trim|required|callback_xss_clean|max_length[200]');
       $this->form_validation->set_rules('accountType', 'Select Account Type', 'trim|required|callback_xss_clean|max_length[200]');
       $this->form_validation->set_rules('accountGLCode', 'Bank Account GL Code', 'trim|required|callback_xss_clean|max_length[200]');
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
          $blastId = $this->bank_model->get_last_code_of_bank();
          $newBCode = bank_model + '1';
        $newBankCode = str_pad($newBCode, 2, "0", STR_PAD_LEFT);
        $bankAccountName = $this->input->post('bankAccountName');
        $accountType = $this->input->post('accountType');
        $accountGLCode = $this->input->post('accountGLCode');
        $bankName = $this->input->post('bankName');
        $accountNumber = $this->input->post('accountNumber');
        $address = $this->input->post('address');
        $contactNumber = $this->input->post('contactNumber');
        $bankCode = $accountGLCode.$newBankCode;
       $lastId = $this->chartAccount_model->get_last_code_of_related_chart($chartAccType);
        $newCode = $lastId + '1';
        $result1 = $this->bank_model->add_new_bank_account($bankCode, $bankAccountName, $accountType, $bankName,$accountNumber, $address, $contactNumber);
        $result2 = $this->bank_model->add_new_chart_master($newCode, $bankAccountName, $accountGLCode, $result1);
        if($result1 && $result2)
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
    
    public function getBalance()
    {
        $url = current_url();
         if ($this->session->userdata('logged_in') == true) { 
             
             $data['bankAccount']=$this->bank_model->view_bank_account_listing();
             
              $this->load->view('dashboard/templates/header');
          $this->load->view('dashboard/bank/showBalance', $data);
           $this->load->view('dashboard/templates/footer');
             
    } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    

    public function editAccount($id=null)
    {
        
    }
    
    public function deleteAccount($id=NULL)
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