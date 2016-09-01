<div id="page-wrapper">
    <div class="graphs">
        <h3 class="blank1">Data restore</h3>
        <div class="tab-content">
            <div class="tab-pane active" id="horizontal-form">
                <?php echo form_open_multipart('setting/restore', array('id' => '','class'=>'form-horizontal', 'novalidate'=>'novalidate'));?>
                
               <div class="form-group">
                                <label for="file" class="col-sm-2 control-label"><b>Upload database to restore</b></label>
                                <div class="col-sm-4">
                                    <input type="file" class="form-control1" name="file" id="file">
                                    
                                    <?php echo form_error('file'); ?>
                                </div>
                            </div>
                    
                
                    <div class="col-sm-2  col-sm-offset-2">
                            <button class="btn btn-success btn-lg" style=" margin-left: 3px; margin-top: -4px; width:100px;">Submit</button>
                           
                        </div>
   
                </form>
            </div>
        </div>


        
        
       
    </div>
</div>
</div>
