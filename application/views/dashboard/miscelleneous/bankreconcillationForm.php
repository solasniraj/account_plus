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
                    <th style="width: 15%">Balance as per bank statement</th>
                    <th style="width: 15%">uncashed cheque amount (reduce)</th>
                    <th style="width: 15%">undeposited amount (add)</th>
                    <th style="width: 15%">Total</th>
                    <th style="width: 15%">Amount as per cash book</th>
                    <th style="width: 10%">Difference</th>
                </tr>
                <tr>
                    <td style="width: 15%"> <?php echo $todayN; ?></td>  
                    <td style="width: 15%">0.00</td>
                    <td style="width: 15%"><?php echo $amount; ?></td>  
                    <td style="width: 15%">0.00</td>
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
                    <table class="table table-bordered">

                        <thead>
                            <tr>
                                <th colspan="4">Undeposited amount</th>
                                <th colspan="5">uncashed cheque</th>
                            </tr>
                            <tr>
                                <th>Date</th>	
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Action</th>
                                <th>Date</th>	
                                <th>Name</th>
                                <th>cheque no</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>                       	

                            </tr>
                            <tr>
                                <td colspan="2">Total</td>
                                <td></td>
                                <td></td>
                                <td colspan="3">Total</td>
                                <td></td>
                                <td></td>
                            </tr>



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

