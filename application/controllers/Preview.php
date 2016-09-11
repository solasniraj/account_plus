<?php

if (!defined('BASEPATH'))
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
        $this->load->helper('csv');
    }

    public function jounalView() {
        
//          <script>
//  $( function() {
//    $( "#datepicker" ).datepicker({ minDate: "+1M +10D", maxDate: new Date() });
//    	dateFormat: 'dd/mm/yy'
//  } );
//  </script>
        
        
        $url = current_url();
        if ($this->session->userdata('logged_in') == true) {

            $orientation = 'landscape';

            $data['bankAccount'] = $this->bank_model->view_bank_account_listing();

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
            $this->dompdf->set_paper('a4', $orientation);
            $this->dompdf->render();
            $this->dompdf->stream("welcome.pdf");
            die;
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function csv($filename = 'CSV_Report.csv') {
        $this->load->dbutil();
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "rn";
        $query = $this->db->query("select * from `bank_info`");
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download($filename, $data);
    }

    public function createCsv() {

        $query = $this->db->query('SELECT * FROM  `bank_info`');
        $num = $query->num_fields();
        $var = array();
        $i = 1;
        $fname = "";
        while ($i <= $num) {
            $test = $i;
            $value = $this->input->post($test);

            if ($value != '') {
                $fname = $fname . " " . $value;
                array_push($var, $value);
            }
            $i++;
        }

        $fname = trim($fname);

        $fname = str_replace(' ', ',', $fname);

        $this->db->select($fname);
        $quer = $this->db->get('bank_info');

        query_to_csv($quer, TRUE, 'bank_info_' . date('dMy') . '.csv');
    }

}
