<script>
     var typingTimer;
var doneTypingInterval = 200;
$(document).ready(function(){
$("#tags").on("input", function () {
    window.clearTimeout(typingTimer);
    typingTimer = window.setTimeout(doneTyping, doneTypingInterval);
});
});

function doneTyping () {
        var q = $("#tags").val();
        $.ajax({
            type: "POST",
            url: baseUrl + 'ledger/search',
            
            data: {'searchKey': q},
            success: function (data) {
               
                $("#testSearch").html(data);
               // toastr.success('Pager has been changed', "Success!");
            },
            error: function (jqXHR, exception) {
                ShowErrorMessage(jqXHR, exception);
            }
        });  
}
     
 </script>
 
 
 <style>
    ul.collection {
    padding: 1em;
}
ul.collection li{
    margin-bottom: 1em;
}
.activity_box h3 {
    background: #00bcd4 none repeat scroll 0 0;
    color: #fff;
    font-size: 1em;
    font-weight: 600;
    margin: 0;
    padding: 1em;
    text-align: left;
    text-transform: uppercase;
}
.btn btn-success{padding: 12px 14px 8px;}
</style><div id="page-wrapper">
    <div class="graphs">
        <h3 class="blank1">Ledger Account Details</h3>
        <div class="xs">
            <div class="col-md-4 email-list1">
                <div class="activity_box">
                    <h3><center>Search Panel</center></h3>
                    <ul class="collection">
                        <?php echo form_open_multipart('ledger/accountGrSearch'); ?>
                        <li>

                    
                    <select class="form-control1 selectOpt" id="chartAccType" name="chartAccType">
                            <option value="">Select Account</option>
                            <?php if (!empty($accountCharts)) {
                                foreach ($accountCharts as $acharts) {
                                    ?>
                                    <option value="<?php echo $acharts->chart_code; ?>"><?php echo $acharts->chart_class_name; ?></option>
    <?php }
} ?>
                        </select>
                     <?php echo form_error('chartAccType'); ?>
                    

                         <div class="clearfix"> </div>   
                        </li>

<li>
                        <select class="form-control1 selectOpt" id="accLedger" name="accLedger">
                            <option value="">Select Account Ledger</option>
                            <?php if (!empty($accountLedgers)) {
                                foreach ($accountLedgers as $aLedgers) {
                                    ?>
                                    <option value="<?php echo $aLedgers->ledger_code; ?>"><?php echo $aLedgers->ledger_code.'&nbsp;&nbsp;&nbsp;'.$aLedgers->ledger_name; ?></option>
    <?php }
} ?>
                        </select>
                     <?php echo form_error('accLedger'); ?>
                         
                            <div class="clearfix"> </div>
                        </li>


                        <li>
                           <select class="form-control1 selectOpt" id="accSubLedger" name="accSubLedger">
                            <option value="">Select Account Sub Ledger</option>
                            <?php if (!empty($subLedgers)) {
                                foreach ($subLedgers as $aSLedgers) {
                                    ?>
                                    <option value="<?php echo $aSLedgers->subledger_code; ?>"><?php echo $aSLedgers->subledger_code.'&nbsp;&nbsp;&nbsp;'.$aSLedgers->subledger_name; ?></option>
    <?php }
} ?>
                        </select>
                     <?php echo form_error('accSubLedger'); ?>
                      
                            <div class="clearfix"> </div>
                        </li>
                        
                        <li>
                           <select class="form-control1 selectOpt" id="donorType" name="donorType">
                            <option value="">Select Donor</option>
                            <?php if (!empty($donorInfo)) {
                                foreach ($donorInfo as $dInfo) {
                                    ?>
                                    <option value="<?php echo $dInfo->donar_code; ?>"><?php echo $dInfo->donar_code.'&nbsp;&nbsp;&nbsp;'.$dInfo->donar_name; ?></option>
    <?php }
} ?>
                        </select>
                     <?php echo form_error('donorType'); ?>
                      
                            <div class="clearfix"> </div>
                        </li>
                        
                        <li>
                          <select class="form-control1 selectOpt" id="ledgerType" name="ledgerType">
                            <option value="">Select Ledger Type</option>
                            <option value="01">Cash</option>
                            <option value="02">Internal Cash</option>
                            <option value="03">Labour Support</option>
                        </select>
                     <?php echo form_error('ledgerType'); ?>
                      
                            <div class="clearfix"> </div>
                        </li>
                        
                          <li>
                          
                        <button class="btn btn-success btn-lg" style="width:100%;">Submit</button>
                      
                            <div class="clearfix"> </div>
                        </li>
                        
                        <?php echo form_close(); ?>
                    </ul>
                </div>	
            </div>
            <div class="col-md-8 inbox_right">
                <?php echo form_open_multipart('ledger/accountGroupSearch'); ?>
                    <div class="input-group input-group-ind">
                        <input id="tags" type="text" placeholder="Search by Ledger Account Heading or code..." class="form-control1 input-search" name="search" required>
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-success"><i class="fa fa-search icon-ser"></i></button>
                        </span>
                    </div><!-- Input Group -->
                   <?php echo form_close(); ?>
                
                <div class="mailbox-content">
                    <table class="table table-bordered table-fhr">
                        <thead>
                            <tr>
                                <th>Ledger Code</th>
                                <th>Ledger Account Heading</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="testSearch">
                            <?php
                            if (!empty($ledgerDetails)) {
                                foreach ($ledgerDetails as $lAList) {
                                    ?>		
                                    <tr>


                                        <td><?php echo $lAList->ledger_master_code; ?></td>
                                        <td><?php echo $lAList->ledger_master_name; ?></td>

                                        <td><a href="#">Edit</a> / <a href="#">Delete</a></td>
                                    </tr>
                                <?php }
                            }
                            ?>

                        </tbody>
                    </table>

                </div>
            </div>
            <div class="clearfix"> </div>
        </div>

    </div>
</div>
</div>

