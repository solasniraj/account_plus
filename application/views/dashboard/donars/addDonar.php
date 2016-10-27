            <div id="page-wrapper">
                <div class="graphs">
                    <h3 class="blank1">Add Fund Donor</h3>
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
                    <div class="tab-pane active" id="horizontal-form">
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
                                <label for="contactPCellNo" class="col-sm-2 control-label"><b>Contact Person Contact No.</b></label>

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
   <br><br> <br>
            
            <div class="table-responsive"  style="width:100%">
                <div class="" style="width:100%">
                <table class="table table-bordered">
                    <thead>
                        <tr>

                            <th><b>Donar Name  </b></th>
                            <th><b>Donar Address </b></th>
                            <th><b>Donar Contact no</b></th>
                            <th><b>Donar Donar code </b></th>
                            <th><b>Donar  Email</b></th>
                            <th><b>Contact person</b></th>
                            <th><b>contact cell no  </b></th>

                        </tr>
                    </thead>

             <tbody class="table table-striped  table-bordered table-condensed">
                                <?php foreach ($donarInfo as $doList){
                                   
                                    ?>

                                <tr>
                                    <td><h5><?php echo $doList->donar_name; ?></h5></td>
                                    <td><h5><?php echo $doList->donar_address; ?></h5></td>
                                     <td><h5><?php echo $doList->donar_contact_no; ?></h5></td>
                                      <td><h5><?php echo $doList->donar_code; ?></h5></td>
                                       <td><h5><?php echo $doList->donar_email; ?></h5></td>
                                        <td><h5><?php echo $doList->contact_person; ?></h5></td>
                                         <td><h5><?php echo $doList->contact_person_cell_no; ?></h5></td>
                                   
                                    
                                </tr>
                                <?php  } ?>
                            </tbody>





            </div>
        </div>
    </div>
