            <div id="page-wrapper">
                <div class="graphs">
                    <h3 class="blank1">Add Account Headings</h3>
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
                            <?php echo form_open_multipart('programs/addnewProgram', array('id' => '','class'=>'form-horizontal', 'novalidate'=>'novalidate'));?>
                            

                            <div class="form-group">
                                <label for="programName" class="col-sm-2 control-label"><b>Account Heading</b></label>
                                <div class="col-sm-4">
                                    <input type="text" value="<?php echo set_value('programName'); ?>" class="form-control1" id="programName" name="programName" placeholder="Enter account heading">
                                    <?php echo form_error('programName'); ?>
                                </div>
                            </div>

                            
                            
                            
                            <div class="col-sm-8 col-sm-offset-2">
                                   <div class="lastButton">
                                                <button class="btn btn-success btn-lg" style=" margin-left: 3px; margin-top: -4px; width:100px;">Submit</button>
                                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            





            </div>
        </div>
    </div>
