<?php if (!defined('BASEPATH'))
exit('No direct script access allowed');
class Miscelleneous extends CI_Controller {
	function __construct() 
	{
		parent::__construct();
		$this->load->library('session');
                $this->load->model('bank_model');
		$this->load->helper('url');
		$this->load->helper(array('form', 'url'));
		$this->load->library('pagination');
                if(is_trans_pending())
        {
        $this->session->set_flashdata("flashMessage", '<div class="alert alert-info" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please take action on draft journals first to make journal entry.</div>');
        redirect('transaction/journalList', 'refresh');
        }
	}

	public function bankReconcillation()
	{
		$url = current_url();
		if ($this->session->userdata('logged_in') == true) {
                    $data['bankAccount']=$this->bank_model->view_bank_account_listing();
			$this->load->view('dashboard/templates/header');
			$this->load->view('dashboard/templates/sideNavigation');
			$this->load->view('dashboard/templates/topHead');
			$this->load->view('dashboard/miscelleneous/bankReconcillation', $data);
			$this->load->view('dashboard/templates/footer');
		} else {
			redirect('login/index/?url=' . $url, 'refresh');
		}
	}
        
        public function showReconcillationForm()
        {
            $url = current_url();
		if ($this->session->userdata('logged_in') == true) {
         $this->load->library('form_validation');
       $this->form_validation->set_rules('formDate', 'Date (From)', 'trim|required|callback_xss_clean');
       $this->form_validation->set_rules('toDate', 'Date (To)', 'trim|required|callback_xss_clean');
       $this->form_validation->set_rules('bankName', 'Bank Account', 'trim|required|callback_xss_clean');
       $this->form_validation->set_rules('amount', 'Bank balance based on statement', 'trim|required|callback_xss_clean');
       $this->form_validation->set_error_delimiters('<div class="form-errors">', '</div>');            
        
       if ($this->form_validation->run() == FALSE)
       {
        $this->bankReconcillation();
      }
      else 
      {       
        $fromDate = $this->input->post('formDate');  
        $toDate = $this->input->post('toDate');  
        $bankName = $this->input->post('bankName');  
        $amount = $this->input->post('amount');  
        
       // $result=$this->program_model->insert_programm_listing($user_id, $programName);
       // if($result)
      //  {
       //  $this->session->set_flashdata('flashMessage', 'Programm added successfully');
         $this->load->view('dashboard/templates/header');
      $this->load->view('dashboard/templates/sideNavigation');
      $this->load->view('dashboard/templates/topHead');
      $this->load->view('dashboard/miscelleneous/bankreconcillationForm');
      $this->load->view('dashboard/templates/footer');
      // }
      // else 
      // {
      //  $this->session->set_flashdata('flashMessage', 'Sorry ! Someting went wrong. Please try again.');

     //   return redirect('miscelleneous/bankReconcillation');
     // }
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
