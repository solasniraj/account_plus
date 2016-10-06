<SCRIPT TYPE = "text/javascript">
function popup(mylink, windowname) {
if (!window.focus)return true;
var href;
if (typeof(mylink) == 'string') href = mylink;
else href = mylink.href;
window.open(href, windowname, 'width=800,height=600,scrollbars=yes');
return false;
}

$(document).ready(function(){
$('.selectOpt').bind("change", function(){
  var account = $('#chartAccType').val();
  var accountLedger = $('#accLedger').val();
  var subLedger = $('#accSubLedger').val();
  var donor = $('#donorType').val();
  var ledgerType = $('#ledgerType').val();
  var accountCode = account+accountLedger+subLedger+donor+ledgerType;
  $('#codeNo').val(accountCode);
});


});

</SCRIPT>   <!--  main script is loaded  -->
<div id="page-wrapper">
                <div class="graphs">
                    <h3 class="blank1">Create Ledger</h3>
                     <style>
     /*custom csss */
                .form-errors 
                {
                    font-size: 14px;
                    padding: 10px;
                    color:red;
                }
               /* .bs-example4{
                    background-color: #8c8c8c;
                }*/
    


                /* custom css ends*/

                </style>
                    <div class="tab-content">
                         <?php
            $flashMessage = $this->session->flashdata('flashMessage');
            if (!empty($flashMessage)) {
                ?>
                <div class="alert alert-success fade in">
                    <p style="text-align:center;font-size:18px;"><strong><?php echo $flashMessage; ?> </strong></p>
                </div>
                <hr>
            <?php }
            ?>
                     <div class="bs-example4" data-example-id="simple-responsive-table">
                        <div class="tab-pane active" id="horizontal-form">
                            <?php echo form_open_multipart('ledger/addnewLedger', array('id' => '','class'=>'form-horizontal', 'novalidate'=>'novalidate'));?>
                            
                            
                            <div class="form-group">
                    <label class="col-sm-2 control-label" for="chartAccType"><h4>Account</h4></label>
                    <div class="col-sm-8"><select class="form-control1 selectOpt" id="chartAccType" name="chartAccType">
                            <option value="">Select Account</option>
                            <?php if (!empty($accountCharts)) {
     
                                foreach ($accountCharts as $acharts) {
                                    ?>
                                    <option value="<?php echo $acharts->chart_code; ?>"><?php echo $acharts->chart_class_name; ?></option>
    <?php }
} ?>
                        </select>
                     <?php echo form_error('chartAccType'); ?>
                    </div>
                </div>
                            
                            <div class="form-group">
                    <label class="col-sm-2 control-label" for="accLedger"><h4>Account Ledger</h4></label>
                    <div class="col-sm-8"><select class="form-control1 selectOpt" id="accLedger" name="accLedger">
                            <option value="00">Select Account Ledger</option>
                            <?php if (!empty($accountLedgers)) {
                                foreach ($accountLedgers as $aLedgers) {
                                    ?>
                                    <option value="<?php echo $aLedgers->ledger_code; ?>"><?php echo $aLedgers->ledger_code.'&nbsp;&nbsp;&nbsp;'.$aLedgers->ledger_name; ?></option>
    <?php }
} ?>
                        </select>
                     <?php echo form_error('accLedger'); ?>
                    </div>
                    <div class="col-sm-2"><a class="btn btn-default" href="<?php echo base_url().'chartAccount/addLedger' ?>" onClick="return popup(this, 'Ledger')"><strong style="color:red;">Create New</strong></a></div>
                </div>
                            
                            <div class="form-group">
                    <label class="col-sm-2 control-label" for="accSubLedger"><h4>Account Sub Ledger</h4></label>
                    <div class="col-sm-8"><select class="form-control1 selectOpt" id="accSubLedger" name="accSubLedger">
                            <option value="00">Select Account Sub Ledger</option>
                            <?php if (!empty($subLedgers)) {
                                foreach ($subLedgers as $aSLedgers) {
                                    ?>
                                    <option value="<?php echo $aSLedgers->subledger_code; ?>"><?php echo $aSLedgers->subledger_code.'&nbsp;&nbsp;&nbsp;'.$aSLedgers->subledger_name; ?></option>
    <?php }
} ?>
                        </select>
                     <?php echo form_error('accSubLedger'); ?>
                    </div>
                    <div class="col-sm-2"><a class="btn btn-default" href="<?php echo base_url().'chartAccount/addSubLedger' ?>" onClick="return popup(this, 'Sub Ledger')"><strong style="color: red;">Create New</strong></a></div>
                </div>
                            
                            <div class="form-group">
                    <label class="col-sm-2 control-label" for="donorType"><h4>Donor</h4></label>
                    <div class="col-sm-8"><select class="form-control1 selectOpt" id="donorType" name="donorType">
                            <option value="00">Select Donor</option>
                            <?php if (!empty($donorInfo)) {
                                foreach ($donorInfo as $dInfo) {
                                    ?>
                                    <option value="<?php echo $dInfo->donar_code; ?>"><?php echo $dInfo->donar_code.'&nbsp;&nbsp;&nbsp;'.$dInfo->donar_name; ?></option>
    <?php }
} ?>
                        </select>
                     <?php echo form_error('donorType'); ?>
                    </div>
                    <div class="col-sm-2"><a class="btn btn-default" href="<?php echo base_url().'donars/addDonar' ?>" onClick="return popup(this, 'Donor')"><strong style="color: red;">Create New</strong></a></div>
                </div>
                            
                            <div class="form-group">
                    <label class="col-sm-2 control-label" for="ledgerType"><h4>Ledger Type</h4></label>
                    <div class="col-sm-8"><select class="form-control1 selectOpt" id="ledgerType" name="ledgerType">
                            <option value="00">Select Ledger Type</option>
                            <option value="01">Cash</option>
                            <option value="02">Internal Cash</option>
                            <option value="03">Labour Support</option>
                        </select>
                     <?php echo form_error('ledgerType'); ?>
                    </div>
                </div>
                            
                                                     
                            
                            <div class="form-group">
                                <label for="codeNo" class="col-sm-2 control-label"><h4>Account Code</h4></label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?php echo set_value('codeNo'); ?>" class="form-control1" id="codeNo" name="codeNo" placeholder="" readonly="true" disabled="true">
                                    <?php echo form_error('codeNo'); ?>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="accDescription" class="col-sm-2 control-label"><h4>Account Description</h4></label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?php echo set_value('accDescription'); ?>" class="form-control1" id="accDescription" name="accDescription" placeholder="Enter Account Description">
                                    <?php echo form_error('accDescription'); ?>
                                </div>
                            </div>

                            <br>
                            
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-success btn-lg" style=" margin-left:628px; margin-top: -39px; width:100px;">Submit</button>
                            </div>

                       </div>
                    </div>
                </div>
            





            </div>
        </div>
    </div>
