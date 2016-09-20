            <div id="page-wrapper">
                <div class="graphs">
                    <h3 class="blank1">Add Fund Donor</h3>
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
                            <?php echo form_open_multipart('donars/addNewDonar', array('id' => '','class'=>'form-horizontal', 'novalidate'=>'novalidate'));?>
                            
                            
                            <div class="form-group">
                                <label for="donarName" class="col-sm-2 control-label"><b>Name</b></label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?php echo set_value('donarName'); ?>" class="form-control1" id="donarName" name="donarName" placeholder="Enter Name">
                                     <?php echo form_error('donarName'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="donarAddress" class="col-sm-2 control-label"><b>Address</b></label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?php echo set_value('donarAddress'); ?>" class="form-control1" id="donarAddress" name="donarAddress" placeholder="Enter Address">
                                    <?php echo form_error('donarAddress'); ?>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="emailId" class="col-sm-2 control-label"><b>Email ID</b></label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?php echo set_value('emailId'); ?>" class="form-control1" id="emailId" name="emailId" placeholder="Enter Email">
                                    <?php echo form_error('emailId'); ?>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="contactNumber" class="col-sm-2 control-label"><b>Contact Number</b></label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?php echo set_value('contactNumber'); ?>" class="form-control1" id="contactNumber" name="contactNumber" placeholder="Enter Contact Number">
                                    <?php echo form_error('contactNumber'); ?>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="contactPerson" class="col-sm-2 control-label"><b>Contact Person</b></label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?php echo set_value('contactPerson'); ?>" class="form-control1" id="contactPerson" name="contactPerson" placeholder="Enter Contact Person's Name">
                                    <?php echo form_error('contactPerson'); ?>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="contactPCellNo" class="col-sm-2 control-label"><b>Contact Person's Mobile</b></label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?php echo set_value('contactPCellNo'); ?>" class="form-control1" id="contactPCellNo" name="contactPCellNo" placeholder="Enter Contact Person's Mobile Number">
                                    <?php echo form_error('contactPCellNo'); ?>
                                </div>
                            </div>
                            
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-success btn-lg" style=" margin-left: 3px; margin-top: -4px; width:100px;">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            
           
        </div>
    </div>
