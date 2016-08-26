<div id="page-wrapper">
    <div class="graphs">
        <div class="xs tabls">
            <?php
            $flashMessage = $this->session->flashdata('flashMessage');
            if (!empty($flashMessage)) {
                ?>
                <div class="alert alert-success fade in">
                    <p style="text-align:center;font-size:18px;"><strong>!!&nbsp;<?php echo $flashMessage; ?> </strong></p>
                </div>
                <hr>
            <?php }
            ?>

            <!-- CSSS AND JS FOR JQUERY DATEPICKER IMPLEMENTATION  -->

            <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
            
            <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
            <script>
                $(function () {
                    $(".datepicker").datepicker();
                });
            </script>





            <!-- END OF LOADED CSSS AND JAVASCITP -->
            <br>
            <br>
            <h3 class="blank1 text-center"> Bank Reconcillation Entry</h3>

            <div data-example-id="simple-responsive-table" class="bs-example4">
                <?php echo form_open_multipart('miscelleneous/showReconcillationForm', array('id' => '','class'=>'form-horizontal', 'novalidate'=>'novalidate'));?>
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed table-striped">
                        <thead>
                            <tr>


                                <th>Date&nbsp;(From)</th>
                                <th>Date&nbsp;(To)</th>
                                <th>Bank  Account</th>
                                <th>Bank Balance based on Statement</th>


                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input class="form-control datepicker" type="text" name="formDate"></td>
                                <td><input class="form-control datepicker" type="text" name="toDate"></td>

                                <td>
                                    <select class="form-control" id="sel1" name="bankName">
                                        <option value="">Select Bank Account</option>
                                        <?php 
                                        if (!empty($bankAccount)) {
                                            foreach ($bankAccount as $bAccount) { ?>
                                        <option value="<?php echo $bAccount->id; ?>"><?php echo $bAccount->bank_name; ?></option>      
                                        <?php    } 
                                      }
                                        ?>
                                       
                                    </select>
                                </td>
                                <td><input class="form-control" style="width:150px;display:inline;"  type="text" name="amount">
                                    <input type="submit" style=" margin-left: 3px;margin-top: -4px;" class="btn-success btn"  value="Submit"/></td>







                            </tr>


                        </tbody>
                    </table>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
</div>
