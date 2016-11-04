          <div id="page-wrapper">
                <div class="graphs">
                    <h3 class="blank1">Company Info</h3>
                    
                    <div class="tab-content">
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
                        <?php if(!empty($committee)){ 
     foreach ($committee as $comData){ ?>
                     <div class="bs-example4" data-example-id="simple-responsive-table">
                        <div class="tab-pane active" id="horizontal-form">
                            <?php echo form_open_multipart('setting/committeeInfoUpdate', array('id' => '','class'=>'form-horizontal', 'novalidate'=>'novalidate'));?>
                            
                            
                            <div class="form-group">
                                <label for="committeeName" class="col-sm-2 control-label"><b>Committee Name</b></label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?php echo $comData->committee_name ?>" class="form-control1" id="committeeName" name="committeeName" placeholder="Enter Name">
                                     <?php echo form_error('committeeName'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="committeeAddress" class="col-sm-2 control-label"><b>Address</b></label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?php echo $comData->address; ?>" class="form-control1" id="committeeAddress" name="committeeAddress" placeholder="Enter Address">
                                    <?php echo form_error('committeeAddress'); ?>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="emailId" class="col-sm-2 control-label"><b>Email ID</b></label>
                                <div class="col-sm-8">
                                    <input type="email" value="<?php echo $comData->email_address; ?>" class="form-control1" id="emailId" name="emailId" placeholder="Enter Email">
                                    <?php echo form_error('emailId'); ?>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="contactNumber" class="col-sm-2 control-label"><b>Contact Number</b></label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?php echo $comData->phone; ?>" class="form-control1" id="contactNumber" name="contactNumber" placeholder="Enter Contact Number">
                                    <?php echo form_error('contactNumber'); ?>
                                </div>
                            </div>
                            <br>
                            
                            
                            <div class="form-group">
                                <label for="committeeCode" class="col-sm-2 control-label"><b>Committee Code</b></label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?php echo $comData->code; ?>" class="form-control1" id="committeeCode" name="committeeCode" placeholder="Enter code">
                                    <?php echo form_error('committeeCode'); ?>
                                </div>
                            </div>
                            <?php if(!empty($comData->logo)){ ?>
  <div class="form-group">
  <label for="committeeCode" class="col-sm-2 control-label"><b>Existing Logo</b></label>
  
  <div class="col-sm-8">
      <div style="width: 125px; height: 125px;">
      <img src="<?php echo base_url().'contents/uploads/images/'.$comData->logo; ?>" style="width: 125px; height: 125px;">
  </div>
     </div>  
       </div>      
 <?php } ?>
                            
                            <div class="form-group">
                                <label for="committeeLogo" class="col-sm-2 control-label"><b>Committee Logo</b></label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control1" name="file_name" id="file" accept="image/*" >
                                    <?php echo form_error('committeeLogo'); ?>
                                    <input type="hidden" name="existingImg" value="<?php echo $comData->logo; ?>">
                                </div>
                            </div>
                            
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-success btn-lg" style="width:100px;">Update</button>
                            </div>

                       
                    </div>
                </div>
     <?php } } ?>
           
        </div>
    </div>
