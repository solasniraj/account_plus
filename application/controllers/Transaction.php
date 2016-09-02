  <?php if (!defined('BASEPATH'))
  exit('No direct script access allowed');
  class transaction extends CI_Controller {
    function __construct() {
      parent::__construct();
      $this->load->library('session');
      $this->load->model('program_model');
       $this->load->model('bank_model');
      $this->load->helper('url');
      $this->load->helper(array('form', 'url'));
      $this->load->library('pagination');
    }

    public function index()
    {
      $url = current_url();
      if ($this->session->userdata('logged_in') == true) {
       $this->load->view('dashboard/templates/header');
       $this->load->view('dashboard/templates/sideNavigation');
       $this->load->view('dashboard/templates/topHead');
       $this->load->view('dashboard/dashboard/dashboardPanel');
       $this->load->view('dashboard/templates/footer');
     } else {
      redirect('login/index/?url=' . $url, 'refresh');
    }
  }

  public function getProgrammListForCurrentChartName()
  {

    $url = current_url();
    if ($this->session->userdata('logged_in') == true) 
    {   
     if (isset($_POST['charClassId'])) 
     {
       $currentCharClassId= $_POST['charClassId'];
       $ProgrammList=$this->program_model->getProgrammListForCurrentChartName($currentCharClassId);
       $output= "";
       if(!empty($ProgrammList))
       {
         foreach ($ProgrammList as $value)
         {
           $output .= '<option programmId="'.$value->program_id.'" value="'.$value->id.'">'.$value->account_code."#".$value->account_name.'</option>';
         }
       }
       else
       {

         $output .= '<option value=""></option>';
       }


       echo $output;

     }
     else 
     {

      echo "Unauthorized access";

    }
  }
  else
  {

   redirect('login/index/?url=' . $url, 'refresh');
  }

  }

  public function getProgrammcodeForCurrentId()
  {

    $url = current_url();
    if ($this->session->userdata('logged_in') == true) 
    {   
     if (isset($_POST['chartId'])) 
     {
       $chartId= $_POST['chartId'];
       $value=$this->program_model->getSingleProgramCode($chartId);
       $output= "";
       if(!empty($value))
       {

         $output .= '<input type="text" id="pCode" class="form-control"  value="'.$value->account_code.'" readonly />';
       }
       else
       {

         $output .= '<input type="text" id="pCode" class="form-control" value="" readonly />';
       }


       echo $output;

     }
     else 
     {

      echo "Unauthorized access";

    }
  }
  else
  {

   redirect('login/index/?url=' . $url, 'refresh');
  }

  }


  function getSubledgerForCurrentProgramId()
  {
   $url = current_url();
   if ($this->session->userdata('logged_in') == true) 
   {   
     if (isset($_POST['programmId'])) 
     {
       $programmId= $_POST['programmId'];
       $subLedgerList=$this->program_model->getSingleProgramSubledgers($programmId);
       $output= "";
       if(!empty($subLedgerList))
       {
         foreach ($subLedgerList as $value)
         {
           $output .= '<option value="'.$value->id.'">'.$value->subledger_name.'</option>';
         }
       }
       else 
       {

         $output = '<option value=""></option>';
       }

       echo $output;
     }
     else 
     {

      echo "Unauthorized access";

    }
  }
  else
  {

   redirect('login/index/?url=' . $url, 'refresh');
  }

  }


  function getDonarListForCurrentProgramId()
  {
   $url = current_url();
   if ($this->session->userdata('logged_in') == true) 
   {   
     if (isset($_POST['programmId'])) 
     {
       $programmId= $_POST['programmId'];
       $donerIds=$this->program_model->getSingleProgramDonerIdsFromDonarBudgetInfo($programmId);
       $idList=array();
       foreach($donerIds as $datas)
       {
         $doner_id = $datas->donar_id;
         array_push($idList, $doner_id);
       }
       $stringIdsWithCommas=implode(",",$idList);
       $donerLists=$this->program_model->getdonerListFromProgamBydonerId($idList);

       echo $stringIdsWithCommas;

       $output= "";
       if(!empty($donerLists))
       {
         foreach ($donerLists as $value)
         {
           $output .= '<option value="'.$value->id.'">'.$value->donar_name.'</option>';
         }
       }
       else 
       {


         $output = '<option value=""></option>';
       }

       echo $output;
     }
     else 
     {

      echo "Unauthorized access";

    }
  }
  else
  {

   redirect('login/index/?url=' . $url, 'refresh');
  }

  }



  public function journalEntry()
  {
   $url = current_url();
   if ($this->session->userdata('logged_in') == true) {

     $user_id=$this->session->userdata('user_id');
     $data['journalNumber']=$this->program_model->getCurrentJournalNumer();
     $data['journalTypes']=$this->program_model->getJournalTypes();
     $data['program_list']=$this->program_model->view_programm_listing($user_id);
     
     $totalTransBalance = $this->bank_model->get_total_balance_of_all_banks_from_trans_info();
     $bankAccount = $this->bank_model->view_bank_account_listing();
     if(!empty($bankAccount)){
         $totalEnd = '0';
        foreach($bankAccount as $blist) {
            $endingBalance = $blist->ending_reconcile_balance;
            $totalEnd += $endingBalance;
        }
     }
     if((!empty($totalTransBalance )) && (!empty($totalEnd))){         
         $finalBalance = $totalEnd - $totalTransBalance;
     }elseif((empty($totalTransBalance )) && (!empty($totalEnd))){       
             $finalBalance = $totalEnd;
     }elseif((!empty($totalTransBalance )) && (empty($totalEnd))){        
             $finalBalance = $totalTransBalance;
         }else{
            $finalBalance = '0';
        }
     
     $data['bankBalance'] = $finalBalance;
     
     $this->load->view('dashboard/templates/header');
     $this->load->view('dashboard/templates/sideNavigation');
     $this->load->view('dashboard/templates/topHead');
     $this->load->view('dashboard/transaction/journalEntry', $data);
     $this->load->view('dashboard/templates/footer');   
   } 
   else
   {

    redirect('login/index/?url=' . $url, 'refresh');

  }

  }
  
  public function journalList()
  {
       $url = current_url();
    if ($this->session->userdata('logged_in') == true) {

      $userId = $this->session->userdata("user_id");
      
      
      
      
       } else {
      redirect('login/index/?url=' . $url, 'refresh');
    }
  }
  
  public function cashReceiptEntry()
  {
       $url = current_url();
    if ($this->session->userdata('logged_in') == true) {

      $userId = $this->session->userdata("user_id");
      
      $this->load->view('dashboard/templates/header');
     $this->load->view('dashboard/templates/sideNavigation');
     $this->load->view('dashboard/templates/topHead');
     $this->load->view('dashboard/transaction/cashReceiptEntry');
     $this->load->view('dashboard/templates/footer');   
      
      
       } else {
      redirect('login/index/?url=' . $url, 'refresh');
    }
  }
  
  public function cashReceiptList()
  {
       $url = current_url();
    if ($this->session->userdata('logged_in') == true) {

      $userId = $this->session->userdata("user_id");
      
      
      
      
      } else {
      redirect('login/index/?url=' . $url, 'refresh');
    } 
  }

  
  public function get_subledgers()
  {
    $url = current_url();
    if ($this->session->userdata('logged_in') == true) {

      $userId = $this->session->userdata("user_id");

      if (isset($_POST['pId'])) {
        $currentProgramId = $_POST['pId'];
        $subLegderDetails=$this->program_model->viewSubLedgerofSingleProgramm($currentProgramId);
        $a= "";
        if(!empty($subLegderDetails)){
         foreach ($subLegderDetails as $lDetails){
          $a .= '<option value="'.$lDetails->subledger_name.'">'.$lDetails->subledger_name.'</option>';
        }}else{
          $a .= '<option value="">Select Subledger</option>';
        }
        echo $a;

      }
    } else {
      redirect('login/index/?url=' . $url, 'refresh');
    }

  }


  public function  addJournal()
  {
   $url = current_url();
   if ($this->session->userdata('logged_in') == true) {
        // transType programType  subLedgerType description amount  chequeNo
     $user_id=$this->session->userdata('user_id');
     $this->load->library('form_validation');
     $this->form_validation->set_rules('transType', 'transType', 'trim|required|callback_xss_clean|max_length[200]');
     $this->form_validation->set_rules('program_name', 'program name', 'trim|required|callback_xss_clean|max_length[200]');
     $this->form_validation->set_rules('subLedger_name', 'subLedger name', 'trim|required|callback_xss_clean|max_length[200]');
     $this->form_validation->set_rules('description', 'description', 'trim|required|callback_xss_clean|max_length[200]');
     $this->form_validation->set_rules('amount', 'amount', 'trim|required|callback_xss_clean|max_length[200]');
     $this->form_validation->set_rules('chequeNo', 'chequeNo', 'trim|required|callback_xss_clean|max_length[200]');
     $this->form_validation->set_rules('ledgerType', 'ledgerType', 'trim|required|callback_xss_clean|max_length[200]');

     
     $this->form_validation->set_error_delimiters('<div class="form-errors">', '</div>'); 

     if ($this->form_validation->run() == FALSE)
     {

  // echo validation_errors(); 
  // exit;
       $data['program_list']=$this->program_model->view_programm_listing($user_id);
       $this->load->view('dashboard/templates/header');
       $this->load->view('dashboard/templates/sideNavigation');
       $this->load->view('dashboard/templates/topHead');
       $this->load->view('dashboard/transaction/journalEntry', $data);
       $this->load->view('dashboard/templates/footer');   


     }
     else 
     {
      echo "success";

    }

  } 

  else 
  {

    redirect('login/index/?url=' . $url, 'refresh');
    
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