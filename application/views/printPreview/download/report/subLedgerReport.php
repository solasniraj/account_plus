<div style="margin-bottom: 15px;float: left;width: 100%;">
        <?php if(!empty($committeeInfo)){ foreach ($committeeInfo as $cLists){ ?>
        <main class="flex-center" style="margin-top:22px;margin-bottom:10px;width: 100%;float: left;">
           <?php if(!empty($cLists->logo)){ ?>
            <div style="width:6.5%;float:left;">
      <img src="<?php echo $_SERVER["DOCUMENT_ROOT"].'/account_plus/contents/uploads/images/'.$cLists->logo; ?>" style="float: left;width: 100%;"/>
  </div>
    <?php } ?>
           <div style="float: left;width: 80%;">
    <h3><?php echo $cLists->committee_name; ?></h3>
                        <p><?php echo $cLists->address; ?></p>
                        <h5>Phone : <?php echo $cLists->phone; ?></h5>
                         
  </div>
     </main>
        <?php }} ?>
    </div>
<div class="clear"></div>

<table class="tables">
    <tr>
        <td colspan="3"><h3>Sub-ledger Account Statement</h3> </td>
    </tr>
    <tr>
         <?php if(!empty($subLedgerDetails)){ ?>

                    <?php foreach($subLedgerDetails as $slDets){ ?>
        <td>Sub Ledger Code : <?php echo $slDets->subledger_code; ?></td>
        <td>Sub Ledger Description : <?php echo $slDets->subledger_name; ?></td>
        <?php } }?>
        <td><P>Balance : <strong>Rs. </strong></p></td>
    </tr>
    <tr>
        <td>From : <?php echo $fromN. ' (' .$fromE. ') '; ?></td>      
        <td>To : <?php echo $toN. ' ('. $toE .')'; ?></td>
        <td>Printed on : <?php echo $todayN. ' (' .$todayE. ') '; ?></td>
    </tr>
   
</table>                           
                    <table class="tables">
            <thead>
                <tr>
                                       
                    <th style="width: 15%;">Date</th>
                    <th style="width: 25%;">Journal No.</th>
                    <th style="width: 25%;">A/C Particulars</th>
                    <th style="width: 10%;">Debit (Rs.)</th>
                    <th style="width: 10%;">Credit (Rs.)</th>
                    <th style="width: 15%;">Balance</th>                           
                </tr>
            </thead>
            <tbody>
                <?php 
                 $sum ='0';             
                if(!empty($ledgerRep)){
                    foreach($ledgerRep as $lEntries){
                       
                        ?>
                <tr>
               

                     
                    <td style="width: 15%;"><?php echo $lEntries->tran_date; ?></td>
                    <td style="width: 25%;"><?php echo $lEntries->journal_voucher_no; ?></td>
                    <td style="width: 25%;"><?php echo $lEntries->memo; ?></td>
                     <td style="width: 10%;"><?php if($lEntries->trans_type=='dr'){echo abs($lEntries->amount); $sum += abs($lEntries->amount);} ?></td>
                    <td style="width: 10%;"><?php if($lEntries->trans_type=='cr'){echo abs($lEntries->amount); $sum -= abs($lEntries->amount);} ?></td>
                    <td style="width: 15%;"><?php echo $sum; ?></td>
                </tr> 
               
                    <?php } ?>
                <?php } else{ echo "<tr><td colspan='6'><strong>No entries are found</td></tr>";} ?>
            </tbody>
 
            
        </table>

               
               
