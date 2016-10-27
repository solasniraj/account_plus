<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class login extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('dbuser');
        $this->load->model('dbmanager_model');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
        $this->load->library('form_validation');
    }
    
    public function index()
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
if($nepaliMth > '3'){
 $fiscYr = $nepaliYr.'/'.($nepaliYr+1); 
}else{
    $fiscYr = ($nepaliYr-1).'/'.$nepaliYr; 
}
$data['fiscalYear'] = $fiscYr;

$fiscalStart = $this->dbmanager_model->get_latest_unlocked_fiscal_year_start_date();
$fiscalEnd = $this->dbmanager_model->get_latest_unlocked_fiscal_year_end_date();
$todayNep = $nepaliYr.'/'.$nepaliMth.'/'.$nepaliDay;

$fscSt = new DateTime($fiscalStart);
$fscEnd = new DateTime($fiscalEnd);
$tday = new DateTime($todayNep);
$fiscalYrStart = $fscSt->format('Y-m-d');
$fiscalYrEnd = $fscEnd->format('Y-m-d');
$dateOfToday = $tday->format('Y-m-d');

if((!empty($fiscalStart)) && (!empty($fiscalEnd))){
  if (($dateOfToday > $fiscalYrStart) && ($dateOfToday < $fiscalYrEnd))
    {
      $data = $this->dbmanager_model->check_database_for_first_time();
          if ($data) {
              $this->login();
          }else{
         $this->load->view('dashboard/login/registration', $data);
          }
    }
    else
    {
      echo "Your system date and time is not correct. Please correct system date and time first to login";  
    }
}else{
  $this->load->view('dashboard/login/registration', $data);  
}
 
    }
    
    public function addNewCommittee()
    {
        $this->form_validation->set_rules('commiteName', 'Name of Committee', 'trim|regex_match[/^[a-z,0-9,A-Z_\-., ]{2,200}$/]|required|callback_xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'trim|regex_match[/^[a-z,0-9,A-Z_\-., ]{2,200}$/]|required|callback_xss_clean');
        $this->form_validation->set_rules('phone', 'Phone Number', 'trim|regex_match[/^[0-9\+-]{6,20}$/]|required|callback_xss_clean');
        $this->form_validation->set_rules('fiscalYear', 'Fiscal Year', 'trim|required|callback_xss_clean');
        $this->form_validation->set_rules('code', 'Committee Code', 'trim|required|callback_xss_clean');
        $this->form_validation->set_error_delimiters('<div class="form_errors">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
           
        $commiteName=$this->input->post('commiteName');
        $address=$this->input->post('address');
        $phone=$this->input->post('phone');
        $code = $this->input->post('code');
        $fiscalYear=$this->input->post('fiscalYear');
        $pieces = explode("/", $fiscalYear);
        
        $dataCommittee = Array(
            'committee_name' => $commiteName,
            'address' => $address,
                'phone' => $phone,
                'code' => $code,
                'status' => '1');
        
        $dataFiscalYear = Array(
            'fiscal_year' => $fiscalYear,
                'begin_date' => $pieces[0] . '/04/01',
            'end_date' => $pieces[1] . '/03/30',
                'status' => '1');
        
        $dataUser = Array(
            'user_name' => 'admin',
            'password' => md5('admin'),
                'user_type' => 'administrator',
                'status' => '1');
        
      $result1 = $this->dbmanager_model->add_committee_default_user_fiscal_year($dataCommittee, $dataFiscalYear, $dataUser);
       
        
       
        if($result1)
        {
             $this->session->set_flashdata("flashMessage", '<div class="alert alert-success" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Thank you! </strong><br/>Committee added successfully. Please Login to continue with default user and password. </div>');
         return redirect('login/login');
        }else{
             $this->session->set_flashdata("flashMessage", '<div class="alert alert-info" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Sorry ! </strong><br/>Something went wrong during registration. Please try again.</div>');
         
        return redirect('login/index');
        }
    }
    }

        public function login()
    {    
$data['fiscalYear'] = $this->dbmanager_model->get_fiscal_year();
 if(!empty($data['fiscalYear'])) {          
            
        if(isset($_GET['url'])){
        $data['link'] = $_GET['url'];
            }
            else{              
                $data['link'] = base_url().'dashboard';
            }
         $this->load->view('dashboard/login/login', $data);
    }else{
        $this->session->set_flashdata("flashMessage", '<div class="alert alert-info" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Sorry ! </strong><br/>Something went wrong. Setup your user committe first.</div>');
        return redirect('login/index');
    }
    
    }

        public function validate()
    {
        $link = $this->input->post('requersUrl');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('userName', 'Username', 'trim|required|callback_xss_clean');
        $this->form_validation->set_rules('userPass', 'Password', 'trim|required|callback_xss_clean');
        $this->form_validation->set_rules('fiscalYear', 'Fiscal Year', 'trim|required|callback_xss_clean');
        $this->form_validation->set_error_delimiters('<div class="form_errors">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
           
            $query = $this->dbuser->validate();
            if ($query) {
                $data = array(
                    'fiscal_year' => $this->input->post('fiscalYear')                
                );
                $this->session->set_userdata($data);
             if($link == base_url().'/login/logout')
             {
                 redirect('dashboard/index','refresh');
                
             }
             else{
                 redirect($link);
             }
            } else { // incorrect username or password
                
                $this->session->set_flashdata("flashMessage", '<div class="alert alert-danger" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Username or password is incorrect. Please review and login with correct username and password.</div>');

               redirect('login/index/?url=' . $link, 'refresh');
            }
        }
    }
    
    
     function logout() {
            if ($this->session->userdata('logged_in') == TRUE) {
                $username = $this->session->userdata('username');
            $data = array(
                    'username' => $username,
                    'logged_in' =>true
                );
            $this->session->unset_userdata($data);
            $this->session->sess_destroy();
            redirect('login');
        }else{
             $this->session->sess_destroy();
              redirect('login');
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