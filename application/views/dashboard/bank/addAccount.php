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
                                <label for="bankAccountName" class="col-sm-2 control-label"><b>Bank Account Name</b></label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?php echo set_value('bankAccountName'); ?>" class="form-control1" id="bankAccountName" name="bankAccountName" placeholder="Enter Bank Account Name">
                                     <?php echo form_error('bankAccountName'); ?>
                                </div>
                            </div>
                           
                            <div class="form-group">
                    <label class="col-sm-2 control-label" for="accountType"><b>Select Account Type</b></label>
                    <div class="col-sm-8">
                        <select class="form-control1" id="accountType" name="accountType">
                            <option value="">Select Account Type</option>
                            <?php if(!empty($accountTypes)){
foreach ($accountTypes as $aTypes){ ?>
                            <option value="<?php echo $aTypes->id; ?>"><?php echo $aTypes->bank_account_type; ?></option>

                            <?php }} ?>
                        </select>
                     <?php echo form_error('accountType'); ?>
                    </div>
                </div>
                            <?php if(!empty($chartMaster)){ ?>
                            <div class="form-group">
                    <label class="col-sm-2 control-label" for="accountGLCode"><b>Bank Account GL Code</b></label>
                    <div class="col-sm-8">
                        <select class="form-control1" id="accountGLCode" name="accountGLCode">
                             <optgroup label="Assets">
                        <?php foreach ($chartMaster as $clist){
                           if($clist->chart_class_id== '1') {
                            ?>                          
                            <option value="<?php echo $clist->account_code; ?>"><?php echo $clist->account_code.' '.$clist->account_name; ?></option> 
                           <?php }  } ?>
                       </optgroup>
                        </select>
                     <?php echo form_error('accountGLCode'); ?>
                    </div>
                </div>
                            <?php } ?>     
                            
                            <div class="form-group">
                                <label for="bankName" class="col-sm-2 control-label"><b>Name of Bank</b></label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?php echo set_value('bankName'); ?>" class="form-control1" id="bankName" name="bankName" placeholder="Enter Bank Name">
                                     <?php echo form_error('bankName'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="accountNumber" class="col-sm-2 control-label"><b>Account Number</b></label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?php echo set_value('accountNumber'); ?>" class="form-control1" id="programName" name="accountNumber" placeholder="Enter Account Number">
                                    <?php echo form_error('accountNumber'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address" class="col-sm-2 control-label"><b>Address</b></label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?php echo set_value('address'); ?>" class="form-control1" id="address" name="address" placeholder="Enter estimated budget">
                                    <?php echo form_error('address'); ?>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="contactNumber" class="col-sm-2 control-label"><b>Contact Number</b></label>
                                <div class="col-sm-8">
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
