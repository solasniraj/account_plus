<div id="page-wrapper">
    <div class="graphs">
        <h3 class="blank1">Add Program</h3>
        <div class="tab-content">
            <div class="tab-pane active" id="horizontal-form">
                <?php echo form_open_multipart('programs/addnewProgram', array('id' => '','class'=>'form-horizontal', 'novalidate'=>'novalidate'));?>
                
                    <div class="form-group">
                        <label for="code" class="col-sm-2 control-label">Program Code</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control1" id="code" name="code" placeholder="Enter program code">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="programName" class="col-sm-2 control-label">Program Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control1" id="programName" name="programName" placeholder="Enter program name">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="programBudget" class="col-sm-2 control-label">Estimated Budget</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control1" id="programBudget" name="programBudget" placeholder="Enter estimated budget">
                        </div>
                    </div>
                
                <div class="form-group">
                        <label for="category" class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control1" id="category" name="category" placeholder="Enter estimated budget">
                        </div>
                    </div>
                
                    <div class="col-sm-8 col-sm-offset-2">
                            <button class="btn-success btn">Submit</button>
                           
                        </div>
   
                </form>
            </div>
        </div>


        
        
       
    </div>
</div>
</div>
