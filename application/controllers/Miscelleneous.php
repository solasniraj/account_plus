<?php if (!defined('BASEPATH'))
exit('No direct script access allowed');
class Miscelleneous extends CI_Controller {
	function __construct() 
	{
		parent::__construct();
		$this->load->library('session');
                $this->load->model('bank_model');
                 $this->load->model('report_model');
                $this->load->model('dbmanager_model');
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
        $user_id = $this->session->userdata('user_id');
             $username = $this->session->userdata('username');
             $committee_id = $this->session->userdata('committee_id');
             $committee_code = $this->session->userdata('committee_code');
             $fiscal_year = $this->session->userdata('fiscal_year');              
             $fiscalCode = $this->session->userdata('fiscal_code');
             $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
                    
         $this->load->library('form_validation');
       $this->form_validation->set_rules('nepaliDateF', 'Date (From)', 'trim|required|callback_xss_clean');
       $this->form_validation->set_rules('nepaliDateT', 'Date (To)', 'trim|required|callback_xss_clean');
       $this->form_validation->set_rules('bankName', 'Bank Account', 'trim|required|callback_xss_clean');
       $this->form_validation->set_rules('amount', 'Bank balance based on statement', 'trim|required|callback_xss_clean');
       $this->form_validation->set_error_delimiters('<div class="form-errors">', '</div>');            
        
       if ($this->form_validation->run() == FALSE)
       {
        $this->bankReconcillation();
      }
      else 
      {       
        $fromDateN = $this->input->post('nepaliDateF'); 
        $fromDateE = $this->input->post('englishDateF'); 
        $toDateN = $this->input->post('nepaliDateT');
        $toDateE = $this->input->post('englishDateT');
        $bankId = $this->input->post('bankName');  
        $amount = $this->input->post('amount');  
       $bankDetails = $this->bank_model->get_bank_details_by_id($bankId);
       if(!empty($bankDetails)){
           foreach ($bankDetails as $banks){
           $bankName = $banks->bank_name;
       }}else{
           $bankName = Null;
       }
      $data['fromN'] = $fromDateN;
      $data['toN'] = $toDateN;
      $data['fromE'] = $fromDateE;
      $data['toE'] = $toDateE;
      $data['todayN'] = $this->dayFunctN();
      $data['todayE'] = $this->dayFunctE();
      $data['bank'] = $bankName;
      $data['amount'] = $amount;
      $data['bankTrans'] = $this->report_model->get_bank_trans_details_by_bank_id_with_in_dates($bankId, $fromDateN, $fromDateE, $toDateN, $toDateE);
      $this->load->view('dashboard/templates/header');
      $this->load->view('dashboard/templates/sideNavigation');
      $this->load->view('dashboard/templates/topHead');
      $this->load->view('dashboard/miscelleneous/bankreconcillationForm', $data);
      $this->load->view('dashboard/templates/footer');
      
    }
                    
        } else {
			redirect('login/index/?url=' . $url, 'refresh');
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
     
        
 
public function dayFunctN()
{
    date_default_timezone_set('Asia/Kathmandu');
$currentYear = date('Y');
$currentMonth = date('m');
$currentDay = date('d');
$this->load->library("nepali_calendar");
$currentNepaliDay = $this->nepali_calendar->AD_to_BS($currentYear,$currentMonth,$currentDay);
$nepaliDay = $currentNepaliDay['date'];
$nepaliMth = $currentNepaliDay['month'];
$nepaliYr = $currentNepaliDay['year'];
$todayNep = $nepaliYr.'/'.$nepaliMth.'/'.$nepaliDay;

$tday = new DateTime($todayNep);

$dateOfToday = $tday->format('Y-m-d');
return $dateOfToday;
}

public function dayFunctE()
{
    date_default_timezone_set('Asia/Kathmandu');
    $today = date('Y-m-d');
    return $today;
}       
        




}
