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
    
    
    
}