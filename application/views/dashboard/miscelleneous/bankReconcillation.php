<script type="text/javascript" src="<?php echo base_url('contents/js/nepali.datepicker.v2.1.min.js'); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('contents/css/nepali.datepicker.v2.1.min.css'); ?>" />
<script type="text/javascript" src="<?php echo base_url('contents/js/function.js'); ?>"></script>
<div id="page-wrapper">
    <div class="graphs">
        <div class="xs tabls">
            <div class="invalid">
							 <?php
            $flashMessage = $this->session->flashdata('flashMessage');
            if (!empty($flashMessage)) {               
                 echo $flashMessage;
            }          
            if (isset($error)) {
                echo $error;
            }
            ?>
						</div>


            <h3 class="blank1 text-center"> Bank Reconcillation Entry</h3>

            <div data-example-id="simple-responsive-table" class="bs-example4">
                <?php echo form_open_multipart('miscelleneous/showReconcillationForm', array('id' => '','class'=>'form-horizontal', 'novalidate'=>'novalidate'));?>
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed table-striped">
                        <thead>
                            <tr>


                                <th>Date&nbsp;(From)</th>
                                <th>Date&nbsp;(To)</th>
                                <th>Bank  Account</th>
                                <th>Bank Balance based on Statement</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" id="nepaliDateF" class="form-control1 nepali-calendar" name="nepaliDateF" value="" placeholder="YYYY-MM-DD"/>
        <input type="hidden" id="englishDateF" name="englishDateF"/>
                                <?php echo form_error('nepaliDateF'); ?>
                                </td>
                                <td><input type="text" id="nepaliDateT" class="form-control1 nepali-calendar" name="nepaliDateT" value="" placeholder="YYYY-MM-DD"/>
        <input type="hidden" id="englishDateT" name="englishDateT"/>
                                <?php echo form_error('nepaliDateT'); ?>
                                </td>

                                <td>
                                    <select class="form-control" id="sel1" name="bankName">
                                        <option value="">Select Bank Account</option>
                                        <?php 
                                        if (!empty($bankAccount)) {
                                            foreach ($bankAccount as $bAccount) { ?>
                                        <option value="<?php echo $bAccount->id; ?>"><?php echo $bAccount->id.' '.$bAccount->bank_name; ?></option>      
                                        <?php    } 
                                      }
                                        ?>
                                       
                                    </select>
                                    <?php echo form_error('bankName'); ?>
                                </td>
                                <td><input class="form-control" type="text" name="amount" value="<?php echo set_value('amount'); ?>">
                                    <?php echo form_error('amount'); ?>
                                </td>
                                <td><input type="submit" style=" margin-left: 3px;margin-top: -4px;" class="btn-success btn"  value="Submit"/></td>







                            </tr>


                        </tbody>
                    </table>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
</div>
