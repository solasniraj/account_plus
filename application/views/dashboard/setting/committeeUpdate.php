            <div id="page-wrapper">
                <div class="graphs">
                    <h3 class="blank1">Company Info</h3>
                     <style>
                .form-errors 
                {
                    font-size: 14px;
                    padding: 10px;
                    color:red;
                }
                </style>
                    <div class="tab-content">
                        <?php if(!empty($committee)){ 
     foreach ($committee as $comData){ ?>
                     <div class="bs-example4" data-example-id="simple-responsive-table">
                        <div class="tab-pane active" id="horizontal-form">
                            <?php echo form_open_multipart('setting/companyInfoUpdate', array('id' => '','class'=>'form-horizontal', 'novalidate'=>'novalidate'));?>
                            
                            
                            <div class="form-group">
                                <label for="committeeName" class="col-sm-1 control-label"><h4>Committee Name</h4></label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?php echo $comData->committee_name ?>" class="form-control1" id="committeeName" name="committeeName" placeholder="Enter Name">
                                     <?php echo form_error('committeeName'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="committeeAddress" class="col-sm-1 control-label"><h4>Address</h4></label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?php echo $comData->address; ?>" class="form-control1" id="committeeAddress" name="committeeAddress" placeholder="Enter Address">
                                    <?php echo form_error('committeeAddress'); ?>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="emailId" class="col-sm-1 control-label"><h4>Email ID</h4></label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?php echo $comData->email_address; ?>" class="form-control1" id="emailId" name="emailId" placeholder="Enter Email">
                                    <?php echo form_error('emailId'); ?>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="contactNumber" class="col-sm-1 control-label"><h4>Contact Number</h4></label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?php echo $comData->phone; ?>" class="form-control1" id="contactNumber" name="contactNumber" placeholder="Enter Contact Number">
                                    <?php echo form_error('contactNumber'); ?>
                                </div>
                            </div>
                            <br>
                            
                            
                            <div class="form-group">
                                <label for="committeeCode" class="col-sm-1 control-label"><h4>Committee Code</h4></label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?php echo $comData->code; ?>" class="form-control1" id="committeeCode" name="committeeCode" placeholder="Enter code">
                                    <?php echo form_error('committeeCode'); ?>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="committeeLogo" class="col-sm-1 control-label"><h4>Upload Committee Logo</h4></label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control1" id="file" name="file" >
                                    <?php echo form_error('committeeLogo'); ?>
                                </div>
                            </div>
                            
                            <div class="col-sm-4 col-sm-offset-4">
                                <button class="btn btn-success btn-lg" style=" margin-left: 3px; margin-top: -10px; width:100px;">Submit</button>
                            </div>

                       
                    </div>
                </div>
     <?php } } ?>
           
        </div>
    </div>
