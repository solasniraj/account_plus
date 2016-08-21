<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class user extends CI_Controller {
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
    
    public function addUser()
    {
        $url = current_url();
         if ($this->session->userdata('logged_in') == true) {
        
           } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    public function userListing()
    {
        $url = current_url();
         if ($this->session->userdata('logged_in') == true) {
        
   $user_id=$this->session->userdata('user_id');
   $data['users']=$this->dbuser->get_all_active_users();
   
         $this->load->view('dashboard/templates/header');
          $this->load->view('dashboard/templates/sideNavigation');
          $this->load->view('dashboard/templates/topHead');
          $this->load->view('dashboard/users/listUsers', $data);
           $this->load->view('dashboard/templates/footer');
           } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    public function editUser($id=NULL)
    {
        
    }
    
    
}