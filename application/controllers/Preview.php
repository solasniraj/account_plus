<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class preview extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('bank_model');
        $this->load->model('program_model');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
    }
    
    public function index()
    {
        $url = current_url();
         if ($this->session->userdata('logged_in') == true) {
 
             
            $data['bankAccount']=$this->bank_model->view_bank_account_listing();
   
      $this->load->view('dashboard/templates/header', $data, true);
     $this->load->view('dashboard/templates/sideNavigation');
    $this->load->view('dashboard/templates/topHead');
    $this->load->view('dashboard/bank/listAccounts', $data);
    $this->load->view('dashboard/templates/footer');
		// Get output html
		$html = $this->output->get_output();
		
		// Load library
		$this->load->library('dompdf_gen');
		
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("welcome.pdf");
    die;         
             
           
             
             
 
             
         } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    
}