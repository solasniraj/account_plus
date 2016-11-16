<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class reports extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('report_model');
        $this->load->model('transaction_model');
        $this->load->model('dbmanager_model');
        $this->load->model('dbuser');
        $this->load->model('ledger_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
        $this->load->library('Numbertowords');
        if (is_trans_pending()) {
            $this->session->set_flashdata("flashMessage", '<div class="alert alert-info" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please take action on draft journals first to make journal entry.</div>');
            redirect('transaction/journalList', 'refresh');
        }
    }

    public function index() {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) {
            $user_id = $this->session->userdata('user_id');
            $username = $this->session->userdata('username');
            $committee_id = $this->session->userdata('committee_id');
            $committee_code = $this->session->userdata('committee_code');
            $fiscal_year = $this->session->userdata('fiscal_year');
            $fiscalCode = $this->session->userdata('fiscal_code');
            $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
            $data['userRole'] = $this->dbuser->get_user_role_by_user_name_and_id($username, $user_id);

            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sideNavigation');
            $this->load->view('dashboard/templates/topHead');
            $this->load->view('dashboard/report/summery');
            $this->load->view('dashboard/templates/footer');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function dayBook() {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) {
            $user_id = $this->session->userdata('user_id');
            $username = $this->session->userdata('username');
            $committee_id = $this->session->userdata('committee_id');
            $committee_code = $this->session->userdata('committee_code');
            $fiscal_year = $this->session->userdata('fiscal_year');
            $fiscalCode = $this->session->userdata('fiscal_code');
            $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
            $data['userRole'] = $this->dbuser->get_user_role_by_user_name_and_id($username, $user_id);

            $day = $this->input->post('englishDate');
            $nepaliDate = $this->input->post('datepicker');
            if (!$day) {
                $day = date('Y-m-d');
                $data['dayN'] = $this->dayFunctN();
                $data['dayE'] = $this->dayFunctE();
            } else {
                $data['dayN'] = $nepaliDate;
                $data['dayE'] = $day;
            }
            $data['journalEntry'] = $this->report_model->get_journal_entry_for_day($day);
            $data['day'] = $day;
            $data['nepaliDay'] = $nepaliDate;
            $data['todayN'] = $this->dayFunctN();
            $data['todayE'] = $this->dayFunctE();
            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sideNavigation');
            $this->load->view('dashboard/templates/topHead');
            $this->load->view('dashboard/report/dayBook', $data);
            $this->load->view('dashboard/templates/footer');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function lReport() {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) {
            $user_id = $this->session->userdata('user_id');
            $username = $this->session->userdata('username');
            $committee_id = $this->session->userdata('committee_id');
            $committee_code = $this->session->userdata('committee_code');
            $fiscal_year = $this->session->userdata('fiscal_year');
            $fiscalCode = $this->session->userdata('fiscal_code');
            $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
            $data['userRole'] = $this->dbuser->get_user_role_by_user_name_and_id($username, $user_id);

            $data['ledgerDetails'] = $this->ledger_model->get_ledger_master_listing();
            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sideNavigation');
            $this->load->view('dashboard/templates/topHead');
            $this->load->view('dashboard/report/ledgerQueryForm', $data);
            $this->load->view('dashboard/templates/footer');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function ledgerReport() {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) {
            $user_id = $this->session->userdata('user_id');
            $username = $this->session->userdata('username');
            $committee_id = $this->session->userdata('committee_id');
            $committee_code = $this->session->userdata('committee_code');
            $fiscal_year = $this->session->userdata('fiscal_year');
            $fiscalCode = $this->session->userdata('fiscal_code');
            $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
            $data['userRole'] = $this->dbuser->get_user_role_by_user_name_and_id($username, $user_id);
            $ledger = $this->input->post('ledgerCode');
            $fromN = $this->input->post('nepaliDateF');
            $fromE = $this->input->post('englishDateF');
            $toN = $this->input->post('nepaliDateT');
            $toE = $this->input->post('englishDateT');
            $data['ledgerDetails'] = $this->ledger_model->get_ledger_details_by_ledger_code($ledger);

            $data['ledgerRep'] = $this->report_model->get_transaction_details_of_ledger_with_in_dates($ledger, $fromN, $fromE, $toN, $toE);

            $data['fromN'] = $fromN;
            $data['toN'] = $toN;
            $data['fromE'] = $fromE;
            $data['toE'] = $toE;
            $data['todayN'] = $this->dayFunctN();
            $data['todayE'] = $this->dayFunctE();
            if ($fromN < $toN) {
                $this->load->view('dashboard/templates/header', $data);
                $this->load->view('dashboard/templates/sideNavigation');
                $this->load->view('dashboard/templates/topHead');
                $this->load->view('dashboard/report/ledgerReport', $data);
                $this->load->view('dashboard/templates/footer');
            } else {
                $this->session->set_flashdata("flashMessage", '<div class="alert alert-warning" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please choose from date before to date.</div>');
                redirect('reports/lReport', 'refresh');
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function slReport() {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) {
            $user_id = $this->session->userdata('user_id');
            $username = $this->session->userdata('username');
            $committee_id = $this->session->userdata('committee_id');
            $committee_code = $this->session->userdata('committee_code');
            $fiscal_year = $this->session->userdata('fiscal_year');
            $fiscalCode = $this->session->userdata('fiscal_code');
            $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
            $data['userRole'] = $this->dbuser->get_user_role_by_user_name_and_id($username, $user_id);
            $data['subLedgerDetails'] = $this->ledger_model->get_sub_ledger_info();
            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sideNavigation');
            $this->load->view('dashboard/templates/topHead');
            $this->load->view('dashboard/report/subLedgerQueryForm', $data);
            $this->load->view('dashboard/templates/footer');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function subLedgerReport() {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) {
            $user_id = $this->session->userdata('user_id');
            $username = $this->session->userdata('username');
            $committee_id = $this->session->userdata('committee_id');
            $committee_code = $this->session->userdata('committee_code');
            $fiscal_year = $this->session->userdata('fiscal_year');
            $fiscalCode = $this->session->userdata('fiscal_code');
            $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
            $data['userRole'] = $this->dbuser->get_user_role_by_user_name_and_id($username, $user_id);
            $subledger = $this->input->post('ledgerCode');
            $fromN = $this->input->post('nepaliDateF');
            $fromE = $this->input->post('englishDateF');
            $toN = $this->input->post('nepaliDateT');
            $toE = $this->input->post('englishDateT');
            $data['subLedgerDetails'] = $this->ledger_model->get_sub_ledger_info_by_code($subledger);

            $data['ledgerRep'] = $this->report_model->get_transaction_details_of_sub_ledger_with_in_dates($subledger, $fromN, $fromE, $toN, $toE);

            $data['fromN'] = $fromN;
            $data['toN'] = $toN;
            $data['fromE'] = $fromE;
            $data['toE'] = $toE;
            $data['todayN'] = $this->dayFunctN();
            $data['todayE'] = $this->dayFunctE();
            if ($fromN < $toN) {
                $this->load->view('dashboard/templates/header', $data);
                $this->load->view('dashboard/templates/sideNavigation');
                $this->load->view('dashboard/templates/topHead');
                $this->load->view('dashboard/report/subLedgerReport', $data);
                $this->load->view('dashboard/templates/footer');
            } else {
                $this->session->set_flashdata("flashMessage", '<div class="alert alert-warning" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please choose from date before to date.</div>');
                redirect('reports/slReport', 'refresh');
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function dReport() {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) {
            $user_id = $this->session->userdata('user_id');
            $username = $this->session->userdata('username');
            $committee_id = $this->session->userdata('committee_id');
            $committee_code = $this->session->userdata('committee_code');
            $fiscal_year = $this->session->userdata('fiscal_year');
            $fiscalCode = $this->session->userdata('fiscal_code');
            $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
            $data['userRole'] = $this->dbuser->get_user_role_by_user_name_and_id($username, $user_id);
            $data['donorDetails'] = $this->ledger_model->get_all_donar();
            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sideNavigation');
            $this->load->view('dashboard/templates/topHead');
            $this->load->view('dashboard/report/donorQueryForm', $data);
            $this->load->view('dashboard/templates/footer');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function donorReport() { {
            $url = current_url();
            if ($this->session->userdata('logged_in') == true) {
                $user_id = $this->session->userdata('user_id');
                $username = $this->session->userdata('username');
                $committee_id = $this->session->userdata('committee_id');
                $committee_code = $this->session->userdata('committee_code');
                $fiscal_year = $this->session->userdata('fiscal_year');
                $fiscalCode = $this->session->userdata('fiscal_code');
                $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
                $data['userRole'] = $this->dbuser->get_user_role_by_user_name_and_id($username, $user_id);
                $donar = $this->input->post('ledgerCode');
                $fromN = $this->input->post('nepaliDateF');
                $fromE = $this->input->post('englishDateF');
                $reportDateN = $this->input->post('nepaliDateLR');
                $reportDateE = $this->input->post('englishDateLR');
                $toN = $this->input->post('nepaliDateT');
                $toE = $this->input->post('englishDateT');
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

                if ($fromN < $toN) {
                    if ($fromN <= $reportDateN && $reportDateN <= $toN) {
                        $this->load->view('dashboard/templates/header', $data);
                        $this->load->view('dashboard/templates/sideNavigation');
                        $this->load->view('dashboard/templates/topHead');
                        $this->load->view('dashboard/report/donorReport', $data);
                        $this->load->view('dashboard/templates/footer');
                    } else {
                        $this->session->set_flashdata("flashMessage", '<div class="alert alert-warning" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please choose from date before to date and last report date between from and to dates.</div>');
                        redirect('reports/dReport', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata("flashMessage", '<div class="alert alert-warning" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please choose from date before to date.</div>');
                    redirect('reports/dReport', 'refresh');
                }
            } else {
                redirect('login/index/?url=' . $url, 'refresh');
            }
        }
    }

    public function bankCashBook() {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) {

            $this->load->view('dashboard/templates/header');
            $this->load->view('dashboard/templates/sideNavigation');
            $this->load->view('dashboard/templates/topHead');
            $this->load->view('dashboard/report/bankCashBook');
            $this->load->view('dashboard/templates/footer');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function trialBalance() {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) {
            $user_id = $this->session->userdata('user_id');
            $username = $this->session->userdata('username');
            $committee_id = $this->session->userdata('committee_id');
            $committee_code = $this->session->userdata('committee_code');
            $fiscal_year = $this->session->userdata('fiscal_year');
            $fiscalCode = $this->session->userdata('fiscal_code');
            $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
            $data['userRole'] = $this->dbuser->get_user_role_by_user_name_and_id($username, $user_id);
            $fiscalStart = $this->dbmanager_model->get_latest_unlocked_fiscal_year_start_date();
            $fscSt = new DateTime($fiscalStart);
            $fiscalYrStart = $fscSt->format('Y-m-d');

            $data['fromN'] = $fiscalYrStart;
            $data['fromE'] = $this->convertToAd($fiscalYrStart);
            $data['todayN'] = $this->dayFunctN();
            $data['todayE'] = $this->dayFunctE();

            $data['allLedger'] = $this->ledger_model->get_ledger_master_listing();


            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sideNavigation');
            $this->load->view('dashboard/templates/topHead');
            $this->load->view('dashboard/report/trialBalance', $data);
            $this->load->view('dashboard/templates/footer');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function incomeExpnReport() {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) {
            $user_id = $this->session->userdata('user_id');
            $username = $this->session->userdata('username');
            $committee_id = $this->session->userdata('committee_id');
            $committee_code = $this->session->userdata('committee_code');
            $fiscal_year = $this->session->userdata('fiscal_year');
            $fiscalCode = $this->session->userdata('fiscal_code');
            $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
            $data['userRole'] = $this->dbuser->get_user_role_by_user_name_and_id($username, $user_id);
            $fiscalStart = $this->dbmanager_model->get_latest_unlocked_fiscal_year_start_date();
            $fscSt = new DateTime($fiscalStart);
            $fiscalYrStart = $fscSt->format('Y-m-d');

            $data['fromN'] = $fiscalYrStart;
            $data['fromE'] = $this->convertToAd($fiscalYrStart);
            $data['todayN'] = $this->dayFunctN();
            $data['todayE'] = $this->dayFunctE();
            $data['allLedger'] = $this->ledger_model->get_ledger_master_listing_of_income_and_expn();



            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sideNavigation');
            $this->load->view('dashboard/templates/topHead');
            $this->load->view('dashboard/report/incomeExpnReport', $data);
            $this->load->view('dashboard/templates/footer');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function balanceSheet() {

        $url = current_url();
        if ($this->session->userdata('logged_in') == true) {
            $user_id = $this->session->userdata('user_id');
            $username = $this->session->userdata('username');
            $committee_id = $this->session->userdata('committee_id');
            $committee_code = $this->session->userdata('committee_code');
            $fiscal_year = $this->session->userdata('fiscal_year');
            $fiscalCode = $this->session->userdata('fiscal_code');
            $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
            $data['userRole'] = $this->dbuser->get_user_role_by_user_name_and_id($username, $user_id);
            $fiscalStart = $this->dbmanager_model->get_latest_unlocked_fiscal_year_start_date();
            $fscSt = new DateTime($fiscalStart);
            $fiscalYrStart = $fscSt->format('Y-m-d');

            $data['fromN'] = $fiscalYrStart;
            $data['fromE'] = $this->convertToAd($fiscalYrStart);
            $data['todayN'] = $this->dayFunctN();
            $data['todayE'] = $this->dayFunctE();
            $data['incExpnLed'] = $this->ledger_model->get_ledger_master_listing_of_income_and_expn();
            $data['allLedger'] = $this->ledger_model->get_ledger_master_listing_of_assets_and_liability();


            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sideNavigation');
            $this->load->view('dashboard/templates/topHead');
            $this->load->view('dashboard/report/balanceSheet', $data);
            $this->load->view('dashboard/templates/footer');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function brs() {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) {
            $user_id = $this->session->userdata('user_id');
            $username = $this->session->userdata('username');
            $committee_id = $this->session->userdata('committee_id');
            $committee_code = $this->session->userdata('committee_code');
            $fiscal_year = $this->session->userdata('fiscal_year');
            $fiscalCode = $this->session->userdata('fiscal_code');
            $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
            $data['userRole'] = $this->dbuser->get_user_role_by_user_name_and_id($username, $user_id);

            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sideNavigation');
            $this->load->view('dashboard/templates/topHead');
            $this->load->view('dashboard/report/bankreconcillationReport', $data);
            $this->load->view('dashboard/templates/footer');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function cLedger() {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) {
            $user_id = $this->session->userdata('user_id');
            $username = $this->session->userdata('username');
            $committee_id = $this->session->userdata('committee_id');
            $committee_code = $this->session->userdata('committee_code');
            $fiscal_year = $this->session->userdata('fiscal_year');
            $fiscalCode = $this->session->userdata('fiscal_code');
            $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
            $data['userRole'] = $this->dbuser->get_user_role_by_user_name_and_id($username, $user_id);
            $data['donorDetails'] = $this->ledger_model->get_all_donar();
            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sideNavigation');
            $this->load->view('dashboard/templates/topHead');
            $this->load->view('dashboard/report/cLedgerQueryForm', $data);
            $this->load->view('dashboard/templates/footer');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function controlLedger() {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) {
            $user_id = $this->session->userdata('user_id');
            $username = $this->session->userdata('username');
            $committee_id = $this->session->userdata('committee_id');
            $committee_code = $this->session->userdata('committee_code');
            $fiscal_year = $this->session->userdata('fiscal_year');
            $fiscalCode = $this->session->userdata('fiscal_code');
            $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
            $data['userRole'] = $this->dbuser->get_user_role_by_user_name_and_id($username, $user_id);
            $fiscalStart = $this->dbmanager_model->get_latest_unlocked_fiscal_year_start_date();

            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('donorName', 'Donor', 'trim|required|callback_xss_clean');
            $this->form_validation->set_rules('nepaliDateF', 'From Date', 'trim|required|callback_xss_clean');
            $this->form_validation->set_rules('nepaliDateT', 'To Date', 'trim|required|callback_xss_clean');
            $this->form_validation->set_error_delimiters('<div class="form_errors">', '</div>');
            if ($this->form_validation->run() == FALSE) {
                $this->cLedger();
            } else {

                $fscSt = new DateTime($fiscalStart);
                $fiscalYrStart = $fscSt->format('Y-m-d');

                $data['fromN'] = $fiscalYrStart;
                $data['fromE'] = $this->convertToAd($fiscalYrStart);
                $data['todayN'] = $this->dayFunctN();
                $data['todayE'] = $this->dayFunctE();


                $this->load->view('dashboard/templates/header', $data);
                $this->load->view('dashboard/templates/sideNavigation');
                $this->load->view('dashboard/templates/topHead');
                $this->load->view('dashboard/report/controlLedger', $data);
                $this->load->view('dashboard/templates/footer');
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function fStatus() {

        $url = current_url();
        if ($this->session->userdata('logged_in') == true) {
            $user_id = $this->session->userdata('user_id');
            $username = $this->session->userdata('username');
            $committee_id = $this->session->userdata('committee_id');
            $committee_code = $this->session->userdata('committee_code');
            $fiscal_year = $this->session->userdata('fiscal_year');
            $fiscalCode = $this->session->userdata('fiscal_code');
            $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
            $data['userRole'] = $this->dbuser->get_user_role_by_user_name_and_id($username, $user_id);
            $data['donorDetails'] = $this->ledger_model->get_all_donar();
            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sideNavigation');
            $this->load->view('dashboard/templates/topHead');
            $this->load->view('dashboard/report/fStatusQueryForm', $data);
            $this->load->view('dashboard/templates/footer');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function fundStatus() {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) {
            $user_id = $this->session->userdata('user_id');
            $username = $this->session->userdata('username');
            $committee_id = $this->session->userdata('committee_id');
            $committee_code = $this->session->userdata('committee_code');
            $fiscal_year = $this->session->userdata('fiscal_year');
            $fiscalCode = $this->session->userdata('fiscal_code');
            $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
            $data['userRole'] = $this->dbuser->get_user_role_by_user_name_and_id($username, $user_id);

            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('donorName', 'Donor', 'trim|required|callback_xss_clean');
            $this->form_validation->set_rules('nepaliDateF', 'From Date', 'trim|required|callback_xss_clean');
            $this->form_validation->set_rules('nepaliDateT', 'To Date', 'trim|required|callback_xss_clean');
            $this->form_validation->set_error_delimiters('<div class="form_errors">', '</div>');
            if ($this->form_validation->run() == FALSE) {
                $this->fStatus();
            } else {
                $fromN = $this->input->post('nepaliDateF');
                $fromE = $this->input->post('englishDateF');
                $toN = $this->input->post('nepaliDateT');
                $toE = $this->input->post('englishDateT');
                
                $data['fromN'] = $fromN;
                $data['toN'] = $toN;
                $data['fromE'] = $fromE;
                $data['toE'] = $toE;
                $data['todayN'] = $this->dayFunctN();
                $data['todayE'] = $this->dayFunctE();
                
                if ($fromN < $toN) {
                if($data['todayN'] >= $data['toN']){
                $this->load->view('dashboard/templates/header', $data);
                $this->load->view('dashboard/templates/sideNavigation');
                $this->load->view('dashboard/templates/topHead');
                $this->load->view('dashboard/report/fundStatus', $data);
                $this->load->view('dashboard/templates/footer');
                }else{
                  $this->session->set_flashdata("flashMessage", '<div class="alert alert-warning" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please choose from date and to date before or equal to today.</div>');
                        redirect('reports/fStatus', 'refresh');   
                }
                }else{
                     $this->session->set_flashdata("flashMessage", '<div class="alert alert-warning" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please choose from date before to date.</div>');
                    redirect('reports/fStatus', 'refresh');
                }
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function pSheet() { {
            $url = current_url();
            if ($this->session->userdata('logged_in') == true) {
                $user_id = $this->session->userdata('user_id');
                $username = $this->session->userdata('username');
                $committee_id = $this->session->userdata('committee_id');
                $committee_code = $this->session->userdata('committee_code');
                $fiscal_year = $this->session->userdata('fiscal_year');
                $fiscalCode = $this->session->userdata('fiscal_code');
                $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
                $data['userRole'] = $this->dbuser->get_user_role_by_user_name_and_id($username, $user_id);

                $this->load->view('dashboard/templates/header', $data);
                $this->load->view('dashboard/templates/sideNavigation');
                $this->load->view('dashboard/templates/topHead');
                $this->load->view('dashboard/report/pSheetQueryForm', $data);
                $this->load->view('dashboard/templates/footer');
            } else {
                redirect('login/index/?url=' . $url, 'refresh');
            }
        }
    }

    public function payableSheet() {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) {
            $user_id = $this->session->userdata('user_id');
            $username = $this->session->userdata('username');
            $committee_id = $this->session->userdata('committee_id');
            $committee_code = $this->session->userdata('committee_code');
            $fiscal_year = $this->session->userdata('fiscal_year');
            $fiscalCode = $this->session->userdata('fiscal_code');
            $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
            $data['userRole'] = $this->dbuser->get_user_role_by_user_name_and_id($username, $user_id);

            $this->load->library(array('form_validation', 'session'));
            
            $this->form_validation->set_rules('nepaliDateF', 'From Date', 'trim|required|callback_xss_clean');
            $this->form_validation->set_rules('nepaliDateT', 'To Date', 'trim|required|callback_xss_clean');
            $this->form_validation->set_error_delimiters('<div class="form_errors">', '</div>');
            if ($this->form_validation->run() == FALSE) {
                $this->pSheet();
            } else {
                $fromN = $this->input->post('nepaliDateF');
                $fromE = $this->input->post('englishDateF');
                $toN = $this->input->post('nepaliDateT');
                $toE = $this->input->post('englishDateT');
                
                $data['fromN'] = $fromN;
                $data['toN'] = $toN;
                $data['fromE'] = $fromE;
                $data['toE'] = $toE;
                $data['todayN'] = $this->dayFunctN();
                $data['todayE'] = $this->dayFunctE();
                
                if ($fromN < $toN) {
                if($data['todayN'] >= $data['toN']){
                    $data['payable'] = $this->report_model->get_accounts_payable_from_liability_from_journal($fromN, $fromE, $toN, $toE);
                $this->load->view('dashboard/templates/header', $data);
                $this->load->view('dashboard/templates/sideNavigation');
                $this->load->view('dashboard/templates/topHead');
                $this->load->view('dashboard/report/payableSheet', $data);
                $this->load->view('dashboard/templates/footer');
                }else{
                  $this->session->set_flashdata("flashMessage", '<div class="alert alert-warning" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please choose from date and to date before or equal to today.</div>');
                        redirect('reports/pSheet', 'refresh');   
                }
                }else{
                     $this->session->set_flashdata("flashMessage", '<div class="alert alert-warning" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please choose from date before to date.</div>');
                    redirect('reports/pSheet', 'refresh');
                }
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function oAdvance() {

        $url = current_url();
        if ($this->session->userdata('logged_in') == true) {
            $user_id = $this->session->userdata('user_id');
            $username = $this->session->userdata('username');
            $committee_id = $this->session->userdata('committee_id');
            $committee_code = $this->session->userdata('committee_code');
            $fiscal_year = $this->session->userdata('fiscal_year');
            $fiscalCode = $this->session->userdata('fiscal_code');
            $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
            $data['userRole'] = $this->dbuser->get_user_role_by_user_name_and_id($username, $user_id);
            $data['donorDetails'] = $this->ledger_model->get_all_donar();
            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sideNavigation');
            $this->load->view('dashboard/templates/topHead');
            $this->load->view('dashboard/report/oAdvanceQueryForm', $data);
            $this->load->view('dashboard/templates/footer');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    public function outstandingAdvance()
    {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) {
            $user_id = $this->session->userdata('user_id');
            $username = $this->session->userdata('username');
            $committee_id = $this->session->userdata('committee_id');
            $committee_code = $this->session->userdata('committee_code');
            $fiscal_year = $this->session->userdata('fiscal_year');
            $fiscalCode = $this->session->userdata('fiscal_code');
            $data['committeeInfo'] = $this->dbmanager_model->get_committee_info($committee_id, $committee_code);
            $data['userRole'] = $this->dbuser->get_user_role_by_user_name_and_id($username, $user_id);

            $this->load->library(array('form_validation', 'session'));
            
            $this->form_validation->set_rules('nepaliDateF', 'From Date', 'trim|required|callback_xss_clean');
            $this->form_validation->set_rules('nepaliDateT', 'To Date', 'trim|required|callback_xss_clean');
            $this->form_validation->set_error_delimiters('<div class="form_errors">', '</div>');
            if ($this->form_validation->run() == FALSE) {
                $this->pSheet();
            } else {
                $fromN = $this->input->post('nepaliDateF');
                $fromE = $this->input->post('englishDateF');
                $toN = $this->input->post('nepaliDateT');
                $toE = $this->input->post('englishDateT');
                
                $data['fromN'] = $fromN;
                $data['toN'] = $toN;
                $data['fromE'] = $fromE;
                $data['toE'] = $toE;
                $data['todayN'] = $this->dayFunctN();
                $data['todayE'] = $this->dayFunctE();
                
                if ($fromN < $toN) {
                if($data['todayN'] >= $data['toN']){
                    $data['advanse'] = $this->report_model->get_outstanding_advance_from_assets_from_journal($fromN, $fromE, $toN, $toE);
                $this->load->view('dashboard/templates/header', $data);
                $this->load->view('dashboard/templates/sideNavigation');
                $this->load->view('dashboard/templates/topHead');
                $this->load->view('dashboard/report/outstandingAdvance', $data);
                $this->load->view('dashboard/templates/footer');
                }else{
                  $this->session->set_flashdata("flashMessage", '<div class="alert alert-warning" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please choose from date and to date before or equal to today.</div>');
                        redirect('reports/pSheet', 'refresh');   
                }
                }else{
                     $this->session->set_flashdata("flashMessage", '<div class="alert alert-warning" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please choose from date before to date.</div>');
                    redirect('reports/pSheet', 'refresh');
                }
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function dayFunctN() {
        date_default_timezone_set('Asia/Kathmandu');
        $currentYear = date('Y');
        $currentMonth = date('m');
        $currentDay = date('d');
        $this->load->library("nepali_calendar");
        $currentNepaliDay = $this->nepali_calendar->AD_to_BS($currentYear, $currentMonth, $currentDay);
        $nepaliDay = $currentNepaliDay['date'];
        $nepaliMth = $currentNepaliDay['month'];
        $nepaliYr = $currentNepaliDay['year'];
        $todayNep = $nepaliYr . '/' . $nepaliMth . '/' . $nepaliDay;

        $tday = new DateTime($todayNep);

        $dateOfToday = $tday->format('Y-m-d');
        return $dateOfToday;
    }

    public function dayFunctE() {
        date_default_timezone_set('Asia/Kathmandu');
        $today = date('Y-m-d');
        return $today;
    }

    public function convertToAd($day = Null) {

        $tday = new DateTime($day);
        $date = $tday->format('Y-m-d');
        $dates = date_parse_from_format("Y.m.d", $date);

        $year = str_pad($dates['year'], 4, "0", STR_PAD_LEFT);
        $month = str_pad($dates['month'], 2, "0", STR_PAD_LEFT);
        $days = str_pad($dates['day'], 2, "0", STR_PAD_LEFT);

        $this->load->library("nepali_calendar");
        $currentNepaliDay = $this->nepali_calendar->BS_to_AD($year, $month, $days);
        $nepaliDay = $currentNepaliDay['date'];
        $nepaliMth = $currentNepaliDay['month'];
        $nepaliYr = $currentNepaliDay['year'];
        $todayNep = $nepaliYr . '/' . $nepaliMth . '/' . $nepaliDay;

        $tday = new DateTime($todayNep);

        $dateOfToday = $tday->format('Y-m-d');
        return $dateOfToday;
    }

    public function xss_clean($str = NULL) {
        if ($this->security->xss_clean($str, TRUE) === FALSE) {
            $this->form_validation->set_message('xss_clean', 'The %s is invalid charactor');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
