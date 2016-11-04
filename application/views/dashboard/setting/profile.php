            <div id="page-wrapper">
                <div class="graphs">

                    <h3 class="blank1">User Deatils</h3>
                    
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
                        <?php if(!empty($userDeatils))foreach ($userDeatils as $uDetails) ?>
                       <div class="bs-example4" data-example-id="simple-responsive-table">
                          <div class="tab-pane active" id="horizontal-form">
                            <?php echo form_open_multipart('setting/updateUserInfo', array('id' => '','class'=>'form-horizontal', 'novalidate'=>'novalidate'));?>
                            
                            
                            <div class="form-group">
                                <label for="userName" class="col-sm-2 control-label"><b>Username</b></label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?php echo $uDetails->user_name; ?>" class="form-control1" id="userName" name="userName" placeholder="Enter Name">
                                     <?php echo form_error('userName'); ?>
                                </div>
                            </div>

                               <div class="form-group">
                                <label for="fullName" class="col-sm-2 control-label"><b>Full Name</b></label>
                                <div class="col-sm-8">
                    <input type="text" value="<?php echo $uDetails->full_name; ?>" class="form-control1" id="fullName" name="fullName" placeholder="Enter Full Name">
                                    <?php echo form_error('fullName'); ?>
                                </div>
                            </div>  
                            
                            <div class="form-group">
                                <label for="emailId" class="col-sm-2 control-label"><b>Email ID</b></label>
                                <div class="col-sm-8">
                                    <input type="email" value="<?php echo $uDetails->email_address; ?>" class="form-control1" id="emailId" name="emailId" placeholder="Enter Email">
                                    <?php echo form_error('emailId'); ?>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="contactNumber" class="col-sm-2 control-label"><b>Contact Number</b></label>
                                <div class="col-sm-8">
                                <input type="text" value="<?php echo $uDetails->contact_no; ?>"
                                     class="form-control1" id="contactNumber" name="contactNumber" placeholder="Enter Contact Number">
                                    <?php echo form_error('contactNumber'); ?>
                                </div>
                            </div>
                            
                            
                            
                            <div class="form-group">
                             <label for="contactPerson" class="col-sm-2 control-label"><b>Password</b>
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?php echo '*********'; ?>" class="form-control1" id="contactPerson" name="contactPerson" placeholder="Enter Name">
                                    <?php echo form_error('contactPerson'); ?>
                                    <a href="#">Change password</a>
                                </div>
                            </div>
                            
                            
                            
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-success btn-lg" style="width:100px;">Update</button>
                            </div>

                        
                    </div>
                </div>
                        <?php  ?>
                        
                </div>
            
        </div>
    </div>
