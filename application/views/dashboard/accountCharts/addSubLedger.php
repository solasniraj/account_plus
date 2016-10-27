            <div id="page-wrapper">
                <div class="graphs">
                    <h3 class="blank1">Create Sub Ledger</h3>

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
                            <?php echo form_open_multipart('chartAccount/addnewSubLedger', array('id' => '','class'=>'form-horizontal', 'novalidate'=>'novalidate'));?>
                            

                            <div class="form-group">
                                <label for="subledgerName" class="col-sm-2 control-label">Sub-Ledger Name</label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?php echo set_value('subledgerName'); ?>" class="form-control1" id="subledgerName" name="subledgerName" placeholder="Enter sub ledger name">
                                    <?php echo form_error('subledgerName'); ?>
                                </div>
                            </div>

                            
                            
                            
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn-success btn-lg">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
                <br>
<br><br>
              
                <div class="table-responsive" style="width:100%">
                <div class="" style="width:95%">
                <table class="table table-bordered">
                    <thead>
                        <tr>

                            <th><b> Subledger Code </b></th>
                            <th><b> SubLedger NameList</b></th>

                        </tr>
                    </thead>
                     <tbody class="table table-striped  table-bordered table-condensed">
                                <?php foreach ($subLedgerInfo as $subledList){
                                   
                                    ?>

                                <tr>
                                    <td><h5><?php echo $subledList->subledger_code; ?></h5></td>
                                    <td><h5><?php echo $subledList->subledger_name; ?></h5></td>
                                   
                                    
                                </tr>
                                <?php  } ?>
                            </tbody>
                        </div>
            





            </div>
        </div>
    </div>
