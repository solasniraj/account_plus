<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class chartAccount extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('ledger_model');
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
    
    public function addLedger($id=NULL)
    {
        $url = current_url();
         if ($this->session->userdata('logged_in') == true) { 
              $this->load->view('dashboard/templates/header');
          $this->load->view('dashboard/templates/sideNavigation');
          $this->load->view('dashboard/templates/topHead');
          $this->load->view('dashboard/accountCharts/addItem');
           $this->load->view('dashboard/templates/footer');
             
    } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function addnewLedger()
    {
        if ($this->session->userdata('logged_in') == true) 
      {
        $user_id=$this->session->userdata('user_id');
       $this->load->library('form_validation');
       $this->form_validation->set_rules('ledgerName', 'Ledger name', 'trim|required|callback_xss_clean|max_length[200]');
       $this->form_validation->set_error_delimiters('<div class="form-errors">', '</div>'); 

       if ($this->form_validation->run() == FALSE)
       {
        $this->addLedger();
      }
      else 
      {
       
         $ledgerName = $this->input->post('ledgerName'); 
        $accLastId = $this->ledger_model->get_last_code_of_ledger();
        $countLedger = $this->ledger_model->count_ledger();
        $newACode = $accLastId + '1';
        
        $newAccountCode = str_pad($newACode, 2, "0", STR_PAD_LEFT);
        if($countLedger <  100){
        
        $result = $this->ledger_model->add_new_ledger($newAccountCode, $ledgerName);
       
        if($result)
            {
         $a = base_url();
              echo '<html>
<head><script src="'. $a . 'contents/js/jquery-1.12.4.min.js"></script><script type="text/javascript">
window.onunload = function(){
  window.opener.location.reload();
};
function loaded()
{
    window.setTimeout(CloseMe, 1000);
}

function CloseMe() 
{
    window.close();
}
</script></head>
<body onLoad="loaded()">
Account Ledger created successfully
</body>';
            }
            else
            {
              $this->session->set_flashdata('flashMessage', 'error occur while creating ledger');

              //return redirect('programs/programListing');
            }
          }else{
            $this->session->set_flashdata('flashMessage', 'You have reached the limit of ledgers. New ledger can not be created');

           // return redirect('programs/programListing');
          }
       }
      }
       else 
       {
        $this->session->set_flashdata('flashMessage', 'Sorry ! something went wrong while adding ledger. Please add again.');
       // return redirect('bank/addLedger');
      }


    }
 
    
    public function addLedgerProgram($id)
    {
        
    }

    

    public function editLedger($id=null)
    {
        
    }
    
    public function deleteLedger($id=NULL)
    {
        
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


