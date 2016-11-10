<script type="text/javascript" src="<?php echo base_url('contents/js/nepali.datepicker.v2.1.min.js'); ?>"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('contents/css/nepali.datepicker.v2.1.min.css'); ?>" />
<script type="text/javascript" src="<?php echo base_url('contents/js/function.js'); ?>"></script>
<div id="page-wrapper">
    <div class="graphs">

        <?php
        $fiscal_year = $this->session->userdata('fiscal_year');
        $value = str_replace('/', '&#47;', $fiscal_year);
        $fy = urlencode($value);
        if (!empty($committeeInfo)) {
            foreach ($committeeInfo as $cLists) {
                ?>

                <main class="flex-center">
                    <?php if (!empty($cLists->logo)) { ?>
                        <div>
                            <img src="<?php echo base_url() . 'contents/uploads/images/' . $cLists->logo; ?>" height="60"/>
                        </div>
                    <?php } ?>
                    <div>
                        <h4><?php echo $cLists->committee_name; ?></h4>
                        <p><?php echo $cLists->address; ?></p>
                        <h5>Phone : <?php echo $cLists->phone; ?></h5>

                    </div>
                </main>    
            <?php }
        }
        ?>



        <div class="text-center" style="padding: 5px 0px 5px 0px;margin-bottom: 15px;">

            <table class="table-striped table-bordered table-condensed" width="100%" cellspacing="0">
                <tr>
                    <td colspan="2"><h3>Bank reconciliation</h3> 

                    </td>
                </tr>
                <tr>
                    <td> <?php echo "Name Of Bank : " . $bank; ?></td>  
                    <td><?php echo "Bank Account Number :"; ?></td>
                </tr>
                <tr>
                    <td>From : <?php echo $fromN . ' (' . $fromE . ') '; ?></td>  
                    <td>To : <?php echo $toN . ' (' . $toE . ') '; ?></td>
                </tr>


            </table>
            <br/>
            <table class="table-striped table-bordered table-condensed" width="100%" cellspacing="0">
                <tr>
                    <th style="width: 15%">Reconcile Date</th>
                    <th style="width: 15%">Begining Balance</th>
                    <th style="width: 15%">Ending Balance</th>
                    <th style="width: 15%">Account Total</th>
                    <th style="width: 15%">Reconciled Amount</th>
                    <th style="width: 15%">Difference</th>
                    
                </tr>
                <tr>
                    <td style="width: 15%"> <?php echo $todayN; ?></td>  
                    <td style="width: 15%">0.00</td>
                    <td style="width: 15%">0.00</td>
                    <td style="width: 15%"><?php echo $amount; ?></td>  
                    <td style="width: 15%">0.00</td>
                    <td style="width: 15%">0.00</td>
                    <td style="width: 10%">0.00</td>
                </tr>


            </table>
            <br/>
        </div>


        <div class="clearfix"></div>
        <div class="xs tabls">
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
            <div data-example-id="simple-responsive-table">

                <div class="table-responsive">
                    <?php if(!empty($bankTrans)){ ?>
                    <table class="table table-bordered">

                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Voucher No.</th>
                                <th>Description</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Action<br/> (choose transction to reconcile)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($bankTrans as $bTrans){ ?> 
                            <tr>
                                <td><?php echo $bTrans->trans_date; ?></td> 
                                <td><?php echo $bTrans->trans_no; ?></td>
                                <td><?php echo $bTrans->memo; ?></td>
                                <td style="width: 15%;"><?php if($bTrans->type=='dr'){echo abs($bTrans->amount);} ?></td>
                                <td style="width: 15%;"><?php if($bTrans->type=='cr'){echo abs($bTrans->amount);} ?></td>
                                <td><input type="checkbox" name="reconcile" class="" value="1"></td>
                            </tr>
                            <?php } ?>
                            



                        </tbody>
                    </table>
                    
                    
                   

                        <div class="lastButton">
                            <button id="submitTheForm" class="btn btn-success btn-lg" style=" margin-left: 3px;"
                                    value="Submit">Rconcile Bank Transactions</button>
                        </div>

                   
                    
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

