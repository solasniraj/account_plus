<?php if (!defined('BASEPATH'))
exit('No direct script access allowed');
class reports extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('session');
         $this->load->model('report_model');
         $this->load->model('transaction_model');
         $this->load->model('dbmanager_model');
         $this->load->model('ledger_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
        $this->load->library('Numbertowords');
        if(is_trans_pending())  // if you add in constructor no need write each function in above controller. 
        {
          $this->session->set_flashdata('flashMessage', 'Please take action on draft journals first to make journal entry.');
         redirect('transaction/journalList', 'refresh');
        }
    }
    
    public function index()
    {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) {
          $this->load->view('dashboard/templates/header');
          $this->load->view('dashboard/templates/sideNavigation');
          $this->load->view('dashboard/templates/topHead');
          $this->load->view('dashboard/report/summery');
          $this->load->view('dashboard/templates/footer');
          
      } else {
        redirect('login/index/?url=' . $url, 'refresh');
    }
}

public function dayBook()       
{
    $url = current_url();
    if ($this->session->userdata('logged_in') == true) {
        $user_id = $this->session->userdata('user_id');
             $username = $this->session->userdata('username');
             $committee_id = $this->session->userdata('committee_id');
             $committee_code = $this->session->userdata('committee_code');
             $fiscal_year = $this->session->userdata('fiscal_year');              
             $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
      
        
        $day = $this->input->post('englishDate');
        $nepaliDate = $this->input->post('datepicker');
        if (!$day) {
                $day = date('Y-m-d');
            }        
        $data['journalEntry'] = $this->report_model->get_journal_entry_for_day($day);
      $data['day']= $day;
      $data['nepaliDay'] = $nepaliDate;
        $this->load->view('dashboard/templates/header');
      $this->load->view('dashboard/templates/sideNavigation');
      $this->load->view('dashboard/templates/topHead');
      $this->load->view('dashboard/report/dayBook', $data);
      $this->load->view('dashboard/templates/footer');
      
  } else {
    redirect('login/index/?url=' . $url, 'refresh');
}
}

public function lReport()
{
     $url = current_url();
    if ($this->session->userdata('logged_in') == true) {
        $data['ledgerDetails'] = $this->ledger_model->get_ledger_master_listing();
      $this->load->view('dashboard/templates/header');
      $this->load->view('dashboard/templates/sideNavigation');
      $this->load->view('dashboard/templates/topHead');
      $this->load->view('dashboard/report/ledgerQueryForm', $data);
      $this->load->view('dashboard/templates/footer');
      
  } else {
    redirect('login/index/?url=' . $url, 'refresh');
}
}

public function ledgerReport()
{
    $url = current_url();
    if ($this->session->userdata('logged_in') == true) {
        $user_id = $this->session->userdata('user_id');
             $username = $this->session->userdata('username');
             $committee_id = $this->session->userdata('committee_id');
             $committee_code = $this->session->userdata('committee_code');
             $fiscal_year = $this->session->userdata('fiscal_year');              
             $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
      
        $ledger = $this->input->post('ledgerCode');
        $fromN = $this->input->post('nepaliDateF');
        $fromE = $this->input->post('englishDateF');
        $toN = $this->input->post('nepaliDateT');
        $toE = $this->input->post('englishDateT');
        $data['ledgerDetails'] = $this->ledger_model->get_ledger_details_by_ledger_code($ledger);
       
        $data['ledgerRep'] = $this->report_model->get_transaction_details_of_ledger_with_in_dates($ledger, $fromN, $fromE, $toN, $toE);
        
      $data['fromN'] = $fromN;
      $data['toN'] = $toN;
      $data['fromE'] = $fromE;
      $data['toE'] = $toE;
      $this->load->view('dashboard/templates/header');
      $this->load->view('dashboard/templates/sideNavigation');
      $this->load->view('dashboard/templates/topHead');
      $this->load->view('dashboard/report/ledgerReport', $data);
      $this->load->view('dashboard/templates/footer');
      
  } else {
    redirect('login/index/?url=' . $url, 'refresh');
}
}

public function slReport()
{
     $url = current_url();
    if ($this->session->userdata('logged_in') == true) {
        $data['subLedgerDetails'] = $this->ledger_model->get_sub_ledger_info();
      $this->load->view('dashboard/templates/header');
      $this->load->view('dashboard/templates/sideNavigation');
      $this->load->view('dashboard/templates/topHead');
      $this->load->view('dashboard/report/subLedgerQueryForm', $data);
      $this->load->view('dashboard/templates/footer');
      
  } else {
    redirect('login/index/?url=' . $url, 'refresh');
}
}

