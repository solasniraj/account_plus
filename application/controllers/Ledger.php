<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ledger extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('ledger_model');
        $this->load->model('donar_model');
         $this->load->model('bank_model');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
        if(is_trans_pending())
        {
        $this->session->set_flashdata("flashMessage", '<div class="alert alert-info" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please take action on draft journals first to make journal entry.</div>');
        redirect('transaction/journalList', 'refresh');
        }
    }

    public function search() {
        if (isset($_POST['searchKey'])) {
            $searchKey = $_POST['searchKey'];
        } else {
            $searchKey = "";
        }

        $result = $this->ledger_model->search_ledger_by_key_or_description($searchKey);

        if ($searchKey != "" && $searchKey != NULL && (!empty($result))) {

            $view = '';
            foreach ($result as $data) {
                $view .= '<tr><td>' . $data->ledger_master_code . '</td>'
                        . '<td>' . $data->ledger_master_name . '</td>'
                        . '<td><a href="#">Edit</a> / <a href="#">Delete</a></td></tr>';
            }

            echo $view;
        }
    }

    public function accountGroupSearch() {
        if ($this->session->userdata('logged_in') == true) {
            $user_id = $this->session->userdata('user_id');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('search', 'Search Key', 'trim|required|callback_xss_clean|max_length[500]');
            $this->form_validation->set_error_delimiters('<div class="form-errors">', '</div>');

            if ($this->form_validation->run() == FALSE) {
                $this->accountGroup();
            } else {
                $searchKey = $this->input->post('search');

                $data['ledgerDetails'] = $this->ledger_model->search_ledger_master_for_submitted_key($searchKey);
                $data['accountCharts'] = $this->ledger_model->get_account_chart_class();
                $data['accountLedgers'] = $this->ledger_model->get_account_ledger_info();
                $data['subLedgers'] = $this->ledger_model->get_sub_ledger_info();
                $data['donorInfo'] = $this->donar_model->get_all_donar();
                $this->load->view('dashboard/templates/header');
                $this->load->view('dashboard/templates/sideNavigation');
                $this->load->view('dashboard/templates/topHead');
                $this->load->view('dashboard/ledger/listLedgerMaster', $data);
                $this->load->view('dashboard/templates/footer');
            }
        } else {
            return redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function accountGrSearch() {
        if ($this->session->userdata('logged_in') == true) {
            $user_id = $this->session->userdata('user_id');

            $chartAccType = $this->input->post('chartAccType');
            $accLedger = $this->input->post('accLedger');
            $accSubLedger = $this->input->post('accSubLedger');
            $donorType = $this->input->post('donorType');
            $ledgerType = $this->input->post('ledgerType');
            if ((!empty($chartAccType)) && (!empty($accLedger)) && (!empty($accSubLedger)) && (!empty($donorType)) && (!empty($ledgerType))) {
                $searchKey = $chartAccType . $accLedger . $accSubLedger . $donorType . $ledgerType;
                $data['ledgerDetails'] = $this->ledger_model->search_ledger_master_for_submitted_key_only_in_code($searchKey);
            } elseif ((!empty($chartAccType)) && (!empty($accLedger)) && (!empty($accSubLedger)) && (!empty($donorType))) {
                $searchKey = $chartAccType . $accLedger . $accSubLedger . $donorType;
                $data['ledgerDetails'] = $this->ledger_model->search_ledger_master_for_submitted_key_only_in_code($searchKey);
            } elseif ((!empty($chartAccType)) && (!empty($accLedger)) && (!empty($accSubLedger))) {
                $searchKey = $chartAccType . $accLedger . $accSubLedger;
                $data['ledgerDetails'] = $this->ledger_model->search_ledger_master_for_submitted_key_only_in_code($searchKey);
            } elseif ((!empty($chartAccType)) && (!empty($accLedger))) {
                $searchKey = $chartAccType . $accLedger;
                $data['ledgerDetails'] = $this->ledger_model->search_ledger_master_for_submitted_key_only_in_code($searchKey);
            } elseif (!empty($chartAccType)) {
                $searchKey = $chartAccType;
                $data['ledgerDetails'] = $this->ledger_model->search_ledger_master_for_submitted_key_only_in_code($searchKey);
            } else {
                $data['ledgerDetails'] = $this->ledger_model->get_ledger_master_listing();
            }

            $data['accountCharts'] = $this->ledger_model->get_account_chart_class();
            $data['accountLedgers'] = $this->ledger_model->get_account_ledger_info();
            $data['subLedgers'] = $this->ledger_model->get_sub_ledger_info();
            $data['donorInfo'] = $this->donar_model->get_all_donar();
            $this->load->view('dashboard/templates/header');
            $this->load->view('dashboard/templates/sideNavigation');
            $this->load->view('dashboard/templates/topHead');
            $this->load->view('dashboard/ledger/listLedgerMaster', $data);
            $this->load->view('dashboard/templates/footer');
        } else {
            return redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function index() {
      //  $this->load->library('Numbertowords');
      //  $words = $this->numbertowords->convert_number('678245');
        
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) {
            $data['ledgerDetails'] = $this->ledger_model->get_ledger_master_listing();
            $data['accountCharts'] = $this->ledger_model->get_account_chart_class();
            $data['accountLedgers'] = $this->ledger_model->get_account_ledger_info();
            $data['subLedgers'] = $this->ledger_model->get_sub_ledger_info();
            $data['donorInfo'] = $this->donar_model->get_all_donar();
            $this->load->view('dashboard/templates/header');
            $this->load->view('dashboard/templates/sideNavigation');
            $this->load->view('dashboard/templates/topHead');
            $this->load->view('dashboard/ledger/listLedgerMaster', $data);
            $this->load->view('dashboard/templates/footer');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function accountGroup() {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) {
            $data['ledgerDetails'] = $this->ledger_model->get_ledger_master_listing();
            $data['accountCharts'] = $this->ledger_model->get_account_chart_class();
            $data['accountLedgers'] = $this->ledger_model->get_account_ledger_info();
            $data['subLedgers'] = $this->ledger_model->get_sub_ledger_info();
            $data['donorInfo'] = $this->donar_model->get_all_donar();
            $this->load->view('dashboard/templates/header');
            $this->load->view('dashboard/templates/sideNavigation');
            $this->load->view('dashboard/templates/topHead');
            $this->load->view('dashboard/ledger/listLedgerMaster', $data);
            $this->load->view('dashboard/templates/footer');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    public function get_account_group()
    {
        $list = $this->ledger_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $customers) {
            
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $customers->ledger_master_code;
            $row[] = $customers->ledger_master_name;
            $row[] = NULL;
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->ledger_model->count_all(),
                        "recordsFiltered" => $this->ledger_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function createLedger() {
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) {
            $data['accountCharts'] = $this->ledger_model->get_account_chart_class();
            $data['accountLedgers'] = $this->ledger_model->get_account_ledger_info();
            $data['subLedgers'] = $this->ledger_model->get_sub_ledger_info();
            $data['donorInfo'] = $this->donar_model->get_all_donar();
            $this->load->view('dashboard/templates/header');
            $this->load->view('dashboard/templates/sideNavigation');
            $this->load->view('dashboard/templates/topHead');
            $this->load->view('dashboard/ledger/createLedger', $data);
            $this->load->view('dashboard/templates/footer');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function addnewLedger() {
        if ($this->session->userdata('logged_in') == true) {
            $user_id = $this->session->userdata('user_id');
            $username = $this->session->userdata('username');
            $committee_id = $this->session->userdata('committee_id');
            $committee_code = $this->session->userdata('committee_code');
            $fiscal_year = $this->session->userdata('fiscal_year');
            $fiscalCode = $this->session->userdata('fiscal_code');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('chartAccType', 'Account', 'trim|required|callback_xss_clean|max_length[500]');
            $this->form_validation->set_rules('codeNo', 'Account Code', 'trim|required|callback_xss_clean|max_length[500]');
            $this->form_validation->set_rules('accDescription', 'Account Description', 'trim|required|callback_xss_clean|max_length[500]');
            $this->form_validation->set_error_delimiters('<div class="form-errors">', '</div>');

            if ($this->form_validation->run() == FALSE) {
                $this->createLedger();
            } else {
                $chartNo = $this->input->post('chartAccType');
                $accLedger = $this->input->post('accLedger');
                $accSubLedger = $this->input->post('accSubLedger');
                $donorType = $this->input->post('donorType');
                $ledgerType = $this->input->post('ledgerType');
                $codeNo = $this->input->post('codeNo');
                $accDescription = $this->input->post('accDescription');

                $query = $this->ledger_model->check_for_code_in_existing_ledger($codeNo);
               if($query){
                   $this->session->set_flashdata("flashMessage", '<div class="alert alert-info" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Same account ledger already exists. Please check ledger once.</div>');
                    
                     $this->createLedger();
               } else{
                
                $result = $this->ledger_model->add_new_ledger_master($chartNo, $accLedger, $accSubLedger, $donorType, $ledgerType, $codeNo, $accDescription, $fiscalCode);
                if((($accLedger <= '09') && ($accLedger >= '00')) && $chartNo =='01')
                {
               $result1 = $this->bank_model->add_new_bank_account_from_ledger($accDescription, $accLedger, $fiscalCode);
                }
       
                if ($result) {
                     $this->session->set_flashdata("flashMessage", '<div class="alert alert-success" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Ledger added successfully</div>');
                   
                    return redirect('ledger/index');
                } else {
                    $this->session->set_flashdata("flashMessage", '<div class="alert alert-info" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Sorry ! </strong><br/>Something went wrong during ledger addition. Please try again.</div>');
                    
                    $this->createLedger();
                }
            }}
        } else {
            return redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function addLedgerProgram($id) {
        
    }

    public function editLedger($id = null) {
        
    }

    public function deleteLedger($id = NULL) {
        
    }

    public function xss_clean($str=NULL) {
        if ($this->security->xss_clean($str, TRUE) === FALSE) {
            $this->form_validation->set_message('xss_clean', 'The %s is invalid charactor');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
