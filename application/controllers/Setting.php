<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class setting extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        
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
         
 $this->session->set_flashdata('message', 'Data backuped sucessfully');                    
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
    
    
}