            <div id="page-wrapper">
                <div class="graphs">
                    <h3 class="blank1">Add Sub Ledger to Program </h3>
                    
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
                            <?php echo form_open_multipart('programs/addSubLedger', array('id' => '','class'=>'form-horizontal', 'novalidate'=>'novalidate'));?>

                            <div class="form-group">
                                <label for="subLedgerName" class="col-sm-2 control-label"><b>Sub-ledger Name</b></label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?php echo set_value('subLedgerName'); ?>" class="form-control1" id="subLedgerName" name="subLedgerName" placeholder="Enter sub ledger name">
                                    <?php echo form_error('subLedgerName'); ?>
                                     <?php echo form_hidden('program_id',$program_id);?>
                                </div>
                            </div>

                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn btn-success btn-lg" style=" margin-left: 0px; margin-top: -4px; width:100px;">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            





            </div>
                <div class="clearfix"></div>
                <br/><br/>
            <div class="graphs">
                    <h3 class="blank1">Sub ledgers under program </h3>
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
                        <?php if(!empty($subledgerInfo)){ ?>
                        <table class="table table-striped table-bordered table-condensed">

                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Sub Ledger </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($subledgerInfo as $sllist){ ?>
                                <tr>
                                    <td><?php echo $sllist->subledger_code; ?></td>
                                    <td><?php echo $sllist->subledger_name; ?></td>
                                    <td>Edit / Delete</td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <?php } ?>
                </div>
            





            </div>
            </div>
    </div>
