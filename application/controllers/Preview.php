<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class preview extends CI_Controller {

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
        $this->load->helper('csv');
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

    public function jounalView($id=null) {
        
        
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) {
$glNo = urldecode($id);
        $glNos = str_replace('&#47;', '/', $glNo);
            $orientation = 'landscape';
             $committee_id = $this->session->userdata('committee_id');
             $committee_code = $this->session->userdata('committee_code');
        $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
        $data['singleGLDetails'] = $this->transaction_model->get_single_transaction_details($glNos);     
            $this->load->view('printPreview/download/templates/header');
      $this->load->view('printPreview/download/transaction/singleJournal', $data);
      $this->load->view('printPreview/download/templates/footer');
            // Get output html
            $html = $this->output->get_output();
            // Load library
            $this->load->library('dompdf_gen');

            // Convert to PDF
            $this->dompdf->load_html($html);
            $this->dompdf->set_paper('a4', $orientation);
//            $this->dompdf->set_option('isHtml5ParserEnabled', true);
            $this->dompdf->render();
            $this->dompdf->stream($glNos.".pdf");
            die;
        } else {
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
         
             $this->load->view('printPreview/download/templates/header');
      $this->load->view('printPreview/download/report/ledgerReport', $data);
      $this->load->view('printPreview/download/templates/footer');
      // var_dump($_SERVER["DOCUMENT_ROOT"]);
                     $html = $this->output->get_output();
            // Load library
            $this->load->library('dompdf_gen');

            // Convert to PDF
            $this->dompdf->load_html($html);
            $paper_orientation = 'landscape';
            $customPaper = array(0,0,950,1200);
            $this->dompdf->set_paper($customPaper,$paper_orientation);
//            $this->dompdf->set_paper('a4', $orientation);
            //$this->dompdf->set_option('isHtml5ParserEnabled', true);
            $this->dompdf->render();
            $this->dompdf->stream("Ledger_report_".$ledger.'_'.$fromN."_".$toN.".pdf");
      
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
       
      $this->load->view('printPreview/download/templates/header');
      $this->load->view('printPreview/download/report/subLedgerReport', $data);
      $this->load->view('printPreview/download/templates/footer');
       // var_dump($_SERVER["DOCUMENT_ROOT"]);
                     $html = $this->output->get_output();
            // Load library
            $this->load->library('dompdf_gen');

            // Convert to PDF
            $this->dompdf->load_html($html);
            $paper_orientation = 'landscape';
            $customPaper = array(0,0,950,1200);
            $this->dompdf->set_paper($customPaper,$paper_orientation);
//            $this->dompdf->set_paper('a4', $orientation);
            //$this->dompdf->set_option('isHtml5ParserEnabled', true);
            $this->dompdf->render();
            $this->dompdf->stream("Sub_ledger_report_".$subledger.'_'.$fromN."_".$toN.".pdf");
     } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    public function donorReport($donorCode=NULL, $fromEng=NULL, $reportDateEng=NULL, $toEng=NULL)
    {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) { 
      $user_id = $this->session->userdata('user_id');
             $username = $this->session->userdata('username');
             $committee_id = $this->session->userdata('committee_id');
             $committee_code = $this->session->userdata('committee_code');
             $fiscal_year = $this->session->userdata('fiscal_year');      
            $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
      
        $donar = $donorCode;
         $fromE = $fromEng;
        $fromN = $this->convertToBs($fromE);
        $reportDateE = $reportDateEng;
        $reportDateN = $this->convertToBs($reportDateE);
        $toE = $toEng;
        $toN = $this->convertToBs($toE);
        $data['donarDetails'] = $this->ledger_model->get_donor_info_by_code($donar);
       
        $data['donarLed'] = $this->ledger_model->get_ledger_master_associated_to_donar($donar);
        
      $data['fromN'] = $fromN;
      $data['toN'] = $toN;
      $data['fromE'] = $fromE;
      $data['toE'] = $toE;
      $data['reportN'] = $reportDateN;
      $data['reportE'] = $reportDateE;
      $data['donorCode'] = $donar;
      $data['todayN'] = $this->dayFunctN();
      $data['todayE'] = $this->dayFunctE();

      if($fromN < $toN){
          if($fromN <= $reportDateN && $reportDateN <= $toN){
      
      $this->load->view('printPreview/download/templates/header');
      $this->load->view('printPreview/download/report/donorReport', $data);
      $this->load->view('printPreview/download/templates/footer');
        // var_dump($_SERVER["DOCUMENT_ROOT"]);
                     $html = $this->output->get_output();
            // Load library
            $this->load->library('dompdf_gen');

            // Convert to PDF
            $this->dompdf->load_html($html);
            $paper_orientation = 'landscape';
            $customPaper = array(0,0,950,1500);
            $this->dompdf->set_paper($customPaper,$paper_orientation);
            //$this->dompdf->set_option('isHtml5ParserEnabled', true);
            $this->dompdf->render();
            $this->dompdf->stream("Donor_report_".$donar.'_'.$fromN."_".$toN.".pdf");
          
           }else{
              $this->session->set_flashdata("flashMessage", '<div class="alert alert-warning" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please choose from date before to date and last report date between from and to dates.</div>');
         redirect('reports/dReport', 'refresh');
          }
      }else{
          $this->session->set_flashdata("flashMessage", '<div class="alert alert-warning" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please choose from date before to date.</div>');
         redirect('reports/dReport', 'refresh');
      } 
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
      
      $this->load->view('printPreview/download/templates/header');
      $this->load->view('printPreview/download/report/dayBook', $data);
      $this->load->view('printPreview/download/templates/footer');
     // var_dump($_SERVER["DOCUMENT_ROOT"]);
                     $html = $this->output->get_output();
            // Load library
            $this->load->library('dompdf_gen');

            // Convert to PDF
            $this->dompdf->load_html($html);
            $paper_orientation = 'landscape';
            $customPaper = array(0,0,950,1200);
            $this->dompdf->set_paper($customPaper,$paper_orientation);
//            $this->dompdf->set_paper('a4', $orientation);
            //$this->dompdf->set_option('isHtml5ParserEnabled', true);
            $this->dompdf->render();
            $this->dompdf->stream("Day_Book_".$data['dayN']."(".$data['dayE'].").pdf");
            
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
             $this->load->view('printPreview/download/templates/header');
      $this->load->view('printPreview/download/report/iEReport', $data);
      $this->load->view('printPreview/download/templates/footer');
    // var_dump($_SERVER["DOCUMENT_ROOT"]);
                     $html = $this->output->get_output();
            // Load library
            $this->load->library('dompdf_gen');

            // Convert to PDF
            $this->dompdf->load_html($html);
            $paper_orientation = 'landscape';
            $customPaper = array(0,0,950,1200);
            $this->dompdf->set_paper($customPaper,$paper_orientation);
//            $this->dompdf->set_paper('a4', $orientation);
            //$this->dompdf->set_option('isHtml5ParserEnabled', true);
            $this->dompdf->render();
            $this->dompdf->stream("Income_expenditure_".$fromN."_".$toN.".pdf");
      
      
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
             $this->load->view('printPreview/download/templates/header');
      $this->load->view('printPreview/download/report/balanceSheet', $data);
      $this->load->view('printPreview/download/templates/footer');
     
       // var_dump($_SERVER["DOCUMENT_ROOT"]);
                     $html = $this->output->get_output();
            // Load library
            $this->load->library('dompdf_gen');

            // Convert to PDF
            $this->dompdf->load_html($html);
            $paper_orientation = 'landscape';
            $customPaper = array(0,0,950,1200);
            $this->dompdf->set_paper($customPaper,$paper_orientation);
//            $this->dompdf->set_paper('a4', $orientation);
            //$this->dompdf->set_option('isHtml5ParserEnabled', true);
            $this->dompdf->render();
            $this->dompdf->stream("Balance_sheet_".$fromN."_".$toN.".pdf");
      
      
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
      $this->load->view('printPreview/download/templates/header');
      $this->load->view('printPreview/download/report/trialBalance', $data);
      $this->load->view('printPreview/download/templates/footer');
    // var_dump($_SERVER["DOCUMENT_ROOT"]);
                     $html = $this->output->get_output();
            // Load library
            $this->load->library('dompdf_gen');

            // Convert to PDF
            $this->dompdf->load_html($html);
            $paper_orientation = 'landscape';
            $customPaper = array(0,0,950,1200);
            $this->dompdf->set_paper($customPaper,$paper_orientation);
//            $this->dompdf->set_paper('a4', $orientation);
            //$this->dompdf->set_option('isHtml5ParserEnabled', true);
            $this->dompdf->render();
            $this->dompdf->stream("Trial_balance_".$fromN."_".$toN.".pdf");
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
    
 public function convertToAd($day=Null)
{
    
    $tday = new DateTime($day);
$date = $tday->format('Y-m-d');
$dates = date_parse_from_format("Y.m.d", $date);

$year =  str_pad($dates['year'], 4, "0", STR_PAD_LEFT);
$month = str_pad($dates['month'], 2, "0", STR_PAD_LEFT);
$days = str_pad($dates['day'], 2, "0", STR_PAD_LEFT);

$this->load->library("nepali_calendar");
$currentNepaliDay = $this->nepali_calendar->BS_to_AD($year,$month,$days);
$nepaliDay = $currentNepaliDay['date'];
$nepaliMth = $currentNepaliDay['month'];
$nepaliYr = $currentNepaliDay['year'];
$todayNep = $nepaliYr.'/'.$nepaliMth.'/'.$nepaliDay;

$tday = new DateTime($todayNep);

$dateOfToday = $tday->format('Y-m-d');
return $dateOfToday;


}   

}
