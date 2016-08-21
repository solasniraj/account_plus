<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class login extends CI_Controller {
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
    
    
}