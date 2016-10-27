<?php if (!defined('BASEPATH'))

    exit('No direct script access allowed');

class setting extends CI_Controller {

    function __construct() {

        parent::__construct();

        $this->load->library('session');

        $this->load->model('setting_model');

        $this->load->helper('url');

        $this->load->helper(array('form', 'url'));

        $this->load->library('pagination');

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

         $this->load->view('dashboard/templates/header');

          $this->load->view('dashboard/templates/sideNavigation');

          $this->load->view('dashboard/templates/topHead');

          $this->load->view('dashboard/setting/dataBackUp');

           $this->load->view('dashboard/templates/footer');

           } else {

            redirect('login/index/?url=' . $url, 'refresh');

        }

    }

    

    public function createBackup()

    {

        $url = current_url();

         if ($this->session->userdata('logged_in') == true) { 

 

      $CI = &get_instance();

$CI->load->database();

$name = $CI->db->database;

$host = $CI->db->hostname;

$user = $CI->db->username;

$pass = $CI->db->password;


        

      date_default_timezone_set('Asia/Kathmandu');

      // Load the DB utility class 

      $this->load->dbutil(); 

      $prefs = array( 'format' => 'zip', 

                               'filename' => 'backup_'.date('d_m_Y_H_i_s').'.sql',                                                    

                                'add_drop' => TRUE,                                                    

                               'add_insert'=> TRUE,                                                   

                               'newline' => "\n"                

                              ); 

         // Backup your entire database and assign it to a variable 

         $backup = $this->dbutil->backup($prefs); 

         // Load the file helper and write the file to your server 

         $this->load->helper('file'); 

         write_file('./database/backups/'.date('d_m_Y_H_i_s').'.zip', $backup); 

         // Load the download helper and send the file to your desktop 

         $this->load->helper('download'); 

         force_download('dbbackup_'.date('d_m_Y_H_i_s').'.zip', $backup);

   $this->session->set_flashdata("flashMessage", '<div class="alert alert-success" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Data backuped sucessfully</div>');      

                   

                        redirect('setting/index', 'refresh');          

                        

    } else {

            redirect('login/index/?url=' . $url, 'refresh');

        }

    }


        public function dataRestore()

    {

        $url = current_url();

         if ($this->session->userdata('logged_in') == true) {

         $this->load->view('dashboard/templates/header');

          $this->load->view('dashboard/templates/sideNavigation');

          $this->load->view('dashboard/templates/topHead');

          $this->load->view('dashboard/setting/dataRestore');

           $this->load->view('dashboard/templates/footer');

           } else {

            redirect('login/index/?url=' . $url, 'refresh');

        }

    }

    

    

    public function restore()

    {    

    $url = current_url();

         if ($this->session->userdata('logged_in') == true) { 

$autoload['libraries'] = array('database');

      $CI = &get_instance();

$CI->load->database();

$name = $CI->db->database;

$host = $CI->db->hostname;

$user = $CI->db->username;

$pass = $CI->db->password;             

$dbname = 'acount';       


$config['upload_path'] = './database/backups';

$config['allowed_types'] = 'sql|csv';

   $this->load->library('upload', $config);          

  if (!$this->upload->do_upload('file')) {

                $data['error'] = $this->upload->display_errors();

                

               $this->load->view('dashboard/templates/header');

          $this->load->view('dashboard/templates/sideNavigation');

          $this->load->view('dashboard/templates/topHead');

          $this->load->view('dashboard/setting/dataRestore');

           $this->load->view('dashboard/templates/footer');

            } else {

                

   $file_name = $_FILES['file']['name'];              

    

$file_restore = $this->load->file($config['upload_path'] . '/' . $file_name, true);


$file_array = explode(';', $file_restore);


foreach ($file_array as $query)

 {

    if(strlen($query)>5){

      //  var_dump($query);

         $this->db->query("SET FOREIGN_KEY_CHECKS = 0");

         $this->db->query($query);

         $this->db->query("SET FOREIGN_KEY_CHECKS = 1");

    }

 }

       	

       

   die('backup completed');          

             

   }           

             

             

    } else {

            redirect('login/index/?url=' . $url, 'refresh');

        }

    }

    

    

    public function committeeInfo()

    {

        $url = current_url();

         if ($this->session->userdata('logged_in') == true) {

             $user_id = $this->session->userdata('user_id');

             $username = $this->session->userdata('username');

             $committee_id = $this->session->userdata('committee_id');

             $committee_code = $this->session->userdata('committee_code');

             $fiscal_year = $this->session->userdata('fiscal_year'); 

           

             $data['committee'] = $this->setting_model->get_committee_detils($committee_id, $committee_code);          

             

         $this->load->view('dashboard/templates/header');

          $this->load->view('dashboard/templates/sideNavigation');

          $this->load->view('dashboard/templates/topHead');

          $this->load->view('dashboard/setting/committeeUpdate', $data);

           $this->load->view('dashboard/templates/footer');

           } else {

            redirect('login/index/?url=' . $url, 'refresh');

        }

    }

    

     public function committeeInfoUpdate() {

        $url = current_url();

         if ($this->session->userdata('logged_in') == true) {

            $user_id = $this->session->userdata('user_id');

             $username = $this->session->userdata('username');

             $committee_id = $this->session->userdata('committee_id');

             $committee_code = $this->session->userdata('committee_code');

             $fiscal_year = $this->session->userdata('fiscal_year'); 

           

             $data['committee'] = $this->setting_model->get_committee_detils($committee_id, $committee_code);          

             

            $config['upload_path'] = './contents/uploads/images/';

            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $config['max_size'] = '20000';

            $config['max_width'] = '10000';

            $config['max_height'] = '10000';


            $this->load->library('upload', $config);

           

            $this->load->view('dashboard/templates/header');

          $this->load->view('dashboard/templates/sideNavigation');

          $this->load->view('dashboard/templates/topHead');

            $this->load->helper('form');

            $this->load->library(array('form_validation', 'session'));

            $this->form_validation->set_rules('committeeName', 'Committee Name', 'trim|regex_match[/^[a-z,0-9,A-Z_\-., ]{2,200}$/]|required|callback_xss_clean|max_length[200]');

            $this->form_validation->set_rules('committeeAddress', 'Address', 'trim|regex_match[/^[a-z,0-9,A-Z_\-., ]{2,200}$/]|required|callback_xss_clean|max_length[200]');

            $this->form_validation->set_rules('emailId', 'Email', 'trim|regex_match[/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/]|callback_xss_clean|max_length[200]');

            $this->form_validation->set_rules('contactNumber', 'Contact Number', 'trim|regex_match[/^[0-9\+-]{6,20}$/]|required|callback_xss_clean|max_length[200]');

            $this->form_validation->set_rules('committeeCode', 'Committee Code', 'trim|required|callback_xss_clean|max_length[200]');

            $this->form_validation->set_error_delimiters('<div class="form_errors">', '</div>');

            if (($this->form_validation->run() == TRUE)) {

                if ($_FILES && $_FILES['file_name']['name'] !== "") {

                    if (!$this->upload->do_upload('file_name')) {

                        $data['error'] =  $this->upload->display_errors('');

                      $this->load->view('dashboard/setting/committeeUpdate', $data);

                    } else {

                $this->load->helper('inflector');

                $committeeName = $this->input->post('committeeName');

                $committeeAddress = $this->input->post('committeeAddress');

                $emailId = $this->input->post('emailId');

                $contactNumber = $this->input->post('contactNumber');

                $data = array('upload_data' => $this->upload->data());

                $committeeLogo = $data['upload_data']['file_name']; 

                $config['file_name'] = $committeeLogo;

               

                $this->setting_model->update_committee_info($committee_id, $committee_code, $committeeName, $committeeAddress, $emailId, $contactNumber, $committeeLogo);

                $this->session->set_flashdata("flashMessage", '<div class="alert alert-success" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Committee info updated sucessfully</div>');

                       

                redirect('setting/committeeInfo');

                    }

                } else {

                $committeeName = $this->input->post('committeeName');

                $committeeAddress = $this->input->post('committeeAddress');

                $emailId = $this->input->post('emailId');

                $contactNumber = $this->input->post('contactNumber');

                $committeeLogo = $this->input->post('existingImg');                

               $this->setting_model->update_committee_info($committee_id, $committee_code, $committeeName, $committeeAddress, $emailId, $contactNumber, $committeeLogo);

               $this->session->set_flashdata("flashMessage", '<div class="alert alert-success" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Committee info updated sucessfully</div>');

                redirect('setting/committeeInfo');

                }

            } else {

                 

                $this->load->view('dashboard/setting/committeeUpdate', $data);

            }


            $this->load->view('dashboard/templates/footer');

        } else {

            redirect('login/index/?url=' . $url, 'refresh');

        }

    }

    

    public function userInfo()

    {

        $url = current_url();

         if ($this->session->userdata('logged_in') == true) {

             $user_id = $this->session->userdata('user_id');

             $username = $this->session->userdata('username');

              $committee_code = $this->session->userdata('committee_code');

             $data['userDeatils'] = $this->setting_model->get_user_details($user_id, $username, $committee_code);

             

         $this->load->view('dashboard/templates/header');

          $this->load->view('dashboard/templates/sideNavigation');

          $this->load->view('dashboard/templates/topHead');

          $this->load->view('dashboard/setting/profile', $data);

           $this->load->view('dashboard/templates/footer');

           } else {

            redirect('login/index/?url=' . $url, 'refresh');

        }

    }

    

    public function updateUserInfo()

    {

        $url = current_url();

         if ($this->session->userdata('logged_in') == true) {

         

             $user_id = $this->session->userdata('user_id');

             $username = $this->session->userdata('username');

              $committee_code = $this->session->userdata('committee_code');

             $data['userDeatils'] = $this->setting_model->get_user_details($user_id, $username, $committee_code);

             

           

            $this->load->view('dashboard/templates/header');

          $this->load->view('dashboard/templates/sideNavigation');

          $this->load->view('dashboard/templates/topHead');

            $this->load->helper('form');

            $this->load->library(array('form_validation', 'session'));

            $this->form_validation->set_rules('userName', 'User Name', 'trim|required|callback_xss_clean|max_length[200]');

            $this->form_validation->set_rules('fullName', 'Full Name', 'trim|regex_match[/^[a-z,0-9,A-Z ]{2,200}$/]|callback_xss_clean|max_length[200]');

            $this->form_validation->set_rules('emailId', 'Email', 'trim|regex_match[/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/]|callback_xss_clean|max_length[200]');

            $this->form_validation->set_rules('contactNumber', 'Contact Number', 'trim|regex_match[/^[0-9\+-]{6,20}$/]|callback_xss_clean|max_length[200]');

            $this->form_validation->set_error_delimiters('<div class="form_errors">', '</div>');

            if (($this->form_validation->run() == TRUE)) {

                $userName = $this->input->post('userName');

                $fullName = $this->input->post('fullName');

                $emailId = $this->input->post('emailId');

                $contactNumber = $this->input->post('contactNumber');

                

                

                


                $this->setting_model->update_user_info($user_id, $userName, $fullName, $emailId, $contactNumber);

                $this->session->set_flashdata("flashMessage", '<div class="alert alert-success" style="margin-bottom: 0;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>User info updated sucessfully</div>');

                redirect('setting/userInfo');

              

            } else {

                $this->load->view('dashboard/setting/profile', $data);

            }


            $this->load->view('dashboard/templates/footer');

             

         }else {

            redirect('login/index/?url=' . $url, 'refresh');

        }

    }


    

    public function yearConfiguration()

    {

        $url = current_url();

         if ($this->session->userdata('logged_in') == true) {

         $this->load->view('dashboard/templates/header');

          $this->load->view('dashboard/templates/sideNavigation');

          $this->load->view('dashboard/templates/topHead');

          $this->load->view('dashboard/setting/yearConfigure');

           $this->load->view('dashboard/templates/footer');

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

    

    

}
