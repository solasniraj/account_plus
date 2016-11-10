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
} ?>



        <div class="text-center" style="padding: 5px 0px 5px 0px;margin-bottom: 15px;">

            <table class="table-striped table-bordered table-condensed" width="100%" cellspacing="0">
                <tr>
                    <td colspan="2"><h3>Bank reconciliation</h3> 
                        
                    </td>
                </tr>
                <tr>
        <td> <?php echo "Name Of Bank : ".$bank; ?></td>  
       <td><?php echo "Bank Account Number :"; ?></td>
    </tr>
                <tr>
        <td>From : <?php echo $fromN. ' (' .$fromE. ') '; ?></td>  
       <td>To : <?php echo $toN. ' (' .$toE. ') '; ?></td>
    </tr>


            </table>
            
            <table class="table-striped table-bordered table-condensed" width="100%" cellspacing="0">
                <tr>
                    <th>Reconcile Date</th>
                     <th>Beginning Balance</th>
                     <th>Ending Balance</th>
                     <th>Account Total</th>
                     <th>Reconciled Amount</th>
                     <th>Difference</th>
                </tr>
                <tr>
        <td> <?php echo $todayN; ?></td>  
       <td>0.00</td>
       <td><?php echo $amount; ?></td>  
       <td>0.00</td>
       <td>0.00</td>
       <td>0.00</td>
    </tr>


            </table>
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
            <div data-example-id="simple-responsive-table" class="bs-example4">

                <div class="table-responsive">
                    <table class="table table-bordered">
                        
                        <thead>
                            <tr>
                                <th>Date</th>	
                                <th>Journal Number</th>
                                <th>Description</th>
                                <th>Debit</th>
                                <th>Credit </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                	
                                	
                               

                            </tr>

                           

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

