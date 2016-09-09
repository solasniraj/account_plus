  <?php if (!defined('BASEPATH'))
  exit('No direct script access allowed');
  class transaction extends CI_Controller {
    function __construct() {
      parent::__construct();
      $this->load->library('session');
      $this->load->model('program_model');
       $this->load->model('bank_model');
        $this->load->model('transaction_model');
       
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
         $output .='<option value="">Select Program</option>';
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

         $output ='<option value=""></option>';
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
     $journalNumber = $this->program_model->getCurrentJournalNumer();
     
  $jnNumber = str_pad($journalNumber, 5, "0", STR_PAD_LEFT);
    // $data['journalNumber'] = 
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
   $data['transactionDetails'] = $this->transaction_model->get_transactions_details();     
   $this->load->view('dashboard/templates/header');
     $this->load->view('dashboard/templates/sideNavigation');
     $this->load->view('dashboard/templates/topHead');
     $this->load->view('dashboard/transaction/journalList', $data);
     $this->load->view('dashboard/templates/footer');   
       } else {
      redirect('login/index/?url=' . $url, 'refresh');
    }
  }
  
  public function preview($id)
  {
      $url = current_url();
    if ($this->session->userdata('logged_in') == true) {
      $userId = $this->session->userdata("user_id");
    $data['singleGLDetails'] = $this->transaction_model->get_single_transaction_details($id);
    $this->load->view('printPreview/preview/templates/header');
     $this->load->view('printPreview/preview/transaction/singleJournalEntry', $data);
     $this->load->view('printPreview/preview/templates/footer');
    
    
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
      
     $this->load->view('dashboard/templates/header');
     $this->load->view('dashboard/templates/sideNavigation');
     $this->load->view('dashboard/templates/topHead');
     $this->load->view('dashboard/transaction/receiptList');
     $this->load->view('dashboard/templates/footer');  
      
      
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

 

  public function glTransaction()
  {
      $url = current_url();
   if ($this->session->userdata('logged_in') == true) {
        // transType programType  subLedgerType description amount  chequeNo
     $user_id=$this->session->userdata('user_id');
     $this->load->library('form_validation');
     $this->form_validation->set_rules('journalNo', 'Journal No', 'trim|required|callback_xss_clean|max_length[200]');
     $this->form_validation->set_rules('datepicker', 'Date', 'trim|required|callback_xss_clean|max_length[200]');
     $this->form_validation->set_rules('journalType', 'Journal Type', 'trim|required|callback_xss_clean|max_length[200]');
    
     
     $this->form_validation->set_error_delimiters('<div class="form-errors">', '</div>'); 

     if ($this->form_validation->run() == FALSE)
     {
       $data['program_list']=$this->program_model->view_programm_listing($user_id);
       $this->load->view('dashboard/templates/header');
       $this->load->view('dashboard/templates/sideNavigation');
       $this->load->view('dashboard/templates/topHead');
       $this->load->view('dashboard/transaction/journalEntry', $data);
       $this->load->view('dashboard/templates/footer');   

     }
     else 
     {
         $ledgerName = $this->input->post('ledgerName');     
         $datepicker = $this->input->post('datepicker');     
         $journalType = $this->input->post('journalType');     
         $comment = $this->input->post('comment');     
         $summary = $this->input->post('summary');     
         $journalNo = $this->input->post('journalNo');     
         
         
         
        $myData = $_POST['mydata'];
       $drCr = json_decode($myData);
       foreach ($drCr as $transData){
           
           $indexNumber = $transData->indexNumber;
           $pCode = $transData->pCode;
           $accountHd = $transData->programName;
           $temp1   = explode('#', $accountHd)[1];
           $accountHead = $temp1;
           $account_id = $transData->program_id;
           $subLedgerName = $transData->subLedgerName;
           $subLedger_id = $transData->subLedger_id;
           $donarName = $transData->donarName;
           $donar_id = $transData->donar_id;
           $ledgerType = $transData->ledgerType;
           $description = $transData->description;
           $debitAmount = $transData->debitAmount;
           $creditAmount = $transData->creditAmount;
           $chequeNo = $transData->chequeNo;
          
           if(!empty($debitAmount)){
              if($journalType == '1' || $journalType == '4'){
                  $this->transaction_model->add_gl_transaction($journalNo, $ledgerName, $datepicker, $journalType, $indexNumber, $pCode, $accountHead, $account_id, $subLedgerName, $subLedger_id, $donarName, $donar_id, $ledgerType, $description, $debitAmount, $chequeNo);
              }elseif($journalType == '2' || $journalType == '3'){
                  $debitAmount = -$debitAmount;
                          $this->transaction_model->add_gl_transaction($journalNo, $ledgerName, $datepicker, $journalType, $indexNumber, $pCode, $accountHead, $account_id, $subLedgerName, $subLedger_id, $donarName, $donar_id, $ledgerType, $description, $debitAmount, $chequeNo);
              }else{
                  echo "something went wrong";
              }
               
           }elseif(!empty ($creditAmount)){
               if($journalType == '1' || $journalType == '4'){
                  $creditAmount = -$creditAmount;
                  $this->transaction_model->add_gl_transaction($journalNo, $ledgerName, $datepicker, $journalType, $indexNumber, $pCode, $accountHead, $account_id, $subLedgerName, $subLedger_id, $donarName, $donar_id, $ledgerType, $description, $creditAmount, $chequeNo);
              }elseif($journalType == '2' || $journalType == '3'){
                  $this->transaction_model->add_gl_transaction($journalNo, $ledgerName, $datepicker, $journalType, $indexNumber, $pCode, $accountHead, $account_id, $subLedgerName, $subLedger_id, $donarName, $donar_id, $ledgerType, $description, $creditAmount, $chequeNo);
              }else{
                  echo "something went wrong";
              }
           }else{
               echo 'neither debit nor credit';
           }
       }
       $this->transaction_model->add_comment_of_transaction($journalNo, $comment, $summary);
       
     echo "Transaction has been added successfully";
       

    }

  } 

  else 
  {

    redirect('login/index/?url=' . $url, 'refresh');
    
  }

  }



  }