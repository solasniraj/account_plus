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
<?php echo form_open_multipart('donars/assignToProgram',array('class'=>'form-horizontal', 'novalidate '=>'novalidate'));?>
    <input type="hidden" value="<?php echo $programId; ?>" name="programId">
    <div class="form-group">
<label for="donorName" class="col-sm-2 control-label"><b>Select Donor</b></label>
<div class="col-sm-8">
 <div class="form-group">
  <select class="form-control1" id="donorName" name="donorName">
    <option>Select  the Doner</option>
  <?php foreach($donars as $donerlist) 
  { ?>
    <option value="<?php echo $donerlist->id; ?>"><?php echo $donerlist->donar_name; ?></option>
 <?php } ?>
  </select>
     <?php echo form_error('donorName'); ?>
</div>
</div>
</div>


<div class="form-group">
<label for="budget" class="col-sm-2 control-label"><b>Budget Amount in Rs.</b></label>
<div class="col-sm-8">
<input type="number" step="any" value="<?php echo set_value('budget'); ?>" class="form-control1" id="budget" name="budget" placeholder="Enter Budget">
<?php echo form_error('budget'); ?>
</div>
</div>


<div class="col-sm-8 col-sm-offset-2">

<div class="col-sm-4">
<button class="btn btn-success btn-lg" style=" margin-left: 85px; margin-top: -2px; width:99px;">Assign</button>
</div>

</div>

</form>
</div>
</div>
</div>
    
    <div class="clearfix"></div>
                <br/><br/>
            <div class="graphs">
                    <h3 class="blank1">Assigned Donors to the program</h3>
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
                        <?php if(!empty($assignedDonors)){ ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Donor Code</th>
                                    <th>Donor </th>
                                    <th>Budget Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($assignedDonors as $dnrlist){
                                    $donar = $this->donar_model->get_donor_info($dnrlist->donar_id);
                                    foreach ($donar as $lsDnr){
                                    ?>

                                <tr>
                                    <td><?php echo $lsDnr->donar_code; ?></td>
                                    <td><?php echo $lsDnr->donar_name; ?></td>
                                    <td><?php echo $dnrlist->donation_amount; ?></td>
                                    <td>Edit / Delete</td>
                                </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                        <?php } ?>
                </div>
            





            </div>
    
    
    
    
    
</div>
</div>
