<?php

function is_trans_pending() {
   $ci=& get_instance();
    $ci->load->database();
   $ci->load->model('transaction_model');
   $day = date("Y-m-d");
   $trans = $ci->transaction_model->check_status_of_transaction($day);
  
  if (isset($trans) && (!empty($trans))) { 
   return true; 
  } 
 else { 
   return false;
 }
}

