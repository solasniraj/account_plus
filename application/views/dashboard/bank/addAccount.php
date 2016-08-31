            <div id="page-wrapper">
                <div class="graphs">
                    <h3 class="blank1">Add Bank Account</h3>
                     <style>
     /*sanoj custom csss */
                .form-errors 
                {
                    font-size: 14px;
                    padding: 10px;
                    color:red;
                }



                /*sanoj custom css ends*/

                </style>
                    <div class="tab-content">
                        <div class="tab-pane active" id="horizontal-form">
                            <?php echo form_open_multipart('bank/addnewAccount', array('id' => '','class'=>'form-horizontal', 'novalidate'=>'novalidate'));?>
                            <div class="form-group">
                                <label for="bankName" class="col-sm-2 control-label"><b>Name of Bank</b></label>
                                <div class="col-sm-4">
                                    <input type="text" value="<?php echo set_value('bankName'); ?>" class="form-control1" id="bankName" name="bankName" placeholder="Enter Bank Name">
                                     <?php echo form_error('bankName'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="accountNumber" class="col-sm-2 control-label"><b>Account Number</b></label>
                                <div class="col-sm-4">
                                    <input type="text" value="<?php echo set_value('accountNumber'); ?>" class="form-control1" id="programName" name="accountNumber" placeholder="Enter Account Number">
                                    <?php echo form_error('accountNumber'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address" class="col-sm-2 control-label"><b>Address</b></label>
                                <div class="col-sm-4">
                                    <input type="text" value="<?php echo set_value('address'); ?>" class="form-control1" id="address" name="address" placeholder="Enter estimated budget">
                                    <?php echo form_error('address'); ?>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="contactNumber" class="col-sm-2 control-label"><b>Contact Number</b></label>
                                <div class="col-sm-4">
                                    <input type="text" value="<?php echo set_value('contactNumber'); ?>" class="form-control1" id="contactNumber" name="contactNumber" placeholder="Enter estimated budget">
                                    <?php echo form_error('contactNumber'); ?>
                                </div>
                            </div>
                            
                            <div class="col-sm-5 col-sm-offset-2">
                                                <button class="btn btn-success btn-lg" style=" margin-left: 3px; margin-top: -4px; width:100px;">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            





            </div>
        </div>
    </div>
