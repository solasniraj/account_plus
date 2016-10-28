  <?php if (!defined('BASEPATH'))
  exit('No direct script access allowed');
  class printview extends CI_Controller {
    function __construct() {
      parent::__construct();
      $this->load->library('session');
       $this->load->model('report_model');
         $this->load->model('transaction_model');
         $this->load->model('dbmanager_model');
         $this->load->model('ledger_model');
      $this->load->helper('url');
      $this->load->helper(array('form', 'url'));
      $this->load->library('pagination');
       $this->load->library('Numbertowords');
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
            
       } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    public function printJoural($id= NULL )
    {
     if ($this->session->userdata('logged_in') == true)
      {
         $url = current_url();
         if( $id === NULL )
         {
          return redirect('dashboard', 'refresh');
         }
      $glNo = urldecode($id);
        $glNos = str_replace('&#47;', '/', $glNo);
     $user_id = $this->session->userdata('user_id');
             $username = $this->session->userdata('username');
             $committee_id = $this->session->userdata('committee_id');
             $committee_code = $this->session->userdata('committee_code');
             $fiscal_year = $this->session->userdata('fiscal_year'); 
             
             $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
        $data['singleGLDetails'] = $this->transaction_model->get_single_transaction_details($glNos);     
      
      $this->load->view('printPreview/printView/templates/header');
      $this->load->view('printPreview/printView/transaction/singleJournalEntryPrint', $data);
      $this->load->view('printPreview/printView/templates/footer');
       }
        else 
        {
          redirect('login/index/?url=' . $url, 'refresh');
    }
  }
  
  public function ledgerReport($fromEng=NULL, $toEng=NULL, $ledCode=NULL)
    {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) { 
      $user_id = $this->session->userdata('user_id');
             $username = $this->session->userdata('username');
             $committee_id = $this->session->userdata('committee_id');
             $committee_code = $this->session->userdata('committee_code');
             $fiscal_year = $this->session->userdata('fiscal_year');              
             $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
      
        $fromE = $fromEng;
        $fromN = $this->convertToBs($fromE);
        $toE = $toEng;
        $toN = $this->convertToBs($toE);
        $ledger = $ledCode;
         $data['fromN'] = $fromN;
      $data['toN'] = $toN;
      $data['fromE'] = $fromE;
      $data['toE'] = $toE; 
      $data['todayN'] = $this->dayFunctN();
      $data['todayE'] = $this->dayFunctE();
      $data['ledgerDetails'] = $this->ledger_model->get_ledger_details_by_ledger_code($ledger);
       
        $data['ledgerRep'] = $this->report_model->get_transaction_details_of_ledger_with_in_dates($ledger, $fromN, $fromE, $toN, $toE);
         
             $this->load->view('printPreview/printView/templates/header');
      $this->load->view('printPreview/printView/report/ledgerReport', $data);
      $this->load->view('printPreview/printView/templates/footer');
      
     } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    public function subLedgerReport($fromEng=NULL, $toEng=NULL, $sledCode=NULL)
    {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) { 
      $user_id = $this->session->userdata('user_id');
             $username = $this->session->userdata('username');
             $committee_id = $this->session->userdata('committee_id');
             $committee_code = $this->session->userdata('committee_code');
             $fiscal_year = $this->session->userdata('fiscal_year');              
             $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
      
       $fromE = $fromEng;
        $fromN = $this->convertToBs($fromE);
        $toE = $toEng;
        $toN = $this->convertToBs($toE);
        $subledger = $sledCode;
        $data['subLedgerDetails'] = $this->ledger_model->get_sub_ledger_info_by_code($subledger);
       
        $data['ledgerRep'] = $this->report_model->get_transaction_details_of_sub_ledger_with_in_dates($subledger, $fromN, $fromE, $toN, $toE);
        
      $data['fromN'] = $fromN;
      $data['toN'] = $toN;
      $data['fromE'] = $fromE;
      $data['toE'] = $toE;
       $data['todayN'] = $this->dayFunctN();
      $data['todayE'] = $this->dayFunctE();
       
      $this->load->view('printPreview/printView/templates/header');
      $this->load->view('printPreview/printView/report/subLedgerReport', $data);
      $this->load->view('printPreview/printView/templates/footer');
      
     } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    public function donorReport()
    {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) { 
      $user_id = $this->session->userdata('user_id');
             $username = $this->session->userdata('username');
             $committee_id = $this->session->userdata('committee_id');
             $committee_code = $this->session->userdata('committee_code');
             $fiscal_year = $this->session->userdata('fiscal_year');      
            
             $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);        
       
             $this->load->view('printPreview/printView/templates/header');
      $this->load->view('printPreview/printView/report/trialBalance', $data);
      $this->load->view('printPreview/printView/templates/footer');
      
     } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    public function dayBook($dayE)
    {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) { 
      $user_id = $this->session->userdata('user_id');
             $username = $this->session->userdata('username');
             $committee_id = $this->session->userdata('committee_id');
             $committee_code = $this->session->userdata('committee_code');
             $fiscal_year = $this->session->userdata('fiscal_year');      
            
             $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);        
       
             $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
    
        if (!$dayE) {
                $day = date('Y-m-d');
                $data['dayN'] = $this->dayFunctN();
      $data['dayE'] = $this->dayFunctE();
            }else{
                $day = $dayE;
        $nepaliDate = $this->convertToBs($dayE);
                $data['dayN'] = $nepaliDate;
      $data['dayE'] = $day;
            }        
        $data['journalEntry'] = $this->report_model->get_journal_entry_for_day($day);
      $data['day']= $day;
      $data['nepaliDay'] = $nepaliDate;
      $data['todayN'] = $this->dayFunctN();
      $data['todayE'] = $this->dayFunctE();
             
             $this->load->view('printPreview/printView/templates/header');
      $this->load->view('printPreview/printView/report/dayBook', $data);
      $this->load->view('printPreview/printView/templates/footer');
      
     } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    public function iEReport($fiscal=NULL, $fromEng=NULL, $toEng=NULL)
    {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) { 
      $user_id = $this->session->userdata('user_id');
             $username = $this->session->userdata('username');
             $committee_id = $this->session->userdata('committee_id');
             $committee_code = $this->session->userdata('committee_code');
             $fiscal_year = $this->session->userdata('fiscal_year');              
             $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
      
        $FisYr = urldecode($fiscal);
        $fiscalData = str_replace('&#47;', '/', $FisYr);
        
        $fromE = $fromEng;
        $fromN = $this->convertToBs($fromE);
        $toE = $toEng;
        $toN = $this->convertToBs($toE);
         $data['fromN'] = $fromN;
      $data['toN'] = $toN;
      $data['fromE'] = $fromE;
      $data['toE'] = $toE; 
      $data['todayN'] = $this->dayFunctN();
      $data['todayE'] = $this->dayFunctE();
      $data['allLedger'] = $this->ledger_model->get_ledger_master_listing_of_income_and_expn();
      
      
      if($fiscalData == $fiscal_year)  { 
             $this->load->view('printPreview/printView/templates/header');
      $this->load->view('printPreview/printView/report/iEReport', $data);
      $this->load->view('printPreview/printView/templates/footer');
      }else{
          $this->session->set_flashdata("flashMessage", '<div class="alert alert-info" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please choose proper fiscal year.</div>');
         redirect('reports/ieAccounts', 'refresh');
      } 
     } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    public function balanceSheet($fiscal=NULL, $fromEng=NULL, $toEng=NULL)
    {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) { 
      $user_id = $this->session->userdata('user_id');
             $username = $this->session->userdata('username');
             $committee_id = $this->session->userdata('committee_id');
             $committee_code = $this->session->userdata('committee_code');
             $fiscal_year = $this->session->userdata('fiscal_year');              
             $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
      
        $FisYr = urldecode($fiscal);
        $fiscalData = str_replace('&#47;', '/', $FisYr);
        
        $fromE = $fromEng;
        $fromN = $this->convertToBs($fromE);
        $toE = $toEng;
        $toN = $this->convertToBs($toE);
         $data['fromN'] = $fromN;
      $data['toN'] = $toN;
      $data['fromE'] = $fromE;
      $data['toE'] = $toE; 
      $data['todayN'] = $this->dayFunctN();
      $data['todayE'] = $this->dayFunctE();
      $data['incExpnLed'] = $this->ledger_model->get_ledger_master_listing_of_income_and_expn();
      $data['allLedger'] = $this->ledger_model->get_ledger_master_listing_of_assets_and_liability();
      
      if($fiscalData == $fiscal_year)  {  
             $this->load->view('printPreview/printView/templates/header');
      $this->load->view('printPreview/printView/report/balanceSheet', $data);
      $this->load->view('printPreview/printView/templates/footer');
      }else{
         $this->session->set_flashdata("flashMessage", '<div class="alert alert-info" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please choose proper fiscal year.</div>');
         redirect('reports/bSheet', 'refresh');
      }
     } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    public function trialBalance($fiscal=NULL, $fromEng=NULL, $toEng=NULL)
    {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) { 
      $user_id = $this->session->userdata('user_id');
             $username = $this->session->userdata('username');
             $committee_id = $this->session->userdata('committee_id');
             $committee_code = $this->session->userdata('committee_code');
             $fiscal_year = $this->session->userdata('fiscal_year');      
    $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);        
    $FisYr = urldecode($fiscal);
        $fiscalData = str_replace('&#47;', '/', $FisYr);
        
        $fromE = $fromEng;
        $fromN = $this->convertToBs($fromE);
        $toE = $toEng;
        $toN = $this->convertToBs($toE);
         $data['fromN'] = $fromN;
      $data['toN'] = $toN;
      $data['fromE'] = $fromE;
      $data['toE'] = $toE; 
      $data['todayN'] = $this->dayFunctN();
      $data['todayE'] = $this->dayFunctE();

      $data['allLedger'] = $this->ledger_model->get_ledger_master_listing();
     if($fiscalData == $fiscal_year)  {
             $this->load->view('printPreview/printView/templates/header');
      $this->load->view('printPreview/printView/report/trialBalance', $data);
      $this->load->view('printPreview/printView/templates/footer');
       }else{
          $this->session->set_flashdata("flashMessage", '<div class="alert alert-info" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please choose proper fiscal year.</div>');
         redirect('reports/tBalance', 'refresh');
      }      
             
     } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
  
  
  
  public function dayFunctN()
{
    date_default_timezone_set('Asia/Kathmandu');
$currentYear = date('Y');
$currentMonth = date('m');
$currentDay = date('d');
$this->load->library("nepali_calendar");
$currentNepaliDay = $this->nepali_calendar->AD_to_BS($currentYear,$currentMonth,$currentDay);
$nepaliDay = $currentNepaliDay['date'];
$nepaliMth = $currentNepaliDay['month'];
$nepaliYr = $currentNepaliDay['year'];
$todayNep = $nepaliYr.'/'.$nepaliMth.'/'.$nepaliDay;

$tday = new DateTime($todayNep);

$dateOfToday = $tday->format('Y-m-d');
return $dateOfToday;
}

public function dayFunctE()
{
    date_default_timezone_set('Asia/Kathmandu');
    $today = date('Y-m-d');
    return $today;
}
  
  
  public function convertToBs($day=Null)
{
    $tday = new DateTime($day);
$date = $tday->format('Y-m-d');

$year = date('Y', strtotime($date));
$month = date('m', strtotime($date));
$days = date('d', strtotime($date));

$this->load->library("nepali_calendar");
$currentNepaliDay = $this->nepali_calendar->AD_to_BS($year,$month,$days);
$nepaliDay = $currentNepaliDay['date'];
$nepaliMth = $currentNepaliDay['month'];
$nepaliYr = $currentNepaliDay['year'];
$todayNep = $nepaliYr.'/'.$nepaliMth.'/'.$nepaliDay;

$tday = new DateTime($todayNep);

$dateOfToday = $tday->format('Y-m-d');
return $dateOfToday;


}
    
  
  
  
  
  
  
  
  
  
  
  
}