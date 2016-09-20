<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class about extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('dbuser');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
    }
    
    public function index()
    {
        $url = current_url();
         if ($this->session->userdata('logged_in') == true) {
        
           } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    public function contact()
    {
        $url = current_url();
         if ($this->session->userdata('logged_in') == true) {
         $this->load->view('dashboard/templates/header');
          $this->load->view('dashboard/templates/sideNavigation');
          $this->load->view('dashboard/templates/topHead');
          $this->load->view('dashboard/about/contactInfo');
           $this->load->view('dashboard/templates/footer');
           } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    public function sysInfo()
    {
       $url = current_url();
         if ($this->session->userdata('logged_in') == true) {
         $this->load->view('dashboard/templates/header');
          $this->load->view('dashboard/templates/sideNavigation');
          $this->load->view('dashboard/templates/topHead');
          $this->load->view('dashboard/about/systemInfo');
           $this->load->view('dashboard/templates/footer');
           } else {
            redirect('login/index/?url=' . $url, 'refresh');
        } 
    }
    
    
    
}