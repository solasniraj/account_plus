<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class dashboard extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
        if(is_trans_pending())
        {
        $this->session->set_flashdata("flashMessage", '<div class="alert alert-info" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please take action on draft journals first to make journal entry.</div>');
        redirect('transaction/journalList', 'refresh');
        }
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
                     
         $this->load->view('dashboard/templates/header');
          $this->load->view('dashboard/templates/sideNavigation');
          $this->load->view('dashboard/templates/topHead');
          $this->load->view('dashboard/dashboard/dashboardPanel');
           $this->load->view('dashboard/templates/footer');
           } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    
    
    
}