            <div id="page-wrapper">
                <div class="graphs">
                    <h3 class="blank1">Add Ledger</h3>
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
                            <?php echo form_open_multipart('ledger/addnewLedger', array('id' => '','class'=>'form-horizontal', 'novalidate'=>'novalidate'));?>
                            

                            <div class="form-group">
                                <label for="ledgerName" class="col-sm-2 control-label">Ledger Name</label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?php echo set_value('ledgerName'); ?>" class="form-control1" id="programName" name="ledgerName" placeholder="Enter ledger name">
                                    <?php echo form_error('ledgerName'); ?>
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
