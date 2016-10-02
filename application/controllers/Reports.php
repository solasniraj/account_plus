<?php if (!defined('BASEPATH'))
exit('No direct script access allowed');
class reports extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('session');
         $this->load->model('report_model');
         $this->load->model('transaction_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
        $this->load->library('Numbertowords');
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