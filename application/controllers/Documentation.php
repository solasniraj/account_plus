<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class documentation extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('dbuser');
        $this->load->model('dbmanager_model');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
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
         $this->load->view('dashboard/templates/header', $data);
          $this->load->view('dashboard/templates/sideNavigation');
          $this->load->view('dashboard/templates/topHead');
          $this->load->view('dashboard/document/helpFile');
           $this->load->view('dashboard/templates/footer');
           } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    
    
    
}