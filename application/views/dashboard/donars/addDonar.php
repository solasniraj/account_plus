            <div id="page-wrapper">
                <div class="graphs">
                    <h3 class="blank1">Add Fund Donar</h3>
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
                                <label for="donarCode" class="col-sm-2 control-label">Donar's Code</label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?php echo set_value('donarCode'); ?>" class="form-control1" id="donarCode" name="donarCode" placeholder="Enter Donar's Code">
                                    <?php echo form_error('donarCode'); ?>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="donarName" class="col-sm-2 control-label">Donar's Name</label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?php echo set_value('donarName'); ?>" class="form-control1" id="donarName" name="donarName" placeholder="Enter Donar's Name">
                                     <?php echo form_error('donarName'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="donarAddress" class="col-sm-2 control-label">Donar's Address</label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?php echo set_value('donarAddress'); ?>" class="form-control1" id="donarAddress" name="donarAddress" placeholder="Enter Donar's Address">
                                    <?php echo form_error('donarAddress'); ?>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="emailId" class="col-sm-2 control-label">Donar's Email ID</label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?php echo set_value('emailId'); ?>" class="form-control1" id="emailId" name="emailId" placeholder="Enter Donar's Email">
                                    <?php echo form_error('emailId'); ?>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="contactNumber" class="col-sm-2 control-label">Donar's Contact Number</label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?php echo set_value('contactNumber'); ?>" class="form-control1" id="contactNumber" name="contactNumber" placeholder="Enter Donar's Contact Number">
                                    <?php echo form_error('contactNumber'); ?>
                                </div>
                            </div>
                            
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn-success btn">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            





            </div>
        </div>
    </div>
