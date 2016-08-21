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

      $CI = &get_instance();
$CI->load->database();
$name = $CI->db->database;
$host = $CI->db->hostname;
$user = $CI->db->username;
$pass = $CI->db->password;             
$dbname = 'acount';       

	set_time_limit(3000); $SQL_CONTENT = (strlen($sql_file_OR_content) > 200 ?  $sql_file_OR_content : file_get_contents($sql_file_OR_content)  );  
        if (function_exists('DOMAIN_or_STRING_modifier_in_DB')) { $SQL_CONTENT = DOMAIN_or_STRING_modifier_in_DB($replacements[0], $replacements[1], $SQL_CONTENT); }
	$allLines = explode("\n",$SQL_CONTENT); 
	$mysqli = new mysqli($host, $user, $pass, $dbname); if (mysqli_connect_errno()){echo "Failed to connect to MySQL: " . mysqli_connect_error();} 
		$zzzzzz = $mysqli->query('SET foreign_key_checks = 0');	        preg_match_all("/\nCREATE TABLE(.*?)\`(.*?)\`/si", "\n". $SQL_CONTENT, $target_tables); foreach ($target_tables[2] as $table){$mysqli->query('DROP TABLE IF EXISTS '.$table);}         $zzzzzz = $mysqli->query('SET foreign_key_checks = 1');    $mysqli->query("SET NAMES 'utf8'");	
	$templine = '';	// Temporary variable, used to store current query
	foreach ($allLines as $line)	{											// Loop through each line
		if (substr($line, 0, 2) != '--' && $line != '') {$templine .= $line; 	// (if it is not a comment..) Add this line to the current segment
			if (substr(trim($line), -1, 1) == ';') {		// If it has a semicolon at the end, it's the end of the query
				$mysqli->query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . $mysqli->error . '<br /><br />');  $templine = ''; // set variable to empty, to start picking up the lines after ";"
			}
		}
        }	echo 'Importing finished. Now, Delete the import file.';
   //see also export.php 
       
             
             
             
             
             
    } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    
}