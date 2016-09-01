<div id="page-wrapper">
<div class="graphs">
<h3 class="blank1">Assign doner</h3>
<style>
/*sanoj custom csss */
.form-errors 
{
font-size: 14px;
padding: 10px;
color:red;
}
input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.3); /* IE */
  -moz-transform: scale(1.3); /* FF */
  -webkit-transform: scale(1.3); /* Safari and Chrome */
  -o-transform: scale(1.3); /* Opera */
  padding: 10px;
}


</style>


<div class="tab-content">
<div class="tab-pane active" id="horizontal-form">
<?php echo form_open_multipart('donars/addNewDonar',array('class'=>'form-horizontal', 'novalidate '=>'novalidate'));?>
<div class="form-group">
<label for="donarCode" class="col-sm-2 control-label"><b>Select Donor</b></label>
<div class="col-sm-8">
 <div class="form-group">
  <select class="form-control1" id="sel1" name="donerName">
    <option>Select  the Doner</option>
  <?php foreach($donars as $donerlist) 
  { ?>
    <option value="<?php echo $donerlist->id; ?>"><?php echo $donerlist->donar_name; ?></option>
 <?php } ?>
  </select>
</div>
</div>
</div>


<div class="form-group">
<label for="donarName" class="col-sm-2 control-label"><b>Budget (Rs)</b></label>
<div class="col-sm-8">
<input type="number" step="any" value="<?php echo set_value('Budget'); ?>" class="form-control1" id="Budget" name="Budget" placeholder="Enter Budget">
<?php echo form_error('donarName'); ?>
</div>
</div>

<div class="form-group">
<div class="col-sm-4 col-sm-offset-2">
<input style="padding-left:5px" type="checkbox" >  <span style="padding-left:10px; font-size:17px;">Assign self as a doner</span>
</div>
<div class="col-sm-4">
</div>

</div>
<div class="form-group">
<label for="donarName"  class="col-sm-2 control-label"><b>Amount (Rs)</b></label>
<div class="col-sm-8">
<input  type="number" step="any" value="<?php echo set_value('Amount'); ?>" class="form-control1" id="Budget" name="Amount" placeholder="Enter Amount">
<?php echo form_error('Amount'); ?>
</div>
</div>


<div class="col-sm-8 col-sm-offset-2">

<div class="col-sm-4">

<button class="btn btn-success btn-lg" style=" margin-left: 85px; margin-top: -2px; width:99px;">Assign</button>

</div>

<div class="col-sm-8">
<button class="btn btn-success btn-lg" style=" margin-left: -4px; margin-top: -2px; width:172px;">Add another Donar</button>
</div>
</div>

</form>
</div>
</div>






</div>
</div>
</div>