public function subLedgerReport()
{
    $url = current_url();
    if ($this->session->userdata('logged_in') == true) {
        $user_id = $this->session->userdata('user_id');
             $username = $this->session->userdata('username');
             $committee_id = $this->session->userdata('committee_id');
             $committee_code = $this->session->userdata('committee_code');
             $fiscal_year = $this->session->userdata('fiscal_year');              
             $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
      
        $subledger = $this->input->post('ledgerCode');
        $fromN = $this->input->post('nepaliDateF');
        $fromE = $this->input->post('englishDateF');
        $toN = $this->input->post('nepaliDateT');
        $toE = $this->input->post('englishDateT');
        $data['subLedgerDetails'] = $this->ledger_model->get_sub_ledger_info_by_code($subledger);
       
        $data['ledgerRep'] = $this->report_model->get_transaction_details_of_sub_ledger_with_in_dates($subledger, $fromN, $fromE, $toN, $toE);
        
      $data['fromN'] = $fromN;
      $data['toN'] = $toN;
      $data['fromE'] = $fromE;
      $data['toE'] = $toE;
      $this->load->view('dashboard/templates/header');
      $this->load->view('dashboard/templates/sideNavigation');
      $this->load->view('dashboard/templates/topHead');
      $this->load->view('dashboard/report/subLedgerReport', $data);
      $this->load->view('dashboard/templates/footer');
      
  } else {
    redirect('login/index/?url=' . $url, 'refresh');
}
}

public function dReport()
{
    $url = current_url();
    if ($this->session->userdata('logged_in') == true) {
        $data['donorDetails'] = $this->ledger_model->get_all_donar();
      $this->load->view('dashboard/templates/header');
      $this->load->view('dashboard/templates/sideNavigation');
      $this->load->view('dashboard/templates/topHead');
      $this->load->view('dashboard/report/donorQueryForm', $data);
      $this->load->view('dashboard/templates/footer');
      
  } else {
    redirect('login/index/?url=' . $url, 'refresh');
}
}

public function donorReport()
{
    {
    $url = current_url();
    if ($this->session->userdata('logged_in') == true) {
        $user_id = $this->session->userdata('user_id');
             $username = $this->session->userdata('username');
             $committee_id = $this->session->userdata('committee_id');
             $committee_code = $this->session->userdata('committee_code');
             $fiscal_year = $this->session->userdata('fiscal_year');              
             $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
      
        $donar = $this->input->post('ledgerCode');
        $fromN = $this->input->post('nepaliDateF');
        $fromE = $this->input->post('englishDateF');
        $toN = $this->input->post('nepaliDateT');
        $toE = $this->input->post('englishDateT');
        $data['donarDetails'] = $this->ledger_model->get_donor_info_by_code($donar);
       
        $data['donarLed'] = $this->ledger_model->get_ledger_master_associated_to_donar($donar);
        
      $data['fromN'] = $fromN;
      $data['toN'] = $toN;
      $data['fromE'] = $fromE;
      $data['toE'] = $toE;
      $data['donorCode'] = $donar;
      $this->load->view('dashboard/templates/header');
      $this->load->view('dashboard/templates/sideNavigation');
      $this->load->view('dashboard/templates/topHead');
      $this->load->view('dashboard/report/donorReport', $data);
      $this->load->view('dashboard/templates/footer');
      
  } else {
    redirect('login/index/?url=' . $url, 'refresh');
}
}
}

public function bankCashBook()
{
    $url = current_url();
    if ($this->session->userdata('logged_in') == true) {

      $this->load->view('dashboard/templates/header');
      $this->load->view('dashboard/templates/sideNavigation');
      $this->load->view('dashboard/templates/topHead');
      $this->load->view('dashboard/report/bankCashBook');
      $this->load->view('dashboard/templates/footer');
      
  } else {
    redirect('login/index/?url=' . $url, 'refresh');
}
}

public function trialBalance()
{
    $url = current_url();
    if ($this->session->userdata('logged_in') == true) {
      $this->load->view('dashboard/templates/header');
      $this->load->view('dashboard/templates/sideNavigation');
      $this->load->view('dashboard/templates/topHead');
      $this->load->view('dashboard/report/trialBalance');
      $this->load->view('dashboard/templates/footer');
      
  } else {
    redirect('login/index/?url=' . $url, 'refresh');
}
}

public function pLAccount()
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

public function balanceSheet()
{
    $url = current_url();
    if ($this->session->userdata('logged_in') == true) {
      $this->load->view('dashboard/templates/header');
      $this->load->view('dashboard/templates/sideNavigation');
      $this->load->view('dashboard/templates/topHead');
      $this->load->view('dashboard/report/balanceSheet');
      $this->load->view('dashboard/templates/footer');
      
  } else {
    redirect('login/index/?url=' . $url, 'refresh');
}
}

public function monthlyStatement()
{
    $url = current_url();
    if ($this->session->userdata('logged_in') == true) {
      
      
  } else {
    redirect('login/index/?url=' . $url, 'refresh');
}
}






}