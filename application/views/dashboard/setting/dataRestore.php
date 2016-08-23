<div id="page-wrapper">
    <div class="graphs">
        <h3 class="blank1">Data restore</h3>
        <div class="tab-content">
            <div class="tab-pane active" id="horizontal-form">
                <?php echo form_open_multipart('setting/restore', array('id' => '','class'=>'form-horizontal', 'novalidate'=>'novalidate'));?>
                
               <div class="form-group">
                                <label for="file" class="col-sm-2 control-label">Upload database to restore</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control1" name="file" id="file">
                                    
                                    <?php echo form_error('file'); ?>
                                </div>
                            </div>
                    
                
                    <div class="col-sm-8 col-sm-offset-2">
                            <button class="btn-success btn">Backup Now</button>
                           
                        </div>
   
                </form>
            </div>
        </div>


        
        
       
    </div>
</div>
</div>
