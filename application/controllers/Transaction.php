  <?php if (!defined('BASEPATH'))
  exit('No direct script access allowed');
  class transaction extends CI_Controller {
    function __construct() {
      parent::__construct();
      $this->load->library('session');
      $this->load->model('program_model');
      $this->load->model('ledger_model');
       $this->load->model('bank_model');
        $this->load->model('transaction_model');
       $this->load->model('dbmanager_model');
      $this->load->helper('url');
      $this->load->helper(array('form', 'url'));
      $this->load->library('pagination');
      $this->load->library('Numbertowords');
      
      
    }

    public function index()
    {
      $url = current_url();
      if ($this->session->userdata('logged_in') == true) {
          if(is_trans_pending())
        {
        $this->session->set_flashdata("flashMessage", '<div class="alert alert-info" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please take action on draft journals first to make journal entry.</div>');
        redirect('transaction/journalList', 'refresh');
        }else{
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
      } }else {
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
  
  public function getJournalPagination()
  {

$list = $this->transaction_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $customers) {
            $sum = $this->transaction_model->get_debit_credit_amount($customers->journal_voucher_no);
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $customers->journal_voucher_no;
            $row[] = $customers->memo;
            $row[] = $customers->tran_date;
            $row[] = $sum['0']->sum/'2';
            $stat = $customers->gl_trans_status;
            $value = str_replace('/', '&#47;', $customers->journal_voucher_no);
$NewNo = urlencode($value);
            if($stat=='1'){
                $row[] = "<select><option value='1' selected>Publish</option></select>";
                
            }elseif($stat=='2'){
                $row[] = "<select onChange='showState(this);'><option value='1' >Publish</option>"
                        . "<option value='2' selected>Draft</option>"
                        . "<option value='3'>Void</option>"
                        . "</select>";
                
            }elseif($stat=='3'){
                $row[] = "<select><option value='3' selected>Void</option></select>";
                
            }else{
                $row[] = "<select class='departments' name='country'><option>Unknown</option></select>";
                }
                if($stat=='2'){
                $row[] = "<a href='".base_url()."transaction/journalPreview/".$NewNo."'>Preview</a> / <a href='#'>Edit</a>";
                }else{
                   $row[] = "<a href='".base_url()."transaction/journalPreview/".$NewNo."'>Preview</a>"; 
                }
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->transaction_model->count_all(),
                        "recordsFiltered" => $this->transaction_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);

  }
  
  public function changeGlStat()
  {
      if(isset($_POST['select']) && (!empty($_POST['select'])) && (isset($_POST['jnNo'])) && (!empty($_POST['jnNo']))){
         $glNo = $_POST['jnNo'];
          $val = $_POST['select'];
         $this->transaction_model->update_transaction_status_in_gl_trans_info($glNo, $val);
         $query = $this->transaction_model->check_journal_entry_in_bank_trans_info($glNo);
     if(!empty($query) && $query != NULL)
     {         
         $this->transaction_model->update_transaction_status_in_bank_trans_info($glNo, $val);
     }
     echo $val;
      }else{
      }
  }

    public function getAssociatedLedger()
  {
     $url = current_url();
    if ($this->session->userdata('logged_in') == true) 
    {
        if(is_trans_pending())
        {
        $this->session->set_flashdata("flashMessage", '<div class="alert alert-info" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please take action on draft journals first to make journal entry.</div>');
        redirect('transaction/journalList', 'refresh');
        }else{
        if (isset($_POST['charClassId'])) 
     {
           
       $currentCharClassId= $_POST['charClassId'];
       
       $accountLedger=$this->ledger_model->get_account_ledger_by_chard_class_id($currentCharClassId);
       $accountSubLedger = $this->ledger_model->get_account_sub_ledger_by_chard_class_id($currentCharClassId);
       $donor = $this->ledger_model->get_account_donor_by_chard_class_id($currentCharClassId);
       $ledgerType = $this->ledger_model->get_account_ledger_type_by_chard_class_id($currentCharClassId);
       $outputL= "";
       $outputS = "";
       $outputD = "";
       $outputLT = "";
       if(!empty($accountLedger))
       {
         $outputL .='<option value="00" class="text-center">Select Program</option>';
         foreach ($accountLedger as $value)
         {

           $outputL .= '<option programmId="'.$value->ledger_code.'" value="'.$value->ledger_code.'">'.$value->ledger_code." &nbsp;&nbsp;".$value->ledger_name.'</option>';
         }
       }
       else
       {

         $outputL .= '<option value="00">Select None</option>';
       }
       
       if(!empty($accountSubLedger))
       {
           $outputS .='<option value="00" class="text-center">Select subledger</option>';
         foreach ($accountSubLedger as $value)
         {
           $outputS .= '<option value="'.$value->subledger_code.'">'.$value->subledger_code.'&nbsp;&nbsp;'.$value->subledger_name.'</option>';
         }
       }
       else 
       {

         $outputS ='<option value="00"> Select None</option>';
       }
       
       if(!empty($donor))
       {
           $outputD .='<option value="00" class="text-center">Select Donor</option>';
         foreach ($donor as $value)
         {
           $outputD .= '<option value="'.$value->donar_code.'">'.$value->donar_code.'&nbsp;&nbsp;'.$value->donar_name.'</option>';
         }
       }
       else 
       {
         $outputD = '<option value="00"> Select None</option>';
       }
       
       if(!empty($ledgerType))
       {
           $outputLT .='<option value="00" class="text-center">Select Ledger Type</option>';
         foreach ($ledgerType as $value)
         {
           $outputLT .= '<option value="'.$value->ledger_type_code.'">'.$value->ledger_type_code.'&nbsp;&nbsp;'.$value->ledger_type_name.'</option>';
         }
       }
       else 
       {
         $outputLT = '<option value="00"> Select None</option>';
       }
       
       $response['ledger'] = $outputL;
        $response['subLedger'] = $outputS;
        $response['donor'] = $outputD;
        $response['ledgerType'] = $outputLT;
       
echo json_encode($response);

     }
     else 
     {

      echo "Unauthorized access";

    }
        } }else
  {

   redirect('login/index/?url=' . $url, 'refresh');
  } 
  }

  
  public function getAssociatedSubLedger()
  {
       {
   $url = current_url();
   if ($this->session->userdata('logged_in') == true) 
   {  if(is_trans_pending())
        {
        $this->session->set_flashdata("flashMessage", '<div class="alert alert-info" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please take action on draft journals first to make journal entry.</div>');
        redirect('transaction/journalList', 'refresh');
        }else{ 
     if (isset($_POST['chartId']) && isset($_POST['programmId'])) 
     {
       if(!empty($_POST['programmId'])){
           $accountId= $_POST['programmId'];}
       else{ $accountId = '0';   }
        $currentCharClassId= $_POST['chartId'];
        
       $subLedgerList=$this->ledger_model->get_subledger_of_ledger($accountId, $currentCharClassId);
       $donor = $this->ledger_model->get_account_donor_by_chard_class_id_and_ledger($accountId, $currentCharClassId);
       $ledgerType = $this->ledger_model->get_account_ledger_type_by_chard_class_id_and_ledger($accountId, $currentCharClassId);
       $outputS = "";
       $outputD = "";
       $outputLT = "";
       
       
       
      if(!empty($subLedgerList))
       {
           $outputS .='<option value="00" class="text-center">Select subledger</option>';
         foreach ($subLedgerList as $value)
         {
           $outputS .= '<option value="'.$value->subledger_code.'">'.$value->subledger_code.'&nbsp;&nbsp;'.$value->subledger_name.'</option>';
         }
       }
       else 
       {

         $outputS ='<option value="00"> Select None</option>';
       }
       
       if(!empty($donor))
       {
           $outputD .='<option value="00" class="text-center">Select Donor</option>';
         foreach ($donor as $value)
         {
           $outputD .= '<option value="'.$value->donar_code.'">'.$value->donar_code.'&nbsp;&nbsp;'.$value->donar_name.'</option>';
         }
       }
       else 
       {
         $outputD = '<option value="00"> Select None</option>';
       }
       
       if(!empty($ledgerType))
       {
           $outputLT .='<option value="00" class="text-center">Select Ledger Type</option>';
         foreach ($ledgerType as $value)
         {
           $outputLT .= '<option value="'.$value->ledger_type_code.'">'.$value->ledger_type_code.'&nbsp;&nbsp;'.$value->ledger_type_name.'</option>';
         }
       }
       else 
       {
         $outputLT = '<option value="00"> Select None</option>';
       }
       
        $response['subLedger'] = $outputS;
        $response['donor'] = $outputD;
        $response['ledgerType'] = $outputLT;
       
echo json_encode($response);
     }
     else 
     {

      echo "Unauthorized access";

    }
   }}
  else
  {

   redirect('login/index/?url=' . $url, 'refresh');
  }

  }
  }

  public function getAssociatedDonor()
   {
       {
   $url = current_url();
   if ($this->session->userdata('logged_in') == true) 
   {  if(is_trans_pending())
        {
        $this->session->set_flashdata("flashMessage", '<div class="alert alert-info" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please take action on draft journals first to make journal entry.</div>');
        redirect('transaction/journalList', 'refresh');
        }else{ 
     if (isset($_POST['chartId']) && isset($_POST['programmId']) && isset($_POST['subLedger'])) 
     {
       $accountId= $_POST['programmId'];
        $currentCharClassId= $_POST['chartId'];
        $subLedgerId = $_POST['subLedger'];
     
       $donor=$this->ledger_model->get_donor_of_ledger_and_subledger($accountId, $currentCharClassId, $subLedgerId);
       $ledgerType = $this->ledger_model->get_account_ledger_type_by_chard_class_id_ledger_and_subledger($accountId, $currentCharClassId, $subLedgerId);
       
        $outputD = "";
       $outputLT = "";
       
       if(!empty($donor))
       {
           $outputD .='<option value="00" class="text-center">Select Donor</option>';
         foreach ($donor as $value)
         {
           $outputD .= '<option value="'.$value->donar_code.'">'.$value->donar_code.'&nbsp;&nbsp;'.$value->donar_name.'</option>';
         }
       }
       else 
       {
         $outputD = '<option value="00"> Select None</option>';
       }
       
       if(!empty($ledgerType))
       {
           $outputLT .='<option value="00" class="text-center">Select Ledger Type</option>';
         foreach ($ledgerType as $value)
         {
           $outputLT .= '<option value="'.$value->ledger_type_code.'">'.$value->ledger_type_code.'&nbsp;&nbsp;'.$value->ledger_type_name.'</option>';
         }
       }
       else 
       {
         $outputLT = '<option value="00"> Select None</option>';
       }
       
        $response['donor'] = $outputD;
        $response['ledgerType'] = $outputLT;
       
echo json_encode($response);
     }
     else 
     {

      echo "Unauthorized access";

    }
   }}
  else
  {

   redirect('login/index/?url=' . $url, 'refresh');
  }

  }
  }

  
  public function getAssociatedLedgerType()
   {
       {
   $url = current_url();
   if ($this->session->userdata('logged_in') == true) 
   {  if(is_trans_pending())
        {
        $this->session->set_flashdata("flashMessage", '<div class="alert alert-info" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please take action on draft journals first to make journal entry.</div>');
        redirect('transaction/journalList', 'refresh');
        }else{ 
     if (isset($_POST['chartId']) && isset($_POST['programmId']) && isset($_POST['subLedger'])) 
     {
       $accountId= $_POST['programmId'];
        $currentCharClassId= $_POST['chartId'];
        $subLedgerId = $_POST['subLedger'];
        $donar = $_POST['donar'];
       
       $ledgerType = $this->ledger_model->get_account_ledger_type_by_chard_class_id_ledger_subledger_and_donar($accountId, $currentCharClassId, $subLedgerId, $donar);
       
       $outputLT = "";
       
       if(!empty($ledgerType))
       {
           $outputLT .='<option value="00" class="text-center">Select Ledger Type</option>';
         foreach ($ledgerType as $value)
         {
           $outputLT .= '<option value="'.$value->ledger_type_code.'">'.$value->ledger_type_code.'&nbsp;&nbsp;'.$value->ledger_type_name.'</option>';
         }
       }
       else 
       {
         $outputLT = '<option value="00"> Select None</option>';
       }
       
        $response['ledgerType'] = $outputLT;
       
echo json_encode($response);
     }
     else 
     {

      echo "Unauthorized access";

    }
   }}
  else
  {

   redirect('login/index/?url=' . $url, 'refresh');
  }

  }
  }
  
  public function checkLedgerMasterCode()
  {
      
      $url = current_url();
   if ($this->session->userdata('logged_in') == true) 
   {  if(is_trans_pending())
        {
        $this->session->set_flashdata("flashMessage", '<div class="alert alert-info" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please take action on draft journals first to make journal entry.</div>');
        redirect('transaction/journalList', 'refresh');
        }else{ 
        $mCode = $_POST['lmCode'];
        
     if (isset($_POST['lmCode'])) 
     {
         $mCode = $_POST['lmCode'];
       $code = $this->ledger_model->check_ledger_master_for_code($mCode); 
       if($code){
           $codeS = 'true';
       }else{
           $codeS = 'false';
       }
       
       $response['code'] = $codeS;
       echo json_encode($response);  
     }
   }}
     else
  {

   redirect('login/index/?url=' . $url, 'refresh');
  }
  }
 



  public function journalEntry()
  {
   $url = current_url();
   if ($this->session->userdata('logged_in') == true) {
       if(is_trans_pending())
        {
        $this->session->set_flashdata("flashMessage", '<div class="alert alert-info" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please take action on draft journals first to make journal entry.</div>');
        redirect('transaction/journalList', 'refresh');
        }else{
$user_id = $this->session->userdata('user_id');
             $username = $this->session->userdata('username');
             $committee_id = $this->session->userdata('committee_id');
             $committee_code = $this->session->userdata('committee_code');
             $fiscal_year = $this->session->userdata('fiscal_year');
     
     $journalNumber = $this->transaction_model->count_all() + 1;
     
  $jnNumber = str_pad($journalNumber, 5, "0", STR_PAD_LEFT);
     $data['journalNumber'] = $committee_code.'-FY'.$fiscal_year.'-'.$jnNumber;
     $data['journalTypes']=$this->ledger_model->getJournalTypes();
     
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
   }} 
   else
   {

    redirect('login/index/?url=' . $url, 'refresh');

  }

  }
  
  
  
  public function journalPreview($id= NULL)
  {
      $url = current_url();
    if ($this->session->userdata('logged_in') == true) {
        if(is_trans_pending())
        {
        $this->session->set_flashdata("flashMessage", '<div class="alert alert-info" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please take action on draft journals first to make journal entry.</div>');
        redirect('transaction/journalList', 'refresh');
        }else{
       $glNo = urldecode($id);
        $glNos = str_replace('&#47;', '/', $glNo);
        
      $user_id = $this->session->userdata('user_id');
             $username = $this->session->userdata('username');
             $committee_id = $this->session->userdata('committee_id');
             $committee_code = $this->session->userdata('committee_code');
             $fiscal_year = $this->session->userdata('fiscal_year');              
             $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
           
    $data['singleGLDetails'] = $this->transaction_model->get_single_transaction_details($glNos);
    $this->load->view('printPreview/preview/templates/header');
     $this->load->view('printPreview/preview/transaction/singleJournalEntry', $data);
     $this->load->view('printPreview/preview/templates/footer');
    
    
    }} else {
      redirect('login/index/?url=' . $url, 'refresh');
    }
  }

  
  public function get_subledgers()
  {
    $url = current_url();
    if ($this->session->userdata('logged_in') == true) {
if(is_trans_pending())
        {
        $this->session->set_flashdata("flashMessage", '<div class="alert alert-info" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please take action on draft journals first to make journal entry.</div>');
        redirect('transaction/journalList', 'refresh');
        }else{
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
    }} else {
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
        if(is_trans_pending())
        {
        $this->session->set_flashdata("flashMessage", '<div class="alert alert-info" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please take action on draft journals first to make journal entry.</div>');
        redirect('transaction/journalList', 'refresh');
        }else{
        $user_id = $this->session->userdata('user_id');
             $username = $this->session->userdata('username');
             $committee_id = $this->session->userdata('committee_id');
             $committee_code = $this->session->userdata('committee_code');
             $fiscal_year = $this->session->userdata('fiscal_year');
     
     $journalNumber = $this->program_model->getCurrentJournalNumer();
     
  $jnNumber = str_pad($journalNumber, 5, "0", STR_PAD_LEFT);
     $data['journalNumber'] = $committee_code.'-FY'.$fiscal_year.'-'.$jnNumber;
     $data['journalTypes']=$this->ledger_model->getJournalTypes();
    
     
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
     
     $data['bankBalance'] = '0';
     
     $this->load->library('form_validation');
     $this->form_validation->set_rules('journalNo', 'Journal No', 'trim|required|max_length[200]');
     $this->form_validation->set_rules('datepicker', 'Date', 'trim|required|callback_xss_clean|max_length[200]');
    
     
     $this->form_validation->set_error_delimiters('<div class="form_errors">', '</div>');

     if ($this->form_validation->run() == FALSE)
     {       
       $this->load->view('dashboard/templates/header');
       $this->load->view('dashboard/templates/sideNavigation');
       $this->load->view('dashboard/templates/topHead');
       $this->load->view('dashboard/transaction/journalEntry', $data);
       $this->load->view('dashboard/templates/footer');   
     }
     else 
     {
         $today = date("Y-m-d");
         $ledgerName = $this->input->post('ledgerName');     
         $glDate = new DateTime($this->input->post('datepicker'));  
         $englishDate = $this->input->post('englishDate');
         $datepicker = $glDate->format('Y-m-d');
         $comment = $this->input->post('comment');      
         $journalNo = $this->input->post('journalNo');              
        $myData = $_POST['mydata'];
       $drCr = json_decode($myData);
      if($today == $englishDate){
       foreach ($drCr as $transData){           
           
           $chartCode = $transData->chartCode;
           $lmcode = $transData->lMCode;
           $accountHd = $this->ledger_model->get_ledger_master_name_by_code($lmcode);
          // $temp1 = preg_replace("/^(\w+\s)/", "", $accountHd);
          // $accountHead = $temp1;
           $accCode = $transData->accCode;
         //  $subLedgerName = $transData->subLedgerName;
           $subLedger_id = $transData->subLedger_id;
          // $donarName = $transData->donarName;
           $donar_id = $transData->donar_id;
           $ledgerType = $transData->ledgerType;
           $description = $transData->description;
           $debits = $transData->debitAmount;
           $debitAmount = str_replace( ',', '', $debits );
           $credits = $transData->creditAmount;
           $creditAmount = str_replace( ',', '', $credits );
           $chequeNo = $transData->chequeNo;
           
           
           if((!empty($debitAmount)) && is_numeric( $debitAmount )){
               $type='dr';
              if($chartCode == '01' || $chartCode == '04'){
                  $this->transaction_model->add_gl_transaction($journalNo, $datepicker, $englishDate, $chartCode, $lmcode, $accountHd, $accCode, $subLedger_id, $donar_id, $ledgerType, $description, $debitAmount, $chequeNo, $type);
              }elseif($chartCode == '02' || $chartCode == '03'){
                  $debitAmount = ('-1') * $debitAmount;
                          $this->transaction_model->add_gl_transaction($journalNo, $datepicker, $englishDate,$chartCode, $lmcode, $accountHd, $accCode, $subLedger_id, $donar_id, $ledgerType, $description, $debitAmount, $chequeNo, $type);
              }else{
                  echo "something went wrong";
              }
              if((($accCode <= '09') && ($accCode >= '00')) && $chartCode =='01'){
               $bankId = $this->transaction_model->get_bank_details_by_ledger_id($accCode);
                $this->transaction_model->add_transaction_to_bank_transaction($journalNo, $datepicker, $englishDate, $lmcode, $description, $debitAmount, $bankId, $type);  
              }else{}
               
           }elseif((!empty ($creditAmount)) && is_numeric( $creditAmount )){
               $type='cr';
               if($chartCode == '01' || $chartCode == '04'){
                  $creditAmount = ('-1') * $creditAmount;
                  $this->transaction_model->add_gl_transaction($journalNo, $datepicker, $englishDate, $chartCode, $lmcode, $accountHd, $accCode, $subLedger_id, $donar_id, $ledgerType, $description, $creditAmount, $chequeNo, $type);
              }elseif($chartCode == '02' || $chartCode == '03'){
                  $this->transaction_model->add_gl_transaction($journalNo, $datepicker, $englishDate, $chartCode, $lmcode, $accountHd, $accCode, $subLedger_id, $donar_id, $ledgerType, $description, $creditAmount, $chequeNo, $type);
              }else{
                  echo "something went wrong";
              }
              if((($accCode <= '09') && ($accCode >= '00')) && $chartCode =='01'){
                 $bankId = $this->transaction_model->get_bank_details_by_ledger_id($accCode);
                $this->transaction_model->add_transaction_to_bank_transaction($journalNo, $datepicker, $englishDate, $lmcode, $description, $creditAmount, $bankId, $type);    
              }else{}
           }else{
               echo 'neither debit nor credit';
           }
       }
       $this->transaction_model->add_comment_of_transaction($journalNo, $comment);
      //switch cases for preview and submit
           switch($_REQUEST['journalEntry']) {
       case 'Submit':
           $this->transaction_model->update_transaction_status_to_approved($journalNo);
          $this->session->set_flashdata("flashMessage", '<div class="alert alert-success" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Transaction added successfully with active status.</div>');
       die;   
       redirect('transaction/journalList');            
           break;

    case 'Preview': 
        $this->transaction_model->update_transaction_status_to_pending($journalNo);
        $this->session->set_flashdata("flashMessage", '<div class="alert alert-success" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Transaction added successfully with pending status.</div>');
        
      
$value = str_replace('/', '&#47;', $journalNo);
$NewNo = urlencode($value);
die;
        redirect('transaction/journalPreview/'.$NewNo);           
        break;

}   
     }else{
         $this->session->set_flashdata("flashMessage", '<div class="alert alert-error" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please check date and submit journal again.</div>');
        
     redirect('transaction/journalEntry', 'refresh'); 
     
     }    
    }

  } 
    }
  else 
  {

    redirect('login/index/?url=' . $url, 'refresh');
    
  }

  }



  }