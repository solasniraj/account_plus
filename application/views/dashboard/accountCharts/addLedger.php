            <div id="page-wrapper">
                <div class="graphs">
                    <h3 class="blank1">Create Account Ledger</h3>

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
                            <?php echo form_open_multipart('chartAccount/addnewLedger', array('id' => '','class'=>'form-horizontal', 'novalidate'=>'novalidate'));?>
                            

                            <div class="form-group">
                                <label for="ledgerName" class="col-sm-2 control-label">Ledger Name</label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?php echo set_value('ledgerName'); ?>" class="form-control1" id="ledgerName" name="ledgerName" placeholder="Enter ledger name">
                                    <?php echo form_error('ledgerName'); ?>
                                </div>
                            </div>
                           

                            
                            
                            
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn-success btn-lg">Submit</button>
                            </div>

                        
                    </div>
                </div>

                <br><br> <br>
            

 <div class="table-responsive" style="width: 100%">
 <div class="" style="width:95%">
                <table class="table table-bordered">
                    <thead>
                        <tr>

                            <th class="row-1 row-code"> <b>Ledger Code  </b></th>
                            <th class="row-1 row-name"><b>Ledger NameList </b></th>

                        </tr>
                    </thead>
                    <tbody class="table table-striped  table-bordered table-condensed">
                                <?php foreach ($ledgerInfo as $ledList){
                                   
                                    ?>

                                <tr>
                                    <td><h5><?php echo $ledList->ledger_code; ?></h5></td>
                                    <td><h5><?php echo $ledList->ledger_name; ?></h5></td>
                                   
                                    
                                </tr>
                                <?php  } ?>
                            </tbody>
                            </table>
                        </div>
                       









            </div>
        </div>
    </div>
