            <div id="page-wrapper">
                <div class="graphs">
                    <h3 class="blank1">Create Sub Ledger</h3>
                     <style>
     /* custom csss */
                .form-errors 
                {
                    font-size: 14px;
                    padding: 10px;
                    color:red;
                }



                /* custom css ends*/

                </style>
                    <div class="tab-content">
                        <div class="tab-pane active" id="horizontal-form">
                            <?php echo form_open_multipart('chartAccount/addnewSubLedger', array('id' => '','class'=>'form-horizontal', 'novalidate'=>'novalidate'));?>
                            

                            <div class="form-group">
                                <label for="subledgerName" class="col-sm-2 control-label">Ledger Name</label>
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

              
                <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>

                            <th> Subledger Code </th>
                            <th> SubLedger NameList</th>

                        </tr>
                    </thead>
                     <tbody class="table table-striped  table-bordered table-condensed">
                                <?php foreach ($subLedgerInfo as $subledList){
                                   
                                    ?>

                                <tr>
                                    <td><?php echo $subledList->subledger_code; ?></td>
                                    <td><?php echo $subledList->subledger_name; ?></td>
                                   
                                    
                                </tr>
                                <?php  } ?>
                            </tbody>
                        </div>
            





            </div>
        </div>
    </div>
