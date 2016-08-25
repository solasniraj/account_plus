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
         $data = $this->dbmanager_model->check_database_for_first_time();
          if ($data) {
              $this->login();
          }else{
         $this->load->view('dashboard/login/registration');
          }
    }
    
    public function addNewCommittee()
    {
         $this->form_validation->set_rules('commiteName', 'Name of Committee', 'trim|required|callback_xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'trim|required|callback_xss_clean');
        $this->form_validation->set_rules('phone', 'Phone Number', 'trim|required|callback_xss_clean');
        $this->form_validation->set_rules('fiscalYear', 'Fiscal Year', 'trim|required|callback_xss_clean');
        $this->form_validation->set_error_delimiters('<div class="form_errors">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
           
        $commiteName=$this->input->post('commiteName');
        $address=$this->input->post('address');
        $phone=$this->input->post('phone');
        $fiscalYear=$this->input->post('fiscalYear');
        $this->dbmanager_model->add_committee($commiteName, $address, $phone);
        $this->dbmanager_model->add_fiscal_year($commiteName, $fiscalYear);
        $this->session->set_flashdata('flashMessage', 'Committee added successfully');
         return redirect('login/login');
        }
    }

        public function login()
    {
        if(isset($_GET['url'])){
        $data['link'] = $_GET['url'];
            }
            else{
               
                $data['link'] = base_url().'dashboard';
            }
         $this->load->view('dashboard/login/login', $data);
    }

        public function validate()
    {
        $link = $this->input->post('requersUrl');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('userName', 'Username', 'trim|required|callback_xss_clean');
        $this->form_validation->set_rules('userPass', 'Password', 'trim|required|callback_xss_clean');
        $this->form_validation->set_error_delimiters('<div class="form_errors">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
           
            $query = $this->dbuser->validate();
            if ($query) {
           
              
                $data = array(
                    'username' => $this->input->post('userName'),
                    'logged_in' => true                   
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
                
                $this->session->set_flashdata('message', 'Username or password incorrect');

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




    public function registration()
    {
      
    }
    
    
}